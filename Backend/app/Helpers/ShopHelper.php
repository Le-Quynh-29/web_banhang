<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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

    /**
     * convert name to slug string
     * @param string $value
     * @return mixed
     */
    public static function createSlug($value) {
        return Str::slug($value, '-');
    }

    /**
     * Check validate unique
     *
     * @param string $table
     * @param string $column
     * @param mixed $id
     * @param string $textCheck
     * @return boolean
     */
    public static function validateUnique($table, $column, $id, $textCheck)
    {
        $data = DB::table($table)->where($column, $textCheck);

        if (!is_null($id)) {
            $data = $data->where('id', '<>', $id);
        }
        $data = $data->get();

        if (sizeof($data) == 0) {
            return true;
        }
        return false;
    }

    /**
     * format phone number
     * @param string $phoneNumber
     * @return mixed
     */
    public static function formatPhoneNumber($phoneNumber)
    {
        $strPhoneNumber = '';
        if (!is_null($phoneNumber)) {
            $splitPhoneNumber = str_split($phoneNumber);
            if ($splitPhoneNumber[0] == '+') {
                $matchOne = substr($phoneNumber, 0, 5);
                $matchTwo = substr($phoneNumber, 5, 3);
                $matchThree = substr($phoneNumber, 8, 4);
                $strPhoneNumber =  $matchOne . '-' . $matchTwo . '-' . $matchThree;
            } else {
                $matchOne = substr($phoneNumber, 0, 3);
                $matchTwo = substr($phoneNumber, 3, 3);
                $matchThree = substr($phoneNumber, 6, 4);
                $strPhoneNumber =  $matchOne . '-' . $matchTwo . '-' . $matchThree;
            }
        }
        return $strPhoneNumber;
    }
}
