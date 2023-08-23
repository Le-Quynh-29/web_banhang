<?php

namespace App\Repositories;

use App\Repositories\Support\AbstractRepository;
use Illuminate\Container\Container as App;

class PermissionRepository extends AbstractRepository
{
    public function model()
    {
        return 'App\Models\Permission';
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * get permission by module
     *
     * @return mixed
     */
    public function getAll() {
        return $this->model->orderBy('module')->get()->groupBy('module');
    }
}
