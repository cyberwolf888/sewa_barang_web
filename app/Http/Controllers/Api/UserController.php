<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'type'=>2, 'isActive'=>1])){
            $model = Auth::user();
            $model->created_at = date('Y-m-d H:i:s');
            $model->save();
            return response()->json(['status'=>1,'data'=>$model->toArray()]);
        }else{
            return response()->json(['status'=>0]);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|alpha_num|max:12',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>0,'error'=>'Register gagal. Email ini sudah digunakan.']);
        }

        $model = new User();
        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->address = $request->address;
        $model->password = bcrypt($request->password);
        $model->type = 2;
        $model->isActive = 1;
        $model->save();

        return response()->json(['status'=>1]);
    }

    public function edit_account(Request $request)
    {
        $model = User::find($request->id);
        return response()->json(['status'=>1,'data'=>$model->toArray()]);
    }

    public function update_account(Request $request)
    {
        $model = User::find($request->id);
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|alpha_num|max:12',
            'address' => 'required|string|max:255',
            'image' => 'image|max:3500'
        ];

        if($request->email === $model->email){
            $rules['email'] = 'required|string|email|max:255';
        }else{
            $rules['email'] = 'required|string|email|max:255|unique:users';
        }

        if($request->password != null){
            $rules['password'] = 'required|string|min:6';
            $model->password = bcrypt($request->password);
        }

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json(['status'=>0,'error'=>'Data tidak valid.']);
        }

        if ($request->hasFile('image')) {
            $path = base_path('assets/img/profile/');
            if(is_file($path.$model->img)){
                unlink($path.$model->img);
            }
            $file = \Image::make($request->file('image'))->resize(300, 300)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');
            $model->img = $file->basename;
        }

        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->address = $request->address;
        $model->save();

        return response()->json(['status'=>1,'img'=>$model->img]);
    }
}
