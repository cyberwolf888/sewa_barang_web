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

    }
}
