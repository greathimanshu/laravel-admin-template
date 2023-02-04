@extends('layouts.user.master')
@section('title', 'Dashboard')

@section('content')
<!-- Main content -->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-header page-header-light changeTitle">
            <div class="page-header-content header-elements-lg-inline">
                <div class="page-title d-flex">
                    <h4> <span class="font-weight-semibold">Dashboard</span></h4>
                    <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
                </div>
            </div>
        </div>
        <div class="content changeBody">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="card card-body cardColor text-white has-bg-image">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="mb-0">{{ $data['payment_count'] ?? 0 }}</h3>
                                <span class="text-uppercase font-size-xs">Payments</span>
                            </div>
                            <div class="ml-3 align-self-center">
                                <i class="icon-coin-dollar icon-4x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('page_style')
<style>
    .popular-items-chart-wrapper {
        width: 50%;
        float: left;
    }
</style>
@endsection