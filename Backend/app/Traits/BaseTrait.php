<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\DB;

trait BaseTrait
{
    /**
     * Check validate unique
     *
     * @param string $table
     * @param string $column
     * @param mixed $id
     * @param string $textCheck
     */
    public function validateUniqueTrait($table, $column, $id, $textCheck)
    {
        $data = DB::table($table)->where($column, $textCheck);

        if (!is_null($id)) {
            $data = $data->where('id', '<>', $id);
        }
        $data = $data->get();

        if (sizeof($data) == 0) {
            return true;
        }
        return false;
    }

    /**
     * user autocomplete
     *
     * @param string $table
     * @param string $column
     * @param string $term
     */
    public function autocompleteTrait($table, $column, $term)
    {
        $users = DB::table($table)->where($column, 'LIKE', '%' . $term . '%');

        $users = $users->limit(20)->get();

        $arr = [];
        foreach ($users as $user) {
            $userO = new \stdClass();
            $userO->id = $user->id;
            $userO->value = html_entity_decode($user->username);
            $arr[] = $userO;
        }

        return $arr;
    }
}
