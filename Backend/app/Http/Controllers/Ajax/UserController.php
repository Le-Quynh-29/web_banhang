<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Ajax\AjaxController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends AjaxController
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * user autocomplete
     *
     * @param Request $request
     * @return mixed
     */
    public function autocomplete(Request $request) {
        $input = $request->get('input');
        $data = $this->userRepo->autocomplete($input);
        if (sizeof($data) > 0) {
            return $this->responseSuccess($data);
        } else {
            return $this->responseError(true);
        }
    }

    /**
     * Update user
     *
     * @return mixed
     */
    public function update(Request $request)
    {
        $id = $request->get('id');
        $user = $this->userRepo->find($id);
        abort_if(is_null($user), 404);
        $data = $request->except(['_token', '_method', '_url']);
        $this->userRepo->updateUser($data);
        return $this->responseSuccess('success');
    }
}
