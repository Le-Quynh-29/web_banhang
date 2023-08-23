<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\SaveLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use SaveLog;

    /**
     * view login
     * @return mixed
     */
    public function viewLogin()
    {
        $yearCurrent = Carbon::now()->format('Y');
        return response()->view('auth.login', compact('yearCurrent'));
    }

    /**
     * login
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        $auth = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = $request->remember == 'on';
        if (Auth::attempt($auth, $remember)) {
            $request->session()->regenerate();
            $user = Auth::guard()->user();

            // Create log
            $event = 'Đăng nhập';
            $this->createLog($event, $user);
            toastr()->success('Đăng nhập thành công.', 'Thông báo!');
            return redirect()->route('dashboard');
        }
    }

    /**
     * check error login
     * @param Request $request
     * @return mixed
     */
    public function checkErrorLogin(Request $request)
    {
        $user = User::query()->where('email', $request->email)
            ->where('password_raw', $request->password)->first();
        if (is_null($user)) {
            return response()->json('Thông tin đăng nhập không chính xác.', 401);
        }
        if (!in_array($user->role, [User::ROLE_ADMIN, User::ROLE_CTV])) {
            return response()->json('Không có quyền truy cập.', 401);
        } elseif ($user->active == User::NO_ACTIVE) {
            return response()->json('Tài khoản bị vô hiệu hóa.', 401);
        }
        return response()->json('Đăng nhập thành công.', 200);
    }

    /**
     * logout
     * @return mixed
     */
    public function logout()
    {
        if (Auth::id() !== null) {
            $user = Auth::guard()->user();
            $event = 'Đăng xuất';
            $this->createLog($event, $user);
            Auth::logout();
            toastr()->success('Đăng xuất thành công.', 'Thông báo!');
        } else {
            toastr()->error('Tài khoản đang đăng nhập ở nơi khác.', 'Lỗi!');
        }

        return redirect()->route('login');
    }
}
