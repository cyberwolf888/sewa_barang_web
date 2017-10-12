@extends('layouts.backend')

@push('plugin_css')
@endpush

@push('page_css')
@endpush

@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Dashboard
                <small>statistics, charts, recent events and reports</small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ url('admin') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Dashboard</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row widget-row">
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Total Iklan</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-green icon-bulb"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">{{ date('F') }}</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ \App\Models\Iklan::count() }}">{{ \App\Models\Iklan::count() }}</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Total Member</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-layers"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">{{ date('F') }}</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ \App\User::where('type',2)->count() }}">{{ \App\User::where('type',2)->count() }}</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Total Kategori</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Unit</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ \App\Models\Category::count() }}">{{ \App\Models\Category::count() }}</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Data Pemasangan Iklan</span>
                        <span class="caption-helper">Monthly stats...</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="site_statistics_loading">
                        <img src="{{ url('assets') }}/backend/global/img/loading.gif" alt="loading" /> </div>
                    <div id="site_statistics_content" class="display-none">
                        <div id="site_statistics" class="chart"> </div>
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
@endsection

@push('plugin_scripts')
<script src="{{ url('assets') }}/backend/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="{{ url('assets') }}/backend/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="{{ url('assets') }}/backend/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="{{ url('assets') }}/backend/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="{{ url('assets') }}/backend/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
@endpush

@push('scripts')
    <script>
        var Dashboard=function(){
            return{
                initCharts:function(){
                    function e(e,t,a,i){
                        $('<div id="tooltip" class="chart-tooltip">'+i+"</div>").css({position:"absolute",display:"none",top:t-40,left:e-40,border:"0px solid #ccc",padding:"2px 6px","background-color":"#fff"}).appendTo("body").fadeIn(200)
                    }
                    if(jQuery.plot){
                        var t=<?= $chart ?>;

                        if(0!=$("#site_statistics").size()){
                            $("#site_statistics_loading").hide(), $("#site_statistics_content").show();
                            var a=($.plot($("#site_statistics"),[{data:t,lines:{fill:.6,lineWidth:0},color:["#f89f9f"]},{data:t,points:{show:!0,fill:!0,radius:5,fillColor:"#f89f9f",lineWidth:3},color:"#fff",shadowSize:0}],{xaxis:{tickLength:0,tickDecimals:0,mode:"categories",min:0,font:{lineHeight:14,style:"normal",variant:"small-caps",color:"#6F7B8A"}},yaxis:{ticks:5,tickDecimals:0,tickColor:"#eee",font:{lineHeight:14,style:"normal",variant:"small-caps",color:"#6F7B8A"}},grid:{hoverable:!0,clickable:!0,tickColor:"#eee",borderColor:"#eee",borderWidth:1}}),null);$("#site_statistics").bind("plothover",function(t,i,l){if($("#x").text(i.x.toFixed(2)),$("#y").text(i.y.toFixed(2)),l){if(a!=l.dataIndex){a=l.dataIndex,$("#tooltip").remove();l.datapoint[0].toFixed(2),l.datapoint[1].toFixed(2);e(l.pageX,l.pageY,l.datapoint[0],"Rp. "+l.datapoint[1])}}else $("#tooltip").remove(),a=null})}
                    }
                },
                init:function(){this.initCharts()}
            }
        }();
        App.isAngularJsApp()===!1&&jQuery(document).ready(function(){Dashboard.init()});
    </script>
@endpush