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
                            <form id="r2" method="POST" action="{{ route('admin.reports.no_agreement_on_discussion_details') }}">
                                @include('admin.includes.search-form')
                            </form>
                            <a href="{{ route('admin.reports.export_no_agreement_on_discussion_details', $searchParams) }}" class="btn btn-success">निर्यात गर्नुहाेस <i class="fas fa-file-download"></i></a>


                            <a href="{{ route('admin.reports.no_agreement_on_discussion_detailsshow') }}" class="btn btn-sm btn-secondary ">Print</a>

                            <div class="report-table-container">
                                <table id="releases-table" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">सि.नं.</th>
                                            <th rowspan="2">दर्ता मिति</th>
                                            <th colspan="4">निवेदकको विवरण</th>
                                            <th colspan="4">विपक्षी/साहुको विवरण</th>
                                            <th rowspan="2">लेनदेन भएको मिति</th>
                                            <th rowspan="2">लेनदेनको प्रयोजन</th>
                                            <th rowspan="2">कारोवारको प्रकृती</th>
                                            <th colspan="2">कारोवारको प्रमाण</th>
                                            <th rowspan="2">अन्तिम पटक छलफल भएको मिति</th>
                                            <th colspan="7">साहुबाट माग भएको</th>
                                            <th colspan="5">निवेदकले तिर्न खोजेको</th>
                                            <th rowspan="2">सहमती हुन नसक्नुका कारण</th>
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

                                            <th>नगद रु.</th>
                                            <th>तमसुक रु.</th>
                                            <th>चेक रकम रु.</th>
                                            <th>जग्गा (क्षेत्रफल विघा-कठ्ठा-धुर)</th>
                                            <th>कित्ता</th>
                                            <th>सुन (ग्राममा)</th>
                                            <th>चाँदी (ग्राममा)</th>

                                            <th>नगद रु.</th>
                                            <th>चेक रकम रु.</th>
                                            <th>जग्गा (क्षेत्रफल विघा-कठ्ठा-धुर)</th>
                                            <th>कित्ता</th>
                                            <th>अन्य तरिका</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registration_reports as $registration )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $registration->registration_id }}</td>
                                            <td>{{ $registration->applicants_names }}</td>
                                            <td>{{ $registration->applicants_local_governments }}</td>
                                            <td>{{ $registration->applicants_wadas }}</td>
                                            <td>{{ $registration->applicants_contacts }}</td>
                                            <td>{{ $registration->offenders_names }}</td>
                                            <td>{{ $registration->offenders_local_governments }}</td>
                                            <td>{{ $registration->offenders_wadas }}</td>
                                            <td>{{ $registration->offenders_contacts }}</td>
                                            {{-- <td>{{ $registration->tansaction_date->format('Y-m-d') }}</td> --}}
                                            <td>{{ \Carbon\Carbon::parse($registration->tansaction_date)->format('Y-m-d') }}</td>
                                            <td>{{ $registration->transaction_purposes }}</td>
                                            <td>{{ $registration->transaction_natures }}</td>
                                            <td>{{ $registration->transaction_proof }}</td>
                                            <td>{{ $registration->transaction_proof_amount }}</td>
                                            {{-- same upto here --}}

                                            <td>{{ $registration->last_discussed_date }}</td>

                                            <td>{{ $registration->offender_refund_on_release_cash ?? '' }}</td>
                                            <td>{{ $registration->offender_refund_on_release_tamasuk ?? '' }}</td>
                                            <td>{{ $registration->offender_refund_on_release_cheque ?? '' }}</td>
                                            <td>{{ $registration->offender_refund_on_release_land ?? '' }}</td>
                                            <td>{{ $registration->offender_refund_on_release_kitta }}</td>
                                            <td>{{ $registration->offender_refund_on_release_gold ?? '' }}</td>
                                            <td>{{ $registration->offender_refund_on_release_silver ?? '' }}</td>

                                            <td>{{ $registration->applicant_receive_on_release_cash ?? '' }}</td>
                                            <td>{{ $registration->applicant_receive_on_release_cheque ?? '' }}</td>
                                            <td>{{ $registration->applicant_receive_on_release_land ?? '' }}</td>
                                            <td>{{ $registration->applicant_receive_on_release_kitta }}</td>
                                            <td>{{ $registration->applicant_receive_on_release_other_nature ?? '' }}
                                            </td>

                                            <td>{{ $registration->reason_to_disagreement }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $registration_reports->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/search.js') }}"></script>

    <script>
        $(".nepali-datepicker").nepaliDatePicker({});
    
    </script>
@endsection
