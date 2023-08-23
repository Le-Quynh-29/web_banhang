<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
        $users = $this->userRepository->listUser($request, false);
        $message = $request->session()->get('message', '');
        return view('user/index', compact('users', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user =  $this->userRepository->store($request);
        $message = 'Thêm mới người dùng ' . $request->fullname . ' thành công';
        return redirect()->route('user.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user =  $this->userRepository->find($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user =  $this->userRepository->find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $message = 'Cập nhật người dùng ' . $request->fullname . ' thành công';
        $user = $this->userRepository->update($request->all(), $id);
        if (!$user[0]) {
            return redirect()->back()->withErrors($user[1])->withInput();
        }
        return redirect()->route('user.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userRepository->find($id);
        $this->userRepository->delete($id);
        deleteFileHepler($user->image);
        return response()->json(
            [
                'message' => 'Xóa ' . $user->fullname . ' thành công',
                'status' => 200
            ],
            200
        );
    }
    /**
     * handel unlock or lock
     */
    public function unlockOrlock(Request $request)
    {
        $user = $this->userRepository->find($request->id);
        $user = $this->userRepository->updateActive($user, $request->active);
        return response()->json(
            [
                'message' => 'Cập nhật trạng thái tài khoản ' . $user->fullname . ' thành công',
                'data' => view('user.render-action', compact('user'))->render(),
                'status' => 200
            ],
            200
        );
    }
}
