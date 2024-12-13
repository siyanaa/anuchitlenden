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
        <a class="btn btn-secondary back-button"
            href="{{ route('admin.reports.no_agreement_on_discussion_details') }}">पछाडी
            जानुहोस</a>
        <button class="print-window btn btn-primary">प्रिन्ट गर्नुहाेस</button>
    </div>

    <table id="releases-table" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
        aria-describedby="example1_info">
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
            @foreach ($registration_reports as $registration)
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
