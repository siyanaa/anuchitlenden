<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print" type="text/css">
</head>
<body>

    <div class="container-fluid d-flex justify-content-center mt-5 gap-4 mb-5">
        <button class="btn btn-secondary back-button" href="{{ route('admin.discussion.index') }}">पछाडी जानुहोस</button>
        <button class="print-window btn btn-primary">प्रिन्ट गर्नुहाेस</button>
    </div>

    <table id="releases-table" class="table table-bordered table-striped dataTable dtr-inline"
    role="grid" aria-describedby="example1_info">
    <thead>
        <tr>
            <th rowspan="3">क्र.सं.</th>
            <th rowspan="3">जिल्ला</th>
            <th rowspan="3">कुल उजुरी संख्या</th>
            <th rowspan="3">छलफलको क्रममा रहेको उजुरी संख्या</th>
            <th rowspan="3">लिनदिन नपर्ने गरी फर्छ्यौट भएको उजुरी संख्या</th>
            <th rowspan="3">लिनदिन पर्ने गरी फर्छ्यौट भएको उजुरी संख्या</th>
            <th rowspan="3">अदालतमा मुद्दा विचाराधिन भए पनि फर्छंयौट गरिएको संख्या</th>
            <th rowspan="3">कारोवार रकम रु</th>
            <th colspan="8">लिनदिन नपर्ने गरी फर्छ्यौट भएको</th>
            <th colspan="13">लिनदिन पर्ने गरी फर्छ्यौट भएको</th>
        </tr>
        <tr>
            <th rowspan="2">अनुचित लेनदेनको परिभाषा भित्र नपर्ने</th>
            <th rowspan="2">आपसी सहमतीमा मिलापत्र गर्न निवेदन फिर्ता</th>
            <th rowspan="2">निवेदकद्वारा निवेदन फिर्ता</th>
            <th rowspan="2">लिनदिन नपर्ने गरी मिलापत्र</th>
            <th rowspan="2">अदालतमा मुद्दा</th>
            <th rowspan="2">जग्गा खरिद विक्री सम्बन्धी कारोवार भएको देखिएको</th>
            <th rowspan="2">साहुद्रारा मिनहा गरिएको</th>
            <th rowspan="2">अन्य कारण</th>

            <th colspan="2">विपक्षी साहुबाट माग भएको रकम</th>
            <th colspan="6">निवेदनकले भूक्तानी गरेको/गर्ने/सहमती सम्बन्धी विवरण</th>
            <th colspan="7">साहुद्वारा फिर्ता सम्बन्धी विवरण</th>
        </tr>
        <tr>

            <th>नखुलेको उजुरी संख्या</th>
            <th>खुलेको रकम रु</th>

            <th>नगद रु.</th>
            <th>चेक रु.</th>
            <th>अन्य रु.</th>
            <th>जम्मा रकम रु.</th>
            <th>जग्गा क्षेत्रफल (विघा-कठ्ठा-धुर)</th>
            <th>कित्ता</th>

            <th>नगद रु.</th>
            <th>तमसुक रु.</th>
            <th>चेक रु.</th>
            <th>जग्गा क्षेत्रफल (विघा-कठ्ठा-धुर)</th>
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
                <td>{{ $district->totalRegistrationCount }}</td>
                <td>{{ $district->totalUnderDiscussionCount }}</td>
                <td>{{ $district->no_transaction_release_count }}</td>
                <td>{{ $district->with_transaction_release_count }}</td>
                <td>{{ $district->sumOfIssueInCourtButReleased }}</td>
                <td>{{ $district->sumOfCollectiveTransactionAmount }}</td>
                <td>{{ $district->getCountByReasonOfNoTransactions(1) }}</td>
                <td>{{ $district->getCountByReasonOfNoTransactions(2) }}</td>
                <td>{{ $district->getCountByReasonOfNoTransactions(3) }}</td>
                <td>{{ $district->getCountByReasonOfNoTransactions(4) }}</td>
                <td>{{ $district->getCountByReasonOfNoTransactions(5) }}</td>
                <td>{{ $district->getCountByReasonOfNoTransactions(6) }}</td>
                <td>{{ $district->getCountByReasonOfNoTransactions(7) }}</td>
                <td>{{ $district->getCountByReasonOfNoTransactions(8) }}</td>
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
                {{-- Kitta --}}
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
            </tr>
        @endforeach

        {{-- ... --}}
        <tr>
            <td></td>
            <td>जम्मा</td>
            <!-- Display the total registration count for the state -->
            <td>{{ $district->getTotalRegistrationStateCountAttribute() }}</td>
            <td>{{ $district->getTotalUnderDiscussionStateCountAttribute() }}</td>
            <td>{{ $district->getTotalNoTransactionReleaseStateCountAttribute() }}</td>
            <td>{{ $district->getWithTransactionReleaseStateCountAttribute() }}</td>
            <td>{{ $district->getSumOfIssueInCourtButReleasedStateAttribute() }}</td>
            <td>{{ $district->getSumOfCollectiveTransactionAmountStateAttribute() }}</td>
            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(1) }}</td>
            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(2) }}</td>
            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(3) }}</td>
            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(4) }}</td>
            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(5) }}</td>
            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(6) }}</td>
            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(7) }}</td>
            <td>{{ $district->getCountByReasonOfNoTransactionsStateAttribute(8) }}</td>
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

        <!-- Display the grand total row -->
        <tr>
            <td></td>
            <td>कुल जम्मा</td>
            <td>{{ $grandTotalRegistrationCount }}</td>
            <td>{{ $grandTotalUnderDiscussionCount }}</td>
            <td>{{ \App\Models\District::getGrandTotalNoTransactionReleaseCountForStates() }}</td>
            <td>{{ \App\Models\District::getGrandTotalWithTransactionReleaseCountForStates() }}</td>
            <td>{{ \App\Models\District::getGrandTotalSumOfIssueInCourtButReleasedForStates() }}</td>
            <td>{{ \App\Models\District::getGrandTotalSumOfCollectiveTransactionAmountForStates() }}</td>
            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(1) }}</td>
            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(2) }}</td>
            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(3) }}</td>
            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(4) }}</td>
            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(5) }}</td>
            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(6) }}</td>
            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(7) }}</td>
            <td>{{ \App\Models\District::getGrandTotalCountByReasonOfNoTransactions(8) }}</td>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ asset('adminassets/vendors/bootstrap/bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.print-window').click(function() {
            window.print();
        });
    });
</script>
</body>
</html>