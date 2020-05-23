<?php


namespace App\Library;


use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;

class Helpers
{
    public static function getState($state)
    {
        switch ($state){
            case "Completed":
                $state="تکمیل شده";
                break;
            case "referred":
                $state="ارجاع شده";
                break;
            case "doing":
                $state=" درحال انجام";
                break;
            case "incompleted":
                $state="نیمه تمام";
                break;
        }

        return $state;
    }

    public static function getDay($row)
    {

        $diff=Carbon::now()->diffInDays($row->expire_date,false);
        if($diff<0)
            return abs($diff)."روز قبل";
        if ($diff==0)
        {
            $diff=Carbon::now()->diffInHours($row->expire_date,false);
            if($diff<0)
                return  abs($diff)."ساعت قبل";
            else{
                if ($diff==0)
                {
                    $diff=Carbon::now()->diffInMinutes($row->expire_date,false);
                    if($diff==0)
                    {
                        return 'مهلت به اتمام رسیده ';
                    }
                    if($diff<0)
                        return  abs($diff)." دقیقه گذشته";
                    else
                        return  $diff." دقیقه مانده";
                }
                return  $diff."ساعت مانده";
            }
        }
        return $diff.'روز مانده';
    }

    public static function shamsi($date)
    {
        return Verta::instance($date)->format('Y-m-d');
    }
    public static function Summarize($text)
    {
        return mb_substr($text,0,20,'UTF-8')."...";
    }

    public static function getDayNum($row)
    {
        return Carbon::now()->diffForHumans($row->expire_date);
    }



}
