<?php

namespace App\Notifications;

use App\Models\NmapRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ScanCompletedNotification extends Notification
{
    use Queueable;

    protected $nmapRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(NmapRequest $nmapRequest)
    {
        $this->nmapRequest = $nmapRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'Scan Completed!',
            'message' => 'Your scan for ' . $this->nmapRequest->target . ' is complete. View the report now.',
            'url' => '/dashboard/scan/' . $this->nmapRequest->id,
            'target' => $this->nmapRequest->target,
        ];
    }
}
