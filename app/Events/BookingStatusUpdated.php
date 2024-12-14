<?php

namespace App\Events;
use App\Models\GuestHouseBooking;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\BroadcastEvent;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $booking;
    /**
     * Create a new event instance.
     */

    public function __construct(GuestHouseBooking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('guest-house-bookings'),
        ];
    }
    public function broadcastAs()
    {
        return 'booking-status-updated';
    }
    public function broadcastWith()
    {
        return [
            'id' => $this->booking->id,
            'status' => $this->booking->status,
        ];
    }
}
