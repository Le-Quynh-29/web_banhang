<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Traits\ShopStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    use ShopStorage;
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
        abort_if(! Gate::allows('pmss--category-index'),403);
        $categories = $this->categoryRepository->listCategory($request, false);
        return view('category/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(! Gate::allows('pmss--category-create'),403);
        return view('category/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        abort_if(! Gate::allows('pmss--category-create'),403);
        $this->categoryRepository->storeCategory($request);
        toastr()->success('Thêm mới danh mục ' . $request->name . ' thành công.', 'Thông báo');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(! Gate::allows('pmss--category-detail'),403);
        $category = $this->categoryRepository->find($id);
        abort_if(is_null($category),404);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(! Gate::allows('pmss--category-update'),403);
        $category = $this->categoryRepository->find($id);
        abort_if(is_null($category),404);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(! Gate::allows('pmss--category-delete'),403);
        $category = $this->categoryRepository->find($id);
        abort_if(is_null($category),404);
        $this->categoryRepository->deleteCategory($category);
        toastr()->success('Xóa danh mục '. $category->name . ' thành công.', 'Thông báo');
        return redirect()->back();
    }
}
