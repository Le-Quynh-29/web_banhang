<?php

namespace App\Repositories;

use App\Repositories\Support\AbstractRepository;
use App\Traits\SaveLog;
use App\Traits\ShopStorage;
use Illuminate\Container\Container as App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryRepository extends AbstractRepository
{
    use SaveLog, ShopStorage;

    public function model()
    {
        return 'App\Models\Category';
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * Get list category
     *
     * @param Request $request
     * @param bool $toArray
     * @param array $with
     * @return mixed
     */
    public function listCategory($request, $toArray = false, $with = [])
    {
        $orderBy = is_null($request->get('order_by')) ? "id" : $request->get('order_by');
        $orderArr = explode(',', $orderBy);
        $sortBy = in_array($request->get('sort_by'), ['asc', 'desc']) ? $request->get('sort_by') : 'desc';
        $searchBy = $request->get('search_by');
        $searchText = $request->get('search_text');
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

        if (!empty($searchBy)) {
                $data = $data->where($searchBy, 'LIKE', "%$searchText%");
        }
        
        if ($toArray) {
            return $data->paginate(self::PAGE_SIZE)->getCollection()->toArray();
        }

        return $data->paginate(self::PAGE_SIZE);
    }

    /**
     * Create category
     *
     * @param Request $request
     * @return void
     */
    public function storeCategory($request)
    {
        $pathInfo = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $pathInfo = $this->uploadFile($imageFile, 'categories');
        }

        $event = "Thêm mới danh mục";
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'user_id' => Auth::guard()->user()->id,
            'image' => $pathInfo,
        ];
        $this->model->create($data);
        $this->createLog($event, $data);
    }

    /**
     * Edit category
     *
     * @param array $data
     * @return mixed
     */
    public function updateCategory($data)
    {
        $id = $data['id'];
        $category = $this->model::findOrFail($id);
        $oldcategory = $category->getOriginal();
        $datas = [
            'name' => $data['name'],
        ];
        if (!is_null($data['image'])) {
            $category->image ? $this->deleteFile($category->image) : '';
            $imageFile = $data['image'];
            $pathInfo = $this->uploadFile($imageFile, 'categories');
            $datas['image'] = $pathInfo;
        }
        $category->update($datas);
        $event = "Cập nhật danh mục";
        $dataLog = [
            'old' => $oldcategory,
            'new' => $category
        ];
        $this->createLog($event, $dataLog);
    }

    /**
     * Delete category
     * @param $category
     */
    public function deleteCategory($category)
    {
        $event = "Xóa danh mục";
        $dataLog = [
            'category' => $category,
            'relationshipOf' => $category->products()->get()->toArray()
        ];
        $category->products()->detach();
        if (!is_null($category->image)) {
            $this->deleteFile($category->image);
        }
        $category->delete();
        $this->createLog($event, $dataLog);
    }

}
