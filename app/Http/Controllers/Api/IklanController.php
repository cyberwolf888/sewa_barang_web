<?php

namespace App\Http\Controllers\Api;

use App\Models\GambarIklan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Iklan;


class IklanController extends Controller
{
    public function getHomePage()
    {
        $model = Iklan::with(['kategori','gambar_iklan','user'])->where('status',2)->orderBy('id','desc')->limit(18)->get();

        return response()->json(['status'=>1,'data'=>$model]);
    }
    public function getIklan(Request $request)
    {
        $model = Iklan::with(['kategori','gambar_iklan','user'])->where('user_id',$request->user_id)->orderBy('id','desc')->get();

        return response()->json(['status'=>1,'data'=>$model]);
    }

    public function getCategory()
    {
        $model = Category::all();
        return response()->json(['status'=>1,'data'=>$model->toArray()]);
    }

    public function saveIklan(Request $request)
    {
        $model = new Iklan();
        $model->user_id = $request->user_id;
        $model->category_id = $request->category_id;
        $model->judul = $request->judul;
        $model->deskripsi = $request->deskripsi;
        $model->harga = $request->harga;
        $model->stock = $request->stock;
        $model->satuan = $request->satuan;
        $model->status = 1;
        $model->save();

        return response()->json(['status'=>1,'id'=>$model->id]);
    }

    public function saveGambarIklan(Request $request)
    {
        foreach ($request->UploadForm as $img){
            //print_r($img);
            $model = new GambarIklan();
            $path = base_path('assets/img/iklan/'.$request->iklan_id.'/');
            if(!\File::exists($path)) {
                \File::makeDirectory($path, $mode = 0777, true, true);
            }
            $file = \Image::make($img)->resize(500, 300)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');
            $model->img = $file->basename;
            $model->iklan_id = $request->iklan_id;
            $model->save();
        }

    }

    public function detailIklan(Request $request)
    {
        $model = Iklan::with(['kategori','gambar_iklan','user'])->where('id',$request->id_iklan)->first();
        $model->dilihat+=1;
        $model->save();
        $model->memberSejak = date('M d, Y',strtotime($model->user->created_at));
        $model->dipasang = date('M d, Y',strtotime($model->created_at));
        $model->lastLogin = $model->user->updated_at->diffForHumans();

        return response()->json(['status'=>1,'data'=>$model]);
    }

    public function addDihubungi(Request $request)
    {
        $model = Iklan::find($request->id_iklan);
        $model->dihubungi+=1;
        $model->save();
    }

    public function searchIklan(Request $request)
    {
        $model = Iklan::with(['kategori','gambar_iklan','user'])->whereRaw(\DB::raw("judul like '%$request->keyword%' AND status=2"))->orderBy('id','desc')->get();

        return response()->json(['status'=>1,'data'=>$model,'count'=>$model->count()]);
    }

    public function getDetailKategori(Request $request)
    {
        $model = Iklan::with(['kategori','gambar_iklan','user'])->whereRaw(\DB::raw("category_id=$request->id_kategori AND status=2"))->orderBy('id','desc')->get();

        return response()->json(['status'=>1,'data'=>$model,'count'=>$model->count()]);
    }

    public function deleteIklan(Request $request){
        $model = Iklan::find($request->iklan_id);
        $model->delete();

        $imgs = GambarIklan::where('iklan_id',$request->iklan_id)->get();
        foreach ($imgs as $row){
            $path = base_path('assets/img/iklan/'.$request->iklan_id."/");
            if(is_file($path.$row->img)){
                unlink($path.$row->img);
            }
            $row->delete();
        }
        rmdir(base_path('assets/img/iklan/'.$request->iklan_id));
    }

    public function deleteImg(Request $request){
        $model = GambarIklan::find($request->id);
        $path = base_path('assets/img/iklan/'.$model->iklan_id."/");
        if(is_file($path.$model->img)){
            unlink($path.$model->img);
        }
        $model->delete();
    }

    public function updateIklan(Request $request){
        //print_r($request->all());
        $iklan = Iklan::find($request->id);
        if($request->has('UploadForm')){
            foreach ($request->UploadForm as $img){
                //print_r($img);
                $model = new GambarIklan();
                $path = base_path('assets/img/iklan/'.$iklan->id.'/');
                if(!\File::exists($path)) {
                    \File::makeDirectory($path, $mode = 0777, true, true);
                }
                $file = \Image::make($img)->resize(500, 300)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');
                $model->img = $file->basename;
                $model->iklan_id = $iklan->id;
                $model->save();
            }
        }
        if(GambarIklan::where('iklan_id',$iklan->id)->count()==0){
            return "Gambar iklan tidak boleh kosong!";
        }else{
            $iklan->judul = $request->judul;
            $iklan->category_id = $request->category_id;
            $iklan->harga = $request->harga;
            $iklan->stock = $request->stock;
            $iklan->satuan = $request->satuan;
            $iklan->deskripsi = $request->deskripsi;
            $iklan->save();
        }

    }
}
