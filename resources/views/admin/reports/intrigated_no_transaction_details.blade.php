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
                            {{-- <form id="r2" method="POST"
                                action="{{ route('admin.reports.integrated_no_transaction_details') }}">
                                @include('admin.includes.search-form')
                            </form> --}}
                            <a href="{{ route('admin.reports.export_integrated_no_transaction_details') }}" class="btn btn-success">निर्यात गर्नुहाेस <i class="fas fa-file-download"></i></a>
                            <a href="{{ route('admin.reports.integrated_no_transaction_detailsshow') }}" class="btn btn-sm btn-secondary ">Print</a>

                            <div class="report-table-container">
                                <table id="releases-table" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th colspan="6"></th>
                                            <th colspan="8">कारणहरु</th>
                                        </tr>
                                        <tr>
                                            <th>क्र.सं. </th>
                                            <th>जिल्ला</th>
                                            <th>लिनदिन नपर्ने गरी फर्छ्यौट भएको उजुरी संख्या</th>
                                            <th>कारोवार रकम रु.</th>
                                            <th colspan="2">अदालतमा मुद्दा विचाराधिन अवस्था</th>


                                            <th>अनुचित लेनदेनको परिभाषा भित्र नपर्ने</th>
                                            <th>आपसी सहमतीमा मिलापत्र गर्न निवेदन फिर्ता</th>
                                            <th>निवेदकद्वारा निवेदन फिर्ता</th>
                                            <th>लिनदिन नपर्ने गरी मिलापत्र</th>
                                            <th>अदालतमा मुद्दा रहेकोमा छलफल गराउँदा सहमती हुन नसकेको</th>
                                            <th>जग्गा खरिद विक्री सम्बन्धी कारोवार भएको देखिएको</th>
                                            <th>साहुद्रारा मिनहा गरिएको</th>
                                            <th>अन्य कारण</th>

                                        </tr>
                                        <tr>
                                            <!-- Empty header cells for spacing -->
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>

                                            <!-- अदालतमा मुद्दा विचाराधिन अवस्था -->
                                            <th>भएको</th>
                                            <th>नभएको</th>

                                            <!-- Empty header subcolumns -->
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registration_reports as $registration)
                                            <tr>
                                                <td colspan="14">{{ $registration->name }}</td>
                                                @php
                                                    $counter = 1; // Initialize the counter
                                                @endphp
                                                @foreach ($registration->districts as $key => $district)
                                                    {{-- @foreach ($district->users as $user) --}}
                                            <tr>

                                                <td>{{ $counter }}</td>
                                                <td>{{ $district->name }}</td>
                                                <td>{{ $district->no_transaction_release_count }}</td>
                                                <td>{{ $district->sum_of_transaction_amount }}</td>
                                                {{-- release_criteria (	0=>no transaction, 1=>transaction) && issue in the code (0=>no, 1=>yes)  --}}
                                                <td>{{ $district->getSumOfIssueInCourtByIssueTypeAndReleaseCriteriaAttribute(0, 1) }}
                                                </td>
                                                <td>{{ $district->getSumOfIssueInCourtByIssueTypeAndReleaseCriteriaAttribute(0, 0) }}
                                                </td>
                                                {{-- parameter passed is based on reason id for notransaction --}}
                                                <td>{{ $district->getCountByReasonOfNoTransactions(1) }}</td>
                                                <td>{{ $district->getCountByReasonOfNoTransactions(2) }}</td>
                                                <td>{{ $district->getCountByReasonOfNoTransactions(3) }}</td>
                                                <td>{{ $district->getCountByReasonOfNoTransactions(4) }}</td>
                                                <td>{{ $district->getCountByReasonOfNoTransactions(5) }}</td>
                                                <td>{{ $district->getCountByReasonOfNoTransactions(6) }}</td>
                                                <td>{{ $district->getCountByReasonOfNoTransactions(7) }}</td>
                                                <td>{{ $district->getCountByReasonOfNoTransactions(8) }}</td>
                                            </tr>
                                            @php
                                                $counter++; // Increment the counter
                                            @endphp
                                            {{-- @endforeach --}}
                                        @endforeach

                                        <tr>
                                            <td></td>
                                            <td>जम्मा</td>
                                            <td>{{ $district->getTotalNoTransactionReleaseStateCountAttribute() }}</td>
                                            <td>{{ $district->getTotalSumOfTransactionAmountStateAttribute() }}</td>
                                            <td>{{ $district->getTotalSumOfIssueInCourtByIssueTypeAndReleaseCriteriaStateAttribute(0, 1) }}
                                            <td>{{ $district->getTotalSumOfIssueInCourtByIssueTypeAndReleaseCriteriaStateAttribute(0, 0) }}
                                            </td>
                                            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(1) }}</td>
                                            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(2) }}</td>
                                            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(3) }}</td>
                                            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(4) }}</td>
                                            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(5) }}</td>
                                            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(6) }}</td>
                                            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(7) }}</td>
                                            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(8) }}</td>
                                        </tr>

                                        </tr>
                                        @endforeach

                                        <tr>
                                            <td></td>
                                            <td>कुल जम्मा</td>
                                            <td>{{ \App\Models\District::getGrandTotalNoTransactionReleaseCountForStates() }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfTransactionAmount() }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfIssueInCourtByIssueTypeAndReleaseCriteria(0, 1) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfIssueInCourtByIssueTypeAndReleaseCriteria(0, 0) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(1) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(2) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(3) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(4) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(5) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(6) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(7) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(8) }}</td>
                                        </tr>
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
@section('scripts')
    <script src="{{ asset('js/search.js') }}"></script>

    <script>
        $(".nepali-datepicker").nepaliDatePicker({});
    
    </script>
@endsection
@endsection
