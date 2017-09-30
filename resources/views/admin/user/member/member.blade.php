@extends('layouts.backend')

@push('plugin_css')
    <link href="{{ url('assets') }}/backend/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets') }}/backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endpush

@push('page_css')
@endpush

@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Member
                <small>Kelola</small>
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
            <a href="{{ route('admin.user.member.manage') }}">Member</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Kelola</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">Kelola Member</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="{{ route('admin.user.member.create') }}" class="btn btn-circle green">
                                <i class="fa fa-plus"></i> Add new data
                            </a>
                        </div>
                        <div class="btn-group">
                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                <i class="fa fa-share"></i>
                                <span class="hidden-xs"> Export Tools </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" id="sample_3_tools">
                                <li>
                                    <a href="javascript:;" data-action="0" class="tool-action">
                                        <i class="icon-printer"></i> Print</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="1" class="tool-action">
                                        <i class="icon-check"></i> Copy</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="2" class="tool-action">
                                        <i class="icon-doc"></i> PDF</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="3" class="tool-action">
                                        <i class="icon-paper-clip"></i> Excel</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="4" class="tool-action">
                                        <i class="icon-cloud-upload"></i> CSV</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th> No </th>
                                <th> Image </th>
                                <th> Nama </th>
                                <th> Email </th>
                                <th> Telp </th>
                                <th> Alamat </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no =1 ?>
                            @foreach($model as $row)
                                <tr>
                                    <td> {{ $no }}</td>
                                    <td> <img class="img-circle" src="{{ $row->img==null ? url('assets/backend/layouts/layout4/img/no_ava.jpg') : url('assets/img/profile/'.$row->img) }}" width="65" height="65"> </td>
                                    <td> {{ $row->name }}</td>
                                    <td> {{ $row->email }}</td>
                                    <td> {{ $row->phone }}</td>
                                    <td> {{ $row->address }}</td>
                                    <td> {{ $row->getStatus() }}</td>
                                    <td class="center" width="100">
                                        <a href="{{ route('admin.user.member.edit',$row->id) }}" class="btn yellow-saffron btn-xs"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                                <?php $no++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End: life time stats -->
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
@endsection

@push('plugin_scripts')
    <script src="{{ url('assets') }}/backend/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{ url('assets') }}/backend/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{ url('assets') }}/backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
@endpush

@push('scripts')
    <script>
        a=function(){
            var e=$("#sample_3"),
                t=e.dataTable({
                    language:{
                        aria:{sortAscending:": activate to sort column ascending",sortDescending:": activate to sort column descending"},
                        emptyTable:"No data available in table",info:"Showing _START_ to _END_ of _TOTAL_ entries",infoEmpty:"No entries found",
                        infoFiltered:"(filtered1 from _MAX_ total entries)",
                        lengthMenu:"_MENU_ entries",
                        search:"Search:",
                        zeroRecords:"No matching records found"
                    },
                    buttons:[
                        {extend:"print",className:"btn dark btn-outline"},
                        {extend:"copy",className:"btn red btn-outline"},
                        {extend:"pdf",className:"btn green btn-outline"},
                        {extend:"excel",className:"btn yellow btn-outline "},
                        {extend:"csv",className:"btn purple btn-outline "},
                        {extend:"colvis",className:"btn dark btn-outline",text:"Columns"}
                    ],
                    responsive:!0,
                    order:[[0,"asc"]],
                    lengthMenu:[[5,10,15,20,-1],[5,10,15,20,"All"]],
                    pageLength:10
                });
            $("#sample_3_tools > li > a.tool-action").on("click",function(){
                var e=$(this).attr("data-action");
                t.DataTable().button(e).trigger()
            })
        };
        jQuery(document).ready(function(){
            jQuery().dataTable&&(a());
        });
    </script>
@endpush