@extends('admin.layouts.master')


@section('content')

<div class="m-2 p-5">
    <h3>
    कुल डाटा
    </h3>
</div>


<table class="table table-bordered table-hover">
    <thead style="border:1px solid black;">
        <tr>
            <th>S.N</th>
            <th>कुल दर्ता</th>
            <th>कुल छलफल</th>
            <th>कुल सहमती हुन नसकेको</th>
            <th>कुल फर्छ्याेट</th>
            @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                <th>द्वारा दर्ता</th>
            @endif
            @if (auth()->user()->role == 3)
            <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody style="border: 1px solid black;">
        @foreach ($counts as $count)
            <tr data-widget="expandable-table" aria-expanded="false">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $count->registration_count ?? '' }}</td>
                <td>{{ $count->discussions_count ?? '' }}</td>
                <td>{{ $count->no_agreement_discussions_count ?? '' }}</td>
                <td>{{ $count->releases_count ?? '' }}</td>
                @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                    <td>{{$count->user->district->name}}</td>
                @endif
                @if (auth()->user()->role == 3)
                    <td> <a href="{{ route('admin.count.edit', $count->id) }} class="btn btn-outline-primary btn-sm mx-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" ></i></a></td>
                @endif

            </tr>
        @endforeach
    </tbody>
</table>


@endsection