<?php
namespace App\Repositories;

use App\Repositories\Support\AbstractRepository;
use Illuminate\Container\Container as App;

class UserRepository extends AbstractRepository
{
    public function model()
    {
        return 'App\Models\User';
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function listUser($request, $toArray = false, $with = []){
        $orderBy      = is_null($request->get('order_by')) ? "id" : $request->get('order_by');
        $orderArr     = explode(',', $orderBy);
        $sortBy       = in_array($request->get('sort_by'), ['asc','desc']) ? $request->get('sort_by') : 'desc';
        $searchBy     = $request->get('search_by');
        $searchText   = $request->get('search_text');
        $active       = $request->get('active');
        $role         = $request->get('role');
        $data         = $this->model::select('*')->distinct();
        if (sizeof($with) > 0) {
            $withParams = '';
            foreach ($with as $key => $value) {
                $withParams .= $value;
                if ($key < sizeof($with) - 1) {
                    $withParams .= ',';
                }
            }
            $data = $data->with($withParams);
        }

        foreach ($orderArr as $order) {
            $data = $data->orderBy($order, $sortBy);
        }

        if (!empty($role)) {
            if (in_array((int)$role,[$this->model::ROLE_ADMIN,$this->model::ROLE_CUSTOMER])) {
                $data = $data->where('role', '=', $role);
            } 
        }

        if (!empty($searchBy)) {
            if (in_array((int)$active,[$this->model::NO_ACTIVE,$this->model::ACTIVE])) {
                $data = $data->where('active', '<>', $active)->where($searchBy, 'LIKE', "%$searchText%");
            } else {
                $data = $data->where($searchBy, 'LIKE', "%$searchText%");
            }
        }

        if ($toArray) {
            return $data->paginate(self::PAGE_SIZE)->getCollection()->toArray();
        }

        return $data->paginate(self::PAGE_SIZE);
    }
}
