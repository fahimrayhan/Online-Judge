<?php

namespace App\Console\Commands\JudgeProcess;

use Illuminate\Console\Command;

class cron5 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judge_process:cron5';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new \App\Services\Judge\JudgeProcessService(5))->multiProcess();
        return 0;
    }
}
