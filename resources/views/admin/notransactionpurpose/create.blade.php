@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('admin.includes.forms')
    <div class="card-header">
        <h1 class="card-title">{{ $page_title }}</h1>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.notransaction.store') }}">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">शीर्षक</label>
                        <input type="text" name="title" class="form-control" id="exampleInputName"
                            placeholder="No Transaction Purpose">
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">सिर्जना गर्नुहाेस</button>
        </div>
    </form>
    </div>

@endsection
