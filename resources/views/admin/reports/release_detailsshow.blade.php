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
        <a class="btn btn-secondary back-button" href="{{ route('admin.reports.releaseDetails') }}">पछाडी जानुहोस</a>
        <button class="print-window btn btn-primary">प्रिन्ट गर्नुहाेस</button>
    </div>

    <table id="releases-table" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
        aria-describedby="example1_info">
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
                <th rowspan="2">सहमती/फर्छ्यौट मिति</th>
                <th rowspan="2">अदालतमा मुद्दा विचाराधिन</th>
                <th rowspan="2">लिन दिन नपर्ने गरी फर्छ्यौट</th>
                <th colspan="2">लिनदिन पर्ने गरी फर्छ्यौट</th>
                <th colspan="5">निवेदनकले भूक्तानी गरेको/गर्ने जम्मा रकम रु</th>
                <th colspan="7">साहुद्वारा फिर्ता भएको विवरण</th>
                <th colspan="2">सहमती कार्यान्वयनको अवस्था</th>
                {{-- <th rowspan="2">अन्य केही खुलाउनुपर्ने कुरा भए</th> --}}
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

                {{-- Transaction Release Subcolumns --}}
                <th>विपक्षी साहुबाट माग रकम</th>
                <th>सहमती/फिर्ता विवरण</th>

                {{-- Applicant Willing To Pay --}}
                <th>नगद रु.</th>
                <th>चेक द्वारा भूक्तानी रु.</th>
                <th>जग्गा छोडेको क्षेत्रफल (विघा-कठ्ठा-धुर) </th>
                <th>कित्ता</th>
                <th>अन्य तरिका</th>
                {{-- <th>मूल्यांकन रु.</th> --}}

                {{-- Offender Refund On Release --}}

                {{-- <th>फिर्ता गर्नुपर्ने प्रमाण/सम्पतीको दायित्व नभएको</th> --}}
                <th>नगद रु.</th>
                <th>तमसुक रु.</th>
                <th>चेक रु.</th>
                <th>जग्गा छोडेको क्षेत्रफल (विघा-कठ्ठा-धुर) </th>
                <th>कित्ता</th>
                <th>सुन (ग्राममा)</th>
                <th>चाँदी (ग्राममा)</th>

                {{-- सहमती कार्यान्वयनको अवस्था --}}
                <th>तत्काल कार्यान्वयन भएको</th>
                <th>हदम्याद दिइएको/अन्तिम मिति</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($registration_reports as $registration)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $registration->id }}</td>
                    <td>{{ $registration->created_at }}</td>
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
                    {{-- same upto here --}}
                    <td>{{ $registration->releases->release_agreement_date ?? '' }}</td>
                    <td>
                        {{ $registration->releases->issue_in_court ?? '' }}
                    </td>
                    <td>{{ $registration->no_transaction_purpose }}</td>

                    {{-- Transaction Release Subcolumns --}}
                    <td>{{ $registration->offender_demand }}</td>
                    <td>{{ $registration->reason_to_disagreement }}</td>
                    {{-- Applicant Willing To Pay --}}
                    <td>{{ $registration->applicant_receive_on_release_cash ?? '' }}</td>
                    <td>{{ $registration->applicant_receive_on_release_cheque ?? '' }}</td>
                    <td>{{ $registration->applicant_receive_on_release_land ?? '' }}</td>
                    <td>{{ $registration->applicant_receive_on_release_kitta }}</td>
                    <td>{{ $registration->applicant_receive_on_release_other_nature ?? '' }}
                    </td>
                    <td>{{ $registration->offender_refund_on_release_cash ?? '' }}</td>
                    <td>{{ $registration->offender_refund_on_release_tamasuk ?? '' }}</td>
                    <td>{{ $registration->offender_refund_on_release_cheque ?? '' }}</td>
                    <td>{{ $registration->offender_refund_on_release_land ?? '' }}</td>
                    <td>{{ $registration->offender_refund_on_release_kitta }}</td>
                    <td>{{ $registration->offender_refund_on_release_gold ?? '' }}</td>
                    <td>{{ $registration->offender_refund_on_release_silver ?? '' }}</td>

                    {{-- सहमती कार्यान्वयनको अवस्था --}}
                    <td>
                        @if ($registration->releases && isset($registration->releases->agreement_applied_status))
                            @if ($registration->releases->agreement_applied_status == 1)
                                भएको
                            @elseif ($registration->releases->agreement_applied_status == 0)
                                नभएको
                            @endif
                        @endif

                    </td>
                    <td>{{ $registration->releases->applied_due_date ?? '' }}</td>

                    {{-- अन्य --}}
                    {{-- <td>अन्य केही खुलाउनुपर्ने</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="to-hide">
        {{ $registration_reports->render() }}
    
    </div>


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
