<?php

namespace App\Mail;

use App\Models\NmapRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScanStarted extends Mailable
{
    use Queueable, SerializesModels;

    public $nmapRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(NmapRequest $nmapRequest)
    {
        $this->nmapRequest = $nmapRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Scan Has Started: ' . $this->nmapRequest->target)
                    ->markdown('emails.scans.scan_started');
    }
}
