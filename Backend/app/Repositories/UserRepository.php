<?php
namespace App\Repositories;

use App\Repositories\Support\AbstractRepository;
use Illuminate\Container\Container as App;

class UserRepository extends AbstractRepository
{
    public function model()
    {
        return 'App\Model\User';
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
    }
}
