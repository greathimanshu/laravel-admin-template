@extends('layouts.admin.master')
@section('title', 'FAQ')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <div class="content-inner">
            <div class="page-header page-header-light changeTitle">
                <div class="page-header-content header-elements-lg-inline">
                    <div class="page-title d-flex">
                        <h4> <span
                                class="font-weight-semibold">{{ $data['page_title'] ??
                                    'Frequently Asked Questions
                                                                                            ' }}</span>
                        </h4>
                        <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
                    </div>
                </div>
            </div>

            <div class="content changeBody">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">FAQ Listing</h4>
                    <a href="{{ route('add-faq') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus menu-icon"></i>
                        Add FAQ
                    </a>
                </div>
                @include('success-error')
                <div class="card changeTable">
                    <div class="table-responsive">
                        <table class="table ">
                            <thead class="t-head " style="text-align: center;vertical-align: middle;">
                                <tr class="changeTheme">
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody style="text-align: center;vertical-align: middle;">

                                @if ($data)

                                    @if (count($data) > 0)
                                        <?php $firstItemIndex = $data->firstItem(); ?>
                                        @foreach ($data as $key => $value)
                                            <tr>
                                                <td>{{ $firstItemIndex++ }}</td>
                                                <td>{{ Str::of($value['question'])->limit(20) }}</td>
                                                <td>{{ Str::of($value['answer'])->limit(30) }}</td>
                                                <td>{{ date('Y-m-d h:m A', strtotime($value['created_at'])) }}</td>
                                                <td>
                                                    <div class="icons">
                                                        <a href={{ route('change-faq-status', [$value['id']]) }}
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
                                                        <a href="{{ route('edit-faq', [$value['id']]) }}"
                                                            class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                            data-placement="top" title="edit user">
                                                            <i class="icon-pencil"></i>
                                                        </a>

                                                        {{-- <form id="myFormId{{$value['id']}}" action="{{ route('delete-faq',[$value['id']]) }}" method="POST" style="display:inline-block">
                                                @method('delete')
                                                @csrf
                                                <a type="submit" id="myBtnId" class="btn btn-sm btn-danger" data-toggle="modal" title="delete poster" data-target="#exampleModalCenter{{$value['id']}}">
                                                    <i class="icon-trash deleteClick"></i>
                                                </a>
                                            </form> --}}
                                                        {{-- modal --}}
                                                        {{-- <div class="modal fade" id="exampleModalCenter{{$value['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter{{$value['id']}}Title" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                                Delete FAQ</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Are you sure to delete ? </h5>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-danger" onclick="$('#myFormId{{$value['id']}}').submit()">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                            <tfoot class="datatable">
                                <tr>
                                    <td class="text" colspan="12">
                                        <?php echo 'Showing ' . $data->firstItem() . ' to ' . $data->lastItem() . ' out of ' . $data->total() . ' entries'; ?>
                                        <div style="float: right;">
                                            {{ $data->links() }}
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
@section('page_script')
    <script></script>
@endsection
@section('page_style')
    <style>

    </style>
@endsection
