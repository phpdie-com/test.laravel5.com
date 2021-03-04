<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testCommand 
                            {carrier_id?}        
                            {startday?}         
                            {endday?}
                            {--tracking_no=}';

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
     * @return mixed
     */
    public function handle()
    {
        $carrier_id = $this->argument('carrier_id');
        $startday = $this->argument('startday');
        $endday = $this->argument('endday');

        $tracking_no=$this->option('tracking_no');

        dump('carrier_id'.$carrier_id);
        dump('startday'.$startday);
        dump('endday'.$endday);
        dump('tracking_no'.$tracking_no);

    }
}
