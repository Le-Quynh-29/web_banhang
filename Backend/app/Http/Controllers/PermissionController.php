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
        abort_if(! Gate::allows('pmss--permission-index'),403);
        $roles = $this->roleRepo->all($request, false);
        return view('permission/index', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id) {
        abort_if(! Gate::allows('pmss--permission-edit'),403);
        $role = $this->roleRepo->find($id);
        abort_if(is_null($role),404);
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
    public function update(Request $request, $id) {
        abort_if(! Gate::allows('pmss--permission-update'),403);
        $role = $this->roleRepo->find($id);
        abort_if(is_null($role),404);
        $permissions = $request->get('permissions');
        $role->permissions()->sync($permissions);
        toastr()->success('Cập nhật phân quyền thành công.', 'Thông báo');
        return redirect()->back();
    }
}
