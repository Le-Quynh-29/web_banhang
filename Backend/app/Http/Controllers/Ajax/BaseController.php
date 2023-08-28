<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;

class BaseController extends AjaxController
{
    use BaseTrait;

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
        $data = $this->validateUniqueTrait($table, $column, $id, $textCheck);
        return $this->responseSuccess($data);
    }

    /**
     * autocomplete name
     *
     * @param  mixed $request
     * @return mixed
     */
    public function autocomplete(Request $request)
    {
        $table = $request->get('table');
        $column = $request->get('column');
        $textCheck = $request->get('text_check');
        $data = $this->autocompleteTrait($table, $column, $textCheck);
        return $this->responseSuccess($data);
    }
}
