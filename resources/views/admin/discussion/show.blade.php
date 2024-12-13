<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print" type="text/css">


    <style>
        .print-window {
            /* margin-top: 10px;
            margin-bottom: 20px;
            font-weight: 800;
            font-size: 16px;
            /* background-color: grey; */
            /* padding: 8px;
            color: white;
            letter-spacing: 2px;
            text-align: center; */ */
        }

        .print-window:hover {
            cursor: pointer;
        }
    </style>
    
</head>

<body>

    <div class="container-fluid d-flex justify-content-center mt-5 gap-4">
        <button class="btn btn-secondary back-button" href="{{ route('admin.discussion.index') }}">पछाडी जानुहोस</button>
        <button class="print-window btn btn-primary">प्रिन्ट गर्नुहाेस</button>
    </div>

    <div class="container">

        <div class="reg-trans-container d-flex mb-5 justify-content-around">

            <div class="registration-stuff">
                <h4>रजिष्ट्रेशन विवरण</h4>
    
                <p> रजिष्ट्रेशन नं: <span style="font-weight: 800">{{ $registration->registration_id }}</span></p>
                {{-- <p> REGISTERED BY: <span style="font-weight: 800">{{ $registration->register_by }}</span></p> --}}
                <p> लेनदेन रकम: <span style="font-weight: 800">{{ $registration->transaction_amount }}</span></p>
                <p> लेनदेन मिती: <span style="font-weight: 800">{{ $registration->tansaction_date }}</span></p>

            </div>

            <div class="transaction-stuff">

                <h4>लेनदेन</h4>
        
                @foreach ($transactionNature as $nature)
                    <p>प्रकृती : {{ $nature->nature->title }}</p>
                @endforeach
        
                @foreach ($transactionPurpose as $purpose)
                    <p>प्रयाेजन : {{ $purpose->purpose->title }}</p>
                @endforeach
        
                @foreach ($transactionProofs as $proof)
                    <p>प्रमाण : {{ $proof->proof->title }}</p>
                    <p>रकम : {{ $proof->amount }}</p>
                @endforeach
            </div>

        </div>


        <div class="app-off-container d-flex justify-content-around">

            <div class="app-stuff">
                
                <h4>निवेदक</h4>
                @foreach ($applicants as $applicant)
                <p> नाम: {{ $applicant->full_name }} </p>
                <p> फाेन नं: {{ $applicant->contact }} </p>
                <p> प्रदेश: {{ $applicant->district->state->name }} </p>
                <p> जिल्ला: {{ $applicant->district->name }} </p>
                <p> स्थानीय तह: {{ $applicant->local_government->name }} </p>
                <p> वडा नं : {{ $applicant->wada_id }} </p>
                <hr>
                @endforeach
            </div>

            <div class="off-stuff">

                <h4>साहु</h4>
                @foreach ($offenders as $offender)
                <p> नाम: {{ $offender->full_name }} </p>
                <p> फाेन नं: {{ $offender->contact }} </p>
                <p> प्रदेश: {{ $offender->district->state->name }} </p>
                <p> जिल्ला: {{ $offender->district->name }} </p>
                <p> स्थानीय तह: {{ $offender->local_government->name }} </p>
                <p> वडा नं : {{ $offender->wada_id }} </p>
                <hr>
                @endforeach 
            </div>
    
        </div>






        <div class=" mt-2">
            <table class="table table-bordered table-striped ">
                <thead class="thead-dark">
                    <tr>
                        <th>सि.नं.</th>
                        <th>रजिष्ट्रेशन नं</th>
                        <th>छलफल मिती</th>
                        <th>अन्तिम छलफल मिती</th>
                        <th>साहुद्वारा माग खुलाएकाे</th>
                        <th>साहुद्वारा माग रकम</th>
                        <th>निवेदकले तिर्न खाेजेकाे</th>
                        <th>असहमति कारण</th>
                        <th>सिर्जना गरेकाे</th>
                        <th>सम्पादन गरेकाे</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($discussions as $discussion)
                        <tr>
                            <td>{{ $discussion->id }}</td>
                            <td>{{ $discussion->registration_id }}</td>
                            <td>{{ $discussion->discussion_date }}</td>
                            <td>{{ $discussion->previous_date }}</td>
                            <td>{{ $discussion->offender_demand_reveal }}</td>
                            <td>{{ $discussion->offender_demand }}</td>
                            <td>{{ $discussion->applicant_willing_to_pay }}</td>
                            <td>{{ $discussion->reason_to_disagreement }}</td>
                            <td>{{ $discussion->created_at }}</td>
                            <td>{{ $discussion->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

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
