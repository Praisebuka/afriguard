<?php

namespace App\Jobs;

use App\Models\NmapRequest;
use App\Mail\ScanStarted;
use App\Mail\ScanCompletedMvp;
use App\Notifications\ScanStartedNotification;
use App\Notifications\ScanCompletedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
     * @return void
     */
    public function handle()
    {
        # we are no longer running the actual scan.

        try {
            # pdate status to processing
            $this->nmapRequest->update([
                'status' => 'processing',
                'started_at' => now(),
            ]);

            # send "Scan Started" email
            $user = $this->nmapRequest->user;
            Mail::to($user->email)->send(new ScanStarted($this->nmapRequest));

            # send "Scan Started" in-app (offline) notification
            $user->notify(new ScanStartedNotification($this->nmapRequest));

            # wait for 5 minutes (300 seconds) - This is our MVP simulation
            sleep(300);

            # create FAKE vulnerability data for the MVP
            $fakeResults = [
                'target' => $this->nmapRequest->target,
                'status' => 'completed',
                'summary' => 'Scan completed. 3 potential vulnerabilities found.',
                'ports' => [
                    [
                        'port' => '80',
                        'protocol' => 'tcp',
                        'state' => 'open',
                        'service' => 'http',
                        'product' => 'Apache httpd',
                        'version' => '2.4.41',
                        'vulnerability' => 'Potential Cross-Site Scripting (XSS). Recommend upgrading and sanitizing inputs.'
                    ],
                    [
                        'port' => '443',
                        'protocol' => 'tcp',
                        'state' => 'open',
                        'service' => 'https',
                        'product' => 'OpenSSL',
                        'version' => '1.1.1',
                        'vulnerability' => 'Outdated Version. Recommend patching to latest OpenSSL version.'
                    ],
                    [
                        'port' => '22',
                        'protocol' => 'tcp',
                        'state' => 'open',
                        'service' => 'ssh',
                        'product' => 'OpenSSH',
                        'version' => '7.4',
                        'vulnerability' => 'Weak ciphers enabled. Recommend updating sshd_config.'
                    ]
                ],
                'timestamp' => now()->toIso8601String(),
            ];

            # update the request with "completed" status and fake results
            $this->nmapRequest->update([
                'status' => 'completed',
                'result' => json_encode($fakeResults), # store our fake JSON results
                'completed_at' => now(),
            ]);

            # send "Scan Completed" email
            Mail::to($user->email)->send(new ScanCompletedMvp($this->nmapRequest));
            
            # send "Scan Completed" in-app notification
            $user->notify(new ScanCompletedNotification($this->nmapRequest));

        } catch (\Exception $e) {
            Log::error('MVP Scan job failed: ' . $e->getMessage());
            $this->nmapRequest->update([ 'status' => 'failed', 'result' => json_encode(['error' => 'An internal error occurred during the scan simulation.']), 'completed_at' => now(), ]);
        }
    }
}
