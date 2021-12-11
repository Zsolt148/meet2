<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    /**
     * @param Request $request
     * @param $name
     * @return array|null
     */
    public function store(Request $request, $name)
    {
        if($request->hasFile($name)) {

            $file = $request->file($name);
            $path = $file->store('tmp');

            return ['name' => $file->getClientOriginalName(), 'path' => $path];
        }else {
            return null;
        }
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        //dd($request->all());
    }
}
