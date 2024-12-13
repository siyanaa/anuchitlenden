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
                <a href="{{ route('admin.releases.create') }}"><button class="btn-success btn-sm"><i class="fa fa-plus"></i>
                    सिर्जना गर्नुहाेस</button></a>
                <a href="{{ route('admin.releases.index') }}"><button class="btn-info btn-sm"><i class="fa fa-list"></i>
                    सुची</button></a>

            </div>
        </div>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-section">
                                <form id="r2" method="POST"
                                    action="{{ route('admin.reports.registrations-details') }}">
                                    @include('admin.includes.search-form')
                                </form>

                                <a href="{{ route('admin.reports.export_registration_details', $searchParams) }}" class="btn btn-success">निर्यात गर्नुहाेस <i class="fas fa-file-download"></i></a>

                                <a href="{{ route('admin.reports.registrations-detailsshow') }}" class="btn btn-sm btn-secondary ">Print</a>

                            </div>
                            <div class="report-table-container">
                                <table id="releases-table" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">सि.नं.</th>
                                            <th rowspan="2">दर्ता नं.</th>
                                            <th rowspan="2">दर्ता मिति</th>
                                            <th colspan="4">निवेदकको विवरण</th>
                                            <th colspan="4">विपक्षी/साहुको विवरण</th>
                                            <th rowspan="2">लेनदेन भएको मिति</th>
                                            <th rowspan="2">लेनदेनको प्रयोजन</th>
                                            <th rowspan="2">कारोवारको प्रकृती</th>
                                            <th colspan="2">कारोवारको प्रमाण</th>
                                        </tr>
                                        <tr>

                                            <!-- Applicant Details subcolumns -->
                                            <th>नाम</th>
                                            <th>स्थानीय तह</th>
                                            <th>वडा नं.</th>
                                            <th>सम्पर्क नं.</th>

                                            <!-- Offender Details subcolumns -->
                                            <th>नाम</th>
                                            <th>स्थानीय तह</th>
                                            <th>वडा नं.</th>
                                            <th>सम्पर्क नं.</th>

                                            <th>कारोवारको प्रमाण</th>
                                            <th>कारोवारको रु.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registration_reports as $registration)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registration->id }}</td>
                                                <td>{{ $registration->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $registration->applicants_names }}</td>
                                                <td>{{ $registration->applicants_local_governments }}</td>
                                                <td>{{ $registration->applicants_wadas }}</td>
                                                <td>{{ $registration->applicants_contacts }}</td>
                                                <td>{{ $registration->offenders_names }}</td>
                                                <td>{{ $registration->offenders_local_governments }}</td>
                                                <td>{{ $registration->offenders_wadas }}</td>
                                                <td>{{ $registration->offenders_contacts }}</td>
                                                <td>{{ $registration->tansaction_date }}</td>
                                                <td>{{ $registration->transaction_purposes }}</td>
                                                <td>{{ $registration->transaction_natures }}</td>
                                                <td>{{ $registration->transaction_proof }}</td>
                                                <td>{{ $registration->transaction_proof_amount }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                                {{ $registration_reports->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @push('scripts')
    {{ $dataTable->scripts() }}
@endpush --}}
@section('scripts')
    <script src="{{ asset('js/search.js') }}"></script>
    <script>
        //onclicking the search list get registration id only
        $(document).on("click", '#registration-id', function(event) {
            event.preventDefault(); // Prevent the default behavior of the link
            var dataId = $(this).data('id'); // Get the data-id attribute as id
            var dataValue = $(this).data('value'); // Get the data-value attribute as registration id
            $('.release-form').show();
            $('#id').val(dataId)
            $('#registration_id').val(dataValue)
            var dataTable = $('#releases-table').DataTable();
            dataTable.destroy();

            datatableInitation(dataId);
            $('#searchResults').html("");

            function datatableInitation(registration_id = null) {
                //datatable setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#releases-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.releases.get') }}',
                        type: 'post',
                        data: {
                            id: registration_id
                        },
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'registration_id',
                            name: 'registration_id'
                        },
                        {
                            data: 'release_agreement_date',
                            name: 'release_agreement_date'
                        },
                        {
                            data: 'issue_in_court',
                            name: 'issue_in_court'
                        },
                        {
                            data: 'release_criteria',
                            name: 'release_criteria'
                        },
                        {
                            data: 'agreement_applied_status',
                            name: 'agreement_applied_status'
                        },
                        {
                            data: 'applied_due_date',
                            name: 'applied_due_date'
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
            }
        });
    </script>

    <script>
        $(".nepali-datepicker").nepaliDatePicker({});
    </script>
@endsection
@endsection
