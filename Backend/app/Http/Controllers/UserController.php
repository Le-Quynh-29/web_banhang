<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Traits\ShopStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    use ShopStorage;
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(! Gate::allows('pmss--user-index'),403);
        $users = $this->userRepository->listUser($request, false);
        return view('user/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(! Gate::allows('pmss--user-create'),403);
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->userRepository->storeUser($request);
        toastr()->success('Thêm mới người dùng ' . $request->fullname . ' thành công.', 'Thông báo');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(! Gate::allows('pmss--user-detail'),403);
        $user = $this->userRepository->find($id);
        abort_if(is_null($user),404);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(! Gate::allows('pmss--user-update'),403);
        $user = $this->userRepository->find($id);
        abort_if(is_null($user),404);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userRepository->find($id);
        abort_if(is_null($user),404);
        if (!is_null($user->image)) {
            $this->deleteFile($user->image);
        }
        $this->userRepository->delete($id);
        toastr()->success('Xóa tài khoản '. $user->username . 'thành công.', 'Thông báo');
        return redirect()->back();
    }

    /**
     * handel unlock or lock
     */
    public function unlockOrLock($id, Request $request)
    {
        $user = $this->userRepository->find($id);
        abort_if(is_null($user),404);
        $notification = $this->userRepository->updateActive($user, $request->active);
        toastr()->success($notification, 'Thông báo');
        return redirect()->back();
    }

    /**
     * Profile
     */
    public function profile()
    {
        abort_if(! Gate::allows('pmss--user-info'),403);
        abort_if(is_null(auth()->user()), 404);
        $user = auth()->user();
        return view('auth/profile', compact('user'));
    }

    /**
     * Edit profile
     */
    public function editProfile()
    {
        abort_if(! Gate::allows('pmss--user-update'),403);
        abort_if(is_null(auth()->user()), 404);
        $user = auth()->user();
        return view('auth/edit-profile', compact('user'));
    }
}
