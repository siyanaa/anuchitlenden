@extends('admin.layouts.master')

@section('content')
    @include('admin.includes.forms')
    <style>
        ul li {
            list-style: none;
            line-height: 30px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1 class="text-center">अनुचित लेनदेन (मिटरब्याज) सम्बन्धी पीडितले भर्ने निवेदन फाराम</h1>
    <div class="container">
        <ol>
            <b>
                <li>निवेदक(ऋण/कर्जा लिने व्यक्ति) को विवरण:</li>
            </b>
            <table class="table border">


                <tbody>
                    <tr>
                        <td>नाम, थर : {{ $loanTakingVictim->basicDetailRegistration->applicant_name}}</td>
                        <td>उमेर : {{ $loanTakingVictim->basicDetailRegistration->applicant_age }}
                        </td>
                    </tr>
                    <tr>
                        <td>नागरिकता नं: {{ $loanTakingVictim->basicDetailRegistration->applicant_citizenship}}</td>

                        <td>जिल्ला: {{ $loanTakingVictim->basicDetailRegistration->applicant_citizenship_issue_district }}
                        </td>
                        <td>
                            जारी मिति:  {{ $loanTakingVictim->basicDetailRegistration->applicant_citizenship_issue_date }}</td>
                    </tr>
                    <tr>
                        <td>बुवाको नाम, थर : {{ $loanTakingVictim->basicDetailRegistration->applicant_fathername}}</td>
                        <td>फोन/मोबाईल नं: {{ $loanTakingVictim->basicDetailRegistration->applicant_fathers_no }}</td>
                    </tr>
                    <tr>
                        <td>पति/पत्नीको नाम थर: {{ $loanTakingVictim->basicDetailRegistration->applicant_spouse }}</td>
                        <td>फोन/मोबाईल नं: {{ $loanTakingVictim->basicDetailRegistration->applicant_spouse_no }}</td>
                    </tr>
                    <tr>
                        <td>सगोल परिवारको सदस्य संख्या: {{ $loanTakingVictim->basicDetailRegistration->applicant_family}}</td>
                        <td>वार्षिक आम्दानी: {{ $loanTakingVictim->basicDetailRegistration->applicant_annual_income }}</td>
                    </tr>
                    <tr>
                        <td>स्थायी ठेगाना:
                            <br>
                            प्रदेश: {{ $getLocalName($loanTakingVictim->basicDetailRegistration->applicant_permanent_state ) }}
                            जिल्ला: {{ $getDistrictName ($loanTakingVictim->basicDetailRegistration->applicant_permanent_district)  }}
                        </td>
                        
                        <td>हाल बसोबासको ठेगाना:
                            <br>
                            प्रदेश:{{$getLocalName ($loanTakingVictim->basicDetailRegistration->applicant_temp_state)  }}
                            जिल्ला: {{$getDistrictName($loanTakingVictim->basicDetailRegistration->applicant_temp_district)}}
                        </td>
                    </tr>
                    <tr>
                        <td>न.पा./गा.पा:{{$getLocalName( $loanTakingVictim->basicDetailRegistration->applicant_permanent_local)}}  वडा नं.: {{ $loanTakingVictim->basicDetailRegistration->applicant_permanent_ward}}</td>
                        <td>न.पा./गा.पा:{{$getLocalName( $loanTakingVictim->basicDetailRegistration->applicant_temp_local)}} वडा नं.: {{ $loanTakingVictim->basicDetailRegistration->applicant_temp_ward}}</td>
                    </tr>
                    <tr>
                        <td>(PAN) नं. : {{$loanTakingVictim->basicDetailRegistration->applicant_pan}}</td>
                        <td>पेशा/व्यवसाय: {{ $loanTakingVictim->basicDetailRegistration->applicant_occup}}</td>
                        <td>शैक्षिक योग्यता: {{ $loanTakingVictim->basicDetailRegistration->applicant_edu}}</td>
                    </tr>
                </tbody>
            </table>
            <b>
                <li>विपक्षी(ऋण/कर्जा दिने  व्यक्ति) को विवरण:</li>
            </b>
            <table class="table border">
                <tbody>
                    <tr>
                        <td>नाम, थर : {{ $loanTakingVictim->basicOpponentDetailRegistration->opponent_name}}</td>
                        <td>उमेर : {{ $loanTakingVictim->basicOpponentDetailRegistration->opponent_age}}
                        </td>
                    </tr>
                    <tr>
                        <td>पिताको नाम, थर :{{ $loanTakingVictim->basicOpponentDetailRegistration->opponent_fathername}}</td>

                        <td>फोन/मोबाईल नं: {{ $loanTakingVictim->basicOpponentDetailRegistration->opponent_fathers_no}}</td>
                    </tr>
                    <tr>
                        <td>पति/पत्नीको नाम थर: {{ $loanTakingVictim->basicOpponentDetailRegistration->opponent_spouse}}</td>
                        <td>फोन/मोबाईल नं: {{ $loanTakingVictim->basicOpponentDetailRegistration->opponent_spouse_no}}</td>
                    </tr>
                    <tr>
                        <td>स्थायी ठेगाना: 
                            <br>
                            प्रदेश: {{$getLocalName ( $loanTakingVictim->basicOpponentDetailRegistration->opponent_permanent_state)}}
                            जिल्ला: {{$getDistrictName ( $loanTakingVictim->basicOpponentDetailRegistration->opponent_permanent_district)}}
                        </td>
                        <td>हाल बसोबासको ठेगाना:
                            <br>
                            प्रदेश:{{ $getLocalName ($loanTakingVictim->basicOpponentDetailRegistration->opponent_temp_state)}}
                            जिल्ला:{{$getDistrictName ( $loanTakingVictim->basicOpponentDetailRegistration->opponent_temp_district)}}
                        </td>
                    </tr>
                    <tr>
                        <td>न.पा./गा.पा: {{ $getLocalName ($loanTakingVictim->basicOpponentDetailRegistration->opponent_permanent_local)}} 
                            वडा नं.: {{ $loanTakingVictim->basicOpponentDetailRegistration->opponent_permanent_ward}}</td>
                        <td>न.पा./गा.पा:{{$getLocalName ( $loanTakingVictim->basicOpponentDetailRegistration->opponent_temp_local)}}
                             वडा नं.: {{ $loanTakingVictim->basicOpponentDetailRegistration->opponent_temp_ward}}
                            </td>
                    </tr>
                    <tr>
                        <td>पेशा/व्यवसाय: {{ $loanTakingVictim->basicOpponentDetailRegistration->opponent_occupation}} </td>
                        <td>शैक्षिक योग्यता: {{ $loanTakingVictim->basicOpponentDetailRegistration->opponent_education_level}}</td>
                    </tr>
                </tbody>
            </table>
            <b>
                <li>ऋण/कर्जा कारोबारको विवरण:</li>
            </b>
            <ul>
                <li><b>(क)</b> ऋण लिनुपर्ने कारण/प्रयोजन(<i class="fa-solid fa-check"></i>)
                    <ul>
                        {{( $loanTakingVictim->loanDetail->loan_purpose)}}
                    </ul>
                </li>
                <li><b>(ख)</b> कर्जा/ऋण कारोबार भएको मिति: {{ $loanTakingVictim->loanDetail->loan_date}}</li>
                <li><b>(ग)</b> कर्जा/ऋण कारोबार भएको स्थान: {{ $loanTakingVictim->loanDetail->loan_location}}</li>
                <li><b>(घ)</b> कर्जा/ऋण कारोबार भएको रकम:{{ $loanTakingVictim->loanDetail->loan_amount}}</li>
                <li><b>(ङ)</b> कर्जा/ऋण कारोबार हुँदाका बखतका साक्षीहरु</li>
                <ul>
                    {{ $loanTakingVictim->loanDetail->loan_witness}}
                    <li><b>(उ)</b> लिखत लेख्ने व्यक्तिको नाम, थर : {{ $loanTakingVictim->loanDetail->loan_docs_write}}</li>
                     <li> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;ठेगाना: {{ $loanTakingVictim->loanDetail->loan_docs_address}} </li>
                </ul>
            </ul>
            <b>
                <li>ऋण/कर्जा लिएको माध्यम (<i class="fa-solid fa-check"></i>) 
                </li>
            </b>
            
                    <ul>
                        {{($loanTakingVictim->loanDetail->loan_medium)}}
                    </ul>
                
            
            <b>
                <li>ऋण/कर्जा लिँदाका बखतका विवरण तथा शर्तहरु:</li>
            </b>
            <ul>
                    <li>
                        <li>
                            <li><b>(क)</b> कर्जा लिँदा तमसुक/लिखत/सम्झौता भएको  
                                <input type="radio" value="1" {{ $previouslyStoredValueForLoanDocs == '1' ? 'checked' : 'disabled' }}> भएको  
                                <input type="radio" value="0" {{ $previouslyStoredValueForLoanDocs == '0' ? 'checked' : 'disabled' }}> नभएको 
                            </li>
                            
                        </li>
                        
                    </li>
                     </li>
                <ul>
                    <li><b>(अ)</b> लेनदेन भएको रकम र तमसुकमा उल्लेख भएको रकम समान 
                        <input type="radio" value="1" {{ $previouslyStoredValueForLoanSame == '1' ? 'checked': 'disabled'  }}> भएको 
                        <input type="radio" value="0" {{ $previouslyStoredValueForLoanSame == '0' ? 'checked': 'disabled'  }}> नभएको
                    </li>

                    <li><b>(आ)</b> लिखत/तमसुकमा उल्लेख भएको रकम : {{ $loanTakingVictim->loanDetail->loan_tamasuk_amount}}</li>
                    <li><b>(इ)</b> ऋण/कर्जा कारोबार भएको वास्तविक रकम: {{ $loanTakingVictim->loanDetail->loan_transaction_actual_amount}}</li>
                    <li><b>(ई)</b> ऋण लिँदा सही छाप मात्र गरी धनिलाई खाली चेक दिएको <input type="radio" value="1" {{ $previouslyStoredValueForLoanStamp == '1' ? 'checked' : 'disabled' }}>  
                            नदिएको  <input type="radio" value="1" {{ $previouslyStoredValueForLoanStamp == '0' ? 'checked' : 'disabled' }}></li> 
                    <li><b>(उ)</b> धनी/साहुलाई रकम उल्लेख भएको चेक दिएको भए, चेकमा के कति रकम भरेको हो? {{ $loanTakingVictim->loanDetail->taken_loan_stamp_amount}}
                    </li>
                    <li><b>(ऊ)</b> लिखत/तमसुक परिवर्तन गरेको <input type="radio" value="1"  {{ $previouslyStoredValue == '1' ? 'checked': 'disabled' }} > 
                                नगरेको <input type="radio" value="0"  {{ $previouslyStoredValue == '0' ? 'checked': 'disabled' }} > </li>
                </ul>
                <li><b>(ख)</b> जग्गा राजिनामा पारीत गरी दिई ऋण/कर्जा लिएको सम्बन्धमा:</li>
                <ul>
                    <li><b>(अ)</b> जग्गा फिर्ता गर्ने शर्त राखिएको थियो <input type="radio" value="1" {{ $previouslyStoredValueForLandReturn == '1' ?'checked': 'disabled' }}>
                         राखिएको थिएन <input type="radio" value="0" {{ $previouslyStoredValueForLandReturn == '0' ?'checked': 'disabled' }}>
                    </li>
                    <li><b>(आ)</b> कुनै अर्को शर्त राखेर अर्को लिखत/तमसुक खडा गरिएको थियो <input type="radio" value="1"  {{ $previouslyStoredValueForOtherReturnPromise == '1' ?'checked': 'disabled' }} > 
                        थिएन <input type="radio" value="0"  {{ $previouslyStoredValueForOtherReturnPromise == '0' ?'checked': 'disabled' }} > 
                    </li>
                </ul>
                <li><b>(ग)</b> हाल सो जग्गाको भोग कसले गरिरहेको छ?
                    <br>{{ $loanTakingVictim->loanDetail->land_rights_possessed_by_whome }}
                    <br>
                    @if ($loanTakingVictim->loanDetail->land_rights_possessed_by_whome == 'अन्य व्यक्ति')
                        अन्य व्यक्ति भए निजको नाम, थर: {{ $loanTakingVictim->loanDetail->land_used_by_name }}
                        <br>
                        ठेगाना: {{ $loanTakingVictim->loanDetail->land_used_by_address }}
                    @endif
                </li>
                <li><b>(घ)</b> जग्गा दृष्टिबन्धक गरी पारित गरिदिई ऋण/कर्जा लिएकोमा: </li>
                <ul>
                    <li><b>(अ)</b> जग्गा दृष्टिबन्धक लिखत गर्दा अन्य केही शर्त राखिएको थियो <input type="radio" value="1" {{ $previouslyStoredValueForLandStopPromise == '1' ?'checked': 'disabled' }}>
                         थिएन <input type="radio" value="0" {{ $previouslyStoredValueForLandStopPromise == '0' ?'checked': 'disabled' }}></li> 

                    <li><b>(आ)</b> शर्त राखिएको भए के शर्त राखिएको थियो? {{ optional($loanTakingVictim->loanDetail)->land_stop_promise_state }}</li>
                    <li><b>(इ)</b> उक्त दृष्टिबन्धक राखिएको जग्गाको भोग चलन कसले गरिरहेको छ?
                       {{ $loanTakingVictim->loanDetail->land_stop_promise_who_name }}
                       @if ($loanTakingVictim->loanDetail->land_stop_promise_who_name == 'अन्य व्यक्ति')
                  
                        <br>
                        अन्य व्यक्ति भए निजको नाम, थर: {{ $loanTakingVictim->loanDetail->land_stop_promise_used_by_name}}
                        ठेगाना: {{ $loanTakingVictim->loanDetail->land_stop_promise_used_by_address}}
                        @endif
                    </li>
                </ul>
                <li><b>(ङ)</b> तमसुक/शर्तनामामा जमानी राखेको भए:</li>
                <ul>
                    <li><b>(क)</b> जमानी बस्नेको कुनै शर्त थियो <input type="radio" value="1" {{ $previouslyStoredValueForWitnessAnyPromise == '1' ?'checked': 'disabled' }}> 
                        थिएन <input type="radio" value="0" {{ $previouslyStoredValueForWitnessAnyPromise == '0' ?'checked': 'disabled' }}></li>
                        @if($previouslyStoredValueForWitnessAnyPromise == '1')
                    <li><b>(ख)</b> शर्त थियो भने के थियो?: {{ optional($loanTakingVictim->loanDetail)->witness_any_promise_state }}</li>
                       @endif
                </ul>
            </ul>
            <b>
                <li>लिखत/तमसुकमा उल्लेख भएको मुलधन र ब्याज सम्बन्धमा:</li>
            </b>
            <ul>
                <li><b>(क)</b> लिखत/तमसुकमा उल्लेख भएको ब्याजदर प्रतिशत: {{ $loanTakingVictim->interestDetail->written_docs_interest_rate}}</li>
                <li><b>(ख)</b> बुझाउने/बुझाएको ब्याजदर प्रतिशत: {{ $loanTakingVictim->interestDetail->written_docs_given_interest_rate}}</li>
                <li><b>(ग)</b> हाल सम्म बुझाएको ब्याज रकम: {{ $loanTakingVictim->interestDetail->till_now_interest_amount}} </li>
                <li><b>(घ)</b> ब्याज बुझाएको माध्यम</li>
                <ul>

                    {{($loanTakingVictim->interestDetail->interest_paid_medium)}}
                    <br>
              
                </ul>
                <li><b>(ङ)</b> हालसम्म बुझाएको मूल धन वापतको रकम: {{ $loanTakingVictim->interestDetail->till_now_paid_capital}}</li>
                <li><b>(च)</b> बुझाउन बाँकी रकम: {{ $loanTakingVictim->interestDetail->till_now_to_be_paid_amount}}</li>
                <li><b>(छ)</b> लिखत वडा कार्यालयमा दर्ता भएको  <input type="radio" value="1" {{ $previouslyStoredValue == '1' ?'checked': 'disabled' }}> 
                         नभएको  <input type="radio" value="0" {{ $previouslyStoredValue == '0' ?'checked': 'disabled' }}> 
                </li>
            </ul>
            <b>
                <li>ऋण/कर्जा/तमसुक/लिखत अनुसार साँवा ब्याज बुझाउने अन्तिम म्याद (भाखा)</li></b> {{ $loanTakingVictim->interestDetail->loan_amount_pay_last_date}}
                
            
            <b>
                <li>ऋण/कर्जा कारोवारको सम्बन्धमा अदालतमा मुद्दा परेको <input type="radio"  value="1" {{ $previouslyStoredCourtValue == '1'? 'checked': 'disabled' }}  > 
                    नपरेको <input type="radio"  value="0" {{ $previouslyStoredCourtValue == '0'? 'checked': 'disabled' }}  >
                </li>
            </b>
            <ul>
                @if($previouslyStoredCourtValue == '1')
                <li><b>(क)</b> अदालतमा मुद्दा दायर भएको भए:</li>
                <ul>
            {{ $loanTakingVictim->courtDetail->issue_in_court_result}}
            
                </ul>
                <li><b>(ख)</b> मुद्दाको विषय: {{ $loanTakingVictim->courtDetail->issue_in_court_subject}}
                     मुद्दा नं: {{ $loanTakingVictim->courtDetail->issue_in_court_subject_no}}.</li>
            </ul>
           
            <b>
                <li>अदालतको फैसलाको अवस्था:</li>
            </b>
            <ul>
                <li><b>(क)</b> फैसला बमोजिम भरीभराउ भई पीडितको अचल सम्पत्ति डाँक लिलाम भएको <input type="radio" value="1" {{ $previouslyStoredCourtValue == '1' ? 'checked': 'disabled' }}  >
                     नभएको <input type="radio" value="0" {{ $previouslyStoredCourtValue == '0' ? 'checked': 'disabled' }}  >
                </li>
                <li><b>(ख)</b> डाँक लिलाममा उक्त अचल सम्पत्ति कसले सकार गरेको हो?
                    नाम, थर: {{ $loanTakingVictim->courtDetail->applicant_collapse_by_who_name}}
                    ठेगाना: {{ $loanTakingVictim->courtDetail->applicant_collapse_by_who_address}}
                </li>
                <li><b>(ग)</b> फैसला बमोजिम रकम असुल उपर गर्न सम्पत्ति नभएकोले थुनामा राखी पाऊ भन्ने निवेदन परेको <input type="radio" value="1" {{ $previouslyStoredCourtValue == '1'? 'checked': 'disabled' }}  > 
                        नपरेको <input type="radio" value="0" {{ $previouslyStoredCourtValue == '0'? 'checked': 'disabled' }}  > 
                </li>
                <li><b>(घ)</b> थुनामा राख्ने आदेश भएको  <input type="radio" value="1" {{ $previouslyStoredCourtValue == '1'? 'checked': 'disabled' }}  > 
                     नभएको  <input type="radio" value="0" {{ $previouslyStoredCourtValue == '0'? 'checked': 'disabled' }}  > </li>
                     @if($previouslyStoredCourtValue == '1')
                <li><b>(ङ)</b> थुनामा गैसकेको भए थुनामा गएको मिति {{ $loanTakingVictim->courtDetail->if_in_jail_start_date}} र थुनामा बस्नुपर्ने
                    अवधि {{ $loanTakingVictim->courtDetail->if_in_jail_start_duration}}</li>
                    @endif
                    @endif
            </ul>
            <b>
                <li>
                    ऋणी उपर चेक बाउन्स सम्बन्धी मुद्दा </li>  </b> भएको 
                    <input type="radio" value="1" {{ $previouslyStoredCourtValue == '1' ? 'checked' : 'disabled' }}> 
                    नभएको  
                    <input type="radio" value="0" {{ $previouslyStoredCourtValue == '0' ? 'checked' : 'disabled' }}>
                    <br>
                    @if($previouslyStoredCourtValue == '1')
                        भए त्यो मुद्दाको अवस्था: {{ $loanTakingVictim->courtDetail->cheque_bounce_case_result }}
                        
                        <br>
                        @if($loanTakingVictim->courtDetail->cheque_bounce_case_result == 'फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको छ')
                            <div>
                                सो फैसला भएको भए बिगो: 
                               {{ $loanTakingVictim->courtDetail->case_result_bigo }}
                            </div>
                            <div>
                               जरिवाना: 
                                {{ $loanTakingVictim->courtDetail->case_result_fine }}
                            </div>
                            <div>
                                कैद: 
                                {{ $loanTakingVictim->courtDetail->case_result_jail }}
                            </div>
                        @endif
                        फैसला भएको भए कार्यान्वयनको अवस्था:{{ $loanTakingVictim->courtDetail->if_bank_cheque_case_resulted}}
                    @endif
                    
                 
                
            <br>
            <b>
                <li>निवेदकको (ऋण/कर्जा लिने व्यक्ति) आर्थिक अवस्था:</li>
            </b>
            <ul>
                <li><b>(क) घरको विवरण:</b>
                    <ul>
                        <li><b>(अ)</b> घरको संख्या: {{ $loanTakingVictim->additionalDetail->applicant_house_no}}</li>
                        <li><b>(आ)</b> घरले चर्चेको जग्गाको क्षेत्रफल: {{ $loanTakingVictim->additionalDetail->applicant_house_area}}</li>
                        <li><b>(इ)</b> घरको किसिम (कच्ची/पक्की): {{ $loanTakingVictim->additionalDetail->applicant_house_type}}</li>
                        <li><b>(ई)</b> घरको तला: {{ $loanTakingVictim->additionalDetail->applicant_house_storeyed}}</li>
                        <li><b>(उ)</b> घर रहेको स्थान:  
                            <li>
                                प्रदेश:  {{$getStateName ( $loanTakingVictim->additionalDetail->applicant_house_state)}} &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                जिल्ला:  {{$getDistrictName ( $loanTakingVictim->additionalDetail->applicant_house_district)}} &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                न.पा./गा.पा: {{$getLocalName ( $loanTakingVictim->additionalDetail->applicant_house_local)}} &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                वडा नं: {{ $loanTakingVictim->additionalDetail->applicant_house_ward}}
                            </li>
 
                    </ul>
                </li>
                <li><b>(ख) जग्गाको विवरण:.</b><br>
                    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>किता नंवर: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>क्षेत्रफल: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>जिल्ला: 
                    </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>न.पा./गा.पा.: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>वडा नं.: </b>
                    <ul>
                        <li><b>(अ)</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $loanTakingVictim->additionalDetail->applicant_land_kitta_no}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $loanTakingVictim->additionalDetail->applicant_land_area}}&nbsp;
                            &nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$getDistrictName ( $loanTakingVictim->additionalDetail->applicant_land_state)}} &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;{{$getLocalName ( $loanTakingVictim->additionalDetail->applicant_land_district)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $loanTakingVictim->additionalDetail->applicant_land_local }}</li>
                    </ul>
                </li>
                {{-- <b>
                    <p>(नोट: एक भन्दा भन्दा बढि ठाउँ /स्थानमा घर/जग्गा भएमा सोही बमोजिम सबै विवरण छुट्टै पानामा उल्लेख
                        गर्ने)</p>
                </b> --}}
                <b>
                    <li><b>(ग)</b> सवारी साधनको विवरण:  </b> {{ optional($loanTakingVictim->additionalDetail)->applicant_vehicle_details }}</li>
               
                <br>
                <br>
                <br>
                <b>
                    <li>(घ) चल सम्पत्तिको विवरण: </b>{{ optional($loanTakingVictim->additionalDetail)->applicant_current_asset_details }}</li>
                
            </ul>
            <br>
            <br>
            <b>


             
                    <li>
                         यो कर्जा कारोवारको सम्बन्धमा पीडितले मुलुकी अपराध संहिता, २०७४ को दफा २४९ क(अनुचित लेनदेन गर्न नहुने) अनुसार सम्बन्धित प्रहरी कार्यालयमा उजुरी/जाहेरी दिएको
            </li></b>भएको
                        <input type="radio" value="1" {{ $loanTakingVictim->additionalDetail->is_crime_reported == '1' ? 'checked' : 'disabled' }}>
                        नभएको
                        <input type="radio" value="0" {{ $loanTakingVictim->additionalDetail->is_crime_reported == '0' ? 'checked' : 'disabled' }}>
                        <br>
                   
                
                    @if($loanTakingVictim->additionalDetail->is_crime_reported == '1')
                    
                    <b>(क)</b> उजुरी/जाहेरी दिएको भए:<br>
                    
                        
                    <ul>
                        <li>
                          <b>(अ)</b> सो मुद्दा कुन अवस्थामा छ?
                          {{ $loanTakingVictim->additionalDetail->if_crime_reported }}
                        </li>
                      </ul>
                       
                    @endif
                    <br>
                    <br>
                    <b><li>यो लेनदेनको सावाँ र ब्याजको सम्बन्धमा अन्य केही कुरा खुलाउनुपर्ने भए?</li></b>
                     {{ $loanTakingVictim->additionalDetail->transaction_actual_interest}}
            
            <br>
            <br>
            <br>
            <b>
                <li>यो निवेदनको ब्यहोरा पुष्टि गर्ने निम्न कागजातको फोटोकपी यसैसाथ संलग्न गरेको छु।</li>
            </b>
            <ul>
               
                <li><b>(क)</b> &nbsp;&nbsp;&nbsp; {{ optional($loanTakingVictim->additionalDetail)->application_verifying_document }}</li>
                <br>
            </ul>
            <b>
                <li>माथि लेखिएको व्यहोरा मैले जाने बुझेसम्म ठिक साँचो हो। यसमा फरक परे कानून बमोजिम सहुँला बुझाउँला भनी
                    सहीछाप गरिदिए</li>
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
                <p>सहीछाप गर्नेको नाम थर: {{ $loanTakingVictim->additionalDetail->stamp_person_name}}</p>
                <br>
                <p>हस्ताक्षर:...................................</p>
                <br>
                <p>मिति: {{ $loanTakingVictim->additionalDetail->stamp_date}}</p>
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
            window.print();
        }
    </script>
@endsection