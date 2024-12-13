@extends('admin.layouts.master')

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="bg-light p-4 rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          
            <div class="lead">
                <a href="{{ route('admin.loantaking-victim.create') }}" class="btn btn-primary btn-sm">सिर्जना गर्नुहोस</a>
            </div>
        </div>
    </div>
    <table id="indexTable" class="table table-striped">
        <thead>
            <tr>
             
                <th>प्रतीक सङ्ख्या</th>
                <th>निवेदको नाम</th>
                <th>हाल बसोबासको ठेगाना</th>
                <th>पेशा/व्यवसाय</th>
                <th>कर्जा दिने व्यक्तिको नाम</th>
                <th>कर्जा कारोबार भएको मिति</th>
                <th>कर्जा कारोबार भएको स्थान</th>
                <th>कर्जा कारोबार भएको रकम</th>
                <th>कारोवार गरेको माध्यम  </th>
                <th>कार्यहरू</th>                     
            </tr>
        </thead>
    </table>
</div>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $(document).ready(function() {
        $('#indexTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{ route('admin.loantaking-victim.index') }}",
    "columns": [
        { "data": null, render: function(data, type, row, meta) { return meta.row + 1; }},
        { "data": "applicant_name" },
        { "data": "applicant_temp_local" },
        { "data": "applicant_occup" },
        { "data": "opponent_name" },
        { "data": "loan_date" },
        { "data": "loan_location" },
        { "data": "loan_amount" },
        { "data": "loan_medium" },
        { "data": "actions", "searchable": false, "orderable": false }
    ]
});
    });
</script>

@endsection
