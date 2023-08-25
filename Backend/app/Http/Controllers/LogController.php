<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Repositories\LogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        abort_if(! Gate::allows('pmss--log-index'),403);
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
        abort_if(! Gate::allows('pmss--log-detail'),403);
        $log = $this->logRepo->find($id);
        abort_if(is_null($log),404);
        return view('log/show', compact('log'));
    }
}
