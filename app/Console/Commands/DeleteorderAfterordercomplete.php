<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Order;
use App\Models\OrderDetail;

class DeleteorderAfterordercomplete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deleteorder-afterordercomplete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        $data = Order::whereNotNull('order_update_at')->get();
        // \Log::info($data);
        if(!empty($data)) {
            foreach ($data as $key => $value) {
                // $punch_inn_time     = '2024-04-29 18:36';
                $punch_inn_time     = \Carbon\Carbon::parse($value->order_update_at)->format('Y-m-d H:i');
                $punch_outt_time    = date('Y-m-d H:i');

                $work_mins = 0;
                if (!empty($punch_inn_time) && !empty($punch_outt_time) && $punch_inn_time != $punch_outt_time) {
                    $start              = strtotime($punch_inn_time);
                    $end                = strtotime($punch_outt_time);
                    $work_mins          = round(($end - $start) / 60);
                }
                // \Log::info($work_mins);
                if($work_mins > 780) {
                    Order::where('order_id',$value->order_id)->delete();
                    OrderDetail::where('order_id',$value->id)->delete();
                }
            }
        }        
    }
}
