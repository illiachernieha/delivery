<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DelayedOrderCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkDelays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check delayed offers';

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
        $timeNow = Carbon::now()->format('H:i:s');

        $delayedOrders = DB::table('orders')
            ->select('id', 'expected_time')
            ->where('expected_time', '<', $timeNow)
            ->get();

        foreach ($delayedOrders as $orders) {
            DB::table('delayed_orders')
                ->insertOrIgnore([
                    'order_id' => $orders->id,
                    'expected_time' => $orders->expected_time,
                    'current_time' => $timeNow,
                ]);
        }
    }
}
