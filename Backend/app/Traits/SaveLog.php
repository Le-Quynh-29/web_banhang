<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Request;

trait SaveLog
{
    private function createLog($event, $data)
    {
        $user = Auth::guard()->user();
        DB::table('logs')->insert([
            'event' => $event,
            'user_id' => $user->id,
            'user_agent' => Request::userAgent(),
            'ip_address' => Request::ip(),
            'data' => json_encode($data, JSON_UNESCAPED_UNICODE),
            'created_at' => Carbon::now()
        ]);
    }
}
