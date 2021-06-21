<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SubmissionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($submission, $testCases)
    {
        $data               = [];
        $data['submission'] = [
            'id'            => $submission->id,
            'time'          => $submission->time,
            'memory'        => $submission->memory,
            'verdict_id'    => $submission->verdict_id,
            'verdict_label' => $submission->verdictStatus(),
        ];
        $data['testcases'] = [];

        foreach ($testCases as $key => $testCase) {
            array_push($data['testcases'], $this->getTestCase($testCase));   
        }

        $this->message = json_encode($data);

    }

    public function getTestCase($testCase)
    {
        return [
            'id'              => $testCase->id,
            'time'            => $testCase->time,
            'memory'          => $testCase->memory,
            'verdict_id'      => $testCase->verdict_id,
            'passed_point'    => $testCase->passed_point,
            'verdict_status'  => $testCase->verdict->statusClass(),
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('submission-channel');
    }

    public function broadcastAs()
    {
        return 'submission-event';
    }
}
