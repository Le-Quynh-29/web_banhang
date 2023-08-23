<?php

namespace App\Repositories;

use App\Repositories\Support\AbstractRepository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function listUser($request, $toArray = false, $with = [])
    {
        $orderBy      = is_null($request->get('order_by')) ? "id" : $request->get('order_by');
        $orderArr     = explode(',', $orderBy);
        $sortBy       = in_array($request->get('sort_by'), ['asc', 'desc']) ? $request->get('sort_by') : 'desc';
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

        return $data->paginate(self::PAGE_SIZE);
    }

    public function store($request)
    {
        $image = '';
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $pathInfo = uploadFileHepler($imageFile, 'images');
            $image = 'storage/'.$pathInfo;
        }
        $event = "Thêm mới";
        $data = [
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'active' => $request->active,
            'password' => Hash::make($request->password),
            'password_raw' => $request->password,
            'image' => $image,
        ];
        $this->model::create($data);
        createLog($event,$data);
    }

    public function update($data, $id, $attribute = "id"){
        $user = $this->model::findOrFail($id);
        $validator = $rules = $messages = $attributes = $datas = [];
        if($data['password']){
            $validator['password'] = $data['password'];
            $rules['password'] = 'required|min:6|max:20|regex:/^[^\s]+$/';
            $messages['password.required'] = ':attribute không được để trống.';
            $messages['password.min'] = ':attribute lớn hơn hoặc bằng :min ký tự.';
            $messages['password.max'] = ':attribute nhỏ hơn hoặc bằng :max ký tự.';
            $messages['password.regex'] = ':attribute không được chứa dấu cách.';
            $attributes['password'] = 'Mật khẩu';
        }
        $validator = Validator::make($validator, $rules, $messages, $attributes);
        if ($validator->fails()) {
            return [false,$validator];
        } else {
            $datas = [
                'username' => $data['username'],
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'birthday' => $data['birthday'],
                'phone_number' => $data['phone_number'],
                'role' => $data['role'],
                'active' => $data['active'],
            ];
            if($data['password']){
                $datas['password'] = Hash::make($data['password']);
                $datas['password_raw'] = $data['password'];
            }
            if(isset($data['image'])){
                $user->image ? deleteFileHepler($user->image) : '';
                $imageFile = $data['image'];
                $pathInfo = uploadFileHepler($imageFile, 'images');
                $image = 'storage/'.$pathInfo;
                $datas['image'] = $image;
            }
            $user->update($datas);
            $event = "Cập nhật";
            createLog($event,$datas);
      
        }
        return [true];
    }

    public function updateActive($user,$active){
        $datas = [
            'active' => $active,
        ];
        $user->update($datas);
        $event = "Chuyển trạng thái tài khoản";
        createLog($event,$datas);
        return $user;
    }
}
