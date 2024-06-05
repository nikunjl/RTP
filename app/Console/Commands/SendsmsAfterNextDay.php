<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Notification;
use App\Models\User;

class SendsmsAfterNextDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sendsms-after-next-day';

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
        \Log::info(\Carbon\Carbon::now()->format('H'));
        $data = Order::where('shift_name','9to2')->where('order_status',2)->whereDate('created_at',\Carbon\Carbon::now()->subDays(1)->format('Y-m-d'))->where('is_sms_sended',0)->get();
        if(!empty($data)) {
            foreach ($data as $key => $value) {
                $order = Order::where('order_id',$value->order_id)->update(['is_sms_sended' => 1]);

                $getuser = Order::select('user_id','totalnet')->where('order_id',$value->order_id)->first();
                $usertoken = User::select('notification_token')->where('id',$getuser->user_id)->first();
                $message = 'Kindly send '.$getuser->totalnet.' grams of gold for your order number '.$value->order_id.' – RTP';
                $this->sendmessage($usertoken->notification_token,$message,$getuser->user_id,'Send notification 9to2 shift');
            }
        }
        $datatwo = Order::where('shift_name','2to7')->where('order_status',2)->whereDate('created_at',\Carbon\Carbon::now()->subDays(2)->format('Y-m-d'))->where('is_sms_sended',0)->get();
        if(!empty($datatwo)) {
            foreach ($datatwo as $key => $values) {
                $order = Order::where('order_id',$values->order_id)->update(['is_sms_sended' => 1]);

                $getuser = Order::select('user_id','totalnet')->where('order_id',$values->order_id)->first();
                $usertoken = User::select('notification_token')->where('id',$getuser->user_id)->first();
                $message = 'Kindly send '.$getuser->totalnet.' grams of gold for your order number '.$values->order_id.' – RTP';
                $this->sendmessage($usertoken->notification_token,$message,$getuser->user_id,'Send notification 2to7 shift');
            }
        }
    }

      public function sendmessage($token,$message,$user,$type = '') {
        $tokenList = $token;
        $template_key = 'AAAAppC8lg0:APA91bFR2OFdI977xFCwa1vdXNg5GsIhTW76ulF0mG7MEr7J8-L0oNhHggdHzSJEA0UqTkNFWDLB8Ta8tZW088h2lb7IdELcumPH6vT5cbeIakKXPMAK2L1k6KJz7yHgCm27yEcDF30T';
        $imssss = '';
        $msg = $message;
        $title = $message;
        $user = $user;
        $sd = '{
                "to": "'.$tokenList.'",
                "data": {
                    "message": "'.$msg.'",
                    "title": "'.$title.'",
                    "users_id": "'.$user.'",
                    "ischat": 1,
                    "type": "'.$type.'",
                    "img": "'.$imssss.'"
                }
            }';
        
        // echo "<pre>"; print_r($sd);exit;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$sd,
          CURLOPT_HTTPHEADER => array(
            'Authorization: key='.$template_key,
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $newnotification = New Notification();
        $newnotification->title = $type;
        $newnotification->type = $type;
        $newnotification->img = '';
        $newnotification->message = $message;
        $newnotification->ischat = 0;
        $newnotification->user_id = $user;
        $newnotification->created_by = 0;
        $newnotification->save();
        // echo $response;
    }
}
