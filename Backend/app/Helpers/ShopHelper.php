<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

class ShopHelper
{
    /**
     * format date => DD/MM/YYYY
     * @param $time
     * @return mixed
     */
    public static function formatTime($time)
    {
        if(is_null($time)) {
            $timeFormat = null;
        }else{
            if (is_string($time)) {
                $time = strtotime($time);
                $timeFormat = date('d/m/Y', $time);
            } else {
                $timeFormat = $time->format('d/m/Y');
            }
        }
        return $timeFormat;
    }

    /**
     * format date DD/MM/YYYY => YYYY-MM-DD
     * @param string $date
     * @return mixed
     */
    public static function formatDate($date) {
        if (!is_null($date) && $date != "") {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        }
        return null;
    }

    /**
     * format time YYYY-MM-DD HH:ii:ss => DD/MM/YYYY HH:ii:ss
     * @param string $time
     * @return mixed
     */
    public static function covertDateTimeDetail($time) {
        if(!is_null($time)) {
            if(str_contains($time, '/')){
                return $time;
            }else{
                return Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('d/m/Y H:i:s');
            }
        }
        return '';
    }
}
