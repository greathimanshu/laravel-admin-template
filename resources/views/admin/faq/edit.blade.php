@extends('layouts.admin.master')
@section('title', 'Add FAQ')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="page-header page-header-light changeTitle">
                <div class="page-header-content header-elements-lg-inline">
                    <div class="page-title d-flex">
                        <h4>
                            <span class="font-weight-semibold">Add User</span>
                        </h4>
                        <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('faq') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus menu-icon"></i>
                                FAQ Listing
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('success-error')
            <div class="content changeBody">
                <form action="{{ route('update-faq', [$data->id]) }}" method="post">
                    @csrf
                    <div class="form-outline mb-4">
                        <label for="exampleInputPassword1" class="form-label"> Question</label>
                        <input type="text" name="question" class="form-control" placeholder="Question"
                            value="{{ $data['question'] }}" />
                        @if ($errors->has('question'))
                            <p class="text-danger">
                                {{ $errors->first('question') }}
                            </p>
                        @endif
                    </div>

                    <div class="form-outline mb-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="form-label"> Answer</label>
                                <textarea name="answer" class="form-control form-control-lg" type="text" placeholder="Terms & Conditions"
                                    style="height:30vh !important; background-color:#e4f7e2;" required>{{ $data['answer'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
