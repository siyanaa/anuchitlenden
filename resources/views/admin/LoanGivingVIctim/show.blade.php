@extends('admin.layouts.master')

@section('content')
@include('admin.includes.forms')
<head>
<style>
    ul li {
        list-style: none;
        line-height: 30px;
        margin-top: 10px;
    }
    @media print {
        body {
            margin-top: 1.5in;
            margin-left: 1.5in;
            margin-right: 0.5in;
            margin-bottom: 0;
        }
    }
</style>
</head>

<body>
    <div id="printableArea">
    <h1 class="text-center">अनुचित लेनदेन (मिटरब्याज) सम्बन्धी ऋण दिने व्यक्तिले भर्नुपर्ने फाराम</h1>
    <div class="container">
        <table class="table border">
            <tbody>
                <tr>
                    <td>नाम, थर : {{ $loanGivingVictim->basicDetailRegistration->applicant_name}}</td>
                    <td>उमेर : {{ $loanGivingVictim->basicDetailRegistration->applicant_age }}
                    </td>
                </tr>
                <tr>
                    <td>नागरिकता नं:{{ $loanGivingVictim->basicDetailRegistration->applicant_citizenship}}</td>
                    <td>जिल्ला: {{ $loanGivingVictim->basicDetailRegistration->applicant_citizenship_issue_district }}</td>
                    <td>जारी मिति:{{ $loanGivingVictim->basicDetailRegistration->applicant_citizenship_issue_date }}
                    </td>
                </tr>
                <tr>
                    <td>बुवाको नाम, थर :{{ $loanGivingVictim->basicDetailRegistration->applicant_fathername}}</td>
                    <td>ऋण दिने व्यक्ति को फोन/ मोबाईल नं:{{ $loanGivingVictim->basicDetailRegistration->applicant_fathers_no }}</td>
                </tr>
                <tr>
                    <td>पति/पत्नीको नाम थर:{{ $loanGivingVictim->basicDetailRegistration->applicant_spouse }} </td>
                    <td>फोन/मोबाईल नं:{{ $loanGivingVictim->basicDetailRegistration->applicant_spouse_no }}</td>
                </tr>
                <tr>
                    <td>सगोल परिवारको सदस्य संख्या:{{ $loanGivingVictim->basicDetailRegistration->applicant_family}}</td>
                    <td>वार्षिक आम्दानी:{{ $loanGivingVictim->basicDetailRegistration->applicant_annual_income }}</td>
                </tr>
                <tr>
                    <td>स्थायी ठेगाना:<br>
                        प्रदेश:
                        @php echo $getStateName($loanGivingVictim->basicDetailRegistration->applicant_permanent_state); @endphp<br>
                        जिल्ला: @php echo $getDistrictName($loanGivingVictim->basicDetailRegistration->applicant_permanent_district); @endphp
                    </td>
                    <td>हाल बसोबासको ठेगाना:
                        <br>
                        प्रदेश:{{$getStateName( $loanGivingVictim->basicDetailRegistration->applicant_temp_state)}}<br>जिल्ला:{{ $getDistrictName($loanGivingVictim->basicDetailRegistration->applicant_temp_district)}}
                    </td>
                </tr>
                <tr>
                    <td>न.पा./गा.पा:{{$getLocalName( $loanGivingVictim->basicDetailRegistration->applicant_permanent_local)}} <br> वडा नं.:{{ $loanGivingVictim->basicDetailRegistration->applicant_permanent_ward}}</td>
                    <td>न.पा./गा.पा:{{$getLocalName( $loanGivingVictim->basicDetailRegistration->applicant_temp_local) }}<br> वडा नं.:{{ $loanGivingVictim->basicDetailRegistration->applicant_temp_ward}}</td>
                </tr>
                <tr>
                    <td>(PAN) नं.{{$loanGivingVictim->basicDetailRegistration->applicant_pan}}</td>
                    <td>पेशा/व्यवसाय:{{ $loanGivingVictim->basicDetailRegistration->applicant_occup}}<br>शैक्षिक योग्यता:{{ $loanGivingVictim->basicDetailRegistration->applicant_edu}}</td>
                </tr>
            </tbody>
        </table>
        <ol>
            <b>
                <li>आर्थिक अवस्था:</li>
            </b>
            <ul>
              <li><b>(क) घरको विवरण:</b>
    <ul>
        <li>(अ) घरको संख्या: {{ $loanGivingVictim->applicationFinance->home_no }}</li>
        <li>(आ) घरले चर्चेको जग्गाको क्षेत्रफल: {{ $loanGivingVictim->applicationFinance->home_area }}</li>
        <li>(इ) घरको किसिम (कच्ची/पक्की): {{ $loanGivingVictim->applicationFinance->home_type }}</li>
        <li>(ई) घरको तला: {{ $loanGivingVictim->applicationFinance->home_storey }}</li>
        <li>(उ) घर रहेको स्थान: 
            {{ $getStateName($loanGivingVictim->applicationFinance->home_state) }},
            जिल्ला: {{ $getDistrictName($loanGivingVictim->applicationFinance->home_district) }},
            न.पा./गा.पा: {{ $getLocalName($loanGivingVictim->applicationFinance->home_local) }},
            वडा नं: {{ $loanGivingVictim->applicationFinance->home_ward }}
        </li> 
    </ul>
