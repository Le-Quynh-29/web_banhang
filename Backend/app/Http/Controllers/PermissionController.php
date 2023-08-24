<?php

namespace App\Http\Controllers;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    protected $permissionRepo;
    protected $roleRepo;

    public function __construct(RoleRepository $roleRepo, PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
        $this->roleRepo = $roleRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        if (! Gate::allows('pmss--permission-index')) {
            abort(403);
        }
        $roles = $this->roleRepo->all($request, false);

        return view('permission/index', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $role_id
     */
    public function edit($role_id) {
        if (! Gate::allows('pmss--permission-edit')) {
            abort(403);
        }
        $role = $this->roleRepo->find($role_id);
        if (is_null($role)) {
            abort(404);
        }
        $permissions = $this->permissionRepo->getAll();
        $arr_pmss = $role->permissions()->pluck('id')->toArray();
        return view('permission/edit', compact('permissions', 'role', 'arr_pmss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $role_id) {
        if (! Gate::allows('pmss--permission-update')) {
            abort(403);
        }
        $role = $this->roleRepo->find($role_id);
        if (is_null($role)) {
            abort(404);
        }
        $permissions = $request->get('permissions');
        $role->permissions()->sync($permissions);
        toastr()->success('Cập nhật thông tin người dùng thành công.', 'Thông báo');
        return redirect()->back();
    }
}
