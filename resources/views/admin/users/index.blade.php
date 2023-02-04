@extends('layouts.admin.master')
@section('title', 'Users')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="page-header page-header-light changeTitle">
                <div class="page-header-content header-elements-lg-inline">
                    <div class="page-title d-flex">
                        <h4>
                            <span class="font-weight-semibold">Users</span>
                        </h4>
                        <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
                    </div>
                    <div class="header-elements d-none">
                        <div class="d-flex justify-content-center">

                            <form style="margin-left: 5px;" action="{{ route('search-user') }}">
                                <div class="navbar-search d-flex align-items-center py-2 py-lg-0">
                                    <div class="form-group-feedback form-group-feedback-left flex-grow-1">
                                        <input type="search" name="q" class="form-control my-search-box"
                                            placeholder="Search" value="">
                                        <button type="submit" id="search-btn-my" class="btn btn-primary"><i
                                                class="icon-search4 fa fa-fw"></i></button>
                                        <div class="form-control-feedback">
                                            <i class="icon-search4 opacity-50"></i>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="content changeBody">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">User Listing</h4>
                    <a href="{{ route('add-user') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus menu-icon"></i>
                        Add User
                    </a>
                </div>
                @include('success-error')
                <div class="card changeTable">
                    <div class="table-responsive">
                        <table class="table ">
                            <thead class="t-head " style="text-align: center;vertical-align: middle;">
                                <tr class="changeTheme">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;vertical-align: middle;">
                                @if ($users)
                                    @if (count($users) > 0)
                                        <?php $firstItemIndex = $users->firstItem(); ?>
                                        @foreach ($users as $key => $value)
                                            <tr>
                                                <td>{{ $firstItemIndex++ }}</td>
                                                <td>{{ $value['name'] }}</td>
                                                <td>{{ $value['email'] }}</td>
                                                <td>{{ date('Y-m-d h:m A', strtotime($value['created_at'])) }}</td>
                                                <td>
                                                    <div class="icons">
                                                        <a href="{{ route('change-status', [$value['id']]) }}"
                                                            class="btn btn-sm btn-" data-toggle="tooltip"
                                                            data-placement="top" title="change status">
                                                            @if ($value['status'] == 'active')
                                                                <i><img src={{ asset('merchant') . '/images/bulbon2.png' }}
                                                                        class="rounded-pill " height="34"
                                                                        alt=""></i>
                                                            @else
                                                                <img src={{ asset('merchant') . '/images/bulboff2.png' }}
                                                                    class="rounded-pill " height="34" alt="">
                                                            @endif
                                                        </a>
                                                        <a href="{{ route('edit-user', [$value['id']]) }}"
                                                            class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                            data-placement="top" title="edit user">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                            <tfoot class="datatable">
                                <tr>
                                    <td class="text" colspan="12">
                                        <?php echo 'Showing ' . $users->firstItem() . ' to ' . $users->lastItem() . ' out of ' . $users->total() . ' entries'; ?>
                                        <div style="float: right;">
                                            {{ $users->links() }}

                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        @else
                            <tr>
                                <td class="text-center" colspan="12">No Record Found
                                </td>
                            </tr>
                            @endif
                            @endif
                            </tbody>
                        </table>
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
