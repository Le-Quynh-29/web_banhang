<?php

use App\Models\Log;
use \Illuminate\Support\Facades\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

if (!function_exists('createLog')) {
    function createLog($event, $data)
    {
        Log::insert([
            'event' => $event,
            'user_id' => Auth::id(),
            'user_agent' => Request::userAgent(),
            'ip_address' => Request::ip(),
            'data' => json_encode($data),
            'created_at' => Carbon::now()
        ]);
    }
}
