@extends('admin.layouts.master')


@section('content')
    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.count.update') }}"
        enctype="multipart/form-data">
        @csrf
        <input name="id" id="" value="{{ $count->id }}" hidden>
        <div class="card-body">
            <div class="form-group">
                <label for="name">कुल दर्ता</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="registration_count" class="form-control" id="registration_count"
                    value="{{ $count->registration_count }}">
            </div>
            <div class="form-group">
                <label for="name">कुल छलफल</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="discussions_count" class="form-control" id="discussions_count"
                value="{{ $count->discussions_count }}">
            </div>
            <div class="form-group">
                <label for="name">कुल सहमती हुन नसकेको</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="no_agreement_discussions_count" class="form-control" id="no_agreement_discussions_count"
                value="{{ $count->no_agreement_discussions_count }}">
            </div>
            <div class="form-group">
                <label for="name">कुल फर्छ्याेट</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="releases_count" class="form-control" id="releases_count"
                value="{{ $count->no_agreement_discussions_count }}">
            </div>


        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn-primary">Submit</button>
        </div>
    </form>
@endsection
