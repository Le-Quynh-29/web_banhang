<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Support\AbstractRepository;
use Illuminate\Container\Container as App;

class RoleRepository extends AbstractRepository
{
    public function model()
    {
        return 'App\Models\Role';
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
    }
}