</li>
                 
                <li><b>(ख) जग्गाको विवरण:</b><br>
                    
                    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <b>किता नंवर</b> &nbsp; &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>क्षेत्रफल</b>&nbsp;
                    &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>जिल्ला
                    </b>&nbsp; &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>न.पा./गा.पा.</b>&nbsp;
                    &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>वडा नं.</b>
                    <ul style="list-style-type: none; padding: 0; margin: 0;">
                        <li style="display: inline-block; margin-right: 180px;">(अ) {{$loanGivingVictim->applicationFinance->land_kitta }}</li>
                        <li style="display: inline-block; margin-right: 125px;"> {{$loanGivingVictim->applicationFinance->land_area }}</li>
                        <li style="display: inline-block; margin-right: 185px;"> {{ $getStateName($loanGivingVictim->applicationFinance->land_state ) }}</li>
                        <li style="display: inline-block; margin-right: 160px;"> {{ $getDistrictName($loanGivingVictim->applicationFinance->land_district) }}</li>
                    
                        <li style="display: inline-block; margin-right:0px;"> {{$loanGivingVictim->applicationFinance->land_ward}}</li>
                        <li>(आ)<li>
                        <li>(इ)</li>
                        <li>(ई)</li>
                        </ul>
                    </li>
                
                <li><b>(ग)सवारी साधनको विवरण: </b> {{$loanGivingVictim->applicationFinance->vehicle_description }}
                    <ul>
                    <li>सवारी साधनको संख्या: {{$loanGivingVictim->applicationFinance->vehicle_count }}</li>
                    </ul>
                    {{-- <ul>
                        <li>(अ) मोटरको संख्या:<input type="text" ></li>
                        <li>(आ) मोटर साईकलको संख्या:<input type="text"></li>
                        <li>(इ) स्कुटरको संख्या:<input type="text"></li>
                        <li>(ई) घोडाको संख्या:<input type="text"></li>
                        <li>(उ) अन्य सवारी साधनको संख्या:<input type="text"></li>
                    </ul> --}}
                </li>
                <li><b>(घ) चल सम्पत्तिको विवरण:</b> {{$loanGivingVictim->applicationFinance->amount_asset_description }}
                    <ul>
                        <li> चल सम्पत्तिको संख्या: {{$loanGivingVictim->applicationFinance->amount_asset_count }}</li>
                        </ul>
                    
                   
                </li>

                <li><b>(ङ) बैङ्क तथा वित्तिय संस्था (सहकारी/लघुवित्त समेत) मा खोलिएको बैंक खाता विवरण :</b>
                    <ul>
                        <li>(अ) संस्थाको नाम:{{ $loanGivingVictim->applicationFinance->finance_name }} </li>
                        <li>(आ) शाखा:{{ $loanGivingVictim->applicationFinance->finance_branch }} </li>
                        <li>(इ) खाता खोलेको मिति:{{ $loanGivingVictim->applicationFinance->finance_accountissue_date}}</li>
                        <li>(ई) बैंक मौज्दात:{{ $loanGivingVictim->applicationFinance->finance_data}} </li>
                    </ul>
                </li>
               
                <li><b>(च.) बैङ्क तथा वित्तिय संस्था (सहकारी/लघुवित्त समेत) बाट ऋण लिएको भए:</b>
                    <ul>
                        <li>(अ) संस्थाको नाम:{{ $loanGivingVictim->applicationFinance->loan_finance_name }} </li>
                        <li>(आ) शाखा:{{ $loanGivingVictim->applicationFinance->loan_finance_branch }} </li>
                        <li>(इ) कर्जाको दायित्व:{{ $loanGivingVictim->applicationFinance->loan_finance_liability }}</li>
                        <li>(ई) तिर्न बाँकी कर्जा रकम:{{ $loanGivingVictim->applicationFinance->loan_finance_remainingpay }} </li>
                    </ul>
                </li>

            </ul>
            </li>
            <b>
                <li>ऋण/कर्जा लिने व्यक्तिको विवरण:</li>
            </b>
            <ul>
                <li>(क) कर्जा लिने व्यक्तिको नाम, थर:{{ $loanGivingVictim->debtorDetails->debtor_name }}<br>
                    ठेगाना:{{ $loanGivingVictim->debtorDetails->debtor_local}}</li>
                <li>(ख) कर्जा कारोबार भएको मिति:{{ $loanGivingVictim->debtorDetails->debit_date }}</li>
                <li>(ग) कर्जा कारोबार रकम:{{ $loanGivingVictim->debtorDetails->debit_amount }}</li>
                <li>(घ) कारोबार गरेको माध्यम: {{ $loanGivingVictim->debtorDetails->debit_medium}}
                    {{-- <ul>
                        <li>अ. नगद दिएको </li>
                        <li>आ. ऋणीको जग्गा राजिनामा पारित गराइएको </li>
                        <li>इ. ऋणीको जग्गा दृष्टिबन्धक गराइएको </li>
                        <li>ई. ऋणी सँग लिखत/तमसुक गराएको वा नगराएको </li>
                        <li>उ. चेकको माध्यमबाट ऋण दिएको</li>
                        <li>ऊ. ऋण दिँदा ऋणी सँग चेक लिइएको </li>
                        <li>ऋ. लिखत/तमसुक गराई ऋणीसँग चेक लिएको </li>
                    </ul> --}}
                </li>
                <li>(ङ) अन्य व्यक्तिलाई ऋण दिएको भए अन्य ऋणीको संख्या: {{ $loanGivingVictim->debtorDetails->other_debtors_no }} &nbsp; &nbsp; कुल ऋण रकम :{{ $loanGivingVictim->debtorDetails->other_debtors_amount }}<br>
                    भएको भए दर्ता नं. {{ $loanGivingVictim->debtorDetails->statement_register_no}}</li>
            </ul>

            <b>
                <li>यो लेनदेन कारोबारको रकमबाट हालसम्म प्राप्त गरेको ब्याज रकम:
                    @foreach($data as $value)
                   
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                                @php
                        $trans_amount_array = explode(',', $loanDetail->trans_amount);
                    @endphp

                    @foreach($trans_amount_array as $key => $trans_amount)
                    <div class="text-field" style="{{ $loanDetail->trans_medium ? 'display: block;' : 'display: none;' }}">
                       {{ $trans_amount }}
                    </div>
                    @endforeach
                </li>
            </b>
            <ul>
                {{-- <li>(क) नगद <input type="text" ></li>
                <li>(ख) चेक <input type="text"></li>
                <li>(ग) जिन्सी <input type="text"></li>
                <li>(घ) अन्य <input type="text"></li> --}}
            </ul>
            <b>
                <li>यो लेनदेन कारोबारको रकमबाट हालसम्म प्राप्त गरेको मुलधन रकम:
                    @foreach($dataCapital as $value)
                                    <option value="{{ $value }}" @if($loanDetail->trans_capital_medium == $value) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            @php
                            $trans_capital_amount_array = explode(',', $loanDetail->trans_capital_amount);
                        @endphp
                        
                        @foreach($trans_capital_amount_array as $key => $trans_amount)
                        <div class="text-field" style="{{ $loanDetail->trans_capital_medium ? 'display: block;' : 'display: none;' }}">
                           {{ $trans_amount }}
                        </div>
                        @endforeach
                </li>
            </b>
            <ul>
                {{-- <li>(क) नगद <input type="text"></li>
                <li>(ख) चेक <input type="text"></li>
                <li>(ग) जिन्सी <input type="text"></li>
                <li>(घ) अन्य <input type="text"></li> --}}
            </ul>
            <b>
                <li>उजुरी कर्ता सँग असुल गर्न बाँकी कर्जा रकम:</li>
            </b>
            सावाँ :{{ $loanGivingVictim->transactionRegistration->comp_amt_rem_prin }} <br>
            व्याज:{{ $loanGivingVictim->transactionRegistration->comp_amt_rem_interest }}
            <b>
                <li>ऋण/कर्जा दिएको बखत जग्गा राजिनामा/दृष्टिबन्धक पारित गरिएको भए:</li>
            </b>
            <ul>
                <li>(क) साविकको जग्गा धनीको नाम, थर: {{ $loanGivingVictim->otherDetails->loan_landrestrict_owner }}</li>
                <li>(ख) ऋणीको नाम, थर: {{ $loanGivingVictim->otherDetails->loan_taking_person_name }}</li>
                <li>(ग) जग्गा पारित गरी लिएको व्यक्तिको नाम, थर:{{ $loanGivingVictim->otherDetails->land_passed_name}}</li>
                <li>(घ) लिखत रजिष्ट्रेशन गराई लिने व्यक्तिसँग तपाईको नाता, सम्बन्ध:{{ $loanGivingVictim->otherDetails->registered_person_relation }}</li>
                <li>(ङ) जग्गाको किता नं :{{ $loanGivingVictim->otherDetails->landrestrict_kitta }} &nbsp; &nbsp; क्षेत्रफल :{{ $loanGivingVictim->otherDetails->landrestrict_area }}</li>
                <li>(च) जग्गा रहेको स्थान :{{$getStateName ($loanGivingVictim->otherDetails->landrestrict_state)}} &nbsp; &nbsp; जिल्ला :{{ $getDistrictName ($loanGivingVictim->otherDetails->landrestrict_district) }} &nbsp;&nbsp; न.पा./गा.पा {{$getLocalName ($loanGivingVictim->otherDetails->landrestrict_local)}}&nbsp;&nbsp;
                    वडा नं. {{ $loanGivingVictim->otherDetails->landrestrict_ward}}</li>
                <li>(छ) जग्गा रजिष्ट्रेशन भएको मिति :{{ $loanGivingVictim->otherDetails->landrestrict_registration_date }}</li>
            </ul>
            <b>
                <li>ऋण/कर्जा दिएको बखत ऋणी सँग बैंक चेक लेखाई लिएको छ <input type="radio" value="1" {{ $previouslyStoredValueForChequeShown == 1 ? 'checked' : 'disabled' }} > वा छैन <input
                        type="radio" value="0" {{ $previouslyStoredValueForChequeShown == 0 ? 'checked' : 'disabled' }}><br>
                    त्यस्तो चेक लिएको भए:</li>
            </b>
            <ul>
                <li>(क) चेक उपलब्ध गराउने व्यक्तिको नाम, थर :{{ $loanGivingVictim->otherDetails->cheque_giving_person }}</li>
                <li>(ख) चेक प्राप्त गर्ने व्यक्तिको नाम, थर :{{ $loanGivingVictim->otherDetails->cheque_receiving_person }}</li>
                <li>(ग) चेक काटेको मिति :{{ $loanGivingVictim->otherDetails->cheque_issue_date }}</li>
                <li>(घ) चेक बाउन्स भएको मिति :{{ $loanGivingVictim->otherDetails->cheque_bounce_date }}</li>
                <li>(ङ) चेकमा उल्लेख भएको रकम :{{ $loanGivingVictim->otherDetails->cheque_detail_amount }}</li>
                <li>(च) चेक सम्बन्धी अन्य विवरण :{{$loanGivingVictim->otherDetails->cheque_other_details }}</li>
            </ul>
            <b>
                <li>ऋण/कर्जा कारोवारको सम्बन्धमा निज ऋणीको विरुद्धमा अदालतमा मुद्दा परेको छ <input type="radio" value="1" {{ $previouslyStoredValueForCourtCasePending == 1 ? 'checked' : 'disabled' }}>
                    छैन <input type="radio" value="0" {{ $previouslyStoredValueForCourtCasePending == 0 ? 'checked' : 'disabled' }}></li>
            </b>
            <ul>
                <li>(क)अदालतमा मुद्दा दायर भएको भए हालको अवस्था: {{ $loanGivingVictim->otherDetails->court_case_state_name}}</li>
                {{-- <ul>
                    <li>(अ) विचाराधीन रहेको <input type="text"></li>
                    <li>(आ) फैसला भैसकेको <input type="text"></li>
                    <li>(इ) फैसला कार्यान्वयन भैसकेको <input type="text"></li>
                    <li>(ई) फैसला कार्यान्वयनको क्रममा रहेको <input type="text"></li>
                    <li>(उ) फैसला कार्यान्वयन नभएको <input type="text"></li>
                    <li>(ऊ) आशिंक रुपमा फैसला कार्यान्वयन भएको <input type="text"></li>
                </ul> --}}
                <li>(ख) मुद्दाको विषय र मुद्दा नं :{{ $loanGivingVictim->otherDetails->court_case_subject }}</li>
                <li>(ग) नपुग बिगो वापत ऋणि कैदमा रहेको अवस्था छ <input type="radio" value="1" {{ $previouslyStoredValueForPersonJail == 1 ? 'checked' : 'disabled' }}> छैन <input
                        type="radio" value="0" {{ $previouslyStoredValueForPersonJail == 0 ? 'checked' : 'disabled' }}>
                </li>
            </ul>
            <b>
                <li>अदालतबाट मुद्दा फैसला भइसकेको भए (<i class="fa-solid fa-check"></i>)</li>
            </b>
            <ul>
                <li>(क) विगो भराउने/जरिवाना/कैद तीनै प्रकारको सजाय भएको <input type="radio" value="1" {{ $previouslyStoredValueForCourtDecision == 1 ? 'checked' : 'disabled' }}>
                (ख) बिगो भराउने र जरिवाना मात्र भएको <input type="radio" value="0" {{ $previouslyStoredValueForCourtDecision == 0 ? 'checked' : 'disabled' }}></li>
            </ul>
            <b>
                <li>कर्जा लेनदेनको क्रममा दृष्टिबन्धक/राजीनामा पारित गरेको भए घर/जग्गा हाल कसले भोगचलन गरिरहेको छ?
                    
                </li>
            </b>
            {{ $loanGivingVictim->otherDetails->landrestricted_usedby_now }}
            <br>
            <br>
            <br>
            <br>
            <b>
                <li>रजिष्ट्रेशन पारित गर्दा छुट्टै शर्तनामाको कागज गरिएको थियो <input type="radio" value="1" {{ $previouslyStoredValue == 1 ? 'checked' : 'disabled' }}> थिएन <input
                        type="radio" value="0" {{ $previouslyStoredValue == 0 ? 'checked' : 'disabled' }}>
                    गरिएको भए के शर्त राखिएको थियो?
                </li>
            </b>
            <ul>
                <li>{{$loanGivingVictim->otherDetails->when_registered_othercondition_name}}</li>
             
                
            </ul>
            <b>
                <li>यो लेनदेन सम्बन्धमा अन्य केही कुरा खुलाउनुपर्ने भए? </li>
            </b>
            <br>
            {{ $loanGivingVictim->otherDetails->other_details_in_transaction}}
            <br>
            <br>
            <br>
            <br>
            <b>
                <li>यो निवेदनको ब्यहोरा पुष्टि गर्ने निम्न कागजातहरु (लिखत/तमसुक समेत) फोटोकपी यसैसाथ संलग्न गरेको
                    छु।</li>
            </b>
            <ul>
                <li>{{ $loanGivingVictim->otherDetails->application_attached_documents }} </li>
                {{-- <li>{{ $loanGivingVictim->otherDetails->application_document_files }} </li> --}}
                
            </ul>
            <b>
                <li>माथि लेखिएको व्यहोरा मैले जाने बुझेसम्म ठिक साँचो हो। यसमा फरक परे कानून बमोजिम सहुँला बुझाउँला
                    भनी सहीछाप गरिदिए</li>
            </b>
        </ol>
        <div class="row">
            <div class="col-lg-6">
                <b>ल्याप्चे सहीछाप:</b><br>
                <table border="1">
                    <tr>
                        <th class="px-5 border border-dark">दायाँ</th>
                        <th class="px-5 border border-dark">बाँयाँ</th>
                    </tr>
                    <tr>
                        <th class=" border border-dark"><br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <p>सहीछाप गर्नेको नाम थर: {{ $loanGivingVictim->otherDetails->stamped_name }}</p>
                <br>
                <p>हस्ताक्षर: {{ $loanGivingVictim->otherDetails->stamped_name }}</p>
                <br>
                <p>मिति:{{ $loanGivingVictim->otherDetails->stamped_date }}</p>
            </div>
        </div>
    </div>
        <div class="container">
            <!-- Print Button -->
            <div class="d-flex justify-content-end">
                <button onclick="printPage()" class="btn btn-primary">
                    <i class="fa fa-print"></i> Print
                </button>
            </div>
        </div>
        <script>
            function printPage() {
                var printContent = document.getElementById('printableArea').innerHTML;
                var originalContent = document.body.innerHTML;
                document.body.innerHTML = printContent;
                window.print();
                document.body.innerHTML = originalContent;
            }
        </script>
@endsection