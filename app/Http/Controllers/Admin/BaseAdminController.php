<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseAdminController extends Controller
{
    /**
     * BaseAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * @param $model
     * @param $request
     * @param array $fields
     * @return mixed
     */
    protected function getQuery($model, Request $request, array $fields = [])
    {
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:created_at,' . implode(',', $fields)],
        ]);

        $query = $model::query();

        $query = $this->search($request->get('search'), $query, $fields);

        $query = $this->orderBy(request(), $query);

        return $query;
    }

    /**
     * @param $search
     * @param $query
     * @param array $fields
     * @return mixed
     */
    protected function search($search, $query, array $fields)
    {
        if($search) {
            $query->where(function($query) use (&$fields, &$search) {
                foreach($fields as $field) {
                    $query->orWhere($field, 'LIKE', '%'.$search.'%');
                }
            });
        }

        return $query;
    }

    /**
     * @param $request
     * @param $query
     * @return mixed
     */
    protected function orderBy($request, $query)
    {
        if($request->has(['field', 'direction'])) {
            $query->orderBy($request->get('field'), $request->get('direction'));
        }else {
            $query->latest();
        }

        return $query;
    }
}