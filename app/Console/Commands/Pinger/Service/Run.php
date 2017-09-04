<?php

namespace App\Console\Commands\Pinger\Service;

use Illuminate\Console\Command;
use Pinger\Checks\Controllers\Checks;
use Pinger\Services\Models\Service;

class Run extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pinger-service:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run active services';

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
     * @return mixed
     */
    public function handle()
    {
        $services = (new Service())->allActive();

        if (!empty($services)) {

            $Checks = new Checks();

            foreach ($services as $service) {
                $methodInstance = $Checks->getMethodInstance($service);
                $result = $methodInstance->process()->result();

                echo $service->title .': ' . intval($result) . "\r\n";

                $methodInstance->notify();
            }
        }
    }
}
