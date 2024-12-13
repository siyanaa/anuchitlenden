@extends('admin.layouts.master')


@section('content')



    <div class="mt-4">
        <div class="d-flex justify-content-between mb-4">

            <div class="border-bottom border-primary">
                <h2>
                    {{ $page_title }}
                </h2>
            </div>
            <div>
                <a href="{{ url()->previous() }}"><button class="btn-primary btn-sm"><i class="fa fa-angle-double-left"></i>
                    पछाडी जानुहाेस</button></a>
                <a href="{{ route('admin.registrations.create') }}"><button class="btn-success btn-sm"><i
                            class="fa fa-plus"></i>
                            सिर्जना गर्नुहाेस</button></a>
                <a href="{{ route('admin.registrations.index') }}"><button class="btn-info btn-sm"><i class="fa fa-list"></i>
                    सुची</button></a>

            </div>
        </div>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="registrations-table" class="table table-bordered table-striped dataTable dtr-inline"
                                role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0">Id</th>
                                        <th class="sorting sorting_asc" tabindex="0">निवेदकको नाम</th>
                                        <th>निवेदकको सम्पर्क नं.</th>
                                        <th>विपक्षी/साहुको नाम</th>
                                        <th>विपक्षी/साहुको सम्पर्क नं.</th>
                                        <th>लेनदेन भएको मिति</th>
                                        <th>द्वारा दर्ता गरिएको</th>
                                        <th>सिर्जना</th>
                                        <th>कार्य</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    {{-- @push('scripts')
    {{ $dataTable->scripts() }}
@endpush --}}
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#registrations-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.registrations.get') }}',
                type: 'post'
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'applicant_full_name',
                    name: 'applicant_full_name'
                },
                {
                    data: 'applicant_contact',
                    name: 'applicant_contact'
                },
                {
                    data: 'offender_full_name',
                    name: 'offender_full_name'
                },
                {
                    data: 'offender_contact',
                    name: 'offender_contact'
                },
                {
                    data: 'tansaction_date',
                    name: 'tansaction_date'
                },
                {
                    data: 'register_by',
                    name: 'register_by'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'actions',
                    name: 'actions'
                }
            ],
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function() {
                            column.search($(this).val()).draw();
                        });
                });
            }
        });
    </script>
@endsection
@endsection
