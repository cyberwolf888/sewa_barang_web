<?php

namespace App\Http\Controllers\Admin;

use App\Models\Iklan;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /*
     * ADMIN
     */
    public function admin()
    {
        $model = User::where('type','1')->orderBy('id','desc')->get();
        return view('admin.user.admin.admin',['model'=>$model]);
    }

    public function create_admin()
    {
        $model = new User();
        return view('admin.user.admin.form_admin',['model'=>$model]);
    }

    public function store_admin(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:12|alpha_num',
            'address' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|max:1|alpha_num',
            'image' => 'required|image|max:3500'
        ]);

        $path = base_path('assets/img/profile/');
        $file = \Image::make($request->file('image'))->resize(300, 300)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');

        $model = new User();
        $model->name = $request->name;
        $model->phone = $request->phone;
        $model->address = $request->address;
        $model->img = $file->basename;
        $model->email = $request->email;
        $model->password = bcrypt($request->password);
        $model->isActive = $request->status;
        $model->type = 1;
        $model->save();

        return redirect()->route('admin.user.admin.manage');

    }

    public function show_admin($id)
    {

    }

    public function edit_admin($id)
    {
        $model = User::find($id);
        return view('admin.user.admin.form_admin',['model'=>$model,'update'=>true]);
    }

    public function update_admin(Request $request, $id)
    {
        //dd($request->all());
        $model = User::findOrFail($id);
        $filter = [
            'name' => 'required',
            'phone' => 'required|max:12|alpha_num',
            'address' => 'required',
            'image' => 'image|max:3500'
        ];

        if($request->email === $model->email){
            $validator['email'] = 'required|string|email|max:255';
        }else{
            $validator['email'] = 'required|string|email|max:255|unique:users';
        }

        if($request->password != null){
            $validator['password'] = 'required|string|min:6|confirmed';
            $model->password = bcrypt($request->password);
        }

        $this->validate($request, $filter);

        if ($request->hasFile('image')) {
            $path = base_path('assets/img/profile/');
            if(is_file($path.$model->img)){
                unlink($path.$model->img);
            }
            $file = \Image::make($request->file('image'))->resize(300, 300)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');
            $model->img = $file->basename;
        }

        $model->name = $request->name;
        $model->phone = $request->phone;
        $model->address = $request->address;
        $model->email = $request->email;
        if($request->has('status')){
            $model->isActive = $request->status;
        }
        $model->save();

        return redirect()->route('admin.user.admin.manage');
    }

    public function destroy_admin($id)
    {
        //
    }


    /*
     * MEMBER
     */

    public function member()
    {
        $model = User::where('type','2')->orderBy('id','desc')->get();
        return view('admin.user.member.member',['model'=>$model]);
    }

    public function create_member()
    {
        $model = new User();
        return view('admin.user.member.form_member',['model'=>$model]);
    }

    public function store_member(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:12|alpha_num',
            'address' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|max:1|alpha_num',
            'image' => 'required|image|max:3500'
        ]);

        $path = base_path('assets/img/profile/');
        $file = \Image::make($request->file('image'))->resize(300, 300)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');

        $model = new User();
        $model->name = $request->name;
        $model->phone = $request->phone;
        $model->address = $request->address;
        $model->img = $file->basename;
        $model->email = $request->email;
        $model->password = bcrypt($request->password);
        $model->isActive = $request->status;
        $model->type = 2;
        $model->save();

        return redirect()->route('admin.user.member.manage');
    }

    public function show_member($id)
    {
        //
    }

    public function edit_member($id)
    {
        $model = User::find($id);
        return view('admin.user.member.form_member',['model'=>$model,'update'=>true]);
    }

    public function update_member(Request $request, $id)
    {
        //dd($request->all());
        $model = User::findOrFail($id);
        $filter = [
            'name' => 'required',
            'phone' => 'required|max:12|alpha_num',
            'address' => 'required',
            'status' => 'required|max:1|alpha_num',
            'image' => 'image|max:3500'
        ];

        if($request->email === $model->email){
            $validator['email'] = 'required|string|email|max:255';
        }else{
            $validator['email'] = 'required|string|email|max:255|unique:users';
        }

        if($request->password != null){
            $validator['password'] = 'required|string|min:6|confirmed';
            $model->password = bcrypt($request->password);
        }

        $this->validate($request, $filter);

        if ($request->hasFile('image')) {
            $path = base_path('assets/img/profile/');
            if(is_file($path.$model->img)){
                unlink($path.$model->img);
            }
            $file = \Image::make($request->file('image'))->resize(300, 300)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');
            $model->img = $file->basename;
        }

        $model->name = $request->name;
        $model->phone = $request->phone;
        $model->address = $request->address;
        $model->email = $request->email;
        $model->isActive = $request->status;
        $model->save();

        return redirect()->route('admin.user.member.manage');
    }

    public function destroy_member($id)
    {
        $model = User::find($id);
        Iklan::where('user_id',$id)->delete();
        $model->delete();

        return redirect()->back();
    }
}
