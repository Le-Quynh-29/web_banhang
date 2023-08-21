<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    //    dd($request->all());
        $users = $this->userRepository->listUser($request, false);
        // dd( $users);
        return view('user/index', compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
     * Upload avatar image
     */
    public function uploadImage(Request $request)
    {
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $pathInfo = uploadFileHepler($imageFile, Auth::id());
                if ($pathInfo) {
                    return response()->json(['message' => 'Tệp đã được tải lên và lưu thành công'.$pathInfo],200);
                }
            }
    
    }
    /**
     * Upload avatar image
     */
    public function deleteImage(Request $request)
    {
           dd($request->all());
    
    }
}
