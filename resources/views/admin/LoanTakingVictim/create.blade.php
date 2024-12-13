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

    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.loantaking-victim.store') }}"
        class="form-inline" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <span class="application_main_title">सम्बन्धित कार्यालयले भर्ने</span>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="registration_id">दर्ता नं</label>
                    <input type="number" id="registration_id" name="loan_taking_application_registration[registration_id]"
                        class="input-text" autofocus  pattern="\d+" min="1"
                        value="{{ old('loan_taking_application_registration.registration_id') }}" >

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="register-datepicker">दर्ता मिति</label>
                    <input type="text" id="register-datepicker"
                        name="loan_taking_application_registration[registration_date]" class="input-text" autofocus
                        value="{{ old('loan_taking_application_registration.registration_date') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="registration_office">कार्यालय</label>
                    <input type="text" id="registration_office" name="loan_taking_application_registration[registration_office]" class="input-text"
                    autofocus value="{{ old('loan_taking_application_registration.registration_office', optional($user->district)->name ?? '') }}">
                </div>
            </div>
        </div>
        <hr class="hr-line">

        {{-- BASIC INFORMATION --}}
        <div class="row">
            <span class="application_main_title">१. निवेदक(ऋण/कर्जा लिने व्यक्ति) को विवरण:</span>
                <div class="col-6" id="applicantForm">
                    <div class="form-group">
                        <label for="applicant_name">नाम, थर <span class="star">*</span></label>
                        <input type="text" id="name" name="loan_taking_applicant_basic_detail[applicant_name]"
                               class="input-text" autofocus value="{{ old('loan_taking_applicant_basic_detail.applicant_name') }}"
                               maxlength="50"  oninput="validateName(this,'nameError')" required>
                               @if ($errors->has('loan_taking_applicant_basic_detail.applicant_name'))
                               <div class="alert alert-danger">
                                   <ul>
                                       @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_name') as $error)
                                       <li>नाम, थर भर्नुहोस्</li>
                                       @endforeach
                                   </ul>
                               </div>
                           @endif

                    </div>
                </div>
               
            <div class="col-6">
                <div class="form-group">
                    <label for="applicant_age">उमेर</label>
                    <input type="number" id="applicant_age" name="loan_taking_applicant_basic_detail[applicant_age]"
                        class="input-text" autofocus pattern="\d+" min="1" value="{{ old('loan_taking_applicant_basic_detail.applicant_age') }}">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="applicant_citizenship">नागरिकता नं</label>
                    <input type="number" id="applicant_citizenship"
                        name="loan_taking_applicant_basic_detail[applicant_citizenship]" class="input-text" autofocus pattern="\d+" min="1"
                        value="{{ old('loan_taking_applicant_basic_detail.applicant_citizenship') }}">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="registrations">जारी जिल्ला</label>
                    <select id="" name="loan_taking_applicant_basic_detail[applicant_citizenship_issue_district]"
                        class="form-control a_district_id">
                    <option disabled selected value>जिल्ला चयन गर्नुहोस्</option>
                    @foreach ($districts as $district)
                    <option value="{{ $district->id }}" {{ old('loan_taking_applicant_basic_detail.applicant_citizenship_issue_district')== $district->id ? 'selected' : '' }}>
                        {{ $district->name }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
           
            <div class="col-4">
                <div class="form-group">
                    <label for="applicant_citizenship_issue_date">जारी मिति</label>
                    <input type="text" id="nepali-datepicker"
                        name="loan_taking_applicant_basic_detail[applicant_citizenship_issue_date]" class="input-text"
                        autofocus value="{{ old('loan_taking_applicant_basic_detail.applicant_citizenship_issue_date') }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="father_name">पिताको नाम, थर <span class="star">*</span></label>
                    <input type="text" value="{{ old('loan_taking_applicant_basic_detail.applicant_fathername') }}"
                        id="father_name" name="loan_taking_applicant_basic_detail[applicant_fathername]" class="input-text"
                        autofocus  maxlength="50" oninput="validateName(this,'nameError1')" required>
                        @if ($errors->has('loan_taking_applicant_basic_detail.applicant_fathername'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_fathername') as $error)
                                <li>पिताको नाम, थर भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif                    
                </div>
            </div>
           

            <div class="col-6">
                <div class="form-group">
                    <label for="applicant_fathers_no">निवेदकको फोन/मोबाईल नं <span class="star">*</span></label>
                    <input type="number" value="{{ old('loan_taking_applicant_basic_detail.applicant_fathers_no') }}"
                           id="applicant_fathers_no" name="loan_taking_applicant_basic_detail[applicant_fathers_no]"
                           class="input-text" maxlength="10" placeholder="१० अंककाे नंबर" autofocus
                           oninput="validatePhoneNumber(this, 'phoneNumberError1')">
                           <span id="phoneNumberError1" style="display: none; color: red;">कृपया १० अंकको सही फोन नंबर प्रविष्ट गर्नुहोस्।</span>
                           @if ($errors->has('loan_taking_applicant_basic_detail.applicant_fathers_no'))
                           <div class="alert alert-danger">
                               <ul>
                                   @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_fathers_no') as $error)
                                   <li>फोन/मोबाईल नं भर्नुहोस्</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif        
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="spouse_name">पति/पत्नीको नाम थर</label>
                    <input type="text" value="{{ old('loan_taking_applicant_basic_detail.applicant_spouse') }}"
                        id="spouse_name" name="loan_taking_applicant_basic_detail[applicant_spouse]" class="input-text"
                        autofocus  maxlength="50" oninput="validateName(this)">
                </div>
            </div>

           
            <div class="col-6">
                <div class="form-group">
                    <label for="spouse_phone">फोन/मोबाईल नं</label>
                    <input type="number" value="{{ old('loan_taking_applicant_basic_detail.applicant_spouse_no') }}"
                        id="spouse_phone" name="loan_taking_applicant_basic_detail[applicant_spouse_no]"
                        class="input-text" autofocus maxlength="10" placeholder="१० अंककाे नंबर"
                        oninput="validatePhoneNumber(this, 'phoneNumberError2')">
                    <span id="phoneNumberError2" style="display: none; color: red;">कृपया १० अंकको सही फोन नंबर प्रविष्ट गर्नुहोस्।</span>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="family_members">सगोल परिवारको सदस्य संख्या <span class="star">*</span></label>
                    <input type="number" value="{{ old('loan_taking_applicant_basic_detail.applicant_family') }}"
                        id="family_members" name="loan_taking_applicant_basic_detail[applicant_family]"
                        class="input-text" autofocus  pattern="\d+" min="1"  oninput="validateRequired(this,'nameError2')" required>
                        @if ($errors->has('loan_taking_applicant_basic_detail.applicant_family'))
                           <div class="alert alert-danger">
                               <ul>
                                   @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_family') as $error)
                                   <li>सगोल परिवारको सदस्य संख्या भर्नुहोस्</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif   
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="annual_income">वार्षिक आम्दानी <span class="star">*</span></label>
                    <select id="annual_income" name="loan_taking_applicant_basic_detail[applicant_annual_income]" class="form-control" autofocus required>
                        <option value="" disabled {{ old('loan_taking_applicant_basic_detail.applicant_annual_income') == '' ? 'selected' : '' }}>वार्षिक आम्दानी चयन गर्नुहोस्</option>
                        <option value="1-5" {{ old('loan_taking_applicant_basic_detail.applicant_annual_income') == '1-5' ? 'selected' : '' }}>१ लाख देखि  ५ लाख</option>
                        <option value="5-10" {{ old('loan_taking_applicant_basic_detail.applicant_annual_income') == '5-10' ? 'selected' : '' }}>५ लाख देखि १० लाख</option>
                        <option value="10-20" {{ old('loan_taking_applicant_basic_detail.applicant_annual_income') == '10-20' ? 'selected' : '' }}>१० लाख देखि  २० लाख</option>
                        <option value="20+" {{ old('loan_taking_applicant_basic_detail.applicant_annual_income') == '20+' ? 'selected' : '' }}>२० लाख +</option>
                    </select>
                    @if ($errors->has('loan_taking_applicant_basic_detail.applicant_annual_income'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_annual_income') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif   
                </div>
            </div>

            <span class="application_second_title">स्थायी ठेगाना:</span>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">प्रदेश <span class="star">*</span></label>
                        <select id="state_id0" name="loan_taking_applicant_basic_detail[applicant_permanent_state]"
                        data-iteration="0" class="form-control a_state_id" onchange="validateRequired(this,'nameError3')" required>
                        <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}"
                                {{ old('loan_taking_applicant_basic_detail.applicant_permanent_state') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('loan_taking_applicant_basic_detail.applicant_permanent_state'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_permanent_state') as $error)
                            <li>प्रदेश चयन गर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif   
                </div>
            </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">जिल्ला <span class="star">*</span></label>
                        <select id="a_district_id0" data-iteration="0"
                        name="loan_taking_applicant_basic_detail[applicant_permanent_district]"
                        class="form-control a_district_id" onchange="validateRequired(this,'nameError4')" required>
                        <option disabled selected value>जिल्ला चयन गर्नुहोस्</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}"
                                {{ old('loan_taking_applicant_basic_detail.applicant_permanent_district') == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}</option>
                        @endforeach            
                    </select>
                    @if ($errors->has('loan_taking_applicant_basic_detail.applicant_permanent_district'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_permanent_district') as $error)
                            <li>जिल्ला चयन गर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif   
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">न.पा./गा.पा<span class="star">*</span></label>
                        <select id="a_localbody_id0" data-iteration="0"
                        name="loan_taking_applicant_basic_detail[applicant_permanent_local]"
                        class="form-control a_localbody_id" onchange="validateRequired(this,'nameError5')" required>
                        <option value="">स्थानीय तह चयन गर्नुहोस्
                        </option>
                        @foreach ($locals as $localBody)
                            <option value="{{ $localBody->id }}" {{ old('loan_taking_applicant_basic_detail.applicant_permanent_local') == $localBody->id ? 'selected' : '' }}>
                                {{ $localBody->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('loan_taking_applicant_basic_detail.applicant_permanent_local'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_permanent_local') as $error)
                            <li>स्थानीय तह चयन गर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif   
                </div>
            </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">वडा नं<span class="star">*</span></label>
                        <select id="wada_id0" name="loan_taking_applicant_basic_detail[applicant_permanent_ward]" class="form-control col-md-12" onchange="validateRequired(this,'nameError6')" required>
                            <option disabled selected value>वडा नं चयन गर्नुहोस्</option>
                            @for ($i = 1; $i <= 32; $i++)
                                <option value="{{ $i }}" {{ old('loan_taking_applicant_basic_detail.applicant_permanent_ward') == $i ? 'selected' : '' }}>वडा नं. {{ $i }}</option>
                            @endfor
                        </select>
                        @if ($errors->has('loan_taking_applicant_basic_detail.applicant_permanent_ward'))
                           <div class="alert alert-danger">
                               <ul>
                                   @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_permanent_ward') as $error)
                                   <li>वडा नं चयन गर्नुहोस्</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif   
                    </div>
                </div>
                <span class="application_second_title">हाल बसोबासको ठेगाना:</span>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">प्रदेश <span class="star">*</span></label>
                        <select id="state_id1" name="loan_taking_applicant_basic_detail[applicant_temp_state]"
                        data-iteration="1" class="form-control o_state_id" onchange="validateRequired(this,'nameError7')" required>
                        <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}"
                                {{ old('loan_taking_applicant_basic_detail.applicant_temp_state') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('loan_taking_applicant_basic_detail.applicant_temp_state'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_temp_state') as $error)
                            <li>प्रदेश चयन गर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif   
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">जिल्ला <span class="star">*</span></label>
                    <select id="o_district_id1" data-iteration="1"
                    name="loan_taking_applicant_basic_detail[applicant_temp_district]"
                    class="form-control o_district_id" onchange="validateRequired(this,'nameError8')" required>
                    <option value="">जिल्ला चयन गर्नुहोस् </option>
                    @foreach ($districts as $district)
                        <option value="{{ $district->id }}"
                            {{ old('loan_taking_applicant_basic_detail.applicant_temp_district') == $district->id ? 'selected' : '' }}>
                            {{ $district->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('loan_taking_applicant_basic_detail.applicant_temp_district'))
                           <div class="alert alert-danger">
                               <ul>
                                   @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_temp_district') as $error)
                                   <li>जिल्ला चयन गर्नुहोस् </li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif   
                </div>
            </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">न.पा./गा.पा <span class="star">*</span></label>
                        <select id="o_localbody_id1" data-iteration="1"
                        name="loan_taking_applicant_basic_detail[applicant_temp_local]"
                        class="form-control o_localbody_id" onchange="validateRequired(this,'nameError9')" required>
                        <option value="">स्थानीय तह चयन गर्नुहोस्
                        </option>
                        @foreach ($locals as $localbody)
                            <option value="{{ $localbody->id }}"
                                {{ old('loan_taking_applicant_basic_detail.applicant_temp_local') == $localbody->id ? 'selected' : '' }}>
                                {{ $localbody->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('loan_taking_applicant_basic_detail.applicant_temp_local'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_temp_local') as $error)
                            <li>स्थानीय तह चयन गर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif   
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">वडा नं<span class="star">*</span></label>
                    <select id="a_wada_id" name="loan_taking_applicant_basic_detail[applicant_temp_ward]"
                        class="form-control col-md-12" onchange="validateRequired(this,'nameError10')" required>
                        <option disabled selected value>वडा नं चयन गर्नुहोस्</option>
                        @for ($i = 1; $i <= 32; $i++)
                            <option value="{{ $i }}"
                                {{ old('loan_taking_applicant_basic_detail.applicant_temp_ward') == $i ? 'selected' : '' }}>
                                वडा नं. {{ $i }}</option>
                        @endfor
                    </select>
                    @if ($errors->has('loan_taking_applicant_basic_detail.applicant_temp_ward'))
                           <div class="alert alert-danger">
                               <ul>
                                   @foreach ($errors->get('loan_taking_applicant_basic_detail.applicant_temp_ward') as $error)
                                   <li>वडा नं चयन गर्नुहोस्</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif   
                </div>
            </div>


            <div class="col-4">
                <div class="form-group">
                    <label for="">(PAN) नं</label>

                    <input type="number" value="{{ old('loan_taking_applicant_basic_detail.applicant_pan') }}"
                        id="" name="loan_taking_applicant_basic_detail[applicant_pan]" class="input-text"  pattern="\d+" min="1"
                        autofocus>

                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="occupation">पेशा/व्यवसाय</label>
                    <select id="occupation" name="loan_taking_applicant_basic_detail[applicant_occup]" class="form-control" autofocus>
                        <option disabled selected value>पेशा/व्यवसाय चयन गर्नुहोस्</option>
                        <option value="teacher" {{ old('loan_taking_applicant_basic_detail.applicant_occup') == 'teacher' ? 'selected' : '' }}>शिक्षक</option>
                        <option value="engineer" {{ old('loan_taking_applicant_basic_detail.applicant_occup') == 'engineer' ? 'selected' : '' }}>अभियंता</option>
                        <option value="doctor" {{ old('loan_taking_applicant_basic_detail.applicant_occup') == 'doctor' ? 'selected' : '' }}>डॉक्टर</option>
                        <option value="lawyer" {{ old('loan_taking_applicant_basic_detail.applicant_occup') == 'lawyer' ? 'selected' : '' }}>वकील</option>
                        <option value="business" {{ old('loan_taking_applicant_basic_detail.applicant_occup') == 'business' ? 'selected' : '' }}>व्यवसाय</option>
                        <option value="farmer" {{ old('loan_taking_applicant_basic_detail.applicant_occup') == 'farmer' ? 'selected' : '' }}>किसान</option>
                        <option value="other" {{ old('loan_taking_applicant_basic_detail.applicant_occup') == 'other' ? 'selected' : '' }}>अन्य</option>
                    </select>
                    
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="">शैक्षिक योग्यता</label>
                    <select id="" name="loan_taking_applicant_basic_detail[applicant_edu]" class="form-control">
                        <option disabled selected value>शैक्षिक योग्यता चयन गर्नुहोस्</option>
                        <option
                            {{ old('loan_taking_applicant_basic_detail.applicant_edu') == 'सामान्य लेखपढ' ? 'selected' : '' }}>
                            सामान्य लेखपढ</option>
                        <option
                            {{ old('loan_taking_applicant_basic_detail.applicant_edu') == 'कक्षा ८ सम्म' ? 'selected' : '' }}>
                            कक्षा ८ सम्म</option>
                        <option
                            {{ old('loan_taking_applicant_basic_detail.applicant_edu') == 'कक्षा १० सम्म' ? 'selected' : '' }}>
                            कक्षा १० सम्म</option>
                        <option
                            {{ old('loan_taking_applicant_basic_detail.applicant_edu') == 'कक्षा १२ सम्म' ? 'selected' : '' }}>
                            कक्षा १२ सम्म</option>
                        <option
                            {{ old('loan_taking_applicant_basic_detail.applicant_edu') == 'उच्च शिक्षा' ? 'selected' : '' }}>
                            उच्च शिक्षा</option>
                    </select>
                </div>
            </div>
        </div>

        <hr class="hr-line">

        {{-- BASIC INFROMATION END --}}

        {{-- OPPONENT INFROMATION --}}
        <div class="row">
            <span class="application_main_title">२. विपक्षी (ऋण/कर्जा दिने व्यक्ति) को विवरण:</span>
            <div class="col-6">
                <div class="form-group">
                    <label for="applicant_name">नाम, थर <span class="star">*</span></label>

                    <input type="text" value="{{ old('loan_taking_opponent_detail.opponent_name') }}" id=""
                        name="loan_taking_opponent_detail[opponent_name]" class="input-text" autofocus  maxlength="50" required oninput="validateName(this)">
                        @if ($errors->has('loan_taking_opponent_detail.opponent_name'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_opponent_detail.opponent_name') as $error)
                                <li>नाम, थर भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif   
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="registrations">उमेर</label>

                    <input type="number" value="{{ old('loan_taking_opponent_detail.opponent_age') }}" id=""
                        name="loan_taking_opponent_detail[opponent_age]" class="input-text" autofocus pattern="\d+" min="1">

                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">पिताको नाम, थर</label>

                    <input type="text" value="{{ old('loan_taking_opponent_detail.opponent_fathername') }}"
                        id="" name="loan_taking_opponent_detail[opponent_fathername]" class="input-text"
                        autofocus  maxlength="50" oninput="validateName(this)">

                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="opponent_fathers_no">फोन/मोबाईल नं</label>
                    <input type="number" value="{{ old('loan_taking_opponent_detail.opponent_fathers_no') }}"
                           id="opponent_fathers_no" name="loan_taking_opponent_detail[opponent_fathers_no]"
                           class="input-text" autofocus placeholder="१० अंककाे नंबर"
                           oninput="validatePhoneNumber(this, 'phoneNumberError3')">
                    <span id="phoneNumberError3" style="display: none; color: red;">कृपया १० अंकको सही फोन नंबर प्रविष्ट गर्नुहोस्।</span>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">पति/पत्नीको नाम थर</label>

                    <input type="text" value="{{ old('loan_taking_opponent_detail.opponent_spouse') }}"
                        id="" name="loan_taking_opponent_detail[opponent_spouse]" class="input-text" autofocus  maxlength="50"  oninput="validateName(this)">

                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="opponent_spouse_no">फोन/मोबाईल नं</label>
                    <input type="number" value="{{ old('loan_taking_opponent_detail.opponent_spouse_no') }}"
                           id="opponent_spouse_no" name="loan_taking_opponent_detail[opponent_spouse_no]"
                           class="input-text" autofocus placeholder="१० अंककाे नंबर"
                           oninput="validatePhoneNumber(this, 'phoneNumberError4')">
                    <span id="phoneNumberError4" style="display: none; color: red;">कृपया १० अंकको सही फोन नंबर प्रविष्ट गर्नुहोस्।</span>
                </div>
            </div>


            <span class="application_second_title">स्थायी ठेगाना:</span>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">प्रदेश </label>
                        <select id="state_id3" name="loan_taking_opponent_detail[opponent_permanent_state]"
                        data-iteration="3" class="form-control c_state_id">
                        <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}"
                                {{ old('loan_taking_opponent_detail.opponent_permanent_state') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">जिल्ला </label>
                    <select id="c_district_id3" data-iteration="3"
                        name="loan_taking_opponent_detail[opponent_permanent_district]"
                        class="form-control c_district_id">
                        <option value="">जिल्ला चयन गर्नुहोस्</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}"
                                {{ old('loan_taking_opponent_detail.opponent_permanent_district') == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">न.पा./गा.पा</label>
                    <select id="c_localbody_id3" data-iteration="3"
                        name="loan_taking_opponent_detail[opponent_permanent_local]" class="form-control c_localbody_id">
                        <option value="">स्थानीय तह चयन गर्नुहोस्</option>
                        @foreach ($locals as $localbody)
                            <option value="{{ $localbody->id }}"
                                {{ old('loan_taking_opponent_detail.opponent_permanent_local') == $localbody->id ? 'selected' : '' }}>
                                {{ $localbody->name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">वडा नं</label>
                    <select id="a_wada_id" name="loan_taking_opponent_detail[opponent_permanent_ward]"
                        class="form-control col-md-12">
                        <option disabled selected value>वडा चयन गर्नुहोस्</option>
                        @for ($i = 1; $i <= 32; $i++)
                            <option value="{{ $i }}"
                                {{ old('loan_taking_opponent_detail.opponent_permanent_ward') == $i ? 'selected' : '' }}>
                                वडा नं. {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
                <span class="application_second_title">हाल बसोबासको ठेगाना:</span>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">प्रदेश</label>
                        <select id="state_id5" name="loan_taking_opponent_detail[opponent_temp_state]" data-iteration="5"
                        class="form-control e_state_id">
                        <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}"
                                {{ old('loan_taking_opponent_detail.opponent_temp_state') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">जिल्ला</label>
                        <select id="e_district_id5" data-iteration="5"
                        name="loan_taking_opponent_detail[opponent_temp_district]" class="form-control e_district_id">
                        <option value="">जिल्ला चयन गर्नुहोस्</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}"
                                {{ old('loan_taking_opponent_detail.opponent_temp_district') == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">न.पा./गा.पा</label>
                        <select id="e_localbody_id5" data-iteration="5"
                        name="loan_taking_opponent_detail[opponent_temp_local]" class="form-control e_localbody_id">
                        <option value="">स्थानीय तह चयन गर्नुहोस्
                        </option>
                        @foreach ($locals as $localbody)
                            <option value="{{ $localbody->id }}"
                                {{ old('loan_taking_opponent_detail.opponent_temp_local') == $localbody->id ? 'selected' : '' }}>
                                {{ $localbody->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">वडा नं</label>
                    <select id="a_wada_id" name="loan_taking_opponent_detail[opponent_temp_ward]"
                        class="form-control col-md-12">
                        <option disabled selected value>वडा चयन गर्नुहोस्</option>
                        @for ($i = 1; $i <= 32; $i++)
                            <option value="{{ $i }}"
                                {{ old('loan_taking_opponent_detail.opponent_temp_ward') == $i ? 'selected' : '' }}>वडा नं.
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            {{-- For other details in the basic information --}}

            <div class="col-6">
                <div class="form-group">
                    <label for="occupation">पेशा/व्यवसाय</label>
                    <select id="occupation" name="loan_taking_opponent_detail[opponent_occupation]" class="form-control" autofocus>
                        <option disabled selected value>पेशा/व्यवसाय चयन गर्नुहोस्</option>
                        <option value="teacher" {{ old('loan_taking_opponent_detail.opponent_occupation') == 'teacher' ? 'selected' : '' }}>शिक्षक</option>
                        <option value="engineer" {{ old('loan_taking_opponent_detail.opponent_occupation') == 'engineer' ? 'selected' : '' }}>अभियंता</option>
                        <option value="doctor" {{ old('loan_taking_opponent_detail.opponent_occupation') == 'doctor' ? 'selected' : '' }}>डॉक्टर</option>
                        <option value="lawyer" {{ old('loan_taking_opponent_detail.opponent_occupation') == 'lawyer' ? 'selected' : '' }}>वकील</option>
                        <option value="business" {{ old('loan_taking_opponent_detail.opponent_occupation') == 'business' ? 'selected' : '' }}>व्यवसाय</option>
                        <option value="farmer" {{ old('loan_taking_opponent_detail.opponent_occupation') == 'farmer' ? 'selected' : '' }}>किसान</option>
                        <option value="other" {{ old('loan_taking_opponent_detail.opponent_occupation') == 'other' ? 'selected' : '' }}>अन्य</option>
                    </select>
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="">शैक्षिक योग्यता</label>
                    <select id="" name="loan_taking_opponent_detail[opponent_education_level]"
                        class="form-control">
                        <option disabled selected value>शैक्षिक योग्यता चयन गर्नुहोस्</option>
                        <option
                            {{ old('loan_taking_opponent_detail.opponent_education_level') == 'सामान्य लेखपढ' ? 'selected' : '' }}>
                            सामान्य लेखपढ</option>
                        <option
                            {{ old('loan_taking_opponent_detail.opponent_education_level') == 'कक्षा ८ सम्म' ? 'selected' : '' }}>
                            कक्षा ८ सम्म</option>
                        <option
                            {{ old('loan_taking_opponent_detail.opponent_education_level') == 'कक्षा १० सम्म' ? 'selected' : '' }}>
                            कक्षा १० सम्म</option>
                        <option
                            {{ old('loan_taking_opponent_detail.opponent_education_level') == 'कक्षा १२ सम्म' ? 'selected' : '' }}>
                            कक्षा १२ सम्म</option>
                        <option
                            {{ old('loan_taking_opponent_detail.opponent_education_level') == 'उच्च शिक्षा' ? 'selected' : '' }}>
                            उच्च शिक्षा</option>
                    </select>
                </div>
            </div>

        </div>

        <hr class="hr-line">

        {{-- OPPONENT INFROMATION END --}}

        {{--  LOAN TAKING DETAIL  --}}
        <div class="row">
            <span class="application_main_title">३. ऋण/कर्जा कारोबारको विवरण:</span>

            <div class="col-12">
                <div class="form-group">
                    <label for="marriage_checkbox">क. ऋण लिनुपर्ने कारण/प्रयोजन <span class="star">*</span></label>
                    <div class="listing_checkbox">
                        (अ) विवाह <input type="checkbox" id="marriage_checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="विवाह" {{ in_array('विवाह', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}><br>
                        (आ) शिक्षा <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="शिक्षा" {{ in_array('शिक्षा', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}><br>
                        (इ) उपचार <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="उपचार" {{ in_array('उपचार', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}><br>
                        (ई) वैदेशिक रोजगारमा पठाउन <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="वैदेशिक रोजगारमा पठाउन" {{ in_array('वैदेशिक रोजगारमा पठाउन', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}><br>
                        (उ) अरुको ऋण तिर्न <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="अरुको ऋण तिर्न" {{ in_array('अरुको ऋण तिर्न', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}><br>
                        (ऊ) घर निर्माण/जग्गा खरिद <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="घर निर्माण/जग्गा खरिद" {{ in_array('घर निर्माण/जग्गा खरिद', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}><br>
                        (ऋ) सवारी साधन खरिद <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="सवारी साधन खरिद" {{ in_array('सवारी साधन खरिद', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}><br>
                        (ऌ) अन्य सामाजिक व्यवहार चलाउन <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="अन्य सामाजिक व्यवहार चलाउन" onchange="toggleOtherOptions()" {{ in_array('अन्य सामाजिक व्यवहार चलाउन', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}>
                        <div class="other-options" style="{{ old('loan_taking_loan_detail.loan_purpose[]', []) && in_array('अन्य सामाजिक व्यवहार चलाउन', old('loan_taking_loan_detail.loan_purpose', [])) ? '' : 'display: none;' }}">
                            <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="जन्म" {{ in_array('जन्म', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}>
                            जन्म
                            <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="मृत्यु" {{ in_array('मृत्यु', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}>
                            मृत्यु
                            <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="पासनी" {{ in_array('पासनी', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}>
                            पासनी
                            <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="व्रतवन्ध"  {{ in_array('व्रतवन्ध', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}>
                            व्रतवन्ध
                            <input type="checkbox" name="loan_taking_loan_detail[loan_purpose][]" value="कर्मकाण्ड"  {{ in_array('कर्मकाण्ड', old('loan_taking_loan_detail.loan_purpose', [])) ? 'checked' : '' }}>
                            कर्मकाण्ड
                        </div>
                        @if ($errors->has('loan_taking_loan_detail.loan_purpose'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.loan_purpose') as $error)
                                <li>ऋण लिनुपर्ने कारण/प्रयोजन भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif   
                    </div>
                    <script>
                        function toggleOtherOptions() {
                            var otherCheckbox = document.querySelector('input[value="अन्य सामाजिक व्यवहार चलाउन"]');
                            var otherOptions = document.querySelectorAll('.other-options');

                            otherOptions.forEach(function(option) {
                                option.style.display = otherCheckbox.checked ? 'block' : 'none';
                            });
                        }
                    </script>

                    </p>

                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="loan-datepicker">ख. कर्जा/ऋण कारोबार भएको मिति <span class="star">*</span></label>
                    <input type="text" value="{{ old('loan_taking_loan_detail.loan_date') }}" id="loan-datepicker"
                        name="loan_taking_loan_detail[loan_date]" class="input-text" autofocus required>
                        @if ($errors->has('loan_taking_loan_detail.loan_date'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.loan_date') as $error)
                                <li>कर्जा/ऋण कारोबार भएको मिति भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif   
                </div>
            </div>
            
            <div class="col-4">
                <div class="form-group">
                    <label for="loan_location">ग. कर्जा/ऋण कारोबार भएको स्थान <span class="star">*</span></label>
                    <input type="text" value="{{ old('loan_taking_loan_detail.loan_location') }}" id="loan_location"
                        name="loan_taking_loan_detail[loan_location]" class="input-text" autofocus required>
                        @if ($errors->has('loan_taking_loan_detail.loan_location'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.loan_location') as $error)
                                <li>कर्जा/ऋण कारोबार भएको स्थान भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif   
                </div>
            </div>
            
            <div class="col-4">
                <div class="form-group">
                    <label for="loan_amount">घ. कर्जा/ऋण कारोबार भएको रकम <span class="star">*</span></label>
                    <input type="number" value="{{ old('loan_taking_loan_detail.loan_amount') }}" id="loan_amount"
                        name="loan_taking_loan_detail[loan_amount]" class="input-text" autofocus pattern="\d+" min="1" required>
                        @if ($errors->has('loan_taking_loan_detail.loan_amount'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.loan_amount') as $error)
                                <li>कर्जा/ऋण कारोबार भएको रकम भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif   
                </div>
            </div>
            
            <div class="col-12">
                <div class="form-group">
                    <label for="loan_witness">ङ. कर्जा/ऋण कारोबार हुँदाका बखतका साक्षीहरु <span class="star">*</span></label>
                    <br>
                    <div id="witness-container">
                        <div class="input-group">
                            <input type="text" value="{{ old('loan_taking_loan_detail.loan_witness.0') }}"
                                name="loan_taking_loan_detail[loan_witness][]" class="mb-2" id="loan_witness" autofocus required>
                                @php
                                $loanwitnessErrors = $errors->get('loan_taking_loan_detail.loan_witness.*');
                            @endphp
                            @if ($loanwitnessErrors)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($loanwitnessErrors as $error)
                                            <li>कर्जा/ऋण कारोबार हुँदाका बखतका साक्षीहरु भर्नुहोस्</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <button type="button" onclick="addWitnessField()">+</button>
                </div>
            </div>
            
            <div class="col-6">
                <div class="form-group">
                    <label for="loan_docs">उ. लिखत लेख्ने व्यक्तिको नाम, थर <span class="star">*</span></label>
                    <input type="text" value="{{ old('loan_taking_loan_detail.loan_docs_write') }}" id="loan_docs"
                        name="loan_taking_loan_detail[loan_docs_write]" class="input-text" autofocus maxlength="50" required>
                        @if ($errors->has('loan_taking_loan_detail.loan_docs_write'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.loan_docs_write') as $error)
                                <li>लिखत लेख्ने व्यक्तिको नाम, थर भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif   
                </div>
            </div>
            
            <div class="col-6">
                <div class="form-group">
                    <label for="loan_address">ठेगाना <span class="star">*</span></label>
                    <input type="text" value="{{ old('loan_taking_loan_detail.loan_docs_address') }}" id="loan_address"
                        name="loan_taking_loan_detail[loan_docs_address]" class="input-text" autofocus required>
                        @if ($errors->has('loan_taking_loan_detail.loan_docs_address'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.loan_docs_address') as $error)
                                <li>ठेगाना भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif   
                </div>
            </div>            
        </div>

        <hr class="hr-line">
        {{-- 2nd LTD  --}}
        <div class="row">

            <div class="col-12">

                <div class="form-group">
                    <label class="application_main_title">४. ऋण/कर्जा लिएको माध्यम: <span class="star">*</span></label>

                    <p class="listing_checkbox">
                        (क) नगद <input type="checkbox" value="नगद" id="" name="loan_taking_loan_detail[loan_medium][]" {{ in_array('नगद', old('loan_taking_loan_detail.loan_medium', [])) ? 'checked' : '' }}><br>
                        (ख) चेक <input type="checkbox" value="चेक" id="" name="loan_taking_loan_detail[loan_medium][]" {{ in_array('चेक', old('loan_taking_loan_detail.loan_medium', [])) ? 'checked' : '' }}><br>
                        (ग) जिन्सी <input type="checkbox" value="जिन्सी" id="" name="loan_taking_loan_detail[loan_medium][]" {{ in_array('जिन्सी', old('loan_taking_loan_detail.loan_medium', [])) ? 'checked' : '' }}><br>
                        (घ) चेक र नगद दुवै <input type="checkbox" value="चेक र नगद दुवै" id="" name="loan_taking_loan_detail[loan_medium][]" {{ in_array('चेक र नगद दुवै', old('loan_taking_loan_detail.loan_medium', [])) ? 'checked' : '' }}><br>
                        (ङ) अन्य <input type="checkbox" value="अन्य" id="" name="loan_taking_loan_detail[loan_medium][]" {{ in_array('अन्य', old('loan_taking_loan_detail.loan_medium', [])) ? 'checked' : '' }}>
                    </p>
                    @if ($errors->has('loan_taking_loan_detail.loan_medium'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_loan_detail.loan_medium') as $error)
                            <li>ऋण/कर्जा लिएको माध्यमभर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif   
                </div>

            </div>
        </div>

        <hr class="hr-line">
        {{-- Another Row Ends --}}
        <div class="row" id="loanForm">
            <span class="application_main_title">५. ऋण/कर्जा लिँदाका बखतका विवरण तथा शर्तहरु:<span
                    class="star">*</span></span>
            <div class="col-12">
                <div class="form-group">
                    <label for="">क. कर्जा लिँदा तमसुक/लिखत/सम्झौता </label>

                    <div>
                        <input type="radio" id="loan_docs_yes" name="loan_taking_loan_detail[is_loan_docs]"
                            value="1" {{ old('loan_taking_loan_detail.is_loan_docs') == '1' ? 'checked' : '' }}>
                        <label for="loan_docs_yes">भएको</label>
                    </div>
                    <div>
                        <input type="radio" id="loan_docs_no" name="loan_taking_loan_detail[is_loan_docs]"
                            value="0" {{ old('loan_taking_loan_detail.is_loan_docs') == '0' ? 'checked' : '' }}>
                        <label for="loan_docs_no">नभएको</label>
                    </div>
                    @if ($errors->has('loan_taking_loan_detail.is_loan_docs'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.is_loan_docs') as $error)
                                <li>कर्जा लिँदा तमसुक/लिखत/सम्झौता भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif  

                </div>
            </div>


            <div class="col-12">
                <div class="form-group">
                    <label for="">अ. लेनदेन भएको रकम र तमसुकमा उल्लेख भएको रकम समान</label>

                    <div>
                        <input type="radio" id="loan_same_yes" name="loan_taking_loan_detail[is_loan_same]"
                            value="1" {{ old('loan_taking_loan_detail.is_loan_same') == '1' ? 'checked' : '' }}>
                        <label for="loan_same_yes">भएको</label>
                    </div>
                    <div>
                        <input type="radio" id="loan_same_no" name="loan_taking_loan_detail[is_loan_same]"
                            value="0" {{ old('loan_taking_loan_detail.is_loan_same') == '0' ? 'checked' : '' }}>
                        <label for="loan_same_no">नभएको</label>
                    </div>

                    @if ($errors->has('loan_taking_loan_detail.is_loan_same'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_loan_detail.is_loan_same') as $error)
                            <li>लेनदेन भएको रकम र तमसुकमा उल्लेख भएको रकम समान भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="">आ. लिखत/तमसुकमा उल्लेख भएको रकम</label>

                    <input type="number" value="{{ old('loan_taking_loan_detail.loan_tamasuk_amount') }}"
                        id="" name="loan_taking_loan_detail[loan_tamasuk_amount]" class="input-text" autofocus pattern="\d+" min="1">
                        @if ($errors->has('loan_taking_loan_detail.loan_tamasuk_amount'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.loan_tamasuk_amount') as $error)
                                <li>लिखत/तमसुकमा उल्लेख भएको रकम भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="">इ. ऋण/कर्जा कारोबार भएको वास्तविक रकम</label>

                    <input type="number" value="{{ old('loan_taking_loan_detail.loan_transaction_actual_amount') }}"
                        id="" name="loan_taking_loan_detail[loan_transaction_actual_amount]" class="input-text"
                        autofocus pattern="\d+" min="1">
                        @if ($errors->has('loan_taking_loan_detail.loan_transaction_actual_amount'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.loan_transaction_actual_amount') as $error)
                                <li>ऋण/कर्जा कारोबार भएको वास्तविक रकम भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="">ई. ऋण लिँदा सही छाप मात्र गरी धनिलाई खाली चेक</label>

                    <div>
                        <input type="radio" id="loan_stamp_given" name="loan_taking_loan_detail[is_taken_loan_stamp]"
                            value="1"
                            {{ old('loan_taking_loan_detail.is_taken_loan_stamp') == '1' ? 'checked' : '' }}>
                        <label for="loan_stamp_given">दिएको</label>
                    </div>
                    <div>
                        <input type="radio" id="loan_stamp_not_given"
                            name="loan_taking_loan_detail[is_taken_loan_stamp]" value="0"
                            {{ old('loan_taking_loan_detail.is_taken_loan_stamp') == '0' ? 'checked' : '' }}>
                        <label for="loan_stamp_not_given">नदिएको</label>
                    </div>
                    @if ($errors->has('loan_taking_loan_detail.is_taken_loan_stamp'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_loan_detail.is_taken_loan_stamp') as $error)
                            <li>धनिलाई खाली चेक दिएको/नदिएको भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="">उ. धनी/साहुलाई रकम उल्लेख भएको चेक दिएको भए, चेकमा के कति रकम भरेको हो?</label>

                    <input type="number" value="{{ old('loan_taking_loan_detail.taken_loan_stamp_amount') }}"
                        id="" name="loan_taking_loan_detail[taken_loan_stamp_amount]" class="input-text"
                        autofocus pattern="\d+" min="1">
                        @if ($errors->has('loan_taking_loan_detail.taken_loan_stamp_amount'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.taken_loan_stamp_amount') as $error)
                                <li>चेकमा दिएको रकम भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="">ऊ. लिखत/तमसुक परिवर्तन</label>

                    <div>
                        <input type="radio" id="written_tamsuk_changed_yes"
                            name="loan_taking_loan_detail[is_written_tamsuk_changed]" value="1"
                            {{ old('loan_taking_loan_detail.is_written_tamsuk_changed') == '1' ? 'checked' : '' }}>
                        <label for="written_tamsuk_changed_yes">गरेको</label>
                    </div>
                    <div>
                        <input type="radio" id="written_tamsuk_changed_no"
                            name="loan_taking_loan_detail[is_written_tamsuk_changed]" value="0"
                            {{ old('loan_taking_loan_detail.is_written_tamsuk_changed') == '0' ? 'checked' : '' }}>
                        <label for="written_tamsuk_changed_no">नगरेको</label>
                    </div>
                    @if ($errors->has('loan_taking_loan_detail.is_written_tamsuk_changed'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_loan_detail.is_written_tamsuk_changed') as $error)
                            <li>लिखत/तमसुक परिवर्तन गरेको/नगरेको भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>


            <span class="application_second_title">ख. जग्गा राजिनामा पारीत गरी दिई ऋण/कर्जा लिएको सम्बन्धमा: </span>

            <div class="col-12">
                <div class="form-group">
                    <label for="">अ. जग्गा फिर्ता गर्ने शर्त राखिएको</label>

                    <div>
                        <input type="radio" id="land_return_promise_kept"
                            name="loan_taking_loan_detail[is_land_return_promise]" value="1"
                            {{ old('loan_taking_loan_detail.is_land_return_promise') == '1' ? 'checked' : '' }}>
                        <label for="land_return_promise_kept">थियो</label>
                    </div>
                    <div>
                        <input type="radio" id="land_return_promise_not_kept"
                            name="loan_taking_loan_detail[is_land_return_promise]" value="0"
                            {{ old('loan_taking_loan_detail.is_land_return_promise') == '0' ? 'checked' : '' }}>
                        <label for="land_return_promise_not_kept">थिएन</label>
                    </div>
                    @if ($errors->has('loan_taking_loan_detail.is_land_return_promise'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_loan_detail.is_land_return_promise') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>


            <div class="col-12">
                <div class="form-group">
                    <label for="">आ. कुनै अर्को शर्त राखेर अर्को लिखत/तमसुक खडा गरिएको</label>

                    <div>
                        <input type="radio" id="other_return_promise_yes"
                            name="loan_taking_loan_detail[is_other_return_promise]" value="1"
                            {{ old('loan_taking_loan_detail.is_other_return_promise') == '1' ? 'checked' : '' }}>
                        <label for="other_return_promise_yes">थियो</label>
                    </div>
                    <div>
                        <input type="radio" id="other_return_promise_no"
                            name="loan_taking_loan_detail[is_other_return_promise]" value="0"
                            {{ old('loan_taking_loan_detail.is_other_return_promise') == '0' ? 'checked' : '' }}>
                        <label for="other_return_promise_no">थिएन</label>
                    </div>
                    @if ($errors->has('loan_taking_loan_detail.is_other_return_promise'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_loan_detail.is_other_return_promise') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>


            <div class="col-12">
                <div class="form-group">
                    <label for="">ग. हाल सो जग्गाको भोग कसले गरिरहेको छ?</label>
                    <select id="select-type" name="loan_taking_loan_detail[land_rights_possessed_by_whome]"
                        onchange="toggleInput()">
                        <option disabled selected value>चयन गर्नुहोस्</option>
                        <option value="निवेदक"
                            {{ old('loan_taking_loan_detail.land_rights_possessed_by_whome') == 'निवेदक' ? 'selected' : '' }}>
                            निवेदक</option>
                        <option value="विपक्षी"
                            {{ old('loan_taking_loan_detail.land_rights_possessed_by_whome') == 'विपक्षी' ? 'selected' : '' }}>
                            विपक्षी</option>
                        <option value="अन्य व्यक्ति"
                            {{ old('loan_taking_loan_detail.land_rights_possessed_by_whome') == 'अन्य व्यक्ति' ? 'selected' : '' }}>
                            अन्य व्यक्ति</option>
                    </select>
                    @if ($errors->has('loan_taking_loan_detail.land_rights_possessed_by_whome'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_loan_detail.land_rights_possessed_by_whome') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>
            <div class="col-6" id="other-person-details" style="display: none;">
                <div class="form-group">
                    <label for="">अन्य व्यक्ति भए निजको नाम, थर</label>
                    <input type="text" value="{{ old('loan_taking_loan_detail.land_used_by_name') }}"
                        name="loan_taking_loan_detail[land_used_by_name]" class="input-text" autofocus  maxlength="50"  oninput="validateName(this)">
                </div>
            </div>
            <div class="col-6" id="other-person-address" style="display: none;">
                <div class="form-group">
                    <label for="">ठेगाना</label>
                    <input type="text" value="{{ old('loan_taking_loan_detail.land_used_by_address') }}"
                        name="loan_taking_loan_detail[land_used_by_address]" class="input-text" autofocus>
                </div>
            </div>
            <script>
                function toggleInput() {
                    var selectType = document.getElementById('select-type');
                    var otherPersonDetails = document.getElementById('other-person-details');
                    var otherPersonAddress = document.getElementById('other-person-address');
                    if (selectType.value === 'अन्य व्यक्ति') {
                        otherPersonDetails.style.display = 'block';
                        otherPersonAddress.style.display = 'block';
                    } else {
                        otherPersonDetails.style.display = 'none';
                        otherPersonAddress.style.display = 'none';
                    }
                }
                // Call toggleInput on page load in case the form is reloaded with old values
                document.addEventListener('DOMContentLoaded', function() {
                    toggleInput();
                });
            </script>


            <div class="row">
                <span class="application_second_title">घ. जग्गा दृष्टिबन्धक गरी पारित गरिदिई ऋण/कर्जा लिएकोमा: </span>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">(अ) जग्गा दृष्टिबन्धक लिखत गर्दा अन्य केही शर्त राखिएको <span
                                class="star">*</span></label>
                        <div>
                            <input type="radio" id="land_stop_promise_yes"
                                name="loan_taking_loan_detail[is_land_stop_promise]" value="1"
                                {{ old('loan_taking_loan_detail.is_land_stop_promise') == '1' ? 'checked' : '' }}
                                onclick="showTextarea1()">
                            <label for="land_stop_promise_yes">थियो</label>
                        </div>
                        <div>
                            <input type="radio" id="land_stop_promise_no"
                                name="loan_taking_loan_detail[is_land_stop_promise]" value="0"
                                {{ old('loan_taking_loan_detail.is_land_stop_promise') == '0' ? 'checked' : '' }}
                                onclick="hideTextarea1()">
                            <label for="land_stop_promise_no">थिएन</label>
                        </div>
                        @if ($errors->has('loan_taking_loan_detail.is_land_stop_promise'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.is_land_stop_promise') as $error)
                                <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                    </div>
                </div>

                <div class="col-12" id="textareaContainer1" style="display: none;">
                    <div class="form-group">
                        <label for="">(आ) शर्त राखिएको भए के शर्त राखिएको थियो?</label>
                        <textarea name="loan_taking_loan_detail[land_stop_promise_state]" class="input-text" autofocus>{{ old('loan_taking_loan_detail.land_stop_promise_state') }}</textarea>
                    </div>
                </div>
            </div>

            <script>
                function showTextarea1() {
                    document.getElementById('textareaContainer1').style.display = 'block';
                }

                function hideTextarea1() {
                    document.getElementById('textareaContainer1').style.display = 'none';
                }
            </script>


            <div class="col-12">
                <div class="form-group">
                    <label for="">(इ) उक्त दृष्टिबन्धक राखिएको जग्गाको भोग चलन कसले गरिरहेको छ</label>
                    <select id="select-type2" onchange="toggleInput2()"
                        name="loan_taking_loan_detail[land_stop_promise_who_name]">
                        <option disabled selected value>चयन गर्नुहोस्</option>
                        <option value="निवेदक"
                            {{ old('loan_taking_loan_detail.land_stop_promise_who_name') == 'निवेदक' ? 'selected' : '' }}>
                            निवेदक</option>
                        <option value="विपक्षी"
                            {{ old('loan_taking_loan_detail.land_stop_promise_who_name') == 'विपक्षी' ? 'selected' : '' }}>
                            विपक्षी</option>
                        <option value="अन्य व्यक्ति"
                            {{ old('loan_taking_loan_detail.land_stop_promise_who_name') == 'अन्य व्यक्ति' ? 'selected' : '' }}>
                            अन्य व्यक्ति</option>
                    </select>
                    @if ($errors->has('loan_taking_loan_detail.land_stop_promise_who_name'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_loan_detail.land_stop_promise_who_name') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>

            <div class="col-6" id="other-person-details2" style="display: none;">
                <div class="form-group">
                    <label for="">अन्य व्यक्ति भए निजको नाम, थर</label>
                    <input type="" value="{{ old('loan_taking_loan_detail.land_stop_promise_used_by_name') }}"
                        id="" name="loan_taking_loan_detail[land_stop_promise_used_by_name]" class="input-text"
                        autofocus  maxlength="50"  oninput="validateName(this)">
                </div>
            </div>
            <div class="col-6" id="other-person-address2" style="display: none;">
                <div class="form-group">
                    <label for="">ठेगाना</label>
                    <input type="" value="{{ old('loan_taking_loan_detail.land_stop_promise_used_by_address') }}"
                        id="" name="loan_taking_loan_detail[land_stop_promise_used_by_address]"
                        class="input-text" autofocus>
                </div>
            </div>

            <script>
                function toggleInput2() {
                    var selectType = document.getElementById('select-type2');
                    var otherPersonDetails = document.getElementById('other-person-details2');
                    var otherPersonAddress = document.getElementById('other-person-address2');
                    if (selectType.value === 'अन्य व्यक्ति') {
                        otherPersonDetails.style.display = 'block';
                        otherPersonAddress.style.display = 'block';
                    } else {
                        otherPersonDetails.style.display = 'none';
                        otherPersonAddress.style.display = 'none';
                    }
                }

                // Define a callback function
                function onPageLoad() {
                    toggleInput2();
                }

                // Call the callback function on page load
                document.addEventListener('DOMContentLoaded', onPageLoad);

                // Optionally, if you want to call toggleInput2() every time the dropdown value changes
                document.getElementById('select-type2').addEventListener('change', toggleInput2);
            </script>

            <div class="row">
                <span class="application_second_title">ङ. तमसुक/शर्तनामामा जमानी राखेको भए:</span>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">क. जमानी बस्नेको कुनै शर्त</label>
                        <div>
                            <input type="radio" id="witness_any_promise_yes"
                                name="loan_taking_loan_detail[is_witness_any_promise]" value="1"
                                onclick="showTextarea2()"
                                {{ old('loan_taking_loan_detail.is_witness_any_promise') == '1' ? 'checked' : '' }}>
                            <label for="witness_any_promise_yes">थियो</label>
                        </div>
                        <div>
                            <input type="radio" id="witness_any_promise_no"
                                name="loan_taking_loan_detail[is_witness_any_promise]" value="0"
                                onclick="hideTextarea2()"
                                {{ old('loan_taking_loan_detail.is_witness_any_promise') == '0' ? 'checked' : '' }}>
                            <label for="witness_any_promise_no">थिएन</label>
                        </div>
                        @if ($errors->has('loan_taking_loan_detail.is_witness_any_promise'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_loan_detail.is_witness_any_promise') as $error)
                                <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                    </div>
                </div>
                <div class="col-12" id="textareaContainer2" style="display: none;">
                    <div class="form-group">
                        <label for="">ख. शर्त थियो भने के थियो?</label>
                            <textarea name="loan_taking_loan_detail[witness_any_promise_state]" class="input-text" autofocus>{{ old('loan_taking_loan_detail.witness_any_promise_state') }}</textarea>
                    </div>
                </div>
            </div>

            <script>
                function showTextarea2() {
                    document.getElementById('textareaContainer2').style.display = 'block';
                }

                function hideTextarea2() {
                    document.getElementById('textareaContainer2').style.display = 'none';
                }
            </script>
        </div>


        <hr class="hr-line">
        {{-- 2nd LTD --}}


        {{--  LOAN TAKING DETAIL END  --}}

        {{-- Interest Detail Start --}}
        <span class="application_main_title">६. लिखत/तमसुकमा उल्लेख भएको मुलधन र ब्याज सम्बन्धमा <span
                class="star">*</span></span>
        <div class="col-12">
            <div class="form-group">
                <label for="">क. लिखत/तमसुकमा उल्लेख भएको ब्याजदर प्रतिशत </label>

                <input type="number" value="{{ old('loan_taking_interest_detail.written_docs_interest_rate') }}"
                    id="" name="loan_taking_interest_detail[written_docs_interest_rate]" class="input-text"
                    autofocus  min="1" >
                    @if ($errors->has('loan_taking_interest_detail.written_docs_interest_rate'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_interest_detail.written_docs_interest_rate') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="">ख. बुझाउने/बुझाएको ब्याजदर प्रतिशत</label>

                <input type="number" value="{{ old('loan_taking_interest_detail.written_docs_given_interest_rate') }}"
                    id="" name="loan_taking_interest_detail[written_docs_given_interest_rate]"
                    class="input-text" autofocus  min="1">
                    @if ($errors->has('loan_taking_interest_detail.written_docs_given_interest_rate'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_interest_detail.written_docs_given_interest_rate') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="">ग. हाल सम्म बुझाएको ब्याज रकम </label>

                <input type="number" value="{{ old('loan_taking_interest_detail.till_now_interest_amount') }}"
                    id="" name="loan_taking_interest_detail[till_now_interest_amount]" class="input-text"
                    autofocus pattern="\d+" min="1">
                    @if ($errors->has('loan_taking_interest_detail.till_now_interest_amount'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_interest_detail.till_now_interest_amount') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">घ. ब्याज बुझाएको माध्यम</label>
                <p class="listing_checkbox">
                    (क) नगद <input type="checkbox" value="नगद" id="" name="loan_taking_interest_detail[interest_paid_medium][]" {{ in_array('नगद', old('loan_taking_interest_detail.interest_paid_medium', [])) ? 'checked' : '' }}><br>
                    (ख) चेक <input type="checkbox" value="चेक" id="" name="loan_taking_interest_detail[interest_paid_medium][]" {{ in_array('चेक', old('loan_taking_interest_detail.interest_paid_medium', [])) ? 'checked' : '' }}><br>
                    (ग) जिन्सी <input type="checkbox" value="जिन्सी" id="" name="loan_taking_interest_detail[interest_paid_medium][]" {{ in_array('जिन्सी', old('loan_taking_interest_detail.interest_paid_medium', [])) ? 'checked' : '' }}><br>
                    (घ) चेक र नगद दुवै <input type="checkbox" value="चेक र नगद दुवै" id="" name="loan_taking_interest_detail[interest_paid_medium][]" {{ in_array('चेक र नगद दुवै', old('loan_taking_interest_detail.interest_paid_medium', [])) ? 'checked' : '' }}><br>
                    (ङ) अन्य <input type="checkbox" value="अन्य" id="" name="loan_taking_interest_detail[interest_paid_medium][]" {{ in_array('अन्य', old('loan_taking_interest_detail.interest_paid_medium', [])) ? 'checked' : '' }}>

                </p>
                @if ($errors->has('loan_taking_interest_detail.interest_paid_medium'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('loan_taking_interest_detail.interest_paid_medium') as $error)
                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="">ङ. हालसम्म बुझाएको मूल धन वापतको रकम </label>

                <input type="number" value="{{ old('loan_taking_interest_detail.till_now_paid_capital') }}"
                    id="" name="loan_taking_interest_detail[till_now_paid_capital]" class="input-text"
                    autofocus pattern="\d+" min="1">
                    @if ($errors->has('loan_taking_interest_detail.till_now_paid_capital'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_interest_detail.till_now_paid_capital') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="">च. बुझाउन बाँकी रकम</label>

                <input type="number" value="{{ old('loan_taking_interest_detail.till_now_to_be_paid_amount') }}"
                    id="" name="loan_taking_interest_detail[till_now_to_be_paid_amount]" class="input-text"
                    autofocus pattern="\d+" min="1">
                    @if ($errors->has('loan_taking_interest_detail.till_now_to_be_paid_amount'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_interest_detail.till_now_to_be_paid_amount') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="">छ. वडा कार्यालयमा लिखत दर्ता</label>
                <div>
                    <input type="radio" id="is_registered_inward_yes"
                        name="loan_taking_interest_detail[is_registered_inward]" value="1"
                        onclick="showRegisteredNoField()"
                        {{ old('loan_taking_interest_detail.is_registered_inward') == '1' ? 'checked' : '' }}>
                    <label for="is_registered_inward_yes">भएको</label>
                </div>
                <div>
                    <input type="radio" id="is_registered_inward_no"
                        name="loan_taking_interest_detail[is_registered_inward]" value="0"
                        onclick="hideRegisteredNoField()"
                        {{ old('loan_taking_interest_detail.is_registered_inward') == '0' ? 'checked' : '' }}>
                    <label for="is_registered_inward_no">नभएको</label>
                </div>
                @if ($errors->has('loan_taking_interest_detail.is_registered_inward'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('loan_taking_interest_detail.is_registered_inward') as $error)
                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
            </div>
        </div>

        <div class="col-6" id="registered_no_field" style="display: none;">
            <div class="form-group">
                <label for="">भएको भए दर्ता नं.</label>
                <input type="number" value="{{ old('loan_taking_interest_detail.registered_no') }}" id="registered_no"
                    name="loan_taking_interest_detail[registered_no]" class="input-text" autofocus pattern="\d+" min="1">
            </div>
        </div>

        <script>
            function showRegisteredNoField() {
                document.getElementById('registered_no_field').style.display = 'block';
            }

            function hideRegisteredNoField() {
                document.getElementById('registered_no_field').style.display = 'none';
            }
        </script>


        <hr class="hr-line">
        {{-- Row ends --}}
        <div class="row">

            <div class="col-12">
                <div class="form-group">
                    <label class="application_main_title" for="payment-datepicker">७. तमसुक/लिखित अनुसार ऋण/कर्जा सावाँ
                        ब्याज बुझाउने अन्तिम म्याद (भाखा)<span class="star">*</span></label>

                    <input type="" value="{{ old('loan_taking_interest_detail.loan_amount_pay_last_date') }}"
                        id="payment-datepicker" name="loan_taking_interest_detail[loan_amount_pay_last_date]"
                        class="input-text" autofocus>
                        @if ($errors->has('loan_taking_interest_detail.loan_amount_pay_last_date'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_interest_detail.loan_amount_pay_last_date') as $error)
                                <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                </div>
            </div>
        </div>


        <hr class="hr-line">
        {{-- Row ends --}}



        {{-- Interest Detail End --}}



        {{-- COURT DETAIL --}}
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="application_main_title" for="">८. ऋण/कर्जा कारोवारको सम्बन्धमा अदालतमा मुद्दा
                        परेको <span class="star">*</span></label>
                    <div>
                        <input type="radio" id="issue_in_court_yes" name="loan_taking_court_detail[is_issue_in_court]"
                            value="1" onclick="toggleCourtFields(true)"
                            {{ old('loan_taking_court_detail.is_issue_in_court') == '1' ? 'checked' : '' }} checked>
                        <label for="issue_in_court_yes">छ </label>
                    </div>
                    <div>
                        <input type="radio" id="issue_in_court_no" name="loan_taking_court_detail[is_issue_in_court]"
                            value="0" onclick="toggleCourtFields(false)"
                            {{ old('loan_taking_court_detail.is_issue_in_court') == '0' ? 'checked' : '' }}>
                        <label for="issue_in_court_no">छैन</label>
                    </div>
                    @if ($errors->has('loan_taking_court_detail.is_issue_in_court'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_court_detail.is_issue_in_court') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>

            <div class="col-12" id="courtCaseFields">

                <div class="form-group">
                    <label for="">क. अदालतमा मुद्दा दायर भएको भए:</label>
                    <select name="loan_taking_court_detail[issue_in_court_result]">
                        <option disabled selected value>अवस्था चयन गर्नुहोस्</option>
                        <option value="विचाराधीन अवस्थामा रहेको"
                            {{ old('loan_taking_court_detail.issue_in_court_result') == 'विचाराधीन अवस्थामा रहेको' ? 'selected' : '' }}>
                            मुद्दा विचाराधीन अवस्थामा रहेको</option>
                        <option value="फैसला भई फैसला कार्यान्वयन हुन बाँकी रहेको"
                            {{ old('loan_taking_court_detail.issue_in_court_result') == 'फैसला भई फैसला कार्यान्वयन हुन बाँकी रहेको' ? 'selected' : '' }}>
                            फैसला भई फैसला कार्यान्वयन हुन बाँकी रहेको</option>
                        <option value="फैसला भई फैसला कार्यान्वयन भई सकेको।"
                            {{ old('loan_taking_court_detail.issue_in_court_result') == 'फैसला भई फैसला कार्यान्वयन भई सकेको।' ? 'selected' : '' }}>
                            फैसला भई फैसला कार्यान्वयन भई सकेको।</option>
                    </select>
                    @if ($errors->has('loan_taking_court_detail.issue_in_court_result'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_court_detail.issue_in_court_result') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>

            <div class="col-6" id="courtCaseFields1">
                <div class="form-group">
                    <label for="">ख. मुद्दाको विषय</label>
                    <input type="text" value="{{ old('loan_taking_court_detail.issue_in_court_subject') }}"
                        name="loan_taking_court_detail[issue_in_court_subject]" class="input-text" autofocus>
                        @if ($errors->has('loan_taking_court_detail.issue_in_court_subject'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_court_detail.issue_in_court_subject') as $error)
                                <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                </div>
            </div>

            <div class="col-6" id="courtCaseFields2">
                <div class="form-group">
                    <label for="">मुद्दा नं</label>
                    <input type="number" value="{{ old('loan_taking_court_detail.issue_in_court_subject_no') }}"
                        name="loan_taking_court_detail[issue_in_court_subject_no]" class="input-text" autofocus pattern="\d+" min="1">
                        @if ($errors->has('loan_taking_court_detail.issue_in_court_subject_no'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('loan_taking_court_detail.issue_in_court_subject_no') as $error)
                                <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" id="courtCaseFields3">
                    <span class="application_main_title">९. अदालतको फैसलाको अवस्था:<span class="star">*</span></span>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">क. फैसला बमोजिम भरीभराउ भई पीडितको अचल सम्पत्ति डाँक लिलाम</label>
                            <div>
                                <input type="radio" id="issue_in_court_applicant_asset_collapse_yes"
                                    name="loan_taking_court_detail[is_issue_in_court_applicant_asset_collapse]"
                                    value="1"
                                    {{ old('loan_taking_court_detail.is_issue_in_court_applicant_asset_collapse') == '1' ? 'checked' : '' }}>
                                <label for="issue_in_court_applicant_asset_collapse_yes">भएको</label>
                            </div>
                            <div>
                                <input type="radio" id="issue_in_court_applicant_asset_collapse_no"
                                    name="loan_taking_court_detail[is_issue_in_court_applicant_asset_collapse]"
                                    value="0"
                                    {{ old('loan_taking_court_detail.is_issue_in_court_applicant_asset_collapse') == '0' ? 'checked' : '' }}>
                                <label for="issue_in_court_applicant_asset_collapse_no">नभएको</label>
                            </div>
                            @if ($errors->has('loan_taking_court_detail.is_issue_in_court_applicant_asset_collapse'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_court_detail.is_issue_in_court_applicant_asset_collapse') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">ख. डाँक लिलाममा उक्त अचल सम्पत्ति कसले सकार गरेको हो? </label>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">नाम, थर</label>
                                    <input type="text"
                                        value="{{ old('loan_taking_court_detail.applicant_collapse_by_who_name') }}"
                                        name="loan_taking_court_detail[applicant_collapse_by_who_name]" class="input-text"
                                        autofocus  maxlength="50" oninput="validateName(this)">
                                        @if ($errors->has('loan_taking_court_detail.applicant_collapse_by_who_name'))
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->get('loan_taking_court_detail.applicant_collapse_by_who_name') as $error)
                                                <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif 
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="">ठेगाना</label>
                                    <input type="text"
                                        value="{{ old('loan_taking_court_detail.applicant_collapse_by_who_address') }}"
                                        name="loan_taking_court_detail[applicant_collapse_by_who_address]"
                                        class="input-text" autofocus>
                                        @if ($errors->has('loan_taking_court_detail.applicant_collapse_by_who_address'))
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->get('loan_taking_court_detail.applicant_collapse_by_who_address') as $error)
                                                <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif 
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="">ग. फैसला बमोजिम रकम असुल उपर गर्न सम्पत्ति नभएकोले थुनामा राखी
                                        पाऊ भन्ने निवेदन</label>
                                    <div>
                                        <input type="radio" id="application_decision_jailtime_yes"
                                            name="loan_taking_court_detail[is_application_decision_jailtime]"
                                            value="1"
                                            {{ old('loan_taking_court_detail.is_application_decision_jailtime') == '1' ? 'checked' : '' }}>
                                        <label for="application_decision_jailtime_yes">परेको</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="application_decision_jailtime_no"
                                            name="loan_taking_court_detail[is_application_decision_jailtime]"
                                            value="0"
                                            {{ old('loan_taking_court_detail.is_application_decision_jailtime') == '0' ? 'checked' : '' }}>
                                        <label for="application_decision_jailtime_no">नपरेको</label>
                                    </div>
                                    @if ($errors->has('loan_taking_court_detail.is_application_decision_jailtime'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->get('loan_taking_court_detail.is_application_decision_jailtime') as $error)
                                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif 
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="">घ. थुनामा राख्ने आदेश </label>
                                    <div>
                                        <input type="radio" id="jail_subjected_yes"
                                            name="loan_taking_court_detail[is_jail_subjected]" value="1"
                                            onclick="toggleJailFields(true)"
                                            {{ old('loan_taking_court_detail.is_jail_subjected') == '1' ? 'checked' : '' }}>
                                        <label for="jail_subjected_yes">भएको</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="jail_subjected_no"
                                            name="loan_taking_court_detail[is_jail_subjected]" value="0"
                                            onclick="toggleJailFields(false)"
                                            {{ old('loan_taking_court_detail.is_jail_subjected') == '0' ? 'checked' : '' }}>
                                        <label for="jail_subjected_no">नभएको</label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group" id="jailFields">
                                        <label for="jail-datepicker">ङ. थुनामा गैसकेको भए थुनामा गएको मिति</label>
                                        <input type="text"
                                            value="{{ old('loan_taking_court_detail.if_in_jail_start_date') }}"
                                            id="jail-datepicker" name="loan_taking_court_detail[if_in_jail_start_date]"
                                            class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group" id="jailDurationFields">
                                        <label for="">र थुनामा बस्नुपर्ने अवधि</label>
                                        <input type="text"
                                            value="{{ old('loan_taking_court_detail.if_in_jail_start_duration') }}"
                                            id="" name="loan_taking_court_detail[if_in_jail_start_duration]"
                                            class="form-control" autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function toggleCourtFields(show) {
                document.getElementById('courtCaseFields').style.display = show ? 'block' : 'none';
                document.getElementById('courtCaseFields1').style.display = show ? 'block' : 'none';
                document.getElementById('courtCaseFields2').style.display = show ? 'block' : 'none';
                document.getElementById('courtCaseFields3').style.display = show ? 'block' : 'none';
            }

            function toggleJailFields(show) {
                document.getElementById('jailFields').style.display = show ? 'block' : 'none';
                document.getElementById('jailDurationFields').style.display = show ? 'block' : 'none';
            }

            // Set initial visibility based on radio buttons
            document.addEventListener('DOMContentLoaded', function() {
                const issueInCourtYes = document.getElementById('issue_in_court_yes').checked;
                toggleCourtFields(issueInCourtYes);

                const jailSubjectedYes = document.getElementById('jail_subjected_yes').checked;
                toggleJailFields(jailSubjectedYes);
            });
        </script>

        <hr class="hr-line">
        {{-- Row ends --}}
        <div class="row">

            <div class="col-12">
                <div class="form-group">
                    <label class="application_main_title" for="">१०. ऋणी उपर चेक बाउन्स सम्बन्धी मुद्दा <span
                            class="star">*</span></label>

                    <div>
                        <input type="radio" id="cheque_bounce_case_yes"
                            name="loan_taking_court_detail[is_cheque_bounce_case]" value="1"
                            {{ old('loan_taking_court_detail.is_cheque_bounce_case') == '1' ? 'checked' : '' }}
                            onclick="showChequeBounceCaseFields()">
                        <label for="cheque_bounce_case_yes">भएको</label>
                    </div>
                    <div>
                        <input type="radio" id="cheque_bounce_case_no"
                            name="loan_taking_court_detail[is_cheque_bounce_case]" value="0"
                            {{ old('loan_taking_court_detail.is_cheque_bounce_case') == '0' ? 'checked' : '' }}
                            onclick="hideChequeBounceCaseFields()">
                        <label for="cheque_bounce_case_no">नभएको</label>
                    </div>
                    @if ($errors->has('loan_taking_court_detail.is_cheque_bounce_case'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_court_detail.is_cheque_bounce_case') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>

            <div class="col-12" id="cheque_bounce_case_result_field" style="display: none;">
                <div class="form-group">
                    <label for="">भएको भए त्यो मुद्दाको अवस्था</label>

                    <select name="loan_taking_court_detail[cheque_bounce_case_result]" id="select-type3"
                        onchange="toggleInput2()">
                        <option disabled selected value>अवस्था चयन गर्नुहोस्</option>
                        <option value="विचाराधीन अवस्थामा रहेको"
                            {{ old('loan_taking_court_detail.cheque_bounce_case_result') == 'विचाराधीन अवस्थामा रहेको' ? 'selected' : '' }}>
                            विचाराधीन अवस्थामा रहेको</option>
                        <option value="विगो भराउने र जरिवाना मात्र भएको"
                            {{ old('loan_taking_court_detail.cheque_bounce_case_result') == 'विगो भराउने र जरिवाना मात्र भएको' ? 'selected' : '' }}>
                            विगो भराउने र जरिवाना मात्र भएको</option>
                        <option value="फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको छ"
                            {{ old('loan_taking_court_detail.cheque_bounce_case_result') == 'फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको छ' ? 'selected' : '' }}>
                            फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको छ</option>
                        <option value="फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको छैन"
                            {{ old('loan_taking_court_detail.cheque_bounce_case_result') == 'फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको छैन' ? 'selected' : '' }}>
                            फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको छैन</option>
                        <option value="सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला भएको"
                            {{ old('loan_taking_court_detail.cheque_bounce_case_result') == 'सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला भएको' ? 'selected' : '' }}>
                            सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला भएको</option>
                        <option value="सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला नभएको"
                            {{ old('loan_taking_court_detail.cheque_bounce_case_result') == 'सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला नभएको' ? 'selected' : '' }}>
                            सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला नभएको</option>
                        {{-- <option>फैसला भएको भए कार्यान्वयनको अवस्था</option> --}}
                    </select>
                    @if ($errors->has('loan_taking_court_detail.cheque_bounce_case_result'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_court_detail.cheque_bounce_case_result') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>

           
           
                <div class="col-4" id="result_bigo" style="display: none;">
                    <div class="form-group">
                       
                        <label>सो फैसला भएको भए बिगो</label>
                        <input type="number" value="{{ old('loan_taking_court_detail.case_result_bigo') }}"
                            id="" name="loan_taking_court_detail[case_result_bigo]" class="input-text"autofocus pattern="\d+" min="1">
                    </div>
                </div>
                <div class="col-4" id="result_fine" style="display: none;">
                    <div class="form-group">
                        <label>जरिवाना</label>
                        <input type="number" value="{{ old('loan_taking_court_detail.case_result_fine') }}"
                            id="" name="loan_taking_court_detail[case_result_fine]"
                            class="input-text"autofocus pattern="\d+" min="1">
                    </div>
                </div>
                <div class="col-4" id="result_jail" style="display: none;">
                    <div class="form-group">
                        <label>कैद</label>
                        <input type="number" value="{{ old('loan_taking_court_detail.case_result_jail') }}"
                            id="" name="loan_taking_court_detail[case_result_jail]"
                            class="input-text"autofocus pattern="\d+" min="1">
                    </div>
                </div>
            
     
        <script>
            function toggleInput2() {
                var selectType = document.getElementById('select-type3');
                var resultBigo = document.getElementById('result_bigo');
                var resultFine = document.getElementById('result_fine');
                var resultJail = document.getElementById('result_jail');
                if (selectType.value === 'फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको छ') {
                    resultBigo.style.display = 'block';
                    resultFine.style.display = 'block';
                    resultJail.style.display = 'block';
                } else {
                    resultBigo.style.display = 'none';
                    resultFine.style.display = 'none';
                    resultJail.style.display = 'none';
                }
            }
            // Call toggleInput2 on page load in case the form is reloaded with old values
            document.addEventListener('DOMContentLoaded', function() {
                toggleInput2();
            });
        </script>



        <div class="col-12" id="bank_cheque_case_resulted_field" style="display: none;">
            <div class="form-group">
                <label for="">फैसला भएको भए कार्यान्वयनको अवस्था</label>

                <input type="" value="{{ old('loan_taking_court_detail.if_bank_cheque_case_resulted') }}"
                    id="" name="loan_taking_court_detail[if_bank_cheque_case_resulted]" class="input-text"
                    autofocus>
                    @if ($errors->has('loan_taking_court_detail.if_bank_cheque_case_resulted'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_court_detail.if_bank_cheque_case_resulted') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
            </div>
        </div>
        </div>

        <script>
            function showChequeBounceCaseFields() {
                var chequeBounceCaseField = document.getElementById('cheque_bounce_case_result_field');
                var bankChequeCaseResultedField = document.getElementById('bank_cheque_case_resulted_field');
                chequeBounceCaseField.style.display = 'block';
                bankChequeCaseResultedField.style.display = 'block';
            }

            function hideChequeBounceCaseFields() {
                var chequeBounceCaseField = document.getElementById('cheque_bounce_case_result_field');
                var bankChequeCaseResultedField = document.getElementById('bank_cheque_case_resulted_field');
                var resultBigo = document.getElementById('result_bigo');
                var resultFine = document.getElementById('result_fine');
                var resultJail = document.getElementById('result_jail');
                chequeBounceCaseField.style.display = 'none';
                bankChequeCaseResultedField.style.display = 'none';
                resultBigo.style.display = 'none';
                resultFine.style.display = 'none';
                resultJail.style.display = 'none';
            }
        </script>

        <hr class="hr-line">
        {{-- COURT DETAIL END --}}



        {{-- Additional Detail  --}}

        {{-- For ANother ROw --}}
        <div class="row">
            <span class="application_main_title">११. निवेदकको (ऋण/कर्जा लिने व्यक्ति) आर्थिक अवस्था: <span
                    class="star">*</span></span>
            <br>
            <span class="application_second_title">क. घरको विवरण:</span>
            <div class="col-6">
                <div class="form-group">
                    <label for="applicant_house_no">अ. घरको संख्या</label>
                    <input type="number" value="{{ old('loan_taking_additional_detail.applicant_house_no') }}"
                           id="applicant_house_no" name="loan_taking_additional_detail[applicant_house_no]"
                           class="input-text" autofocus min="1" max="10" placeholder="१ देखि १० सम्म" required
                           oninput="validateHouseNumber(this)">
                    <span id="houseNumberError" style="display: none; color: red;">कृपया १ देखि १० सम्मको संख्या प्रविष्ट गर्नुहोस्।</span>
                    @if ($errors->has('loan_taking_additional_detail.applicant_house_no'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('loan_taking_additional_detail.applicant_house_no') as $error)
                            <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
            </div>
            <div class="container mt-5">
                <!-- First set of fields -->
                <div id="form-container-1" class="row form-set">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="applicant_house_area_1">आ. घरले चर्चेको जग्गाको क्षेत्रफल</label>
                            <input id="applicant_house_area_1" type="number" value="{{ old('loan_taking_additional_detail.applicant_house_area.0') }}" name="loan_taking_additional_detail[applicant_house_area][]" class="input-text" autofocus min="1">
                            @php
                            $houseareaErrors = $errors->get('loan_taking_additional_detail.applicant_house_area.*');
                        @endphp
                        @if ($houseareaErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($houseareaErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="applicant_house_type_1">इ. घरको किसिम (कच्ची/पक्की)</label>
                            <select id="applicant_house_type_1" name="loan_taking_additional_detail[applicant_house_type][]">
                                <option disabled selected value>घरको किसिम चयन गर्नुहोस्</option>
                                <option value="कच्ची" {{ old('loan_taking_additional_detail.applicant_house_type') == 'कच्ची' ? 'selected' : '' }}>कच्ची</option>
                                <option value="पक्की" {{ old('loan_taking_additional_detail.applicant_house_type') == 'पक्की' ? 'selected' : '' }}>पक्की</option>
                                <option value="अन्य" {{ old('loan_taking_additional_detail.applicant_house_type') == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                            </select>
                            @php
                            $housetypeErrors = $errors->get('loan_taking_additional_detail.applicant_house_type.*');
                        @endphp
                        @if ($housetypeErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($housetypeErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="applicant_house_storeyed_1">ई. घरको तला:</label>
                            <input id="applicant_house_storeyed_1" type="number" value="{{ old('loan_taking_additional_detail.applicant_house_storeyed.0') }}" name="loan_taking_additional_detail[applicant_house_storeyed][]" class="input-text" autofocus min="1">
                            @php
                            $housestoreyedErrors = $errors->get('loan_taking_additional_detail.applicant_house_storeyed.*');
                        @endphp
                        @if ($housestoreyedErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($housestoreyedErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <span class="application_second_title">उ. घर रहेको स्थान</span>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="state">प्रदेश</label>
                            <select id="state_0" name="loan_taking_additional_detail[applicant_house_state][]" data-iteration="0" class="form-control d_state_id">
                                <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{ old('loan_taking_additional_detail.applicant_house_state.0') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                @endforeach
                            </select>
                            @php
                            $housestateErrors = $errors->get('loan_taking_additional_detail.applicant_house_state.*');
                        @endphp
                        @if ($housestateErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($housestateErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="district_0">जिल्ला</label>
                            <select id="district_0" name="loan_taking_additional_detail[applicant_house_district][]" data-iteration="0" class="form-control d_district_id">
                                <option value="">जिल्ला चयन गर्नुहोस्</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" {{ old('loan_taking_additional_detail.applicant_house_district.0') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                @endforeach
                            </select>
                            @php
                            $housedistrictErrors = $errors->get('loan_taking_additional_detail.applicant_house_district.*');
                        @endphp
                        @if ($housedistrictErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($housedistrictErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="localbody_0">न.पा./गा.पा</label>
                            <select id="localbody_0" name="loan_taking_additional_detail[applicant_house_local][]" data-iteration="0" class="form-control d_localbody_id">
                                <option value="">स्थानीय तह चयन गर्नुहोस्</option>
                                @foreach ($locals as $localbody)
                                    <option value="{{ $localbody->id }}" {{ old('loan_taking_additional_detail.applicant_house_local.0') == $localbody->id ? 'selected' : '' }}>{{ $localbody->name }}</option>
                                @endforeach
                            </select>
                            @php
                            $applicanthouselocalErrors = $errors->get('loan_taking_additional_detail.applicant_house_local.*');
                        @endphp
                        @if ($applicanthouselocalErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($applicanthouselocalErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="applicant_house_ward_1">वडा नं</label>
                            <select id="applicant_house_ward_1" name="loan_taking_additional_detail[applicant_house_ward][]" class="form-control col-md-12">
                                <option disabled selected value>वडा चयन गर्नुहोस्</option>
                                @for ($i = 1; $i <= 32; $i++)
                                    <option value="{{ $i }}" {{ old('loan_taking_additional_detail.applicant_house_ward.0') == $i ? 'selected' : '' }}>वडा नं. {{ $i }}</option>
                                @endfor
                            </select>
                            @php
                            $applicanthousewardErrors = $errors->get('loan_taking_additional_detail.applicant_house_ward.*');
                        @endphp
                        @if ($applicanthousewardErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($applicanthousewardErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p class="mb-0"><b>(नोट: एक भन्दा बढी ठाउँ /स्थानमा घर/जग्गा भएमा सोही बमोजिम सबै विवरण छुट्टै पानामा उल्लेख गर्ने)</b></p>
                    <button class="btn btn-outline-secondary ml-2 add-dropdown-1" type="button">+</button>
                </div>


                <span class="application_second_title">ख. जग्गाको विवरण:</span>
                <div id="form-container-2" class="row form-set">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="applicant_land_kitta_no_1">कित्ता नं</label>
                            <input id="applicant_land_kitta_no_1" type="number" value="{{ old('loan_taking_additional_detail.applicant_land_kitta_no.0') }}" name="loan_taking_additional_detail[applicant_land_kitta_no][]" class="input-text" autofocus>
                            @php
                            $applicantlandkittanoErrors = $errors->get('loan_taking_additional_detail.applicant_land_kitta_no.*');
                        @endphp
                        @if ($applicantlandkittanoErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($applicantlandkittanoErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="applicant_land_area_1">क्षेत्रफल</label>
                            <input id="applicant_land_area_1" type="number" value="{{ old('loan_taking_additional_detail.applicant_land_area.0') }}" name="loan_taking_additional_detail[applicant_land_area][]" class="input-text" autofocus>
                            @php
                            $applicantlandareaErrors = $errors->get('loan_taking_additional_detail.applicant_land_area.*');
                        @endphp
                        @if ($applicantlandareaErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($applicantlandareaErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="state_id2_1">प्रदेश</label>
                            <select id="bstate_0" name="loan_taking_additional_detail[applicant_land_state][]"  data-iteration="0" class="form-control b_state_id">
                                <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}" {{ old('loan_taking_additional_detail.applicant_land_state.0') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                @endforeach
                            </select>
                            @php
                            $applicantlandstateErrors = $errors->get('loan_taking_additional_detail.applicant_land_state.*');
                        @endphp
                        @if ($applicantlandstateErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($applicantlandstateErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="b_district_id2_1">जिल्ला</label>
                            <select id="bdistrict_0" name="loan_taking_additional_detail[applicant_land_district][]"  data-iteration="0" class="form-control b_district_id">
                                <option value="">जिल्ला चयन गर्नुहोस्</option>
                                @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ old('loan_taking_additional_detail.applicant_land_district.0') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                @endforeach
                            </select>
                            @php
                            $applicantlanddistrictErrors = $errors->get('loan_taking_additional_detail.applicant_land_district.*');
                        @endphp
                        @if ($applicantlanddistrictErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($applicantlanddistrictErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="b_localbody_id2_1">न.पा./गा.पा</label>
                            <select id="blocalbody_0" name="loan_taking_additional_detail[applicant_land_local][]"  data-iteration="0" class="form-control b_localbody_id">
                                <option value="">स्थानीय तह चयन गर्नुहोस्</option>
                                @foreach ($locals as $localbody)
                                <option value="{{ $localbody->id }}" {{ old('loan_taking_additional_detail.applicant_land_local.0') == $localbody->id ? 'selected' : '' }}>{{ $localbody->name }}</option>
                                @endforeach
                            </select>
                            @php
                            $applicantlandlocalErrors = $errors->get('loan_taking_additional_detail.applicant_land_local.*');
                        @endphp
                        @if ($applicantlandlocalErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($applicantlandlocalErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="applicant_land_ward_1">वडा नं</label>
                            <select id="applicant_land_ward_1" name="loan_taking_additional_detail[applicant_land_ward][]" class="form-control col-md-12">
                                <option disabled selected value>वडा चयन गर्नुहोस्</option>
                                @for ($i = 1; $i <= 32; $i++)
                                <option value="{{ $i }}" {{ old('loan_taking_additional_detail.applicant_land_ward.0') == $i ? 'selected' : '' }}>वडा नं. {{ $i }}</option>
                                @endfor
                            </select>
                            @php
                            $applicantlandwardErrors = $errors->get('loan_taking_additional_detail.applicant_land_ward.*');
                        @endphp
                        @if ($applicantlandwardErrors)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($applicantlandwardErrors as $error)
                                        <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p class="mb-0"><b>(नोट: एक भन्दा बढी ठाउँ /स्थानमा घर/जग्गा भएमा सोही बमोजिम सबै विवरण छुट्टै पानामा उल्लेख गर्ने)</b></p>
                    <button class="btn btn-outline-secondary ml-2 add-dropdown-2" type="button">+</button>
                </div>
                </div>

                <script>
                    $(document).ready(function () {
                        let formIndex1 = 0;
                        let formIndex2 = 0;
                        function updateNamesAndIds(clone, index, prefix) {
                            clone.find('input, select').each(function () {
                                let name = $(this).attr('name');
                                let id = $(this).attr('id');
                                let iteration = $(this).data('iteration');
                                var currentIteration = $(this).data("iteration");
                                console.log(currentIteration);
                                if (name) {
                                    name = name.replace(/\[\d*\]/, '[' + index + ']');
                                    $(this).attr('name', name);
                                }
                                if (id) {
                                    let newId = id.split('_')[0] + '_' + index;
                                    $(this).attr('id', newId);
                                    console.log('Current id:' + id);
                                }
                                if (iteration !== undefined) {
                                    //console.log('Current data-iteration:' + iteration);
                                    // console.log('New index:' + index);
                                    // Remove the existing data-iteration attribute
                                    $(this).removeAttr('data-iteration');
                                    // Set the new data-iteration attribute with the new index value
                                    $(this).attr('data-iteration', index);
                                    }
                            });
                        }
                        $('.add-dropdown-1').on('click', function () {
                            formIndex1++;
                            let clone = $('#form-container-1').clone().attr('id', 'form-container-1-' + formIndex1);
                            updateNamesAndIds(clone, formIndex1, 'form1');
                            clone.append('<div class="col-12 text-right"><button type="button" class="btn btn-outline-danger btn-sm ml-2 remove-dropdown">-</button></div>');
                            $('<hr class="separator">').insertAfter($('#form-container-1').last());
                            clone.insertAfter($('#form-container-1').last());
                            clone.find('.remove-dropdown').on('click', function () {
                                $(this).closest('.form-set').remove();
                            });
                        });
                        $('.add-dropdown-2').on('click', function () {
                            formIndex2++;
                            let clone = $('#form-container-2').clone().attr('id', 'form-container-2-' + formIndex2);
                            updateNamesAndIds(clone, formIndex2, 'form2');
                            clone.append('<div class="col-12 text-right"><button type="button" class="btn btn-outline-danger btn-sm ml-2 remove-dropdown">-</button></div>');
                            $('<hr class="separator">').insertAfter($('#form-container-2').last());
                            clone.insertAfter($('#form-container-2').last());
                            clone.find('.remove-dropdown').on('click', function () {
                                $(this).closest('.form-set').remove();
                            });
                        });
                        $(document).on('click', '.remove-dropdown', function () {
                            $(this).closest('.form-set').remove();
                        });
                    
                    });
                </script>


            {{-- Another Row Starts --}}
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <label for="">ग. सवारी साधनको विवरण
                        </label>

                        <textarea id="" name="loan_taking_additional_detail[applicant_vehicle_details]" class="input-text"
                            autofocus>{{ old('loan_taking_additional_detail.applicant_vehicle_details') }}</textarea>
                            @if ($errors->has('loan_taking_additional_detail.applicant_vehicle_details'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('loan_taking_additional_detail.applicant_vehicle_details') as $error)
                                    <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">घ. चल सम्पत्तिको विवरण
                        </label>

                        <textarea id="" name="loan_taking_additional_detail[applicant_current_asset_details]" class="input-text"
                            autofocus>{{ old('loan_taking_additional_detail.applicant_current_asset_details') }}</textarea>

                            @if ($errors->has('loan_taking_additional_detail.applicant_current_asset_details'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('loan_taking_additional_detail.applicant_current_asset_details') as $error)
                                    <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 
                    </div>
                </div>

            </div>

            {{-- Another Row Starts --}}
            <div class="row">
                <label for="">ङ बैंक तथा वित्तिय संस्था (सहकारी/लघुवित्त समेत) मा खोलिएको बैंक खाता विवरण:
                </label>

                <div class="col-12">
                    <div class="form-group">
                        <label for=""> बैंक तथा वित्तिय संस्था को नाम
                        </label>
                        <input type="" value="{{ old('loan_taking_additional_detail.applicant_org_name') }}"
                            id="" name="loan_taking_additional_detail[applicant_org_name]" class="input-text"
                            autofocus>
                            @if ($errors->has('loan_taking_additional_detail.applicant_org_name'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('loan_taking_additional_detail.applicant_org_name') as $error)
                                    <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 

                    </div>
                </div>


                <div class="col-12">
                    <div class="form-group">
                        <label for=""> शाखा/उपाशाखा
                        </label>
                        <input type=""
                            value="{{ old('loan_taking_additional_detail.applicant_finance_org_branch') }}"
                            id="" name="loan_taking_additional_detail[applicant_finance_org_branch]"
                            class="input-text" autofocus>
                            @if ($errors->has('loan_taking_additional_detail.applicant_finance_org_branch'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('loan_taking_additional_detail.applicant_finance_org_branch') as $error)
                                    <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="account-datepicker"> खाता खोलेको मिति
                        </label>
                        <input type=""
                            value="{{ old('loan_taking_additional_detail.applicant_account_opening_date') }}"
                            id="account-datepicker" name="loan_taking_additional_detail[applicant_account_opening_date]"
                            class="input-text" autofocus>

                            @if ($errors->has('loan_taking_additional_detail.applicant_account_opening_date'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('loan_taking_additional_detail.applicant_account_opening_date') as $error)
                                    <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 
                    </div>
                </div>

                {{-- Another Row Starts --}}


                <div class="col-12">
                    <div class="form-group">
                        <label for="account-datepicker">खातामा मैज्दात रकम
                        </label>
                        <input type="number"
                            value="{{ old('loan_taking_additional_detail.applicant_finance_amount') }}"
                            id="account-datepicker" name="loan_taking_additional_detail[applicant_finance_amount]"
                            class="input-text" autofocus pattern="\d+" min="1">

                            @if ($errors->has('loan_taking_additional_detail.applicant_finance_amount'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('loan_taking_additional_detail.applicant_finance_amount') as $error)
                                    <li>कृपया यो क्षेत्र भर्नुहोस्</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 
                    </div>
                </div>
            </div>

            <hr class="hr-line">
            {{-- Another Row Starts --}}
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="application_main_title">१२. यो कर्जा कारोवारको सम्बन्धमा पीडितले मुलुकी अपराध
                            संहिता, २०७४ को दफा २४९ क(अनुचित लेनदेन गर्न नहुने) अनुसार सम्बन्धित प्रहरी कार्यालयमा
                            उजुरी/जाहेरी दिएको <span class="star">*</span></label>
                        <div>
                            <input type="radio" id="crime_reported_yes"
                                name="loan_taking_additional_detail[is_crime_reported]" value="1"
                                {{ old('loan_taking_additional_detail.is_crime_reported') == '1' ? 'checked' : '' }}>
                            <label for="crime_reported_yes">छ</label>
                        </div>
                        <div>
                            <input type="radio" id="crime_reported_no"
                                name="loan_taking_additional_detail[is_crime_reported]" value="0"
                                {{ old('loan_taking_additional_detail.is_crime_reported') == '0' ? 'checked' : '' }}>
                            <label for="crime_reported_no">छैन</label>
                        </div>
                    </div>

                    <div class="col-6" id="if_crime_reported_fields" style="display: none;">
                        <span class="application_second_title">क. उजुरी/जाहेरी दिएको भए:</span>
                        <div class="form-group">
                            <label for="">अ. सो मुद्दा कुन अवस्थामा छ?</label>
                            <select name="loan_taking_additional_detail[if_crime_reported]">
                                <option disabled selected value>अवस्था चयन गर्नुहोस्</option>
                                <option
                                    {{ old('loan_taking_additional_detail.if_crime_reported') == 'अभियोग पत्र पेश भएको' ? 'selected' : '' }}>
                                    अभियोग पत्र पेश भएको</option>
                                <option
                                    {{ old('loan_taking_additional_detail.if_crime_reported') == 'अभियोग पत्र पेश नभएको' ? 'selected' : '' }}>
                                    अभियोग पत्र पेश नभएको</option>
                                <option
                                    {{ old('loan_taking_additional_detail.if_crime_reported') == 'पीडक थुनामा रहेको' ? 'selected' : '' }}>
                                    पीडक थुनामा रहेको</option>
                                <option
                                    {{ old('loan_taking_additional_detail.if_crime_reported') == 'पीडक थुनामा नरहेको' ? 'selected' : '' }}>
                                    पीडक थुनामा नरहेको</option>
                                <option
                                    {{ old('loan_taking_additional_detail.if_crime_reported') == 'पीडक धरौटीमा  छुटेको' ? 'selected' : '' }}>
                                    पीडक धरौटीमा छुटेको</option>
                                <option
                                    {{ old('loan_taking_additional_detail.if_crime_reported') == 'पीडकले  सजाय  पाएको' ? 'selected' : '' }}>
                                    पीडकले सजाय पाएको</option>
                                <option
                                    {{ old('loan_taking_additional_detail.if_crime_reported') == 'पीडकले  सजाय नपाएको' ? 'selected' : '' }}>
                                    पीडकले सजाय नपाएको</option>
                                {{-- Add other options as needed --}}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // Add event listener to radio buttons
                var crimeReportedYes = document.getElementById('crime_reported_yes');
                var ifCrimeReportedFields = document.getElementById('if_crime_reported_fields');

                // Function to show or hide fields
                function toggleFields() {
                    if (crimeReportedYes.checked) {
                        ifCrimeReportedFields.style.display = 'block';
                    } else {
                        ifCrimeReportedFields.style.display = 'none';
                    }
                }

                // Add event listener for 'छ' radio button
                crimeReportedYes.addEventListener('change', function() {
                    toggleFields();
                });

                var crimeReportedNo = document.getElementById('crime_reported_no');

                // Add event listener for 'छैन' radio button
                crimeReportedNo.addEventListener('change', function() {
                    ifCrimeReportedFields.style.display = 'none';
                });

                // Call the toggleFields function initially
                toggleFields();
            </script>


            {{-- Another Row Starts --}}
            <hr class="hr-line">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="form-group">
                        <label class="application_main_title">१३. यो लेनदेनको सावाँ र ब्याजको सम्बन्धमा अन्य केही कुरा
                            खुलाउनुपर्ने भए?</label>

                        <textarea name="loan_taking_additional_detail[transaction_actual_interest]">{{ old('loan_taking_additional_detail.transaction_actual_interest') }}</textarea>
                        {{-- <input type="" value="{{ old('loan_taking_additional_detail.transaction_actual_interest') }}" id="" name="loan_taking_additional_detail[transaction_actual_interest]" class="input-text"
                        autofocus> --}}

                    </div>
                </div>
            </div>

            <hr class="hr-line">

            {{-- Another Row Starts --}}
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="form-group">
                        <label class="application_main_title">१४. यो निवेदनको व्यहोरा पुष्टि गर्ने निम्न कागजातको फोटोकपी यसैसाथ संलग्न गरेको छु।</label>
                        <div id="document-container">
                            <div class="input-group mb-2">
                                <textarea name="loan_taking_additional_detail[application_verifying_document][]" class="form-control equal-height" autofocus>{{ old('loan_taking_additional_detail.application_verifying_document.0') }}</textarea>
                                <input type="file" name="loan_taking_additional_detail[application_document_file][]" class="form-control equal-height ml-2">
                                @if(old('uploaded_file_name'))
                                    <span>{{ old('uploaded_file_name') }}</span>
                                @endif
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm add-textarea equal-height" type="button">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <hr class="hr-line">
            {{-- Another Row Starts --}}
            <div class="row mt-4">
                <label class="application_main_title">१५. माथि लेखिएको व्यहोरा मैले जाने बुझेसम्म ठिक साँचो हो। यसमा फरक
                    परे कानून बमोजिम सहुँला बुझाउँला भनी
                    सहीछाप गरिदिए</label>

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
                        <p> <label for="">नाम, थर
                            </label>
                            <input type="" value="{{ old('loan_taking_additional_detail.stamp_person_name') }}"
                                id="" name="loan_taking_additional_detail[stamp_person_name]"
                                class="input-text" autofocus maxlength="50" required oninput="validateName(this)" >
                        </p>
                        <br>
                        <p><label for="">हस्ताक्षर </label>
                            <input type="" value="{{ old('loan_taking_additional_detail.stamp_person_name') }}"
                                id="" name="loan_taking_additional_detail[stamp_person_name]"
                                class="input-text" autofocus>
                        </p>
                        <br>
                        <p> <label for="stamp-datepicker">मिति
                            </label>
                            <input type="" value="{{ old('loan_taking_additional_detail.stamp_date') }}"
                                id="stamp-datepicker" name="loan_taking_additional_detail[stamp_date]"
                                class="input-text" autofocus>
                        </p>
                    </div>
                </div>
            </div>
            {{-- Additional Detail End --}}
            <hr class="hr-line">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">सिर्जना गर्नुहोस</button>
            </div>
    </form>


    </div>

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
        var currentIteration = $(this).attr('data-iteration');
        alert(currentIteration);
        var append_to = 'bdistrict_' + currentIteration;
        var next_append = 'blocalbody_' + currentIteration;
        fetchDistrict(b_state_id, append_to, next_append);
    });
    $(document).on('change', '.b_district_id', function() {
        var b_district_id = $(this).val();
        var currentIteration = $(this).attr('data-iteration');
        var append_to = 'blocalbody_' + currentIteration;
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
        var currentIteration = $(this).attr('data-iteration');
        var append_to = 'district_' + currentIteration;
        console.log("d_state_id value:" + d_state_id);
        console.log("currentIteration for state:" + currentIteration);
        console.log("append to:" + append_to);
        var next_append = 'localbody_' + currentIteration;
        fetchDistrict(d_state_id, append_to, next_append);
    });
    // $(document).on('change', '.d_district_id', function() {
    //     var d_district_id = $(this).val();
    //     var currentIteration = $(this).data("iteration");
    //     var append_to = 'localbody_' + currentIteration;
    //     console.log("district id:" + d_district_id);
    //     console.log("currentIteration for district :" + currentIteration);
    //     fetchLocalGoverment(d_district_id, append_to);
    // });
    $(document).on('change', '.d_district_id', function() {
    var d_district_id = $(this).val();
    var currentIteration = $(this).attr('data-iteration');
    var append_to = 'localbody_' + currentIteration;
    console.log("district id:" + d_district_id);
    console.log("currentIteration for district :" + currentIteration);
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
                                '<option disabled selected value>स्थानीय तह चयन गर्नुहोस्</option>');
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
        });

        $(document).ready(function() {
            // Function to handle dynamic dropdowns...
            // Move Nepali Datepicker initialization outside the dynamic dropdown function
            initializeNepaliDatepicker();
        });

        function initializeNepaliDatepicker() {
            // Initialize Nepali Datepicker for "Registration Date" field
            var registerInput = document.getElementById("register-datepicker");
            if (registerInput) {
                registerInput.nepaliDatePicker({
                    dateFormat: "YYYY-MM-DD",
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 200
                });
            }
            // Initialize Nepali Datepicker for "Citizenship Issue Date" field
            var citizenshipInput = document.getElementById("citizenship-datepicker");
            if (citizenshipInput) {
                $(citizenshipInput).nepaliDatePicker({
                    dateFormat: "YYYY-MM-DD",
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 200
                });
            }

            // Initialize Nepali Datepicker for "Loan Date" field
            var LoanInput = document.getElementById("loan-datepicker");
            if (LoanInput) {
                LoanInput.nepaliDatePicker({
                    dateFormat: "YYYY-MM-DD",
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 200
                });
            }
            // Initialize Nepali Datepicker for "Jailed Date" field
            var jailInput = document.getElementById("jail-datepicker");
            if (jailInput) {
                jailInput.nepaliDatePicker({
                    dateFormat: "YYYY-MM-DD",
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 200
                });
            }

            // Initialize Nepali Datepicker for "Account Opened Date" field
            var accountInput = document.getElementById("account-datepicker");
            if (accountInput) {
                accountInput.nepaliDatePicker({
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

            // Initialize Nepali Datepicker for "Ammountpayment LastDate" field
            var ammountInput = document.getElementById("payment-datepicker");
            if (ammountInput) {
                ammountInput.nepaliDatePicker({
                    dateFormat: "YYYY-MM-DD",
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 200
                });
            }
        }

        document.addEventListener('DOMContentLoaded', (event) => {
    const numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach(input => {
        input.addEventListener('keypress', (e) => {
            if (e.key === '-' || e.key === '+' || e.key === 'e' || e.key === 'E') {
                e.preventDefault();
            }
        });

        input.addEventListener('input', (e) => {
            if (e.target.value < 0) {
                e.target.value = '';
            }
        });
    });
});

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


function addWitnessField() {
                    // Create a new input group container
                    var inputGroup = document.createElement("div");
                    inputGroup.className = "input-group";
                    // Create a new input element
                    var newInput = document.createElement("input");
                    newInput.type = "text";
                    newInput.name = "loan_taking_loan_detail[loan_witness][]";
                    newInput.autofocus = true;
                    newInput.className = "mb-2";
                    // Create a remove button
                    var removeBtn = document.createElement("button");
                    removeBtn.type = "button";
                    removeBtn.textContent = "-";
                    removeBtn.onclick = function() { removeField(removeBtn); };
                    // Append the input and remove button to the input group
                    inputGroup.appendChild(newInput);
                    inputGroup.appendChild(removeBtn);
                    // Create a line break element
                    var lineBreak = document.createElement("br");
                    // Append the input group and line break to the witness container
                    var container = document.getElementById("witness-container");
                    container.appendChild(inputGroup);
                    container.appendChild(lineBreak);
                }
                function removeField(button) {
                    // Remove the parent input group of the button
                    var inputGroup = button.parentNode;
                    inputGroup.nextSibling.remove();  // Remove the line break
                    inputGroup.remove();
            }

            //For Textarea + button
            $(document).ready(function() {
            // Function to add new textarea and file input fields
            $(document).on('click', '.add-textarea', function() {
                var container = $('#document-container');
                var newInputGroup = $('<div class="input-group mb-2">')
                    .append('<textarea name="loan_taking_additional_detail[application_verifying_document][]" class="form-control equal-height" autofocus></textarea>')
                    .append('<input type="file" name="loan_taking_additional_detail[application_document_file][]" class="form-control equal-height ml-2">')
                    .append('<div class="input-group-append"><button class="btn btn-outline-secondary btn-sm remove-textarea equal-height" type="button">-</button></div>');
                container.append(newInputGroup);
            });
            // Function to remove textarea and file input fields
            $(document).on('click', '.remove-textarea', function() {
                $(this).closest('.input-group').remove();
            });
        });

        function validateName(input) {
                    const errorSpan = document.getElementById('nameError');
                    const value = input.value;
                    const filteredValue = value.replace(/[0-9]/g, '');

                    if (filteredValue.length > 50) {
                        input.value = filteredValue.slice(0, 50);
                        errorSpan.style.display = 'block'; // Ensure error message is displayed
                    } else {
                        input.value = filteredValue;
                        errorSpan.style.display = 'none'; // Hide error message
                    }
                }

                document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('quickForm');
                        const name = document.getElementById('name');
                        const nameError = document.getElementById('nameError');

                        // Add event listener for form submission
                        form.addEventListener('submit', function(event) {
                            // Check if the name field is empty
                            if (name.value.trim() === '') {
                                nameError.style.display = 'inline';
                                name.scrollIntoView({ behavior: 'smooth', block: 'center' }); // Scroll to the input field
                                name.focus();
                                event.preventDefault(); // Prevent form submission
                            } else {
                                nameError.style.display = 'none';
                            }
                        });

                        // Clear error message on input
                        name.addEventListener('input', function() {
                            if (name.value.trim() !== '') {
                                nameError.style.display = 'none';
                            }
                        });
                    });

    </script>


@endsection
