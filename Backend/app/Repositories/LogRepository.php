<?php

namespace App\Repositories;

use App\Models\Log;
use App\Repositories\Support\AbstractRepository;
use Illuminate\Container\Container as App;
use Illuminate\Http\Request;

class LogRepository extends AbstractRepository
{
    public function model()
    {
        return 'App\Models\Log';
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * Get list log
     * @param Request $request
     * @param bool $toArray
     * @param array $with
     * @return mixed
     */
    public function getListLog($request, $toArray = false, $with = [])
    {
        $user = $request->get('search_user_id');
        $module = $request->get('module');

        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $data = parent::all($request, null);

        if (!is_null($user)) {
            if ($user !== '') {
                $userId = json_decode(html_entity_decode($user))[0]->id;
                $data = $data->where('user_id', $userId);
            }
        }

        if (!is_null($startDate) && !is_null($endDate)) {
            $data = $data->where(function ($key) use ($startDate, $endDate) {
                $key->where('created_at', '>=', $startDate)
                    ->where('created_at', '<=', $endDate)
                    ->orWhere('created_at', 'LIKE', '%' . $startDate . '%')
                    ->orWhere('created_at', 'LIKE', '%' . $endDate . '%');
            });
        } else {
            if (!is_null($startDate) && is_null($endDate)) {
                $data = $data->where(function ($key) use ($startDate) {
                    $key->where('created_at', '>=', $startDate)
                        ->orWhere('created_at', 'LIKE', '%' . $startDate . '%');
                });
            } else if (is_null($startDate) && !is_null($endDate)) {
                $data = $data->where(function ($key) use ($endDate) {
                    $key->where('created_at', '<=', $endDate)
                        ->orWhere('created_at', 'LIKE', '%' . $endDate . '%');
                });
            }
        }

        if (!is_null($module)) {
            switch ($module) {
                case 'DM':
                    $data = $data->where('event', 'LIKE', '%' . Log::SEARCH_DM . '%');
                    break;
                case 'DH':
                    $data = $data->where('event', 'LIKE', '%' . Log::SEARCH_DH . '%');
                    break;
                case 'MGG':
                    $data = $data->where('event', 'LIKE', '%' . Log::SEARCH_MGG . '%');
                    break;
                case 'SP':
                    $data = $data->where('event', 'LIKE', '%' . Log::SEARCH_SP . '%');
                    break;
            }
        }

        return $data->paginate(self::PAGE_SIZE);
    }
}
