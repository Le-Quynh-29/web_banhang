<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Support\AbstractRepository;
use App\Traits\SaveLog;
use App\Traits\ShopStorage;
use Illuminate\Container\Container as App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends AbstractRepository
{
    use SaveLog, ShopStorage;

    public function model()
    {
        return 'App\Models\User';
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * Get list user
     *
     * @param Request $request
     * @param bool $toArray
     * @param array $with
     * @return mixed
     */
    public function listUser($request, $toArray = false, $with = [])
    {
        $orderBy = is_null($request->get('order_by')) ? "id" : $request->get('order_by');
        $orderArr = explode(',', $orderBy);
        $sortBy = in_array($request->get('sort_by'), ['asc', 'desc']) ? $request->get('sort_by') : 'desc';
        $searchBy = $request->get('search_by');
        $searchText = $request->get('search_text');
        $active = $request->get('active');
        $role = $request->get('role');
        $data = $this->model::select('*')->distinct();
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
            if (in_array((int)$role, [$this->model::ROLE_ADMIN, $this->model::ROLE_CTV])) {
                $data = $data->where('role', '=', $role);
            }
        }

        if (!empty($searchBy)) {
            if (in_array((int)$active, [$this->model::NO_ACTIVE, $this->model::ACTIVE])) {
                $data = $data->where('active', '<>', $active)->where($searchBy, 'LIKE', "%$searchText%");
            } else {
                $data = $data->where($searchBy, 'LIKE', "%$searchText%");
            }
        }

        if ($toArray) {
            return $data->paginate(self::PAGE_SIZE)->getCollection()->toArray();
        }

        $data = $data->whereIn('role', [User::ROLE_ADMIN, User::ROLE_CTV]);

        return $data->paginate(self::PAGE_SIZE);
    }

    /**
     * Create User
     *
     * @param Request $request
     * @return void
     */
    public function storeUser($request)
    {
        $pathInfo = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $pathInfo = $this->uploadFile($imageFile, 'users');
        }

        $active = $request->active == 'on' ? 1 : 0;
        $event = "Thêm mới người dùng";
        $data = [
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'active' => $active,
            'password' => Hash::make($request->password),
            'password_raw' => $request->password,
            'image' => $pathInfo,
        ];
        $this->model::create($data);
        $this->createLog($event, $data);
    }

    /**
     * Edit User
     *
     * @param array $data
     * @return mixed
     */
    public function updateUser($data)
    {
        $id = $data['id'];
        $user = $this->model::findOrFail($id);
        $oldUser = $user->getOriginal();
        $active = $data['active'] == 'on' ? 1 : 0;
        $datas = [
            'username' => $data['username'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'phone_number' => $data['phone_number'],
            'role' => $data['role'],
            'active' => $active,
            'password' => Hash::make($data['password']),
            'password_raw' => $data['password']
        ];

        if (!is_null($data['image'])) {
            $user->image ? $this->deleteFile($user->image) : '';
            $imageFile = $data['image'];
            $pathInfo = $this->uploadFile($imageFile, 'users');
            $datas['image'] = $pathInfo;
        } else {
            $datas['image'] = $user->image;
        }

        $user->update($datas);
        $event = "Cập nhật người dùng";
        $dataLog = [
            'old' => $oldUser,
            'new' => $datas
        ];
        $this->createLog($event, $dataLog);
        return base64_encode('app/' . $datas['image']);
    }

    /**
     * Update user active
     *
     * @param User $user
     * @param $active
     * @return mixed
     */
    public function updateActive($user, $active)
    {
        $event = 'Cập nhật người dùng';
        if($active == '1') {
            $notification = 'Kích hoạt tài khoản ' .$user->username . ' thành công.';
            $dataLog = [
                'user_id' => $user->id,
                'user_name' => $user->username,
                'active' => 'Kích hoạt tài khoản'
            ];
        } else {
            $notification = 'Vô hiệu hóa tài khoản ' .$user->username . ' thành công.';
            $dataLog = [
                'user_id' => $user->id,
                'user_name' => $user->username,
                'active' => 'Vô hiệu hóa tài khoản'
            ];
        }

        $data = [
            'active' => $active,
        ];
        $user->update($data);
        $this->createLog($event, $dataLog);
        return $notification;
    }

    /**
     * Edit profile
     *
     * @param array $data
     * @return mixed
     */
    public function updateProfile($data)
    {
        $user = $this->model::findOrFail(auth()->id());
        $oldUser = $user->getOriginal();
        $datas = [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'phone_number' => $data['phone_number'],
        ];

        if (!is_null($data['image'])) {
            $user->image ? $this->deleteFile($user->image) : '';
            $imageFile = $data['image'];
            $pathInfo = $this->uploadFile($imageFile, 'users');
            $datas['image'] = $pathInfo;
        } else {
            $datas['image'] = $user->image;
        }

        $user->update($datas);
        $event = "Cập nhật thông tin cá nhân";
        $dataLog = [
            'old' => $oldUser,
            'new' => $datas
        ];
        $this->createLog($event, $dataLog);
        return base64_encode('app/' . $datas['image']);
    }

    /**
     * Check validate current password
     *
     * @param string $password
     * @return boolean
     */
    public function checkValidateCurrentPassword($password)
    {
        $data = $this->model->where('id', auth()->id())
            ->where('password_raw', $password)->exists();
        return $data;
    }

    /**
     * change password
     *
     * @param array $data
     * @return void
     */
    public function changePassword($data)
    {
        $user = $this->model::findOrFail(auth()->id());

        $oldData = [
            'password' => $user->password,
            'password_raw' => $user->new_password
        ];

        $newData = [
            'password' => Hash::make($data['new_password']),
            'password_raw' => $data['new_password']
        ];
        $user->update($newData);

        $event = "Đổi mật khẩu";
        $dataLog = [
            'old' => $oldData,
            'new' => $newData
        ];
        $this->createLog($event, $dataLog);
    }
}
