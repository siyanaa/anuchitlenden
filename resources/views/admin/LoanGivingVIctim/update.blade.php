@extends('admin.layouts.master')

@section('content')
    @include('admin.includes.forms')
    <div class="card-header">
        <h1 class="card-title">{{ $page_title }}</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <style>
        label {
            margin: 10px 0 10px;
            font-size: 16px;
        }

        .application_main_title {
            margin-top: 20px;
            font-size: 18px;
            font-weight: 600;
            color: black;

        }



        .listing_checkbox input {
            margin: 10px 10px;
            width: 20px;

        }


        .application_second_title {
            margin-top: 10px;
            font-size: 15px;
            text-decoration: underline;

        }

        .purposeandnature {
            font-size: 14px
        }

        .equal-height {
            height: 38px;
        }

        .star {
            color: red;
            font-size: 24px;
        }

        textarea {
            width: 100%;
            height: 100px;
        }

        .textarea-container {
            display: flex;
            align-items: center;
        }

        .remove-textarea {
            margin-left: 10px;
            /* Adjust the margin as needed */
        }
    </style>

    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ url('admin/loangiving-victim/update/' . $loanGivingVictim->id) }}"
        class="form-inline" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <div class="row">
                <span class="application_main_title">सम्बन्धित कार्यालयले भर्ने</span>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="applicant_name">दर्ता नं</label>
                        <input type="number"
                               value="{{ $loanGivingVictim->registrationDetail->registration_id }}" id="applicant_name" name="loan_giving_application_registration[registration_id]" class="input-text" autofocus min="1" required>
                        <small id="registrationIdHelp" class="form-text text-muted " ></small>
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="registration-datepicker">दर्ता मिति</label>

                        <input type="text" value="{{ $loanGivingVictim->registrationDetail->registration_date }}"
                            id="registration-datepicker" name="loan_giving_application_registration[registration_date]"
                            class="input-text" autofocus>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="applicant_name">कार्यालय</label>
                        <input type="text" id="applicant_name" 
                               {{-- value="{{ old('loan_giving_application_registration.registration_office', optional($user->district)->name ?? '') }}"  --}}
                               value="{{ $loanGivingVictim->registrationDetail->registration_office }}"
                               name="loan_giving_application_registration[registration_office]" class="input-text" autofocus>
                    </div>
                </div>
            </div>


                <hr class="hr-line">
                <div class="row">
                    <span class="application_main_title">निवेदक(ऋण/कर्जा दिने व्यक्ति) को विवरण:</span>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="applicant_name">नाम, थर<span class="star">*</span></label>

                            <input type="text" value="{{ $loanGivingVictim->basicDetailRegistration->applicant_name}}"
                                id="applicant_name" name="loan_giving_applicant_basic_detail[applicant_name]"
                                class="input-text" autofocus>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="age">उमेर</label>
                            <input type="number"
                            value="{{ $loanGivingVictim->basicDetailRegistration->applicant_age}}" id="age" name="loan_giving_applicant_basic_detail[applicant_age]" class="input-text" autofocus min="1" required>
                            <small id="ageHelp" class="form-text text-muted"></small>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="registrations">नागरिकता नं</label>
                            <input type="number"
                                value="{{ $loanGivingVictim->basicDetailRegistration->applicant_citizenship}}" id="" name="loan_giving_applicant_basic_detail[applicant_citizenship]" class="input-text" autofocus min="1" required>
                                <small id="citizenshipHelp" class="form-text text-muted"></small>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="registrations">जिल्ला</label>
                            <select id="a_district_id" data-iteration="0"
                                name="loan_giving_applicant_basic_detail[applicant_citizenship_issue_district]"
                                class="form-control a_district_id">
                                <option disabled selected value>जिल्ला चयन गर्नुहोस्</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ $loanGivingVictim->basicDetailRegistration->applicant_citizenship_issue_district  == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="citizenship-datepicker">नागरिकता जारी मिति</label>
                            <input type="text"
                                   value="{{ $loanGivingVictim->basicDetailRegistration->applicant_citizenship_issue_date }}"
                                   id="citizenship-datepicker"
                                   name="loan_giving_applicant_basic_detail[applicant_citizenship_issue_date]"
                                   class="input-text" autofocus>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">बुवाको नाम, थर<span class="star">*</span></label>
                            <input type="text"
                                value="{{ $loanGivingVictim->basicDetailRegistration->applicant_fathername }}"
                                id="" name="loan_giving_applicant_basic_detail[applicant_fathername]"
                                class="input-text" autofocus>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="applicant_fathers_no">ऋण दिने व्यक्ति को फोन/ मोबाईल नं<span class="star">*</span></label>
                            <input type="number"
                                   value={{ $loanGivingVictim->basicDetailRegistration->applicant_fathers_no }} id="applicant_fathers_no" name="loan_giving_applicant_basic_detail[applicant_fathers_no]" class="input-text" maxlength="10" placeholder="ex: ९८११११११११/०१-२३४५६८७" autofocus oninput="validatePhoneNumber(this, 'phoneNumberError')" min="1" required>
                            <span id="phoneNumberError" style="display: none; color: red;">कृपया १० अंकको सही नंबर प्रविष्ट गर्नुहोस्।</span>
                        </div>
                    </div>
                    

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">पति/पत्नीको नाम थर</label>

                            <input type="text"
                                value="{{ $loanGivingVictim->basicDetailRegistration->applicant_spouse}}" id=""
                                name="loan_giving_applicant_basic_detail[applicant_spouse]" class="input-text" autofocus>

                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="applicant_spouse_no">फोन/मोबाईल नं <span class="star">*</span></label>
                            <input type="number" value="{{ $loanGivingVictim->basicDetailRegistration->applicant_spouse_no }}"
                                   id="applicant_spouse_no" name="loan_giving_applicant_basic_detail[applicant_spouse_no]"
                                   class="input-text" maxlength="10" placeholder="ex: ९८११११११११/०१-२३४५६८७" autofocus min="1" required
                                   oninput="validatePhoneNumber(this, 'phoneNumberError1')">
                            <span id="phoneNumberError1" style="display: none; color: red;">कृपया १० अंकको सही फोन नंबर प्रविष्ट गर्नुहोस्।</span>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">सगोल परिवारको सदस्य संख्या <span class="star">*</span></label>
                            <input type="number"
                                value={{ $loanGivingVictim->basicDetailRegistration->applicant_family}} id=""
                                name="loan_giving_applicant_basic_detail[applicant_family]" class="input-text" autofocus min="1" required>
                                <small id="familyidHelp" class="form-text text-muted "></small>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="annual_income">वार्षिक आम्दानी<span class="star">*</span></label>
                            <select id="annual_income" name="loan_giving_applicant_basic_detail[applicant_annual_income]" class="form-control" autofocus>
                                <option value="" disabled {{ $loanGivingVictim->basicDetailRegistration->applicant_annual_income  == '' ? 'selected' : '' }}>वार्षिक आम्दानी चयन गर्नुहोस्</option>
                                <option value="1-5" {{ $loanGivingVictim->basicDetailRegistration->applicant_annual_income == '1-5' ? 'selected' : '' }}>१ लाख देखि  ५ लाख</option>
                                <option value="5-10" {{ $loanGivingVictim->basicDetailRegistration->applicant_annual_income == '5-10' ? 'selected' : '' }}>५ लाख देखि १० लाख</option>
                                <option value="10-20" {{ $loanGivingVictim->basicDetailRegistration->applicant_annual_income == '10-20' ? 'selected' : '' }}>१० लाख देखि  २० लाख</option>
                                <option value="20+" {{ $loanGivingVictim->basicDetailRegistration->applicant_annual_income == '20+' ? 'selected' : '' }}>२० लाख +</option>
                            </select>
                        </div>
                    </div>

                    <span class="application_second_title">स्थायी ठेगाना:<span class="star">*</span></span>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">प्रदेश<span class="star">*</span></label>
                            <select id="state_id0" name="loan_giving_applicant_basic_detail[applicant_permanent_state]"
                                data-iteration="0" class="form-control a_state_id">
                                <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ $loanGivingVictim->basicDetailRegistration->applicant_permanent_state == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">जिल्ला<span class="star">*</span></label>
                            <select id="a_district_id0" data-iteration="0"
                                name="loan_giving_applicant_basic_detail[applicant_permanent_district]"
                                class="form-control a_district_id">
                                <option disabled selected value>जिल्ला चयन गर्नुहोस्</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ $loanGivingVictim->basicDetailRegistration->applicant_permanent_district == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">न.पा./गा.पा<span class="star">*</span></label>
                            <select id="a_localbody_id0" data-iteration="0"
                                name="loan_giving_applicant_basic_detail[applicant_permanent_local]"
                                class="form-control a_localbody_id">
                                <option value="">न.पा./गा.पा चयन गर्नुहोस्
                                </option>
                                @foreach ($locals as $localbody)
                                    <option value="{{ $localbody->id }}"
                                        {{ $loanGivingVictim->basicDetailRegistration->applicant_permanent_local == $localbody->id ? 'selected' : '' }}>
                                        {{ $localbody->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">वडा नं<span class="star">*</span></label>
                            <select id="a_wada_id" name="loan_giving_applicant_basic_detail[applicant_permanent_ward]"
                                class="form-control col-md-12">
                                <option disabled selected value>वडा चयन गर्नुहोस्</option>
                                @for ($i = 1; $i <= 32; $i++)
                                    <option value="{{ $i }}"
                                    {{ $loanGivingVictim->basicDetailRegistration->applicant_permanent_ward == $i ? 'selected' : '' }}>
                                        वडा नं. {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <span class="application_second_title">हाल बसोबासको ठेगाना:<span class="star">*</span></span>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">प्रदेश<span class="star">*</span></label>
                            <select id="state_id1" name="loan_giving_applicant_basic_detail[applicant_temp_state]"
                                data-iteration="1" class="form-control o_state_id">
                                <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ $loanGivingVictim->basicDetailRegistration->applicant_temp_state == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">जिल्ला<span class="star">*</span></label>
                            <select id="o_district_id1" data-iteration="1"
                                name="loan_giving_applicant_basic_detail[applicant_temp_district]"
                                class="form-control o_district_id">
                                <option disabled selected value>जिल्ला चयन गर्नुहोस्</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ $loanGivingVictim->basicDetailRegistration->applicant_temp_district == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">न.पा./गा.पा<span class="star">*</span></label>
                            <select id="o_localbody_id1" data-iteration="1"
                                name="loan_giving_applicant_basic_detail[applicant_temp_local]"
                                class="form-control o_localbody_id">
                                <option value="">न.पा./गा.पा चयन गर्नुहोस्
                                </option>
                                @foreach ($locals as $localbody)
                                    <option value="{{ $localbody->id }}"
                                        {{ $loanGivingVictim->basicDetailRegistration->applicant_temp_local == $localbody->id ? 'selected' : '' }}>
                                        {{ $localbody->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">वडा नं<span class="star">*</span></label>
                            <select id="a_wada_id" name="loan_giving_applicant_basic_detail[applicant_temp_ward]"
                                class="form-control col-md-12">


                                <option disabled selected value>वडा चयन गर्नुहोस्</option>
                                @for ($i = 1; $i <= 32; $i++)
                                    <option value="{{ $i }}"
                                    {{ $loanGivingVictim->basicDetailRegistration->applicant_temp_ward == $i ? 'selected' : '' }}>
                                        वडा नं. {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="form-group">
                            <label for="">(PAN) नं</label>

                            <input type="number" value="{{ $loanGivingVictim->basicDetailRegistration->applicant_pan}}"
                                id="" name="loan_giving_applicant_basic_detail[applicant_pan]"
                                class="input-text" autofocus min="1" required>

                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="occupation">पेशा/व्यवसाय<span class="star">*</span></label>
                            <select id="occupation" name="loan_giving_applicant_basic_detail[applicant_occup]" class="form-control" autofocus>
                                <option disabled selected value>पेशा/व्यवसाय चयन गर्नुहोस्</option>
                                <option value="teacher" {{ $loanGivingVictim->basicDetailRegistration->applicant_occup == 'teacher' ? 'selected' : '' }}>शिक्षक</option>
                                <option value="engineer" {{$loanGivingVictim->basicDetailRegistration->applicant_occup == 'engineer' ? 'selected' : '' }}>अभियंता</option>
                                <option value="doctor" {{ $loanGivingVictim->basicDetailRegistration->applicant_occup == 'doctor' ? 'selected' : '' }}>डॉक्टर</option>
                                <option value="lawyer" {{ $loanGivingVictim->basicDetailRegistration->applicant_occup == 'lawyer' ? 'selected' : '' }}>वकील</option>
                                <option value="business" {{ $loanGivingVictim->basicDetailRegistration->applicant_occup == 'business' ? 'selected' : '' }}>व्यवसाय</option>
                                <option value="farmer" {{ $loanGivingVictim->basicDetailRegistration->applicant_occup == 'farmer' ? 'selected' : '' }}>किसान</option>
                                <option value="other" {{ $loanGivingVictim->basicDetailRegistration->applicant_occup == 'other' ? 'selected' : '' }}>अन्य</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="">शैक्षिक योग्यता</label>

                            <select id="" name="loan_giving_applicant_basic_detail[applicant_edu]"
                                class="form-control">
                                <option value="" selected disabled>शैक्षिक योग्यता चयन गर्नुहोस्</option>
                                <option
                                    {{$loanGivingVictim->basicDetailRegistration->applicant_edu == 'सामान्य लेखपढ' ? 'selected' : '' }}>
                                    सामान्य लेखपढ</option>
                                <option
                                    {{$loanGivingVictim->basicDetailRegistration->applicant_edu == 'कक्षा ८ सम्म' ? 'selected' : '' }}>
                                    कक्षा ८ सम्म</option>
                                <option
                                    {{$loanGivingVictim->basicDetailRegistration->applicant_edu == 'कक्षा १० सम्म' ? 'selected' : '' }}>
                                    कक्षा १० सम्म</option>
                                <option
                                    {{$loanGivingVictim->basicDetailRegistration->applicant_edu == 'कक्षा १२ सम्म' ? 'selected' : '' }}>
                                    कक्षा १२ सम्म</option>
                                <option
                                    {{$loanGivingVictim->basicDetailRegistration->applicant_edu == 'उच्च शिक्षा' ? 'selected' : '' }}>
                                    उच्च शिक्षा</option>
                                <option
                                    {{ $loanGivingVictim->basicDetailRegistration->applicant_edu == 'निराक्षर' ? 'selected' : '' }}>
                                    निराक्षर</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="hr-line">
                {{-- For ANother ROw --}}
                <div class="row">
                    <span class="application_main_title">१. आर्थिक अवस्था:<span class="star">*</span></span>
                    <br>

                    <span class="application_second_title">क. घरको विवरण:</span>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="house_no">अ. घरको संख्या</label>
                            <input type="number" value="{{ $loanGivingVictim->applicationFinance->home_no }}"
                                   id="house_no" name="loan_giving_applicant_finance_cond[home_no]"
                                   class="input-text" autofocus min="1" max="10" placeholder="१ देखि १० सम्म" required
                                   oninput="validateHouseNumber(this)">
                            <span id="houseNumberError" style="display: none; color: red;">कृपया १ देखि १० सम्मको संख्या प्रविष्ट गर्नुहोस्।</span>
                        </div>
                    </div>

                    <div class="row additional-fields-container">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">आ. घरले चर्चेको जग्गाको क्षेत्रफल</label>
                                <input type="number" value="{{ $loanGivingVictim['applicationFinance']['home_area'] ?? '' }}" id="" name="loan_giving_applicant_finance_cond[home_area][]"
                                    id="" name="loan_giving_applicant_finance_cond[home_area][]"
                                    class="input-text" autofocus min="1">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="" >इ. घरको किसिम (कच्ची/पक्की)</label>
                                <select name="loan_giving_applicant_finance_cond[home_type][]">
                                    <option value="" selected disabled>घरको किसिम चयन गर्नुहोस्</option>
                                    <option value="कच्ची"
                                        {{ $loanGivingVictim->applicationFinance->home_type == 'कच्ची' ? 'selected' : '' }}>
                                        कच्ची</option>
                                    <option value="पक्की"
                                        {{ $loanGivingVictim->applicationFinance->home_type == 'पक्की' ? 'selected' : '' }}>
                                        पक्की</option>
                                    <option value="अन्य"
                                        {{ $loanGivingVictim->applicationFinance->home_type == 'अन्य' ? 'selected' : '' }}>
                                        अन्य</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">ई. घरको तला</label>
                                <input type="number" value="{{ $loanGivingVictim->applicationFinance->home_storey }}"
                                    id="" name="loan_giving_applicant_finance_cond[home_storey][]"
                                    class="input-text" autofocus min="1" required>
                                <small id="homestoreyHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <span class="application_second_title">उ. घर रहेको स्थान</span>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">प्रदेश</label>
                                <select id="state_id3" name="loan_giving_applicant_finance_cond[home_state][]"
                                    data-iteration="3" class="form-control c_state_id">
                                    <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            {{ old('loan_giving_applicant_finance_cond.home_state.0') == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">जिल्ला</label>
                                <select id="c_district_id3" data-iteration="3"
                                    name="loan_giving_applicant_finance_cond[home_district][]"
                                    class="form-control c_district_id">
                                    <option value="{{ old('loan_giving_applicant_finance_cond.home_district.0') }}">जिल्ला चयन गर्नुहोस्</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">न.पा./गा.पा</label>
                                <select id="c_localbody_id3" data-iteration="3"
                                    name="loan_giving_applicant_finance_cond[home_local][]"
                                    class="form-control c_localbody_id">
                                    <option value="{{ old('loan_giving_applicant_finance_cond.home_local.0') }}">न.पा./गा.पा चयन गर्नुहोस्</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">वडा नं</label>
                                <select id="a_wada_id" name="loan_giving_applicant_finance_cond[home_ward][]"
                                    class="form-control col-md-8">
                                    <option disabled selected value="{{ old('loan_giving_applicant_finance_cond.home_ward.0') }}">वडा चयन गर्नुहोस्</option>
                                    <option value="1">वडा नं. १</option>
                                    <option value="2">वडा नं. २</option>
                                    <option value="3">वडा नं. ३</option>
                                    <option value="4">वडा नं. ४</option>
                                    <option value="5">वडा नं. ५</option>
                                    <option value="6">वडा नं. ६</option>
                                    <option value="7">वडा नं. ७</option>
                                    <option value="8">वडा नं. ८</option>
                                    <option value="9">वडा नं. ९</option>
                                    <option value="10">वडा नं. १०</option>
                                    <option value="11">वडा नं. ११</option>
                                    <option value="12">वडा नं. १२</option>
                                    <option value="13">वडा नं. १३</option>
                                    <option value="14">वडा नं. १४</option>
                                    <option value="15">वडा नं. १५</option>
                                    <option value="16">वडा नं. १६</option>
                                    <option value="17">वडा नं. १७</option>
                                    <option value="18">वडा नं. १८</option>
                                    <option value="19">वडा नं. १९</option>
                                    <option value="20">वडा नं. २०</option>
                                    <option value="21">वडा नं. २१</option>
                                    <option value="22">वडा नं. २२</option>
                                    <option value="23">वडा नं. २३</option>
                                    <option value="24">वडा नं. २४</option>
                                    <option value="25">वडा नं. २५</option>
                                    <option value="26">वडा नं. २६</option>
                                    <option value="27">वडा नं. २७</option>
                                    <option value="28">वडा नं. २८</option>
                                    <option value="29">वडा नं. २९</option>
                                    <option value="30">वडा नं. ३०</option>
                                    <option value="31">वडा नं. ३१</option>
                                    <option value="32">वडा नं. ३२</option>
                                </select><br>
                            </div>
                            <button class="btn btn-outline-secondary add-all-fields" type="button">+</button>
                        </div>
                        <span class="note"><strong>(नोट : एक भन्दा बढी घर भए, अर्को घरको स्थान )</strong></span>
                    </div>
                    

                    <script>
                        $(document).ready(function() {
                            // Function to load districts based on selected state
                            function loadDistricts(selectElement, stateId) {
                                // AJAX call to fetch districts based on stateId
                                $.ajax({
                                    url: '/get-districts/' + stateId, // Replace with your actual route for fetching districts
                                    type: 'GET',
                                    success: function(response) {
                                        // Clear existing options
                                        selectElement.empty();
                                        // Append new options
                                        $.each(response.districts, function(key, value) {
                                            selectElement.append($('<option></option>').attr('value', value.id).text(value.name));
                                        });
                                        // Trigger change event to update local bodies
                                        selectElement.trigger('change');
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                    }
                                });
                            }
                    
                            // Function to load local bodies based on selected district
                            function loadLocalBodies(selectElement, districtId) {
                                // AJAX call to fetch local bodies based on districtId
                                $.ajax({
                                    url: '/get-local-bodies/' + districtId, // Replace with your actual route for fetching local bodies
                                    type: 'GET',
                                    success: function(response) {
                                        // Clear existing options
                                        selectElement.empty();
                                        // Append new options
                                        $.each(response.localBodies, function(key, value) {
                                            selectElement.append($('<option></option>').attr('value', value.id).text(value.name));
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                    }
                                });
                            }
                    
                            // Event listener for adding all fields at once
                            $('.add-all-fields').click(function() {
                                // Clone the entire additional fields container
                                var additionalFieldsContainer = $('.additional-fields-container').first().clone();
                                // Append the cloned container after the original container
                                $('.additional-fields-container').last().after(additionalFieldsContainer);
                    
                                // Get the state dropdown in the newly added container
                                var stateDropdown = additionalFieldsContainer.find('.c_state_id');
                                // Load districts based on the selected state
                                loadDistricts(additionalFieldsContainer.find('.c_district_id'), stateDropdown.val());
                    
                                // Add a remove button to the newly added container
                                var removeButton = $('<button class="remove-fields btn btn-outline-secondary" type="button">-</button>');
                                // Append the remove button next to the add button
                                additionalFieldsContainer.find('.add-all-fields').after(removeButton);
                    
                                // Hide the note
                                $('.note').hide();
                            });
                    
                            // Event listener for change event on state dropdown
                            $(document).on('change', '.c_state_id', function() {
                                // Get the selected state value
                                var stateId = $(this).val();
                                // Get the corresponding district dropdown
                                var districtDropdown = $(this).closest('.form-group').next().find('.c_district_id');
                                // Load districts based on selected state
                                loadDistricts(districtDropdown, stateId);
                            });
                    
                            // Event listener for change event on district dropdown
                            $(document).on('change', '.c_district_id', function() {
                                // Get the selected district value
                                var districtId = $(this).val();
                                // Get the corresponding local body dropdown
                                var localBodyDropdown = $(this).closest('.form-group').next().next().find('.c_localbody_id');
                                // Load local bodies based on selected district
                                loadLocalBodies(localBodyDropdown, districtId);
                            });
                    
                            // Event listener for removing all fields
                            $(document).on('click', '.remove-fields', function() {
                                $(this).closest('.additional-fields-container').remove();
                                // Show the note if there are no additional fields left
                                if ($('.additional-fields-container').length === 1) {
                                    $('.note').show();
                                }
                            });
                    
                            // Function to hide or show the note based on the number of additional fields
                            function toggleNoteVisibility() {
                                if ($('.additional-fields-container').len gth > 1) {
                                    $('.note').hide();
                                } else {
                                    $('.note').show();
                                }
                            }
                        });
                    </script>
                    
                        

<span class="application_second_title">ख. जग्गाको विवरण:</span>
<div class="land-details-container">
    <div class="land-details-block">
        <div class="row">
            <div class="col-6">
                <div class="form-group" data-input-type="land_kitta">
                    <label for="">कित्ता नं<span class="star">*</span></label>
                    <div class="input-group">
                        <input type="number" value="{{ $loanGivingVictim->applicationFinance->land_kitta}}" id=""
                            name="loan_giving_applicant_finance_cond[land_kitta][]" class="input-text" autofocus min="1" required>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group" data-input-type="land_area">
                    <label for="">क्षेत्रफल<span class="star">*</span></label>
                    <div class="input-group">
                        <input type="number" value="{{ $loanGivingVictim->applicationFinance->land_area }}" id=""
                            name="loan_giving_applicant_finance_cond[land_area][]" class="input-text" autofocus min="1" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">प्रदेश<span class="star">*</span></label>
                    <select id="state_id5" name="loan_giving_applicant_finance_cond[land_state][]"
                        data-iteration="5" class="form-control e_state_id">
                        <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="">जिल्ला<span class="star">*</span></label>
                    <select id="e_district_id5" data-iteration="5"
                        name="loan_giving_applicant_finance_cond[land_district][]"
                        class="form-control e_district_id">
                        <option value="{{ $loanGivingVictim->applicationFinance->land_district }}">जिल्ला चयन गर्नुहोस्</option>
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="">न.पा./गा.पा<span class="star">*</span></label>
                    <select id="e_localbody_id5" data-iteration="5"
                        name="loan_giving_applicant_finance_cond[land_local][]"
                        class="form-control e_localbody_id">
                        <option value="{{ old('loan_giving_applicant_finance_cond.land_local.0') }}">न.पा./गा.पा चयन गर्नुहोस्</option>
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="">वडा<span class="star">*</span></label>
                    <select id="a_wada_id5" name="loan_giving_applicant_finance_cond[land_ward][]"
                        class="form-control col-md-12">
                        <option disabled selected value>वडा चयन गर्नुहोस्</option>
                        <option value="1">वडा नं. १</option>
                        <option value="2">वडा नं. २</option>
                        <option value="3">वडा नं. ३</option>
                        <option value="4">वडा नं. ४</option>
                        <option value="5">वडा नं. ५</option>
                        <option value="6">वडा नं. ६</option>
                        <option value="7">वडा नं. ७</option>
                        <option value="8">वडा नं. ८</option>
                        <option value="9">वडा नं. ९</option>
                        <option value="10">वडा नं. १०</option>
                        <option value="11">वडा नं. ११</option>
                        <option value="12">वडा नं. १२</option>
                        <option value="13">वडा नं. १३</option>
                        <option value="14">वडा नं. १४</option>
                        <option value="15">वडा नं. १५</option>
                        <option value="16">वडा नं. १६</option>
                        <option value="17">वडा नं. १७</option>
                        <option value="18">वडा नं. १८</option>
                        <option value="19">वडा नं. १९</option>
                        <option value="20">वडा नं. २०</option>
                        <option value="21">वडा नं. २१</option>
                        <option value="22">वडा नं. २२</option>
                        <option value="23">वडा नं. २३</option>
                        <option value="24">वडा नं. २४</option>
                        <option value="25">वडा नं. २५</option>
                        <option value="26">वडा नं. २६</option>
                        <option value="27">वडा नं. २७</option>
                        <option value="28">वडा नं. २८</option>
                        <option value="29">वडा नं. २९</option>
                        <option value="30">वडा नं. ३०</option>
                        <option value="31">वडा नं. ३१</option>
                        <option value="32">वडा नं. ३२</option>
                    </select>
                    <br>
                </div>
                <button class="btn btn-outline-secondary add-more" type="button">+</button>
            </div>
        </div>
    </div>
</div>
<div class="note">
    <strong>( नोट : एक भन्दा बढी ठाउँ/ स्थानमा घर/जग्गा भएमा सोहि बमोजिम सबै विवरण छुट्टै पानामा उल्लेख गर्ने )</strong>
</div>

<script>
    $(document).ready(function() {
        $('.add-more').click(function() {
            // Clone the entire block containing the main land details fields
            var landDetailsBlock = $('.land-details-block').first().clone();
    
            // Clear the input values in the cloned block
            landDetailsBlock.find('input[type="text"]').val('');
            landDetailsBlock.find('select').val('');
    
            // Add a remove button to the cloned block
            var removeButton = $('<button class="btn btn-outline-danger remove-field ml-2" type="button">-</button>');
            landDetailsBlock.find('.col-3:last-child').append(removeButton);
    
            // Append the cloned block to the end of the container
            $('.land-details-container').append(landDetailsBlock);
    
            // Hide the note if it's currently shown
            $('.note').hide();
        });
    
        // Event handler for removing the additional fields when "-" button is clicked
        $(document).on('click', '.remove-field', function() {
            $(this).closest('.land-details-block').remove();
    
            // Show the note if there are no additional fields left
            if ($('.land-details-block').length === 1) {
                $('.note').show();
            }
        });
    });
    </script>
                    {{-- Another Row Starts --}}

                    <div class="row">
                        <div class="form-group">
                            <label for="">ग. सवारी साधनको विवरण<span class="star">*</span></label>
                            <div class="dropdown-container">
                                @php
                                    // Get old values if they exist
                                    $vehicleDescriptions = old('loan_giving_applicant_finance_cond.vehicle_description', []);
                                    $vehicleCounts = old('loan_giving_applicant_finance_cond.vehicle_count', []);
                                @endphp
                    
                                @foreach($vehicleDescriptions as $index => $vehicleDescription)
                                    <div class="dropdown">
                                        <select class="form-control purpose-dropdown col-6"
                                            name="loan_giving_applicant_finance_cond[vehicle_description][]"
                                            class="form-control" autofocus>
                                            <option value="" disabled {{ $vehicleDescription == '' ? 'selected' : '' }}>सवारी साधन चयन गर्नुहोस्</option>
                                            <option value="मोटर संख्या" {{ $vehicleDescription == 'मोटर संख्या' ? 'selected' : '' }}>मोटरको संख्या</option>
                                            <option value="मोटर साइकलको संख्या" {{ $vehicleDescription == 'मोटर साइकलको संख्या' ? 'selected' : '' }}>मोटर साइकलको संख्या</option>
                                            <option value="स्कुटरको संख्या" {{ $vehicleDescription == 'स्कुटरको संख्या' ? 'selected' : '' }}>स्कुटरको संख्या</option>
                                            <option value="घोडाको संख्या" {{ $vehicleDescription == 'घोडाको संख्या' ? 'selected' : '' }}>घोडाको संख्या</option>
                                            <option value="अन्य सवारी साधनको संख्या" {{ $vehicleDescription == 'अन्य सवारी साधनको संख्या' ? 'selected' : '' }}>अन्य सवारी साधनको संख्या</option>
                                        </select>
                                        <div class="text-field">
                                            <input type="number" class="form-control selected-purpose-text"
                                                name="loan_giving_applicant_finance_cond[vehicle_count][]"
                                                value="{{ $vehicleCounts[$index] ?? '' }}"
                                                placeholder="यहाँ संख्या लेख्नुहोस्">
                                        </div>
                                    </div>
                                @endforeach
                    
                                @if(empty($vehicleDescriptions))
                                    <div class="dropdown">
                                        <select class="form-control purpose-dropdown col-6"
                                            name="loan_giving_applicant_finance_cond[vehicle_description][]"
                                            class="form-control" autofocus>
                                            <option value="" disabled selected>सवारी साधन चयन गर्नुहोस्</option>
                                            <option value="मोटर संख्या">मोटरको संख्या</option>
                                            <option value="मोटर साइकलको संख्या">मोटर साइकलको संख्या</option>
                                            <option value="स्कुटरको संख्या">स्कुटरको संख्या</option>
                                            <option value="घोडाको संख्या">घोडाको संख्या</option>
                                            <option value="अन्य सवारी साधनको संख्या">अन्य सवारी साधनको संख्या</option>
                                        </select>
                                        <div class="text-field" style="display: none;">
                                            <input type="number" class="form-control selected-purpose-text"
                                                name="loan_giving_applicant_finance_cond[vehicle_count][]"
                                                placeholder="यहाँ संख्या लेख्नुहोस्">
                                        </div>
                                    </div>
                                @endif
                                <button class="btn btn-outline-secondary add-dropdown" type="button">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="">घ. चल सम्पत्तिको विवरण <span class="star">*</span></label>
                            <div class="dropdown-container">
                                @php
                                    // Get old values if they exist
                                    $assetDescriptions = old('loan_giving_applicant_finance_cond.amount_asset_description', []);
                                    $assetCounts = old('loan_giving_applicant_finance_cond.amount_asset_count', []);
                                @endphp
                                @foreach($assetDescriptions as $index => $assetDescription)
                                    <div class="dropdown">
                                        <select class="form-control purpose-dropdown col-6"
                                                name="loan_giving_applicant_finance_cond[amount_asset_description][]">
                                            <option value="" disabled {{ $assetDescription == '' ? 'selected' : '' }}>चल सम्पत्ति चयन गर्नुहोस्</option>
                                            <option value="नगद" {{ $assetDescription == 'नगद' ? 'selected' : '' }}>नगद</option>
                                            <option value="सुन" {{ $assetDescription == 'सुन' ? 'selected' : '' }}>सुन</option>
                                            <option value="चांदी" {{ $assetDescription == 'चांदी' ? 'selected' : '' }}>चांदी</option>
                                        </select>
                                        <div class="text-field">
                                            <input type="number" class="form-control selected-purpose-text"
                                                   name="loan_giving_applicant_finance_cond[amount_asset_count][]"
                                                   value="{{ $assetCounts[$index] ?? '' }}"
                                                   placeholder="नगद रूपैँया मा राख्नुहोस, सुन चाँदी तोलामा राख्नुहोस">
                                        </div>
                                    </div>
                                @endforeach
                                @if(empty($assetDescriptions))
                                    <div class="dropdown">
                                        <select class="form-control purpose-dropdown col-6"
                                                name="loan_giving_applicant_finance_cond[amount_asset_description][]">
                                            <option value="" disabled selected>चल सम्पत्ति चयन गर्नुहोस्</option>
                                            <option value="नगद">नगद</option>
                                            <option value="सुन">सुन</option>
                                            <option value="चांदी">चांदी</option>
                                        </select>
                                        <div class="text-field" style="display: none;">
                                            <input type="number" class="form-control selected-purpose-text"
                                                   name="loan_giving_applicant_finance_cond[amount_asset_count][]"
                                                   placeholder="नगद रूपैँया मा राख्नुहोस, सुन चाँदी तोलामा राख्नुहोस">
                                        </div>
                                    </div>
                                @endif
                                <button class="btn btn-outline-secondary add-dropdown" type="button">+</button>
                            </div>
                        </div>
                    </div>
                    

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const addDropdownButtonsSection1 = document.querySelectorAll('.section1 .add-dropdown');
                            const addDropdownButtonsSection2 = document.querySelectorAll('.section2 .add-dropdown');
                    
                            addDropdownButtonsSection1.forEach(button => {
                                button.addEventListener('click', function () {
                                    const dropdownContainer = this.parentElement.querySelector('.dropdown-container');
                                    const clonedDropdownContainer = dropdownContainer.cloneNode(true);
                                    dropdownContainer.parentElement.appendChild(clonedDropdownContainer);
                                });
                            });
                    
                            addDropdownButtonsSection2.forEach(button => {
                                button.addEventListener('click', function () {
                                    const dropdownContainer = this.parentElement.querySelector('.dropdown-container');
                                    const clonedDropdownContainer = dropdownContainer.cloneNode(true);
                                    dropdownContainer.parentElement.appendChild(clonedDropdownContainer);
                                });
                            });
                        });
                    </script>

<span class="application_second_title"> बैङ्क तथा वित्तिय संस्था (सहकारी/लघुवित्त समेत) मा खोलिएको बैंक खाता विवरण :</span>
<div class="row bank-account-details">
    <div class="col-3">
        <div class="form-group">
            <label for="">अ.संस्थाको नाम</label>
            <input type="text" class="form-control" name="loan_giving_applicant_finance_cond[finance_name][]" value="{{ $loanGivingVictim->applicationFinance->finance_name }}" placeholder="">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="">आ.शाखा</label>
            <input type="text" class="form-control" name="loan_giving_applicant_finance_cond[finance_branch][]" value="{{ $loanGivingVictim->applicationFinance->finance_branch }}" placeholder="">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="accountissue-datepicker">इ. खाता खोलेको मिति</label>
            <input type="text" class="form-control" name="loan_giving_applicant_finance_cond[finance_accountissue_date][]" value="{{ $loanGivingVictim->applicationFinance->finance_accountissue_date }}" id="accountissue-datepicker" placeholder="">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="">ई.बैंक मौज्दात</label>
            <div class="input-group">
                <input type="text" class="form-control" name="loan_giving_applicant_finance_cond[finance_data][]" value="{{  $loanGivingVictim->applicationFinance->finance_data }}"placeholder="">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary add-fields" type="button">+</button>
                </div>
            </div>
        </div>
    </div>
</div>
<strong>(नोट : एक भन्दा बढि बैंक वा वित्तिय संस्थामा खाता खोलिएको भए विवरण उल्लेख गर्ने)</strong>


<span class="application_second_title">ङ. बैङ्क तथा वित्तिय संस्था (सहकारी/लघुवित्त समेत) बाट ऋण लिएको भए:</span>
<div class="row loan-details">
    <div class="col-3">
        <div class="form-group">
            <label for="">अ. संस्थाको नाम</label>
            <input type="text" class="form-control" name="loan_giving_applicant_finance_cond[loan_finance_name][]" value="{{  $loanGivingVictim->applicationFinance->loan_finance_name }}"placeholder="">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="">आ. शाखा</label>
            <input type="text" class="form-control" name="loan_giving_applicant_finance_cond[loan_finance_branch][]" value="{{  $loanGivingVictim->applicationFinance->loan_finance_branch }}" placeholder="">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="account_datepicker">इ. कर्जाको दायित्व</label>
            <input type="text" class="form-control" name="loan_giving_applicant_finance_cond[loan_finance_liability][]" value="{{ $loanGivingVictim->applicationFinance->loan_finance_liability }}" placeholder="">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="">ई. तिर्न बाँकी कर्जा रकम</label>
            <div class="input-group">
                <input type="number" class="form-control" name="loan_giving_applicant_finance_cond[loan_finance_remainingpay][]" value="{{ $loanGivingVictim->applicationFinance->loan_finance_remainingpay}}" placeholder="" min="1">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary add-fields" type="button">+</button>
                </div>
            </div>
        </div>
    </div>
</div>
<strong>(नोट : एक भन्दा बढि बैंक वा वित्तिय संस्थाबाट ऋण लिएको भए उल्लेख गर्ने)</strong>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to add a remove button to a row
        function addRemoveButton(row) {
            var lastCol = row.querySelector(".col-3:last-child .input-group");
            var removeButton = document.createElement("button");
            removeButton.className = "btn btn-outline-secondary remove-fields";
            removeButton.type = "button";
            removeButton.textContent = "-";
            lastCol.appendChild(removeButton);
        }
    
        // Function to remove a row
        function removeRow(row) {
            row.remove();
        }
    
        // Function to hide the note
        function hideNote() {
            document.querySelectorAll(".note").forEach(function(note) {
                note.style.display = "none";
            });
        }
    
        // Function to show the note
        function showNote() {
            document.querySelectorAll(".note").forEach(function(note) {
                note.style.display = "block";
            });
        }
    
        // Add event listener to the initial add button
        document.querySelectorAll(".add-fields").forEach(function(addButton) {
            addButton.addEventListener("click", function() {
                var parentRow = this.closest(".row");
                var clonedRow = parentRow.cloneNode(true);
    
                // Remove the remove button from the main fields
                clonedRow.querySelectorAll(".remove-fields").forEach(function(button) {
                    button.remove();
                });
    
                // Clear values in the cloned row
                clonedRow.querySelectorAll(".form-control").forEach(function(input) {
                    input.value = "";
                });
    
                // Insert the cloned row after the parent row
                parentRow.parentNode.insertBefore(clonedRow, parentRow.nextSibling);
    
                // Add the remove button to the cloned row
                addRemoveButton(clonedRow);
    
                // Add event listener to the remove button of the cloned row
                clonedRow.querySelector(".remove-fields").addEventListener("click", function() {
                    removeRow(clonedRow);
                    // Show the note if there are no additional fields left
                    if (document.querySelectorAll(".additional-fields-container").length === 1) {
                        showNote();
                    }
                });
    
                // Hide the note
                hideNote();
            });
        });
    
        // Add event listener to the initial rows (for existing remove buttons)
        document.querySelectorAll(".row").forEach(function(row) {
            if (row.querySelector(".remove-fields")) {
                row.querySelector(".remove-fields").addEventListener("click", function() {
                    removeRow(row);
                    // Show the note if there are no additional fields left
                    if (document.querySelectorAll(".additional-fields-container").length === 1) {
                        showNote();
                    }
                });
            }
        });
    });
    </script>
    
                    </div>
                    <hr class="hr-line">

                    <div class="row">
                        <span class="application_main_title">२. ऋण/कर्जा लिने व्यक्ति को विवरण:<span class="star">*</span></span>

                        <span class="application_second_title">क. कर्जा लिने व्यक्तिको</span>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="applicant_name">नाम, थर</label>

                                <input type="text"
                                    value="{{ $loanGivingVictim->debtorDetails->debtor_name  }}"
                                    id="applicant_name" name="loan_giving_debtor_application_detail[debtor_name]"
                                    class="input-text" autofocus>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="applicant_name">ठेगाना</label>

                                <input type="text" value=" {{$loanGivingVictim->debtorDetails->debtor_local}} " id=""
                                    name="loan_giving_debtor_application_detail[debtor_local]" class="input-text"
                                    autofocus>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group">
                                <label for="debit-datepicker">ख. कर्जा कारोबार भएको मिति</label>

                                <input type="text"
                                    value="{{  $loanGivingVictim->debtorDetails->debit_date }}"
                                    id="debit-datepicker" name="loan_giving_debtor_application_detail[debit_date]"
                                    class="input-text" autofocus>

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">ग. कर्जा कारोबार रकम</label>

                                <input type="number"
                                    value="{{  $loanGivingVictim->debtorDetails->debit_amount }}"
                                    id="" name="loan_giving_debtor_application_detail[debit_amount]"
                                    class="input-text" autofocus min="1">

                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group col-md-4">
                                <label for="">घ. कारोबार गरेको माध्यम</label>
                                <p class="listing_checkbox">
                                    @php
                                        $debit_medium = is_array($loanGivingVictim->debtorDetails->debit_medium) 
                                                        ? $loanGivingVictim->debtorDetails->debit_medium 
                                                        : [];
                                    @endphp
                        
                                    अ. नगद दिएको
                                    <input type="checkbox" name="loan_giving_debtor_application_detail[debit_medium][]" value="नगद दिएको" 
                                    {{ in_array('नगद दिएको', $debit_medium) ? 'checked' : '' }}>
                                    <br>
                        
                                    आ. ऋणीको जग्गा राजिनामा पारित गराइएको
                                    <input type="checkbox" name="loan_giving_debtor_application_detail[debit_medium][]" value="ऋणीको जग्गा राजिनामा पारित गराइएको" 
                                    {{ in_array('ऋणीको जग्गा राजिनामा पारित गराइएको', $debit_medium) ? 'checked' : '' }}>
                                    <br>
                        
                                    इ. ऋणीको जग्गा दृष्टिबन्धक गराइएको
                                    <input type="checkbox" name="loan_giving_debtor_application_detail[debit_medium][]" value="ऋणीको जग्गा दृष्टिबन्धक गराइएको" 
                                    {{ in_array('ऋणीको जग्गा दृष्टिबन्धक गराइएको', $debit_medium) ? 'checked' : '' }}>
                                    <br>
                        
                                    ई. ऋणी सँग लिखत/तमसुक गराएको वा नगराएको
                                    <input type="checkbox" name="loan_giving_debtor_application_detail[debit_medium][]" value="ऋणी सँग लिखत/तमसुक गराएको वा नगराएको" 
                                    {{ in_array('ऋणी सँग लिखत/तमसुक गराएको वा नगराएको', $debit_medium) ? 'checked' : '' }}>
                                    <br>
                        
                                    उ. चेकको माध्यमबाट ऋण दिएको
                                    <input type="checkbox" name="loan_giving_debtor_application_detail[debit_medium][]" value="चेकको माध्यमबाट ऋण दिएको" 
                                    {{ in_array('चेकको माध्यमबाट ऋण दिएको', $debit_medium) ? 'checked' : '' }}> 
                                    <br> 
                        
                                    ऊ. ऋण दिँदा ऋणी सँग लिइएको
                                    <input type="checkbox" name="loan_giving_debtor_application_detail[debit_medium][]" value="ऋण दिँदा ऋणी सँग लिइएको" 
                                    {{ in_array('ऋण दिँदा ऋणी सँग लिइएको', $debit_medium) ? 'checked' : '' }}>
                                    <br>
                        
                                    ऋ. लिखत/तमसुक गराई ऋणीसँग चेक लिएको
                                    <input type="checkbox" name="loan_giving_debtor_application_detail[debit_medium][]" value="लिखत/तमसुक गराई ऋणीसँग चेक लिएको" 
                                    {{ in_array('लिखत/तमसुक गराई ऋणीसँग चेक लिएको', $debit_medium) ? 'checked' : '' }}>
                                    <br>
                                </p>
                            </div>
                        </div>
                        
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">ङ. अन्य व्यक्तिलाई ऋण दिएको भए अन्य ऋणीको संख्या</label>

                                <input type="number"
                                    value="{{ $loanGivingVictim->debtorDetails->other_debtors_no }}"
                                    id="" name="loan_giving_debtor_application_detail[other_debtors_no]"
                                    class="input-text" autofocus min="1">

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">कुल ऋण रकम</label>

                                <input type="number"
                                    value="{{ $loanGivingVictim->debtorDetails->other_debtors_amount }}"
                                    id="" name="loan_giving_debtor_application_detail[other_debtors_amount]"
                                    class="input-text" autofocus min="1">

                            </div>
                        </div>

                        {{-- <div class="col-6">
                <div class="form-group">
                    <label for="">च. लिखत वडा कार्यालयमा दर्ता भएको </label>

                    <select name="is_statement_register">
                        <option>भएको</option>
                        <option>नभएको</option>
                    </select>

                </div>
            </div> --}}

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">च. लिखत वडा कार्यालयमा दर्ता: </label>
                                <div>
                                    <input type="radio" id="is_statement_register_yes"
                                        name="loan_giving_debtor_application_detail[is_statement_register]" value="1"
                                        {{ $loanGivingVictim->debtorDetails->is_statement_register == '1' ? 'checked' : '' }}
                                        onclick="showStatementRegisterNo()">
                                    <label for="is_statement_register_yes">भएको</label>
                                    <input type="radio" id="is_statement_register_no"
                                        name="loan_giving_debtor_application_detail[is_statement_register]" value="0"
                                        {{ $loanGivingVictim->debtorDetails->is_statement_register  == '0' ? 'checked' : '' }}
                                        onclick="hideStatementRegisterNo()">
                                    <label for="is_statement_register_no">नभएको</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6" id="statementRegisterNoContainer" style="display: none;">
                            <div class="form-group">
                                <label for="">भएको भए दर्ता नं.</label>
                                <input type="number"
                                    value="{{ $loanGivingVictim->debtorDetails->statement_register_no }}"
                                    id="statement_register_no"
                                    name="loan_giving_debtor_application_detail[statement_register_no]" class="input-text"
                                    autofocus min="1">
                            </div>
                        </div>
                        <script>
                            function showStatementRegisterNo() {
                                document.getElementById('statementRegisterNoContainer').style.display = 'block';
                            }

                            function hideStatementRegisterNo() {
                                document.getElementById('statementRegisterNoContainer').style.display = 'none';
                                document.getElementById('statement_register_no').value = "";
                            }
                        </script>

                    </div>
                    <hr class="hr-line">
                    {{-- Row of offender ends here --}}



                    <div class="row">
                        <span class="application_main_title">३. यो लेनदेन कारोबारको रकमबाट हालसम्म प्राप्त गरेको ब्याज
                            रकम:<span class="star">*</span></span>
                        <div class="form-group">
                            <div class="dropdown-container">
                                @php
                                    // Get old values if they exist
                                    $transMediums = old('loan_giving_transaction_application_detail.trans_medium', []);
                                    $transAmounts = old('loan_giving_transaction_application_detail.trans_amount', []);
                                @endphp
                                @foreach($transMediums as $index => $transMedium)
                                    <div class="dropdown">
                                        <select class="form-control purpose-dropdown"
                                                name="loan_giving_transaction_application_detail[trans_medium][]">
                                            <option value="">माध्यम चयन गर्नुहोस्</option>
                                            <option value="नगद" {{ $transMedium == 'नगद' ? 'selected' : '' }}>नगद</option>
                                            <option value="चेक" {{ $transMedium == 'चेक' ? 'selected' : '' }}>चेक</option>
                                            <option value="जिन्सी" {{ $transMedium == 'जिन्सी' ? 'selected' : '' }}>जिन्सी</option>
                                            <option value="अन्य" {{ $transMedium == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                                        </select>
                                        <div class="text-field">
                                            <input type="number" class="form-control selected-purpose-text"
                                                   name="loan_giving_transaction_application_detail[trans_amount][]"
                                                   value="{{ $transAmounts[$index] ?? '' }}"
                                                   placeholder="यहाँ संख्या लेख्नुहोस्">
                                        </div>
                                    </div>
                                @endforeach
                                @if(empty($transMediums))
                                    <div class="dropdown">
                                        <select class="form-control purpose-dropdown"
                                                name="loan_giving_transaction_application_detail[trans_medium][]">
                                            <option value="">माध्यम चयन गर्नुहोस्</option>
                                            <option value="नगद">नगद</option>
                                            <option value="चेक">चेक</option>
                                            <option value="जिन्सी">जिन्सी</option>
                                            <option value="अन्य">अन्य</option>
                                        </select>
                                        <div class="text-field" style="display: none;">
                                            <input type="number" class="form-control selected-purpose-text"
                                                   name="loan_giving_transaction_application_detail[trans_amount][]"
                                                   placeholder="यहाँ संख्या लेख्नुहोस्">
                                        </div>
                                    </div>
                                @endif
                                <button class="btn btn-outline-secondary add-dropdown" type="button">+</button>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <span class="application_main_title">४. यो लेनदेनको कारोबारबाट हालसम्मको प्राप्त मुलधन रकम:<span
                                class="star">*</span></span>
                        <div class="form-group">
                            <div class="dropdown-container">
                                @php
                                    // Get old values if they exist
                                    $transCapitalMediums = old('loan_giving_transaction_application_detail.trans_capital_medium', []);
                                    $transCapitalAmounts = old('loan_giving_transaction_application_detail.trans_capital_amount', []);
                                @endphp
                                @foreach($transCapitalMediums as $index => $transCapitalMedium)
                                    <div class="dropdown">
                                        <select class="form-control purpose-dropdown"
                                                name="loan_giving_transaction_application_detail[trans_capital_medium][]">
                                            <option value="">माध्यम चयन गर्नुहोस्</option>
                                            <option value="नगद" {{ $transCapitalMedium == 'नगद' ? 'selected' : '' }}>नगद</option>
                                            <option value="चेक" {{ $transCapitalMedium == 'चेक' ? 'selected' : '' }}>चेक</option>
                                            <option value="जिन्सी" {{ $transCapitalMedium == 'जिन्सी' ? 'selected' : '' }}>जिन्सी</option>
                                            <option value="अन्य" {{ $transCapitalMedium == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                                        </select>
                                        <div class="text-field">
                                            <input type="number" class="form-control selected-purpose-text"
                                                   name="loan_giving_transaction_application_detail[trans_capital_amount][]"
                                                   value="{{ $transCapitalAmounts[$index] ?? '' }}"
                                                   placeholder="यहाँ लेख्नुहोस्">
                                        </div>
                                    </div>
                                @endforeach
                                @if(empty($transCapitalMediums))
                                    <div class="dropdown">
                                        <select class="form-control purpose-dropdown"
                                                name="loan_giving_transaction_application_detail[trans_capital_medium][]">
                                            <option value="">माध्यम चयन गर्नुहोस्</option>
                                            <option value="नगद">नगद</option>
                                            <option value="चेक">चेक</option>
                                            <option value="जिन्सी">जिन्सी</option>
                                            <option value="अन्य">अन्य</option>
                                        </select>
                                        <div class="text-field" style="display: none;">
                                            <input type="number" class="form-control selected-purpose-text"
                                                   name="loan_giving_transaction_application_detail[trans_capital_amount][]"
                                                   placeholder="यहाँ लेख्नुहोस्">
                                        </div>
                                    </div>
                                @endif
                                <button class="btn btn-outline-secondary add-dropdown" type="button">+</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $(document).on('click', '.add-dropdown', function() {
                                var dropdownContainer = $(this).closest('.form-group').find('.dropdown-container').first()
                                    .clone();
                                dropdownContainer.find('.text-field input').val('');
                                dropdownContainer.find('.text-field').hide();
                                dropdownContainer.find('.add-dropdown').remove(); // Remove existing "+" button
                                dropdownContainer.append(
                                    '<button class="btn btn-outline-secondary add-dropdown" type="button">+</button>'
                                    ); // Add new "+" button
                                dropdownContainer.append(
                                    '<button class="btn btn-outline-danger remove-dropdown" type="button">-</button>'
                                    ); // Add "-" button
                                dropdownContainer.appendTo($(this).closest('.form-group'));
                            });

                            $(document).on('change', '.purpose-dropdown', function() {
                                var selectedValue = $(this).val();
                                var textField = $(this).closest('.dropdown').find('.text-field');
                                textField.hide();
                                textField.find('input').val('');
                                if (selectedValue !== '') {
                                    textField.show();
                                }
                            });

                            $(document).on('click', '.remove-dropdown', function() {
                                var dropdownContainer = $(this).closest('.dropdown-container');
                                dropdownContainer.remove();
                            });
                        });
                    </script>

                    <div class="row">
                        <span class="application_main_title">५. उजुरी कर्ता सँग असुल गर्न बाँकी कर्जा रकम:<span
                                class="star">*</span> </span>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">सावाँ</label>
                                <input type="number"
                                    value="{{ $loanGivingVictim->transactionRegistration->comp_amt_rem_prin }}"
                                    id="" name="loan_giving_transaction_application_detail[comp_amt_rem_prin]"
                                    class="input-text" autofocus min="1">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">व्याज</label>
                                <input type="number"
                                    value="{{ $loanGivingVictim->transactionRegistration->comp_amt_rem_interest }}"
                                    id=""
                                    name="loan_giving_transaction_application_detail[comp_amt_rem_interest]"
                                    class="input-text" autofocus min="1">
                            </div>
                        </div>
                    </div>
                    <hr class="hr-line">


                    {{-- start of row --}}

                    <div class="row">
                        <span class="application_main_title">६. ऋण/कर्जा दिएको बखत जग्गा राजिनामा/दृष्टिबन्धक पारित गरिएको
                            भए:</span>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">क. साविकको जग्गा धनीको नाम, थर</label>

                                <input type="text"
                                    value="{{ $loanGivingVictim->otherDetails->loan_landrestrict_owner }}"
                                    id="" name="loan_giving_application_other_details[loan_landrestrict_owner]"
                                    class="input-text" autofocus>

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">ख. ऋणीको नाम, थर</label>

                                <input type="text"
                                    value="{{ $loanGivingVictim->otherDetails->loan_taking_person_name }}"
                                    id="" name="loan_giving_application_other_details[loan_taking_person_name]"
                                    class="input-text" autofocus>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="text">ग. जग्गा पारित गरी लिएको व्यक्तिको नाम, थर</label>

                                <input type=""
                                    value="{{ $loanGivingVictim->otherDetails->land_passed_name }}"
                                    id="" name="loan_giving_application_other_details[land_passed_name]"
                                    class="input-text" autofocus>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">घ. लिखत रजिष्ट्रेशन गराई लिने व्यक्तिसँग तपाईको नाता,
                                    सम्बन्ध:</label>

                                <input type="text"
                                    value="{{ $loanGivingVictim->otherDetails->registered_person_relation }}"
                                    id=""
                                    name="loan_giving_application_other_details[registered_person_relation]"
                                    class="input-text" autofocus>

                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group">
                                <label for="">ङ. जग्गाको कित्ता नं
                                </label>

                                <input type="number"
                                    value="{{ $loanGivingVictim->otherDetails->landrestrict_kitta }}"
                                    id="" name="loan_giving_application_other_details[landrestrict_kitta][]"
                                    class="input-text" autofocus min="1">

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">क्षेत्रफल
                                </label>

                                <input type="number"
                                    value="{{ $loanGivingVictim->otherDetails->landrestrict_area }}"
                                    id="" name="loan_giving_application_other_details[landrestrict_area][]"
                                    class="input-text" autofocus min="1">

                            </div>
                        </div>


                        <span class="application_second_title">च. जग्गा रहेको स्थान</span>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">प्रदेश</label>
                                <select id="state_id2" name="loan_giving_application_other_details[landrestrict_state][]"
                                    data-iteration="2" class="form-control b_state_id">
                                    <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="">जिल्ला</label>

                                <select id="b_district_id2" data-iteration="2"
                                    name="loan_giving_application_other_details[landrestrict_district][]"
                                    class="form-control b_district_id">
                                    <option value="{{$loanGivingVictim->otherDetails->landrestrict_district}}">जिल्ला चयन गर्नुहोस्</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-3">
                            <div class="form-group">
                                <label for="">न.पा./गा.पा</label>

                                <select id="b_localbody_id2" data-iteration="2"
                                    name="loan_giving_application_other_details[landrestrict_local][]"
                                    class="form-control b_localbody_id">
                                    <option value="{{$loanGivingVictim->otherDetails->land_passed_name}}">न.पा./गा.पा चयन गर्नुहोस्
                                    </option>
                                </select>

                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="">वडा नं</label>

                                <select id="a_wada_id" name="loan_giving_application_other_details[landrestrict_ward][]"
                                    class="form-control col-md-12">
                                    <option disabled selected value>वडा चयन गर्नुहोस्</option>
                                    <option value="1">वडा नं. १</option>
                                    <option value="2">वडा नं. २</option>
                                    <option value="3">वडा नं. ३</option>
                                    <option value="4">वडा नं. ४</option>
                                    <option value="5">वडा नं. ५</option>
                                    <option value="6">वडा नं. ६</option>
                                    <option value="7">वडा नं. ७</option>
                                    <option value="8">वडा नं. ८</option>
                                    <option value="9">वडा नं. ९</option>
                                    <option value="10">वडा नं. १०</option>
                                    <option value="11">वडा नं. ११</option>
                                    <option value="12">वडा नं. १२</option>
                                    <option value="13">वडा नं. १३</option>
                                    <option value="14">वडा नं. १४</option>
                                    <option value="15">वडा नं. १५</option>
                                    <option value="16">वडा नं. १६</option>
                                    <option value="17">वडा नं. १७</option>
                                    <option value="18">वडा नं. १८</option>
                                    <option value="19">वडा नं. १९</option>
                                    <option value="20">वडा नं. २०</option>
                                    <option value="21">वडा नं. २१</option>
                                    <option value="22">वडा नं. २२</option>
                                    <option value="23">वडा नं. २३</option>
                                    <option value="24">वडा नं. २४</option>
                                    <option value="25">वडा नं. २५</option>
                                    <option value="26">वडा नं. २६</option>
                                    <option value="27">वडा नं. २७</option>
                                    <option value="28">वडा नं. २८</option>
                                    <option value="29">वडा नं. २९</option>
                                    <option value="30">वडा नं. ३०</option>
                                    <option value="31">वडा नं. ३१</option>
                                    <option value="32">वडा नं. ३२</option>

                                </select>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <label for="landregistration-datepicker">छ. जग्गा रजिष्ट्रेशन भएको मिति
                                </label>

                                <input type="text"
                                    value="{{ $loanGivingVictim->otherDetails->landrestrict_registration_date }}"
                                    id="landregistration-datepicker"
                                    name="loan_giving_application_other_details[landrestrict_registration_date]"
                                    class="input-text" autofocus><br><br>

                            </div>
                        </div>

                    </div>
                    {{--  end of row --}}




                    {{-- Another Row Ends --}}

                    {{-- <div class="row">
                            <span class="application_main_title">7. ऋण/कर्जा दिएको बखत</span>
                             <div class="col-12">

                                <div class="form-group">
                                    <label for="">ऋणी सँग बैंक चेक लेखाई लिएको </label>

                                    <select id="" name="is_loan_cheque_shown" class="">
                                        <option>छ</option>
                                        <option>छैन</option>
                                    </select>

                                </div>
                            </div>  --}}

                    <script>
                        function showFields() {
                            document.getElementById('chequeFields').style.display = 'block';
                            document.getElementById('chequeFields2').style.display = 'block';
                            document.getElementById('chequeFields3').style.display = 'block';
                            document.getElementById('chequeFields4').style.display = 'block';
                            document.getElementById('chequeFields5').style.display = 'block';
                            document.getElementById('chequeFields6').style.display = 'block';
                        }

                        function hideFields() {
                            document.getElementById('chequeFields').style.display = 'none';
                            document.getElementById('chequeFields2').style.display = 'none';
                            document.getElementById('chequeFields3').style.display = 'none';
                            document.getElementById('chequeFields4').style.display = 'none';
                            document.getElementById('chequeFields5').style.display = 'none';
                            document.getElementById('chequeFields6').style.display = 'none';
                        }
                    </script>
                    </head>

                    <body>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="application_main_title">७. ऋण/कर्जा दिएको बखत ऋणी सँग बैंक चेक लेखाई
                                        लिएको:<span class="star">*</span></label>
                                    <div>
                                        <input type="radio" id="loan_cheque_shown_yes"
                                            name="loan_giving_application_other_details[is_loan_cheque_shown]"
                                            value="1" onclick="showFields()"
                                            {{ $loanGivingVictim->otherDetails->is_loan_cheque_shown == '1' ? 'checked' : '' }}>
                                        <label for="loan_cheque_shown_yes">छ</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="loan_cheque_shown_no"
                                            name="loan_giving_application_other_details[is_loan_cheque_shown]"
                                            value="0" onclick="hideFields()"
                                            {{ $loanGivingVictim->otherDetails->is_loan_cheque_shown == '0' ? 'checked' : '' }}>
                                        <label for="loan_cheque_shown_no">छैन</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6" id="chequeFields" style="display: none;">
                                <div class="form-group">
                                    <label for="">क. चेक उपलब्ध गराउने व्यक्तिको नाम, थर</label>
                                    <input type="text"
                                        value="{{ $loanGivingVictim->otherDetails->cheque_giving_person }}"
                                        id="cheque_giving_person"
                                        name="loan_giving_application_other_details[cheque_giving_person]"
                                        class="input-text" autofocus>
                                </div>
                            </div>
                            <div class="col-6" id="chequeFields2" style="display: none;">
                                <div class="form-group">
                                    <label for="">ख. चेक प्राप्त गर्ने व्यक्तिको नाम, थर</label>
                                    <input type="text"
                                        value="{{ $loanGivingVictim->otherDetails->cheque_receiving_person}}"
                                        id="cheque_receiving_person"
                                        name="loan_giving_application_other_details[cheque_receiving_person]"
                                        class="input-text" autofocus>
                                </div>
                            </div>
                            <div class="col-6" id="chequeFields3" style="display: none;">
                                <div class="form-group">
                                    <label for="cheque-datepicker">ग. चेक काटेको मिति</label>
                                    <input type="text"
                                        value="{{ $loanGivingVictim->otherDetails->cheque_issue_date }}"
                                        id="cheque-datepicker"
                                        name="loan_giving_application_other_details[cheque_issue_date]" class="input-text"
                                        autofocus>
                                </div>
                            </div>
                            <div class="col-6" id="chequeFields4" style="display: none;">
                                <div class="form-group">
                                    <label for="chequebounce-datepicker">घ. चेक बाउन्स भएको मिति</label>
                                    <input type="text"
                                        value="{{$loanGivingVictim->otherDetails->cheque_bounce_date }}"
                                        id="chequebounce-datepicker"
                                        name="loan_giving_application_other_details[cheque_bounce_date]"
                                        class="input-text" autofocus>
                                </div>
                            </div>
                            <div class="col-6" id="chequeFields5" style="display: none;">
                                <div class="form-group">
                                    <label for="">ङ. चेकमा उल्लेख भएको रकम</label>
                                    <input type="number"
                                        value="{{ $loanGivingVictim->otherDetails->cheque_detail_amount }}"
                                        id="cheque_detail_amount"
                                        name="loan_giving_application_other_details[cheque_detail_amount]"
                                        class="input-text" autofocus min="1">
                                </div>
                            </div>
                            <div class="col-6" id="chequeFields6" style="display: none;">
                                <div class="form-group">
                                    <label for="">च. चेक सम्बन्धी अन्य विवरण</label>
                                    <textarea name="loan_giving_application_other_details[cheque_other_details]">{{ $loanGivingVictim->otherDetails->cheque_other_details }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Another Row Ends --}}


                        {{-- Row ends --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="application_main_title">८. ऋण/कर्जा कारोवारको सम्बन्धमा निज ऋणीको विरुद्धमा अदालतमा मुद्दा परेको:<span class="star">*</span></label>
                                    <div>
                                        <input type="radio" id="court_case_pending_yes" name="loan_giving_application_other_details[is_court_case_pending]" value="1" onclick="showCourtCaseFields()" {{ old('loan_giving_application_other_details.is_court_case_pending') == '1' ? 'checked' : '' }} checked>
                                        <label for="court_case_pending_yes"> छ</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="court_case_pending_no" name="loan_giving_application_other_details[is_court_case_pending]" value="0" onclick="hideCourtCaseFields()" {{ old('loan_giving_application_other_details.is_court_case_pending') == '0' ? 'checked' : '' }}>
                                        <label for="court_case_pending_no"> छैन</label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-4" id="courtCaseFields7"
                                style="{{ old('loan_giving_application_other_details.is_court_case_pending') == '1' ? 'display: block;' : 'display: none;' }}">
                                
                                <div class="form-group">
                                    <label for="">क. अदालतमा मुद्दा दायर भएको भए हालको अवस्था:</label>
                                    <select name="loan_giving_application_other_details[court_case_state_name]">
                                        <option disabled selected value>अवस्था चयन गर्नुहोस्</option>

                                        <option
                                            {{ $loanGivingVictim->otherDetails->court_case_state_name == 'विचाराधीन अवस्थामा रहेको' ? 'selected' : '' }}>
                                            विचाराधीन रहेको</option>
                                        <option
                                            {{ $loanGivingVictim->otherDetails->court_case_state_name == 'फैसला भैसकेको' ? 'selected' : '' }}>
                                            फैसला भैसकेको</option>
                                        <option
                                            {{ $loanGivingVictim->otherDetails->court_case_state_name == 'फैसला भै फैसला कार्यान्वयन भई सकेको' ? 'selected' : '' }}>
                                            फैसला कार्यान्वयन भई सकेको</option>
                                        <option
                                            {{$loanGivingVictim->otherDetails->court_case_state_name == 'फैसला भै फैसला कार्यान्वयनको क्रममा रहेको' ? 'selected' : '' }}>
                                            फैसला कार्यान्वयनको क्रममा रहेको</option>
                                        <option
                                            {{ $loanGivingVictim->otherDetails->court_case_state_name == 'फैसला भै फैसला कार्यान्वयन हुन बाँकी रहेको' ? 'selected' : '' }}>
                                            फैसला कार्यान्वयन नभएको</option>
                                        <option
                                            {{$loanGivingVictim->otherDetails->court_case_state_name == 'आशिंक रुपमा फैसला कार्यान्वयन भएको' ? 'selected' : '' }}>
                                            आशिंक रुपमा फैसला कार्यान्वयन भएको</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4" id="courtCaseFields8"
                                style="{{ old('loan_giving_application_other_details.is_court_case_pending') == '1' ? 'display: block;' : 'display: none;' }}">
                                <div class="form-group">
                                    <label for="">ख. मुद्दाको विषय र मुद्दा नं </label>
                                    <input type="text"
                                        value="{{ $loanGivingVictim->otherDetails->court_case_subject}}"
                                        id="" name="loan_giving_application_other_details[court_case_subject]"
                                        class="input-text" autofocus>
                                </div>
                            </div>
                            <div class="col-4" id="courtCaseFields10"
                                style="{{ $loanGivingVictim->otherDetails->court_case_pending == '1' ? 'display: block;' : 'display: none;' }}">
                                <div class="form-group">
                                    <label for="">ग. नपुग बिगो वापत ऋणि कैदमा रहेको अवस्था </label>
                                    <div>
                                        <input type="radio" id="amount_short_person_injail_yes"
                                            name="loan_giving_application_other_details[is_amount_short_person_injail]"
                                            value="1" onclick="showCourtCaseDoneFields()"
                                            {{ $loanGivingVictim->otherDetails->is_amount_short_person_injail  == '1' ? 'checked' : '' }}>
                                        <label for="amount_short_person_injail_yes">छ</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="amount_short_person_injail_no"
                                            name="loan_giving_application_other_details[is_amount_short_person_injail]"
                                            value="0" onclick="hideCourtCaseDoneFields()"
                                            {{$loanGivingVictim->otherDetails->is_amount_short_person_injail  == '0' ? 'checked' : '' }}>
                                        <label for="amount_short_person_injail_no">छैन</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="courtCaseFields11"
                                style="{{ old('loan_giving_application_other_details.is_court_case_pending') == '1' ? 'display: block;' : 'display: none;' }}">
                                <div class="form-group">
                                    <label class="application_main_title">९. अदालतबाट मुद्दा फैसला भइसकेको भए </label>
                                    <div>
                                        <input type="radio" id="court_case_done_yes"
                                            name="loan_giving_application_other_details[is_court_case_done]"
                                            value="1" onclick="showCourtCaseDoneFields()"
                                            {{ $loanGivingVictim->otherDetails->is_court_case_done == '1' ? 'checked' : '' }}>
                                        <label for="court_case_done_yes">विगो भराउने/जरिवाना/कैद तीनै प्रकारको सजाय
                                            भएको</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="court_case_done_no"
                                            name="loan_giving_application_other_details[is_court_case_done]"
                                            value="0" onclick="hideCourtCaseDoneFields()"
                                            {{ $loanGivingVictim->otherDetails->is_court_case_done == '0' ? 'checked' : '' }}>
                                        <label for="court_case_done_no">बिगो भराउने र जरिवाना मात्र भएको</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
        // Set the default visibility of court case fields based on the default checked radio button
        if (document.getElementById('court_case_pending_yes').checked) {
            showCourtCaseFields();
        } else {
            hideCourtCaseFields();
        }

        if (document.getElementById('amount_short_person_injail_yes').checked) {
            showCourtCaseDoneFields();
        } else {
            hideCourtCaseDoneFields();
        }
    });

    function showCourtCaseFields() {
        document.getElementById('courtCaseFields7').style.display = 'block';
        document.getElementById('courtCaseFields8').style.display = 'block';
        document.getElementById('courtCaseFields10').style.display = 'block';
        document.getElementById('courtCaseFields11').style.display = 'block';
    }

    function hideCourtCaseFields() {
        document.getElementById('courtCaseFields7').style.display = 'none';
        document.getElementById('courtCaseFields8').style.display = 'none';
        document.getElementById('courtCaseFields10').style.display = 'none';
        document.getElementById('courtCaseFields11').style.display = 'none';
    }

    function showCourtCaseDoneFields() {
        document.getElementById('courtCaseDoneFields7').style.display = 'block';
        document.getElementById('courtCaseDoneFields8').style.display = 'block';
    }

    function hideCourtCaseDoneFields() {
        document.getElementById('courtCaseDoneFields7').style.display = 'none';
        document.getElementById('courtCaseDoneFields8').style.display = 'none';
    }
                        </script>

                        {{-- Row ends --}}
                        <div class="row">
                           
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="application_main_title">१०. कर्जा लेनदेनको क्रममा दृष्टिबन्धक/राजीनामा पारित
                                        गरेको भए घर/जग्गा हाल कसले भोगचलन गरिरहेको छ?</label>
                                    <textarea name="loan_giving_application_other_details[landrestricted_usedby_now]"
                                    >{{ $loanGivingVictim->otherDetails->landrestricted_usedby_now  }}</textarea>
                                    <autofocus>
                                </div>
                            </div>

                        </div>


                        {{-- Row Starts --}}
                        <div class="row">
                            <span class="application_main_title">११.रजिष्ट्रेशन पारित गर्दा छुट्टै शर्तनामाको कागज गरिएको:</span>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for=""></label>
                                    <div>
                                        <label>
                                            <input type="radio"
                                                name="loan_giving_application_other_details[is_when_registered_otherdocs]"
                                                value="1" onclick="showTextarea()"
                                                {{ $loanGivingVictim->otherDetails->is_when_registered_otherdocs == '1' ? 'checked' : '' }}>
                                            थियो
                                        </label>
                                        <label>
                                            <input type="radio"
                                                name="loan_giving_application_other_details[is_when_registered_otherdocs]"
                                                value="0" onclick="hideTextarea()"
                                                {{ $loanGivingVictim->otherDetails->is_when_registered_otherdocs  == '0' ? 'checked' : '' }}>
                                            थिएन
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-3" id="textareaContainer"
                            style="{{ old('loan_giving_application_other_details.is_when_registered_otherdocs') == '1' ? '' : 'display: none;' }}">
                           <div class="form-group">
                               <label for="">गरिएको भए के शर्त राखिएको थियो?</label>
                               <div id="textareas">
                                   <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                       <textarea name="loan_giving_application_other_details[when_registered_othercondition_name][]"
                                                 class="form-control equal-height" style="height: 20px; flex-grow: 1;">{{ $loanGivingVictim->otherDetails->when_registered_othercondition_name}}</textarea>
                                       <button class="btn btn-outline-secondary" type="button" style="margin-left: 10px;" onclick="addTextarea()">+</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       
                       <script>
                           function showTextarea() {
                               document.getElementById('textareaContainer').style.display = 'block';
                           }
                       
                           function hideTextarea() {
                               document.getElementById('textareaContainer').style.display = 'none';
                           }
                       
                           function addTextarea() {
                               const textareasDiv = document.getElementById('textareas');
                               const newTextareaWrapper = document.createElement('div');
                               newTextareaWrapper.style.display = 'flex';
                               newTextareaWrapper.style.alignItems = 'center';
                               newTextareaWrapper.style.marginBottom = '10px';
                       
                               const newTextarea = document.createElement('textarea');
                               newTextarea.name = 'loan_giving_application_other_details[when_registered_othercondition_name][]';
                               newTextarea.className = 'form-control equal-height';
                               newTextarea.style.height = '20px';
                               newTextarea.style.flexGrow = '1';
                       
                               const removeButton = document.createElement('button');
                               removeButton.className = 'btn btn-outline-secondary';
                               removeButton.type = 'button';
                               removeButton.style.marginLeft = '10px';
                               removeButton.textContent = '-';
                               removeButton.onclick = function() {
                                   textareasDiv.removeChild(newTextareaWrapper);
                               };
                       
                               newTextareaWrapper.appendChild(newTextarea);
                               newTextareaWrapper.appendChild(removeButton);
                       
                               textareasDiv.appendChild(newTextareaWrapper);
                           }
                       </script>

                            {{-- Row Starts --}}

                            <div class="row m-0 p-0">
                                <div class="form-group"><br>
                                    <label for=""><span class="application_main_title">१२. यो लेनदेन सम्बन्धमा
                                            अन्य केही कुरा खुलाउनुपर्ने भए?</label>
                                    <textarea name="loan_giving_application_other_details[other_details_in_transaction]"
                                        class="form-control equal-height"style="height: 20px;">{{ $loanGivingVictim->otherDetails->other_details_in_transaction  }}</textarea>
                                </div>
                                {{-- Another Row Starts --}}
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <div class="form-group">
                                            <label class="application_main_title">१४. यो निवेदनको व्यहोरा पुष्टि गर्ने निम्न कागजातको फोटोकपी यसैसाथ संलग्न गरेको छु।</label>
                                            <div id="document-container">
                                                <div class="input-group mb-2">
                                                    <textarea name="loan_giving_application_other_details[application_attached_documents][]" class="form-control equal-height" autofocus>{{ $loanGivingVictim->otherDetails->application_attached_documents  }}</textarea>
                                                    <input type="file" name="loan_giving_application_other_details[application_document_file][]" class="form-control equal-height ml-2"{{ $loanGivingVictim->otherDetails->appliction_document_file }}>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary btn-sm add-textarea equal-height" type="button">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <script>
                                   //For Textarea + button
            $(document).ready(function() {
            // Function to add new textarea and file input fields
            $(document).on('click', '.add-textarea', function() {
                var container = $('#document-container');
                var newInputGroup = $('<div class="input-group mb-2">')
                    .append('<textarea name="loan_giving_other_details[application_attached_documents][]" class="form-control equal-height" autofocus></textarea>')
                    .append('<input type="file" name="loan_giving_other_details[application_document_file][]" class="form-control equal-height ml-2">')
                    .append('<div class="input-group-append"><button class="btn btn-outline-secondary btn-sm remove-textarea equal-height" type="button">-</button></div>');
                container.append(newInputGroup);
            });
            // Function to remove textarea and file input fields
            $(document).on('click', '.remove-textarea', function() {
                $(this).closest('.input-group').remove();
            });
        });
                                </script>

                                {{-- Another Row Starts --}}
                                <div class="row">
                                
                                    
                                    <label class="application_main_title">१४. माथि लेखिएको व्यहोरा मैले जानेबुझे सम्म ठिक
                                        साँचो हो। यसमा फरक परे कानुन बमोजिम सहुँला बुझाँउला भनि सहिछाप गरिदिए:</label>



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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">नाम, थर
                                            </label>
                                            <input type=""
                                                value="{{ $loanGivingVictim->otherDetails->stamped_name }}"
                                                id=""
                                                name="loan_giving_application_other_details[stamped_name]"
                                                class="input-text" autofocus>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="">हस्ताक्षर
                                            </label>
                                            <input type=""
                                                value="{{ $loanGivingVictim->otherDetails->stamped_name }}"
                                                id=""
                                                name="loan_giving_application_other_details[stamped_name]"
                                                class="input-text" autofocus>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="stamp-datepicker">मिति
                                            </label>
                                            <input type=""
                                                value="{{ $loanGivingVictim->otherDetails->stamped_date}}"
                                                id="stamp-datepicker"
                                                name="loan_giving_application_other_details[stamped_date]"
                                                class="input-text" autofocus>
                                        </div>
                                    </div>
                                </div>



                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">सिर्जना गर्नुहोस</button>
                                </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js">
    </script>

    <script>
        $(document).ready(function() {
            // Function to handle applicant dynamic dropdowns
            $(document).on('change', '.a_state_id', function() {
                var a_state_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'a_district_id' + currentIteration;
                var next_append = 'a_localbody_id' + currentIteration;
                fetchDistrict(a_state_id, append_to, next_append);
            });

            $(document).on('change', '.a_district_id', function() {
                var a_district_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'a_localbody_id' + currentIteration;
                fetchLocalGoverment(a_district_id, append_to);
            });


            // Function to handle offender dynamic dropdowns
            $(document).on('change', '.o_state_id', function() {
                var o_state_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'o_district_id' + currentIteration;
                var next_append = 'o_localbody_id' + currentIteration;
                fetchDistrict(o_state_id, append_to, next_append);
            });

            $(document).on('change', '.o_district_id', function() {
                var o_district_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'o_localbody_id' + currentIteration;
                fetchLocalGoverment(o_district_id, append_to);
            });

            // Function to handle dynamic dropdowns for the new set for जग्गा रहेको स्थान
            $(document).on('change', '.b_state_id', function() {
                var b_state_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'b_district_id' + currentIteration;
                var next_append = 'b_localbody_id' + currentIteration;
                fetchDistrict(b_state_id, append_to, next_append);
            });

            $(document).on('change', '.b_district_id', function() {
                var b_district_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'b_localbody_id' + currentIteration;
                fetchLocalGoverment(b_district_id, append_to);
            });

            // Function to handle dynamic dropdowns for the new set for  घर रहेको स्थान
            $(document).on('change', '.c_state_id', function() {
                var c_state_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'c_district_id' + currentIteration;
                var next_append = 'c_localbody_id' + currentIteration;
                fetchDistrict(c_state_id, append_to, next_append);
            });

            $(document).on('change', '.c_district_id', function() {
                var c_district_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'c_localbody_id' + currentIteration;
                fetchLocalGoverment(c_district_id, append_to);
            });


            // Function to handle dynamic dropdowns for the new set for  कर्जा लिने व्यक्तिको
            $(document).on('change', '.d_state_id', function() {
                var d_state_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'd_district_id' + currentIteration;
                var next_append = 'd_localbody_id' + currentIteration;
                fetchDistrict(d_state_id, append_to, next_append);
            });

            $(document).on('change', '.d_district_id', function() {
                var d_district_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'd_localbody_id' + currentIteration;
                fetchLocalGoverment(d_district_id, append_to);
            });



            // Function to handle dynamic dropdowns for the new set for जग्गाको विवरण
            $(document).on('change', '.e_state_id', function() {
                var e_state_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'e_district_id' + currentIteration;
                var next_append = 'e_localbody_id' + currentIteration;
                fetchDistrict(e_state_id, append_to, next_append);
            });

            $(document).on('change', '.e_district_id', function() {
                var e_district_id = $(this).val();
                var currentIteration = $(this).data("iteration");
                var append_to = 'e_localbody_id' + currentIteration;
                fetchLocalGoverment(e_district_id, append_to);
            });


            function fetchDistrict(stateId, append_to, next_append = null) {
                $.ajax({
                    url: '/admin/registration/get-districts/' + stateId,
                    type: 'GET',
                    success: function(response) {

                        var clearThisData = $('#' + append_to + '').empty();
                        var clearNextToThisData = $('#' + next_append + '').empty();
                        if (response.length > 0) {
                            $('#' + append_to + '').append(
                                '<option disabled selected value>जिल्ला चयन गर्नुहोस्</option>');
                            $.each(response, function(key, value) {
                                $('#' + append_to + '').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        } else {
                            $('#' + append_to + '').append(
                                '<option value="">No districts found</option>');
                        }
                    },
                    error: function() {
                        console.log("error in the ajax");
                    }
                });
            }

            function fetchLocalGoverment(distirctId, append_to) {
                $.ajax({
                    url: '/admin/registration/get-local-governments/' + distirctId,
                    type: 'GET',
                    success: function(response) {
                        var clearThisData = $('#' + append_to + '').empty();
                        if (response.length > 0) {
                            $('#' + append_to + '').append(
                                '<option disabled selected value>न.पा./गा.पा चयन गर्नुहोस्</option>'
                                );
                            $.each(response, function(key, value) {
                                $('#' + append_to + '').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        } else {
                            $('#' + append_to + '').append(
                                '<option value="">No Local Goverment found</option>');
                        }
                    },
                    error: function() {
                        console.log("error in the ajax");
                    }
                });
            }


            $(document).ready(function() {
                // Function to handle dynamic dropdowns...

                // Move Nepali Datepicker initialization outside the dynamic dropdown function
                initializeNepaliDatepicker();
            });

            function initializeNepaliDatepicker() {

                // Initialize Nepali Datepicker for "Registration Date" field
                var registrationInput = document.getElementById("registration-datepicker");
                if (registrationInput) {
                    registrationInput.nepaliDatePicker({
                        dateFormat: "YYYY-MM-DD",
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                }

                 // Initialize Nepali Datepicker for "Citizenship Issue Date" field
            var citizenshipInput = document.getElementById("citizenship-datepicker");
            console.log('Citizenship Input:', citizenshipInput); // Debugging statement
            if (citizenshipInput) {
                citizenshipInput.nepaliDatePicker({
                    dateFormat: "YYYY-MM-DD",
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 200
                });
            }
                // Initialize Nepali Datepicker for "Check Issue Date" field
                var chequeInput = document.getElementById("cheque-datepicker");
                if (chequeInput) {
                    chequeInput.nepaliDatePicker({
                        dateFormat: "YYYY-MM-DD",
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                }

                // Initialize Nepali Datepicker for "Check Bounce Date" field
                var chequeInput = document.getElementById("chequebounce-datepicker");
                if (chequeInput) {
                    chequeInput.nepaliDatePicker({
                        dateFormat: "YYYY-MM-DD",
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                }

                // Initialize Nepali Datepicker for "Stamped Date" field
                var stampInput = document.getElementById("stamp-datepicker");
                if (stampInput) {
                    stampInput.nepaliDatePicker({
                        dateFormat: "YYYY-MM-DD",
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                }

                // Initialize Nepali Datepicker for "Debit Date" field
                var debitInput = document.getElementById("debit-datepicker");
                if (debitInput) {
                    debitInput.nepaliDatePicker({
                        dateFormat: "YYYY-MM-DD",
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                }

                // Initialize Nepali Datepicker for "Land Registered Date" field
                var landregistrationInput = document.getElementById("landregistration-datepicker");
                if (landregistrationInput) {
                    landregistrationInput.nepaliDatePicker({
                        dateFormat: "YYYY-MM-DD",
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                }

                // Initialize Nepali Datepicker for "Account Issued Date" field
                var accountissueInput = document.getElementById("accountissue-datepicker");
                if (accountissueInput) {
                    accountissueInput.nepaliDatePicker({
                        dateFormat: "YYYY-MM-DD",
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                }
            }
        });

        //Phone Number Validation

       function validatePhoneNumber(input, errorSpanId) {
    const errorSpan = document.getElementById(errorSpanId);
    if (input.value.length > 10) {
        input.value = input.value.slice(0, 10);
    }
    if (input.value.length < 10 && input.value.length > 0) {
        errorSpan.style.display = 'block';
    } else {
        errorSpan.style.display = 'none';
    }
}

// Validation for Register number

document.getElementById("applicant_name").addEventListener("keydown", function(event) {
                if (event.key === "-" || event.keyCode === 189) {
                    event.preventDefault();
                }
            });
            document.getElementById("applicant_name").addEventListener("keydown", function(event) {
        if ((event.key === "-" && this.selectionStart === 0) || // prevent typing "-" at the beginning
        (event.key === "0" && this.value === "")) { // prevent starting with "0"
        event.preventDefault();
    }
    
});

// Validation for age 

document.getElementById("age").addEventListener("keydown", function(event) {
                if (event.key === "-" || event.keyCode === 189) {
                    event.preventDefault();
                }
            });
document.getElementById("age").addEventListener("keydown", function(event) {
    if ((event.key === "-" && this.selectionStart === 0) || // prevent typing "-" at the beginning
        (event.key === "0" && this.value === "")) { // prevent starting with "0"
        event.preventDefault();
    }
});

// For nagrikta number

document.getElementById("citizenship").addEventListener("keydown", function(event) {
                if (event.key === "-" || event.keyCode === 189) {
                    event.preventDefault();
                }
            });
document.getElementById("citizenship").addEventListener("keydown", function(event) {
    if ((event.key === "-" && this.selectionStart === 0) || // prevent typing "-" at the beginning
        (event.key === "0" && this.value === "")) { // prevent starting with "0"
        event.preventDefault();
    }
});

// For Family members number

document.getElementById("familyid").addEventListener("keydown", function(event) {
                if (event.key === "-" || event.keyCode === 189) {
                    event.preventDefault();
                }
            });
document.getElementById("familyid").addEventListener("keydown", function(event) {
    if ((event.key === "-" && this.selectionStart === 0) || // prevent typing "-" at the beginning
        (event.key === "0" && this.value === "")) { // prevent starting with "0"
        event.preventDefault();
    }
});
       
//For house number
function validateHouseNumber(input) {
    const errorSpan = document.getElementById('houseNumberError');
    const value = parseInt(input.value, 10);
    if (value < 1 || value > 10) {
        errorSpan.style.display = 'block';
    } else {
        errorSpan.style.display = 'none';
    }
}
// For House Storey

document.getElementById("housestoreyid").addEventListener("input", function(event) {
    // Remove leading zeros
    if (this.value.length > 1 && this.value.startsWith("0")) {
        this.value = this.value.slice(1);
    }
    // Prevent typing "-" at the beginning
    if (this.value.startsWith("-")) {
        this.value = "";
    }
});
    </script>


@endsection
