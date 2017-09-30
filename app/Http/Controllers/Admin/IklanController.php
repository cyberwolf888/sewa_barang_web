<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Iklan;

class IklanController extends Controller
{
    public function index()
    {
        $model = Iklan::orderBy('id','desc')->get();
        return view('admin.iklan.manage',['model'=>$model]);
    }

    public function show($id)
    {
        $model = Iklan::find($id);
        return view('admin.iklan.detail',['model'=>$model]);
    }

    public function enable($id)
    {
        $model = Iklan::find($id);
        $model->status = 2;
        $model->save();

        return redirect()->back();
    }

    public function disable($id)
    {
        $model = Iklan::find($id);
        $model->status = 0;
        $model->save();

        return redirect()->back();
    }
}
