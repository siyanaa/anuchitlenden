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
        <a class="btn btn-secondary back-button" href="{{ route('admin.reports.under_discussion_details') }}">पछाडी
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
                <th colspan="2">छलफल मिति</th>
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


                <th>कुल छलफल</th>
                <th>छलफल मिति</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($registration_reports as $registration)
                <tr>
                    <td>{{ $loop->iteration }}</td>
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
                    {{-- same upto here --}}


                    <td>{{ count($registration->discussions) }}</td>
                    <td>{{ $registration->last_discussed_date }}</td>
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
