<?php

namespace App\Console\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Console\Command;

use App\Activeplans;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class PlanCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:cron';

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
        $endDate = Carbon::today()->addDays(6)->format('Y-m-d H:i:s');
        $plan = Activeplans::whereDate('end','=',$endDate)
        ->join('users','users.id','active_plans.user_id')
        ->select('active_plans.end','users.email','users.name as username')
        ->get()->toArray();
        if(is_array($plan) && count($plan) > 0){
            $url =  URL::to('/','public');
            $price =  URL::to('public/pricing');
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <trueb1pn@truebooksoft.com>' . "\r\n";
            $subject = 'Plan Expiring Notification';
            foreach ($plan as $key => $pl) {
                $data = array(
                    'name' => $pl['username'],
                    'email' => $pl['email'],
                    'expireDate' => date('d F, Y',strtotime($pl['end'])),
                );
                try {
                    $html = '<html style="width:100%;font-family:arial,helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Micro Investors</title><link href="https://fonts.googleapis.com/css?family=Niramit:300,400,500,600,700&amp;display=swap" rel="stylesheet"></head><body style="margin:0;"><div style="width:100%;display:block;float:left;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;font-family: \'Niramit\', sans-serif;"><div style="max-width:640px;margin:0 auto;"><div style="width:100%;display:block;float:left;text-align:center;background-color:#1f86ef;"> <img src="http://truebooksoft.com/investor/public/assets/img/logo.png" alt="Micro Investors" style="max-width:175px;padding:12px 0;display:block;margin:0 auto;"></div><div style="clear:both;"></div><div style="background-color:#f8f8f8;padding:40px 32px 0;width:100%;display:block;float:left;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;"><div style="clear:both;"></div><div style="width:100%;display:block;float:left;background:#fff;padding: 30px 24px;margin:15px 0 24px;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;"><div style="clear:both;"></div><h2 style="width:100%;display:block;float:left;color:#1f86ef;font-size:24px;line-height:30px;font-weight:bold;font-stretch:normal;font-style:normal;letter-spacing:normal;margin:0;">Dear '.ucfirst($data['name']).',</h2><p style="width:100%;display:block;float:left;margin:8px 0 0;color:#666666;font-size:18px;line-height:25px;font-weight:bold;font-stretch:normal;font-style:normal;letter-spacing:normal;/* text-align: center; */"> Your current plan will expire on '.$data['expireDate'].'. Click the button below to renew your plan.</p><div style="clear:both;"></div><p style="/* text-align: center; */margin-top:45px;">
                        <a href='.$price.' 
                        style="color:#fff;font-size:18px;line-height:26px;font-weight:normal;font-stretch:normal;font-style:normal;padding:15px 50px;letter-spacing:normal;margin:0;text-decoration:none;background:#1f86ef;">BUY NOW</a></p><p style="width:100%;display:block;float:left;margin:20px 0;color:#666666;font-size:14px;line-height:26px;font-weight:normal;font-stretch:normal;font-style:normal;letter-spacing:normal;/* text-align: center; */">Thankyou for choosing us.</p></div><div style="clear:both;"></div><p style="width:100%;display:block;float:left;margin:0;color:#666666;font-size:14px;line-height:26px;font-weight:normal;font-stretch:normal;font-style:normal;letter-spacing:normal;">The Micro Investors Team,</p><div style="clear:both;"></div><div style="width:100%;display:block;float:left;margin:0;"> <a href="'.$url.'" style="color:#1f86ef;font-size:14px;line-height:26px;font-weight:normal;font-stretch:normal;font-style:normal;letter-spacing:normal;display:block;margin:0;text-decoration:none;">'.$url.'</a></div><div style="clear:both;"></div></div><div style="width:100%;display:block;float:left;margin:24px 0 0;padding:40px 30px 32px;background:#222;box-sizing: border-box"><div style="text-align: center;"> <a style="color:#fff;text-decoration:none;padding:5px 18px;" href="'.$url.'">Visit Website</a></div></div></div></div></body></html>';
                    $s = mail($pl['email'],$subject,$html,$headers);
                    \Log::info($s);
                    \Log::info($pl['email']);

                } catch (Exception $e) {
                    
                }
                echo $html;
            }
        }
    }
}
