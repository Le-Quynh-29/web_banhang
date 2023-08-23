<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Repositories\LogRepository;
use Illuminate\Http\Request;

class LogController extends Controller
{
    protected $logRepo;

    public function __construct(LogRepository $logRepo)
    {
        $this->logRepo = $logRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $logs = $this->logRepo->getListLog($request, false);
        $user = $request->get('search_user_id');
        $userTagify = json_encode([]);
        if (!is_null($user)) {
            if ($user !== '') {
                $userTagify = $request->get('search_user_id');
            }
        }
        return view('log/index', compact('logs', 'userTagify'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $log = $this->logRepo->find($id);
        if (is_null($log)) {
            abort(404);
        }
        return view('log/show', compact('log'));
    }
}
