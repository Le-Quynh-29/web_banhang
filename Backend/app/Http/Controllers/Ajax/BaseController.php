<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends AjaxController
{
    /**
     * Check validate unique username
     *
     * @param  mixed $request
     * @return mixed
     */
    public function validateUnique(Request $request)
    {
        $table = $request->get('table');
        $column = $request->get('column');
        $id = $request->get('id');
        $textCheck = $request->get('text_check');
        $data = \ShopHelper::validateUnique($table, $column, $id, $textCheck);
        return $this->responseSuccess($data);
    }
}
