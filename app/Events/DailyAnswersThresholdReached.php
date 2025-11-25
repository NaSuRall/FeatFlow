<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Survey;


class DailyAnswersThresholdReached
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Survey $survey;
    public int $answersCount;


    /**
     * Create a new event instance.
     * 
     * @param Survey $survey
     * @param int $answersCount
     */
    public function __construct(Survey $survey, int $answersCount)
    {
        $this->survey = $survey;
        $this->answersCount = $answersCount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */ 
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
