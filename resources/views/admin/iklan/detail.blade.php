@extends('layouts.backend')

@push('plugin_css')
    <link href="{{ url('assets') }}/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets') }}/backend/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('page_css')
@endpush

@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Iklan
                <small>Kelola Iklan</small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('admin.iklan.manage') }}">Iklan</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Detail Iklan</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->

    <br>
    @if($model->status == 1)
        <div class="row">
            <div class="col-md-12 ">
                <a href="javascript:void(0);" class="btn btn-circle green-jungle" id="verifikasi">
                    <i class="fa fa-check"></i> Verifikasi Iklan
                </a>

                <a href="javascript:void(0);" class="btn btn-circle red-mint" id="tolak">
                    <i class="fa fa-close"></i> Tolak Iklan
                </a>
            </div>
        </div>
        <br><br>
    @endif
    @if($model->status == 2)
        <div class="row">
            <div class="col-md-12 ">
                <a href="javascript:void(0);" class="btn btn-circle red-mint" id="tolak">
                    <i class="fa fa-close"></i> Matikan Iklan
                </a>
            </div>
        </div>
        <br><br>
    @endif
    @if($model->status == 0)
        <div class="row">
            <div class="col-md-12 ">
                <a href="javascript:void(0);" class="btn btn-circle green-jungle" id="verifikasi">
                    <i class="fa fa-check"></i> Aktifkan Iklan
                </a>
            </div>
        </div>
        <br><br>
    @endif
    <div class="row">
        <div class="col-md-12 ">

            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-body form">
                    @foreach(\App\Models\GambarIklan::where('iklan_id',$model->id)->get() as $row)
                        <div class="col-md-4 ">
                            <img class="img-responsive" src="{{ url('assets/img/iklan/'.$model->id.'/'.$row->img) }}">
                        </div>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">

            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Detail Iklan</span>
                    </div>
                </div>

                <div class="portlet-body form">
                    <table class="table table-bordered m-n" cellspacing="0">
                        <tbody>
                        <tr>
                            <td>
                                <h4><small>Judul Iklan</small></h4>
                                <h4>{{ $model->judul }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><small>Kategori</small></h4>
                                <h4>{{ $model->kategori->name }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><small>Harga</small></h4>
                                <h4>Rp {{ number_format($model->harga,0,',','.') }} /{{ $model->satuan }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><small>Tanggal Dibuat</small></h4>
                                <h4>{{ date('d/m/Y',strtotime($model->created_at)) }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><small>Status</small></h4>
                                <h4>{{ $model->getStatus() }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><small>Deskripsi</small></h4>
                                <h4>{{ $model->deskripsi }}</h4>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="portlet light bordered">

                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Detail Customer</span>
                    </div>
                </div>

                <div class="portlet-body form">
                    <table class="table table-bordered m-n" cellspacing="0">
                        <tbody>
                        <tr>
                            <td>
                                <h4><small>Nama Pemasang</small></h4>
                                <h4>{{ $model->user->name }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><small>Telp Customer</small></h4>
                                <h4>{{ $model->user->phone }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><small>Email</small></h4>
                                <h4>{{ $model->user->email }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><small>Alamat Customer</small></h4>
                                <h4>{{ $model->user->address }}</h4>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
@endsection

@push('plugin_scripts')
    <script src="{{ url('assets') }}/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="{{ url('assets') }}/backend/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="{{ url('assets') }}/backend/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
@endpush

@push('scripts')
    <script>
        jQuery(document).ready(function(){

            $("#verifikasi").click(function(){
                bootbox.confirm({
                    title: "Aktifkan?",
                    message: "Apakah anda yakin mengaktifkan iklan ini?",
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> Tidak'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> Yakin'
                        }
                    },
                    callback: function (result) {
                        console.log('This was logged in the callback: ' + result);
                        if(result){
                            window.location = "<?= route('admin.iklan.enable',$model->id) ?>";
                        }
                    }
                });
            });

            $("#tolak").click(function(){
                bootbox.confirm({
                    title: "Nonaktif?",
                    message: "Apakah anda yakin menonaktifkan iklan ini?",
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> Tidak'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> Yakin'
                        }
                    },
                    callback: function (result) {
                        console.log('This was logged in the callback: ' + result);
                        if(result){
                            window.location = "<?= route('admin.iklan.disable',$model->id) ?>";
                        }
                    }
                });
            });

        });
    </script>
@endpush