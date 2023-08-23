<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->listCategory($request, false);
        $message = $request->session()->get('message', '');
        return view('category/index', compact('categories', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->categoryRepository->store($request);
        $message = 'Thêm mới danh mục ' . $request->fullname . ' thành công';
        return redirect()->route('category.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->categoryRepository->find($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryRepository->find($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $message = 'Cập nhật người dùng ' . $request->fullname . ' thành công';
        $category = $this->categoryRepository->update($request->all(), $id);
        return redirect()->route('category.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryRepository->find($id);
        $this->categoryRepository->delete($id);
        deleteFileHepler($category->image);
        return response()->json(
            [
                'message' => 'Xóa ' . $category->name . ' thành công',
                'status' => 200
            ],
            200
        );
    }
}
