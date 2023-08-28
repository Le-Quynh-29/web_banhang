<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Ajax\AjaxController;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends AjaxController
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Update category
     *
     * @return mixed
     */
    public function update(Request $request)
    {
        $id = $request->get('id');
        $category = $this->categoryRepo->find($id);
        abort_if(is_null($category), 404);
        $data = $request->except(['_token', '_method', '_url']);
        $this->categoryRepo->updateCategory($data);
        return $this->responseSuccess('success');
    }
}
