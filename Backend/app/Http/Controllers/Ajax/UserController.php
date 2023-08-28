<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserRequest;
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
     * Update user
     *
     * @param UserRequest $request
     * @return mixed
     */
    public function update(UserRequest $request)
    {
        $id = $request->get('id');
        $user = $this->userRepo->find($id);
        abort_if(is_null($user), 404);
        $data = $request->except(['_token', '_method', '_url']);
        $pathImage = $this->userRepo->updateUser($data);
        return $this->responseSuccess($pathImage);
    }

    /**
     * Update profile
     *
     * @param ProfileRequest $request
     * @return mixed
     */
    public function updateProfile(ProfileRequest $request)
    {
        $user = $this->userRepo->find(auth()->id());
        abort_if(is_null($user), 404);
        $data = $request->except(['_token', '_method', '_url']);
        $pathImage = $this->userRepo->updateProfile($data);
        return $this->responseSuccess($pathImage);
    }

    /**
     * Check validate current password
     *
     * @param Request $request
     * @return mixed
     */
    public function checkValidateCurrentPassword(Request $request) {
        $input = $request->get('password');
        $data = $this->userRepo->checkValidateCurrentPassword($input);
        return $this->responseSuccess($data);
    }

    /**
     * Change password
     *
     * @param Request $request
     * @return mixed
     */
    public function changePassword(Request $request) {
        $input = $request->all();
        $this->userRepo->changePassword($input);
        return $this->responseSuccess('success');
    }
}
