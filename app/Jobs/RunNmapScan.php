<?php

namespace App\Jobs;

use App\Models\NmapRequest;
use App\Notifications\ScanCompleted;
use App\Services\NmapScanner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RunNmapScan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $nmapRequest;

    /**
     * Create a new job instance.
     *
     * @param NmapRequest $nmapRequest
     * @return void
     */
    public function __construct(NmapRequest $nmapRequest)
    {
        $this->nmapRequest = $nmapRequest;
    }

    /**
     * Execute the job.
     *
     * @param NmapScanner $scanner
     * @return void
     */
    public function handle(NmapScanner $scanner)
    {
        try {
            // Update status to processing
            $this->nmapRequest->update([
                'status' => 'processing',
                'started_at' => now(),
            ]);

            // Run the scan
            $result = $scanner->scanTarget($this->nmapRequest->target);

            // Update the request with results
            $this->nmapRequest->update([
                'status' => $result['status'] === 'success' ? 'completed' : 'failed',
                'output_file' => $result['data']['report_file'] ?? null,
                'result' => $result['status'] === 'success' ? json_encode($result['data']) : json_encode(['error' => $result['message']]),
                'completed_at' => now(),
            ]);

            // Notify the user
            $this->nmapRequest->user->notify(new ScanCompleted($this->nmapRequest));

        } catch (\Exception $e) {
            Log::error('Nmap scan job failed: ' . $e->getMessage());
            $this->nmapRequest->update([
                'status' => 'failed',
                'result' => json_encode(['error' => $e->getMessage()]),
                'completed_at' => now(),
            ]);

            // Notify the user of failure
            $this->nmapRequest->user->notify(new ScanCompleted($this->nmapRequest));
        }
    }
    
}
