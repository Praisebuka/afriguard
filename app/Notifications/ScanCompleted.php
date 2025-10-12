<?php

namespace App\Notifications;

use App\Models\NmapRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ScanCompleted extends Notification
{
    use Queueable;

    protected $nmapRequest;

    /**
     * Create a new notification instance.
     *
     * @param NmapRequest $nmapRequest
     * @return void
     */
    public function __construct(NmapRequest $nmapRequest)
    {
        $this->nmapRequest = $nmapRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Nmap Scan Completed')
            ->line('Your Nmap scan for target ' . $this->nmapRequest->target . ' has completed.')
            ->line('Status: ' . ucfirst($this->nmapRequest->status));

        if ($this->nmapRequest->status === 'completed') {
            $results = json_decode($this->nmapRequest->result, true);
            $message->line('Found ' . count($results['ports']) . ' open ports.');
        } elseif ($this->nmapRequest->status === 'failed') {
            $results = json_decode($this->nmapRequest->result, true);
            $message->line('Error: ' . ($results['error'] ?? 'Unknown error'));
        }

        return $message->action('View Results', url('/scan-results/' . $this->nmapRequest->id));
    }
}