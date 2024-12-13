@extends('admin.layouts.master')


@section('content')



    <div class="mt-4">
        <div class="d-flex justify-content-between mb-4">

            <div class="border-bottom border-primary">
                <h2>
                    {{ $page_title }}
                </h2>
            </div>
        </div>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <div class="form-section">
                                <form id="r2" method="POST"
                                    action="{{ route('admin.reports.registrations-details') }}">
                                    @include('admin.includes.search-form')
                                </form>
                            </div> --}}
                            <a href="{{ route('admin.reports.export_integrated_transaction_needed_details') }}" class="btn btn-success">निर्यात गर्नुहाेस <i class="fas fa-file-download"></i></a>
                            <a href="{{ route('admin.reports.integrated_with_transaction_detailsshow') }}" class="btn btn-sm btn-secondary ">Print</a>
                            <div class="report-table-container">
                                <table id="releases-table" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th>क्र.सं.</th>
                                            <th>जिल्ला</th>
                                            <th>लिनदिन पर्ने गरी फर्छ्यौट भएको उजुरी संख्या</th>
                                            <th>कारोवार रकम रु.</th>
                                            <th colspan="2">अदालतमा मुद्दा विचाराधिन अवस्था</th>
                                            <th colspan="2">विपक्षी साहुबाट माग भएको रकम</th>
                                            <th colspan="6">निवेदनकले भूक्तानी गरेको/गर्ने/सहमती सम्बन्धी विवरण</th>
                                            <th colspan="7">साहुद्वारा फिर्ता सम्बन्धी विवरण</th>
                                        </tr>
                                        <tr>
                                            <!-- Empty header cells for spacing -->
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>

                                            <!-- Applicant Details subcolumns -->
                                            <th>भएको</th>
                                            <th>नभएको</th>

                                            <th>नखुलेको उजुरी संख्या</th>
                                            <th>खुलेको रकम रु.</th>

                                            <!-- applicant Details subcolumns -->
                                            <th> नगद रु.</th>
                                            <th>चेक रु.</th>
                                            <th>अन्य रु.</th>
                                            <th>जम्मा रकम रु.</th>
                                            <th>जग्गा क्षेत्रफल (विघा-कठ्ठा-धुर)</th>
                                            <th>कित्ता</th>

                                            <!-- Offender header cells -->
                                            <th>नगद रु.</th>
                                            <th>तमसुक रु.</th>
                                            <th>चेक रु.</th>
                                            <th>जग्गा (क्षेत्रफल विघा-कठ्ठा-धुर)</th>
                                            <th>कित्ता</th>
                                            <th>सुन (ग्राममा)</th>
                                            <th>चाँदी (ग्राममा)</th>

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
                                                <td>{{ $district->with_transaction_release_count }}</td>
                                                <td>{{ $district->sum_of_with_transaction_release_count }}</td>

                                                {{-- release_criteria (	0=>no transaction, 1=>transaction) && issue in the code (0=>no, 1=>yes)  --}}
                                                <td>{{ $district->getSumOfIssueInCourtByIssueTypeAndReleaseCriteriaAttribute(1, 1) }}
                                                </td>
                                                <td>{{ $district->getSumOfIssueInCourtByIssueTypeAndReleaseCriteriaAttribute(1, 0) }}
                                                </td>
                                                <td>{{ $district->getTotalNoOfOffenderDemandNotReveal() }}</td>
                                                <td>{{ $district->getTotalSumOfOffenderDemand() }}</td>
                                                {{-- नगद =1 --}}
                                                <td>{{ $district->getSumOfApplicantReceivedByNature(1, 1) }}</td>
                                                {{-- चेक =2 --}}
                                                <td>{{ $district->getSumOfApplicantReceivedByNature(1, 2) }}</td>
                                                {{-- अन्य =8 --}}
                                                <td>{{ $district->getSumOfApplicantReceivedByNature(1, 8) }}</td>
                                                {{-- total of all --}}
                                                <td>{{ $district->getTotalSumOfApplicantReceived(1) }}</td>
                                                {{-- जग्गा क्षेत्रफल --}}
                                                <td>{{ $district->getTotalSumOfApplicantLand(1) }}</td>
                                                {{-- kitta --}}
                                                <td>{{ $district->getTotalSumOfApplicantLandKitta(1) }}</td>
                                                {{-- नगद =1 --}}
                                                <td>{{ $district->getSumOfOffenderReturnByNature(1, 1) }}</td>
                                                {{-- तमसुक =5 --}}
                                                <td>{{ $district->getSumOfOffenderReturnByNature(1, 5) }}</td>
                                                {{-- चेक =2 --}}
                                                <td>{{ $district->getSumOfOffenderReturnByNature(1, 2) }}</td>
                                                {{-- जग्गा क्षेत्रफल --}}
                                                <td>{{ $district->getTotalSumOfOffenderLand(1) }}</td>
                                                {{-- kitta --}}
                                                <td>{{ $district->getTotalSumOfOffenderLandKitta(1) }}</td>
                                                {{-- सुन =6 --}}
                                                <td>{{ $district->getSumOfOffenderReturnByNature(1, 6) }}</td>
                                                {{-- चाँदी =7 --}}
                                                <td>{{ $district->getSumOfOffenderReturnByNature(1, 7) }}</td>
                                                @php
                                                    $counter++; // Increment the counter
                                                @endphp
                                        @endforeach
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td>जम्मा</td>
                                            <td>{{ $district->getWithTransactionReleaseStateCountAttribute() }}</td>
                                            <td>{{ $district->getTotalSumOfWithTransactionReleaseCountStateAttribute() }}
                                            </td>
                                            <td>{{ $district->getTotalSumOfIssueInCourtByIssueTypeAndReleaseCriteriaStateAttribute(1, 1) }}
                                            </td>
                                            <td>{{ $district->getTotalSumOfIssueInCourtByIssueTypeAndReleaseCriteriaStateAttribute(1, 0) }}
                                            </td>
                                            <td>{{ $district->getTotalNoOfOffenderDemandNotRevealStateAttribute() }}</td>
                                            <td>{{ $district->getTotalSumOfOffenderDemandStateAttribute() }}</td>
                                            <td>{{ $district->getSumOfApplicantReceivedByNatureState(1, 1) }}</td>
                                            <td>{{ $district->getSumOfApplicantReceivedByNatureState(1, 2) }}</td>
                                            <td>{{ $district->getSumOfApplicantReceivedByNatureState(1, 8) }}</td>
                                            <td>{{ $district->getTotalSumOfApplicantReceivedState(1) }}</td>
                                            <td>{{ $district->getTotalSumOfApplicantLandState(1) }}</td>
                                            <td>{{ $district->getTotalSumOfApplicantLandKittaState(1) }}</td>
                                            <td>{{ $district->getSumOfOffenderReturnByNatureState(1, 1) }}</td>
                                            <td>{{ $district->getSumOfOffenderReturnByNatureState(1, 5) }}</td>
                                            <td>{{ $district->getSumOfOffenderReturnByNatureState(1, 2) }}</td>
                                            <td>{{ $district->getTotalSumOfOffenderLandState(1) }}</td>
                                            <td>{{ $district->getTotalSumOfOffenderLandKittaState(1) }}</td>
                                            <td>{{ $district->getSumOfOffenderReturnByNatureState(1, 6) }}</td>
                                            <td>{{ $district->getSumOfOffenderReturnByNatureState(1, 7) }}</td>
                                        </tr>
                                        @endforeach

                                        <tr>
                                            <td></td>
                                            <td>कुल जम्मा</td>
                                            <td>{{ \App\Models\District::getGrandTotalWithTransactionReleaseCountForStates() }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfWithTransactionReleaseCount() }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfIssueInCourtByIssueTypeAndReleaseCriteria(1, 1) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfIssueInCourtByIssueTypeAndReleaseCriteria(1, 0) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalNoOfOffenderDemandNotReveal() }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfOffenderDemand() }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfApplicantReceivedByNature(1, 1) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfApplicantReceivedByNature(1, 2) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfApplicantReceivedByNature(1, 8) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfApplicantReceived(1) }}</td>
                                            {{-- <td>LANDSHIT</td> --}}
                                            <td>{{ \App\Models\District::getGrandTotalSumOfApplicantLand(1) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfApplicantLandKittaState(1) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfOffenderReturnByNature(1, 1) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfOffenderReturnByNature(1, 5) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfOffenderReturnByNature(1, 2) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfOffenderLandState(1) }}</td>
                                            {{-- <td>LANDSHIT</td> --}}
                                            <td>{{ \App\Models\District::getGrandTotalSumOfOffenderLandKitta(1) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfOffenderReturnByNature(1, 6) }}</td>
                                            <td>{{ \App\Models\District::getGrandTotalSumOfOffenderReturnByNature(1, 7) }}</td>
                                        </tr>

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
        $(".nepali-datepicker").nepaliDatePicker({});
    
    </script>
@endsection
@endsection