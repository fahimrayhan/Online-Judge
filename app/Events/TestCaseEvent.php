<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestCaseEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($testCase)
    {
        $this->message = json_encode([
            'id'              => $testCase->id,
            'input'           => nl2br($testCase->input),
            'output'          => nl2br($testCase->output),
            'expected_output' => nl2br($testCase->expected_output),
            'time'            => $testCase->time,
            'memory'          => $testCase->memory,
            'passed_point'    => $testCase->passed_point,
            'checker_log'     => nl2br($testCase->checker_log),
            'compiler_log'    => nl2br($testCase->compiler_log),
            'verdict_id'      => $testCase->verdict_id,
            'verdict_status'  => $testCase->verdict->statusClass(),
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('submission');
    }

    public function broadcastAs()
    {
        return 'testcase';
    }
}
