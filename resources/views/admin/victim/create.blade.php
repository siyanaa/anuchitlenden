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
        .application_main_title {
            margin-top: 20px;
            font-size: 20px;
            text-decoration: underline;
            color: black;
        }

        
        .application_second_title {
            margin-top: 10px;
            font-size: 15px;
            text-decoration: underline;

        }
        .purposeandnature{
            font-size: 14px
        }
    </style>

    <form id="quickForm" novalidate="novalidate" method="POST" action="" class="form-inline">
        @csrf
        <div class="card-body">

            <div class="row">
                <span class="application_main_title">1. निवेदक(ऋण/कर्जा लिने व्यक्ति) को विवरण:</span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="applicant_name">नाम, थर</label>

                        <input type="text" value="" id="applicant_name" name="" class="input-text"
                            autofocus>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="registrations">उमेर</label>

                        <input type="text" value="" id="" name="" class="input-text" autofocus>

                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="registrations">नागरिकता नं</label>

                        <input type="text" value="" id="" name="" class="input-text" autofocus>

                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="">नागरिकता जारी जिल्ला</label>

                        <input type="text" value="" id="" name="" class="input-text" autofocus>

                    </div>
                </div>



                <div class="col-4">
                    <div class="form-group">
                        <label for="">नागरिकता जारी मिती</label>

                        <input type="text" value="" id="nepali-datepicker" name="" class="input-text" autofocus>

                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="">बुवाको नाम थर</label>

                        <input type="text" value="" id="" name="" class="input-text" autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">फोन नं</label>

                        <input type="text" value="" id="" name="" class="input-text" autofocus>

                    </div>
                </div>
               

                <div class="col-6">
                    <div class="form-group">
                        <label for="">पति/पत्नीको नाम थर</label>

                        <input type="text" value="" id="" name="" class="input-text" autofocus>

                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="">फोन नं</label>

                        <input type="text" value="" id="" name="" class="input-text" autofocus>

                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="">परिवार सदस्य संख्या</label>
                        <input type="text" value="" id="" name="" class="input-text" autofocus>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">वार्षिक आम्दानी</label>
                        <input type="text" value="" id="" name="" class="input-text" autofocus>
                    </div>
                </div>



                <span class="application_second_title">स्थायी ठेगाना:</span>


                <div class="col-3">
                    <div class="form-group">
                        <label for="">प्रदेश</label>
                        <select id="state_id0" name="" data-iteration="0" class="form-control a_state_id">
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

                        <select id="a_district_id0" data-iteration="0" name="" class="form-control a_district_id">
                            <option value="">जिल्ला चयन गर्नुहोस्</option>
                        </select>
                    </div>
                </div>


                <div class="col-3">
                    <div class="form-group">
                        <label for="">स्थानिय तह</label>

                        <select id="a_localbody_id0" data-iteration="0" name=""
                            class="form-control a_localbody_id">
                            <option value="">स्थानीय तह चयन गर्नुहोस्
                            </option>
                        </select>

                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="">वडा</label>

                        <select id="a_wada_id" name="applicant_temp_ward" class="form-control col-md-12">
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
                            <option value="33">वडा नं. ३३</option>
                            <option value="34">वडा नं. ३४</option>
                            <option value="35">वडा नं. ३५</option>
                        </select>
                    </div>
                </div>

                <span class="application_second_title">हाल बसोबासको ठेगाना:</span>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">प्रदेश</label>
                        <select id="state_id0" name="" data-iteration="0" class="form-control a_state_id">
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

                        <select id="a_district_id0" data-iteration="0" name="" class="form-control a_district_id">
                            <option value="">जिल्ला चयन गर्नुहोस्</option>
                        </select>
                    </div>
                </div>


                <div class="col-3">
                    <div class="form-group">
                        <label for="">स्थानिय तह</label>

                        <select id="a_localbody_id0" data-iteration="0" name=""
                            class="form-control a_localbody_id">
                            <option value="">स्थानीय तह चयन गर्नुहोस्
                            </option>
                        </select>

                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="">वडा</label>

                        <select id="a_wada_id" name="applicant_temp_ward" class="form-control col-md-12">
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
                            <option value="33">वडा नं. ३३</option>
                            <option value="34">वडा नं. ३४</option>
                            <option value="35">वडा नं. ३५</option>
                        </select>
                    </div>
                </div>

                {{-- For other details in the basic information --}}
                <div class="col-4">
                    <div class="form-group">
                        <label for="">(PAN) नं</label>

                        <input type="text" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="">पेशा/व्यवसाय</label>

                        <input type="text" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="">शैक्षिक योग्यता</label>

                        <select id="" name=""
                            class="form-control">
                            <option value="">शैक्षिक योग्यता चयन गर्नुहोस्</option>
                            <option>सामान्य लेखपढ</option>
                            <option>कक्षा ८ सम्म</option>
                            <option>कक्षा १० सम्म</option>
                            <option>कक्षा १२ सम्म</option>
                            <option>उच्च शिक्षा</option>
                        </select>

                    </div>
                </div>
            </div>
            {{-- First Row Ends --}}

            <div class="row">
                <span class="application_main_title">2. विपक्षी (ऋण/कर्जा दिने व्यक्ति) को विवरण:</span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="applicant_name">नाम, थर</label>

                        <input type="text" value="" id="applicant_name" name="" class="input-text"
                            autofocus>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="registrations">उमेर</label>

                        <input type="text" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>


                <span class="application_second_title">स्थायी ठेगाना:</span>


                <div class="col-3">
                    <div class="form-group">
                        <label for="">प्रदेश</label>
                        <select id="state_id0" name="" data-iteration="0" class="form-control a_state_id">
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

                        <select id="a_district_id0" data-iteration="0" name="" class="form-control a_district_id">
                            <option value="">जिल्ला चयन गर्नुहोस्</option>
                        </select>
                    </div>
                </div>


                <div class="col-3">
                    <div class="form-group">
                        <label for="">स्थानिय तह</label>

                        <select id="a_localbody_id0" data-iteration="0" name=""
                            class="form-control a_localbody_id">
                            <option value="">स्थानीय तह चयन गर्नुहोस्
                            </option>
                        </select>

                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="">वडा</label>

                        <select id="a_wada_id" name="applicant_temp_ward" class="form-control col-md-12">
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
                            <option value="33">वडा नं. ३३</option>
                            <option value="34">वडा नं. ३४</option>
                            <option value="35">वडा नं. ३५</option>
                        </select>
                    </div>
                </div>


                <span class="application_second_title">हाल बसोबासको ठेगाना:</span>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">प्रदेश</label>
                        <select id="state_id0" name="" data-iteration="0" class="form-control a_state_id">
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

                        <select id="a_district_id0" data-iteration="0" name="" class="form-control a_district_id">
                            <option value="">जिल्ला चयन गर्नुहोस्</option>
                        </select>
                    </div>
                </div>


                <div class="col-3">
                    <div class="form-group">
                        <label for="">स्थानिय तह</label>

                        <select id="a_localbody_id0" data-iteration="0" name=""
                            class="form-control a_localbody_id">
                            <option value="">स्थानीय तह चयन गर्नुहोस्
                            </option>
                        </select>

                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="">वडा</label>

                        <select id="a_wada_id" name="applicant_temp_ward" class="form-control col-md-12">
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
                            <option value="33">वडा नं. ३३</option>
                            <option value="34">वडा नं. ३४</option>
                            <option value="35">वडा नं. ३५</option>
                        </select>
                    </div>
                </div>

                {{-- For other details in the basic information --}}


                <div class="col-6">
                    <div class="form-group">
                        <label for="">पेशा/व्यवसाय</label>

                        <input type="text" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">शैक्षिक योग्यता</label>

                        <select id="" name="" class="form-control">
                            <option value="">शैक्षिक योग्यता चयन गर्नुहोस्</option>
                            <option>सामान्य लेखपढ</option>
                            <option>कक्षा ८ सम्म</option>
                            <option>कक्षा १० सम्म</option>
                            <option>कक्षा १२ सम्म</option>
                            <option>उच्च शिक्षा</option>
                        </select>

                    </div>
                </div>

            </div>
            {{-- Row of offender ends here --}}

            <div class="row">
                <span class="application_main_title">3. ऋण/कर्जा कारोबारको विवरण:</span>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">क. ऋण लिनुपर्ने कारण/प्रयोजन</label>

                        <div class="purposeandnature" style="">
                            @foreach ($purposes as $purpose)
                                <input type="checkbox" name="purpose_id[]"
                                    value="{{ $purpose->id }}">{{ $purpose->title }}<br>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="">ख. कर्जा/ऋण कारोबार भएको मिति</label>

                        <input type="" value="" id="nepali-datepicker" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="">ग. कर्जा/ऋण कारोबार भएको स्थान</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="">घ. कर्जा/ऋण कारोबार भएको रकम</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">ङ. कर्जा/ऋण कारोबार हुँदाका बखतका साक्षीहरु</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>



                <div class="col-6">
                    <div class="form-group">
                        <label for="">उ. लिखत लेख्ने व्यक्तिको नाम, थर</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ठेगाना </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

            </div>

            {{-- Another Row Ends --}}
            <div class="row">
                <span class="application_main_title">4. ऋण/कर्जा लिएको माध्यम :</span>
                <div class="col-12">
                    
                    <div class="form-group col-md-4">
                        <label for="">माध्यम</label>

                        <select id="" name="" class="form-control"
                        required>
                        <option  disabled selected value>माध्यम चयन गर्नुहोस्</option>
                        @foreach ($proofs as $proof)
                            <option value="{{ $proof->id }}">{{ $proof->title }}</option>
                        @endforeach
                    </select>

                    </div>
                </div>
            </div>


            {{-- Another Row Ends --}}
            <div class="row">
                <span class="application_main_title">5. ऋण/कर्जा लिँदाका बखतका विवरण तथा शर्तहरु:</span>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">क. कर्जा लिँदा तमसुक/लिखत/सम्झौता</label>

                        <select name="">
                            <option>भएको</option>
                            <option>नभएको</option>
                        </select>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">अ. लेनदेन भएको रकम र तमसुकमा उल्लेख भएको रकम समान </label>
                       
                        <select name="">
                            <option>भएको</option>
                            <option>नभएको</option>
                        </select>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">आ. लिखत/तमसुकमा उल्लेख भएको रकम</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">इ. ऋण/कर्जा कारोबार भएको वास्तविक रकम</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">ई. ऋण लिँदा सही छाप मात्र गरी धनिलाई खाली चेक</label>

                        
                        <select name="">
                            <option>दिएको</option>
                            <option>नदिएको</option>
                        </select>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">उ. धनी/साहुलाई रकम उल्लेख भएको चेक दिएको भए, चेकमा के कति रकम </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">ऊ. लिखत/तमसुक परिवर्तन </label>

                       
                        <select name="">
                            <option>गरेको</option>
                            <option>नगरेको</option>
                        </select>

                    </div>
                </div>

                <span class="application_second_title">ख. जग्गा राजिनामा पारीत गरी दिई ऋण/कर्जा लिएको सम्बन्धमा:</span>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">अ. जग्गा फिर्ता गर्ने शर्त</label>

                        
                        <select name="">
                            <option>राखिएको</option>
                            <option>थिएन</option>
                        </select>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">आ. कुनै अर्को शर्त राखेर अर्को लिखत/तमसुक खडा गरिएको  </label>              
                        <select name="">
                            <option>थियो</option>
                            <option>थिएन</option>
                        </select>
                    </div>
                </div>


                <span class="application_second_title">ग. हाल सो जग्गाको भोग कसले गरिरहेको छ?</span>
                <div class="col-4">
                   
                    <div class="form-group">
                        <label for="">कसले गरिरहेको</label>

                    
                            <select id="select-type" onchange="toggleInput()">
                                <option value="निवेदक">निवेदक</option>
                                <option value="विपक्षी">विपक्षी</option>
                                <option value="custom">अन्य</option>
                            </select>
                     
                        
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">अन्य व्यक्ति भए निजको नाम, थर</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">ठेगाना</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>


                <span class="application_second_title">घ. जग्गा दृष्टिबन्धक गरी पारित गरिदिई ऋण/कर्जा लिएकोमा: </span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">अ. जग्गा दृष्टिबन्धक लिखत गर्दा अन्य केही शर्त राखिएको </label>

                        <select name="">
                            <option>थियो</option>
                            <option>थिएन</option>
                        </select>

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">आ. शर्त राखिएको भए के शर्त राखिएको थियो?</label>

                        <textarea type="" value="" id="" name="" class="input-text" autofocus>

                        </textarea>

                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">इ. उक्त दृष्टिबन्धक राखिएको जग्गाको भोग चलन कसले गरिरहेको छ</label>

                        <select id="select-type" onchange="toggleInput()">
                            <option value="निवेदक">निवेदक</option>
                            <option value="विपक्षी">विपक्षी</option>
                            <option value="custom">अन्य</option>
                        </select>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">अन्य व्यक्ति भए निजको नाम, थर</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">ठेगाना</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>


                <span class="application_second_title">ङ. तमसुक/शर्तनामामा जमानी राखेको भए:</span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">क. जमानी बस्नेको कुनै शर्त </label>

                        <select name="">
                            <option>थियो</option>
                            <option>थिएन</option>
                        </select>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ख. शर्त थियो भने के थियो?</label>

                        <textarea type="" value="" id="" name="" class="input-text">

                        </textarea>

                    </div>
                </div>



                <span class="application_second_title">6. लिखत/तमसुकमा उल्लेख भएको मुलधन र ब्याज सम्बन्धमा</span>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">क. लिखत/तमसुकमा उल्लेख भएको ब्याजदर प्रतिशत </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">ख. बुझाउने/बुझाएको ब्याजदर प्रतिशत</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ग. हाल सम्म बुझाएको ब्याज रकम </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">घ. ब्याज बुझाएको माध्यम</label>

                    <select id="" name="" class="form-control"
                        required>
                        <option  disabled selected value>माध्यम चयन गर्नुहोस्</option>
                        @foreach ($proofs as $proof)
                            <option value="{{ $proof->id }}">{{ $proof->title }}</option>
                        @endforeach
                    </select>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ङ. हालसम्म बुझाएको मूल धन वापतको रकम </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">च. बुझाउन बाँकी रकम</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">छ. लिखत वडा कार्यालयमा दर्ता भएको </label>

                        <select name="">
                            <option>भएको</option>
                            <option>नभएको</option>
                        </select>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">भएको भए दर्ता नं.</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

            </div>
            {{-- Row ends --}}
            <div class="row">
                <span class="application_main_title">7. ऋण/कर्जा/तमसुक/लिखत अनुसार साँवा ब्याज बुझाउने अन्तिम म्याद </span>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">भाखा</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>
            </div>

            {{-- Row ends --}}
            <div class="row">
                <span class="application_main_title">8. ऋण/कर्जा कारोवारको सम्बन्धमा अदालतमा </span>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">मुद्दा</label>

                        <select name="">
                            <option>परेको</option>
                            <option>नपरेको</option>
                        </select>
                    </div>
                </div>

                <span class="application_second_title">क. अदालतमा मुद्दा दायर भएको भए:</span>

                <div class="col-4">
                    <div class="form-group">
                        <label for="">अवस्था</label>

                        <select>
                            <option>विचाराधीन अवस्थामा रहेको</option>
                            <option>फैसला भई फैसला कार्यान्वयन हुन बाँकी रहेको</option>
                            <option>फैसला भई फैसला कार्यान्वयन भई सकेको।</option>
                        </select>

                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">ख. मुद्दाको विषय</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">मुद्दा नं</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

            </div>


            {{-- Row ends --}}
            <div class="row">
                <span class="application_main_title">9. अदालतको फैसलाको अवस्था:</span>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">क. फैसला बमोजिम भरीभराउ भई पीडितको अचल सम्पत्ति डाँक लिलाम</label>

                        <select name="">
                            <option>भएको</option>
                            <option>नभएको</option>
                        </select>

                    </div>
                </div>

                <span class="application_second_title">ख. डाँक लिलाममा उक्त अचल सम्पत्ति कसले सकार गरेको हो? </span>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">नाम, थर</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">ठेगाना</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>


                <div class="col-12">
                    <div class="form-group">
                        <label for="">ग. फैसला बमोजिम रकम असुल उपर गर्न सम्पत्ति नभएकोले थुनामा राखी पाऊ भन्ने
                            निवेदन</label>

                            <select name="">
                                <option>परेको</option>
                                <option>नपरेको</option>
                            </select>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">घ. थुनामा राख्ने आदेश </label>

                        <select name="">
                            <option>भएको</option>
                            <option>नभएको</option>
                        </select>

                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="">ङ. थुनामा गैसकेको भए थुनामा गएको मिति</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ङ. थुनामा बस्नुपर्ने अवधि</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

            </div>

            {{-- Row ends --}}
            <div class="row">
                <span class="application_main_title">10. ऋणी उपर चेक बाउन्स सम्बन्धी :</span>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">मुद्दा</label>

                        <select name="">
                            <option>परेको</option>
                            <option>नपरेको</option>
                        </select>


                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="">मुद्दाको अवस्था</label>

                        <select>
                            <option>विचाराधीन अवस्थामा रहेको</option>
                            <option>विगो भराउने र जरिवाना मात्र भएको</option>
                            <option>फैसलाले विगो भराएर कैद समेत हुने ठहराएको </option>
                            <option>फैसलाले विगो भराएर जरिवाना हुने ठहराएको </option>
                            <option>फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको </option>

                            <option>सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला भएको</option>
                            <option>सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला नभएको</option>
                            {{-- <option>फैसला भएको भए कार्यान्वयनको अवस्था</option> --}}
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">फैसला भएको भए कार्यान्वयनको अवस्था
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>
            </div>


            {{-- For ANother ROw --}}
            <div class="row">
                <span class="application_main_title">11. निवेदकको (ऋण/कर्जा लिने व्यक्ति) आर्थिक अवस्था:</span>
                <br>

                <span class="application_second_title">क. घरको विवरण:</span>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">अ. घरको संख्या
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">आ. घरले चर्चेको जग्गाको क्षेत्रफल
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="">इ. घरको किसिम (कच्ची/पक्की)
                        </label>

                        <select>
                            <option>कच्ची</option>
                            <option>पक्की</option>
                            <option>अन्य</option>
                        </select>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ई. घरको तला:
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <span class="application_second_title">उ. घर रहेको स्थान</span>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">प्रदेश</label>
                        <select id="state_id0" name="" data-iteration="0" class="form-control a_state_id">
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

                        <select id="a_district_id0" data-iteration="0" name="" class="form-control a_district_id">
                            <option value="">जिल्ला चयन गर्नुहोस्</option>
                        </select>
                    </div>
                </div>


                <div class="col-3">
                    <div class="form-group">
                        <label for="">स्थानिय तह</label>

                        <select id="a_localbody_id0" data-iteration="0" name=""
                            class="form-control a_localbody_id">
                            <option value="">स्थानीय तह चयन गर्नुहोस्
                            </option>
                        </select>

                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="">वडा</label>

                        <select id="a_wada_id" name="applicant_temp_ward" class="form-control col-md-12">
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
                            <option value="33">वडा नं. ३३</option>
                            <option value="34">वडा नं. ३४</option>
                            <option value="35">वडा नं. ३५</option>
                        </select>
                    </div>
                </div>



                <span class="application_second_title">ख. जग्गाको विवरण:</span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">कित्ता नं
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">क्षेत्रफल
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="">प्रदेश</label>
                        <select id="state_id0" name="" data-iteration="0" class="form-control a_state_id">
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

                        <select id="a_district_id0" data-iteration="0" name="" class="form-control a_district_id">
                            <option value="">जिल्ला चयन गर्नुहोस्</option>
                        </select>
                    </div>
                </div>


                <div class="col-3">
                    <div class="form-group">
                        <label for="">स्थानिय तह</label>

                        <select id="a_localbody_id0" data-iteration="0" name=""
                            class="form-control a_localbody_id">
                            <option value="">स्थानीय तह चयन गर्नुहोस्
                            </option>
                        </select>

                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="">वडा</label>

                        <select id="a_wada_id" name="applicant_temp_ward" class="form-control col-md-12">
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
                            <option value="33">वडा नं. ३३</option>
                            <option value="34">वडा नं. ३४</option>
                            <option value="35">वडा नं. ३५</option>
                        </select>
                    </div>
                </div>


            </div>


            {{-- Another Row Starts --}}
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <label for="">ग. सवारी साधनको विवरण
                        </label>

                        <textarea type="" value="" id="" name="" class="input-text" autofocus>

                        </textarea>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">घ. चल सम्पत्तिको विवरण
                        </label>

                        <textarea type="" value="" id="" name="" class="input-text" autofocus>

                        </textarea>

                    </div>
                </div>

            </div>


            {{-- Another Row Starts --}}
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <label for="">12. यो लेनदेनको सावाँ र ब्याजको सम्बन्धमा अन्य केही कुरा खुलाउनुपर्ने भए?
                        </label>
                        <textarea type="" value="" id="" name="" class="input-text" autofocus>

                        </textarea>

                    </div>
                </div>

            </div>

            {{-- Another Row Starts --}}
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <label for="">13. संलग्न कागजात फोटोकपी
                        </label>
                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>


                    </div>
                </div>

            </div>

            {{-- Another Row Starts --}}
            <div class="row">
                <span class="application_main_title">सहीछाप गर्नेको विवरण:</span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">नाम, थर
                        </label>
                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>


                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">मिति
                        </label>
                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>


                    </div>
                </div>

            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>



  

@endsection
