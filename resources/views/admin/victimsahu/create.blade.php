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

        .purposeandnature {
            font-size: 14px
        }
    </style>

    <form id="quickForm" novalidate="novalidate" method="POST" action="" class="form-inline">
        @csrf
        <div class="card-body">

            <div class="row">
                <span class="application_main_title">1. निवेदक(ऋण/कर्जा दिने व्यक्ति) को विवरण:</span>
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
                        <label for="registrations">नागरिकता जारी जिल्ला</label>

                        <input type="text" value="" id="" name="" class="input-text" autofocus>

                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="">नागरिकता जारी मिती</label>

                        <input type="text" value="" id="nepali-datepicker" name="" class="input-text"
                            autofocus>

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

                        <select id="a_district_id0" data-iteration="0" name=""
                            class="form-control a_district_id">
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

                        <select id="a_district_id0" data-iteration="0" name=""
                            class="form-control a_district_id">
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
            {{-- First Row Ends --}}

            {{-- For ANother ROw --}}
            <div class="row">
                <span class="application_main_title">1. आर्थिक अवस्था:</span>
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

                        <select id="a_district_id0" data-iteration="0" name=""
                            class="form-control a_district_id">
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

                        <select id="a_district_id0" data-iteration="0" name=""
                            class="form-control a_district_id">
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

                <span class="application_second_title">ङ. बैङ्क तथा वित्तिय संस्था (सहकारी/लघुवित्त समेत) बाट ऋण लिएको
                    भए:</span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">अ. संस्थाको नाम
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">आ. शाखा
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">इ. कर्जाको दायित्व
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ई. तिर्न बाँकी कर्जा रकम
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>


            </div>



            <div class="row">
                <span class="application_main_title">2. विपक्षी (ऋण/कर्जा लिने व्यक्ति) को विवरण:</span>

                <span class="application_second_title">क. कर्जा लिने व्यक्तिको</span>
                <div class="col-12">
                    <div class="form-group">
                        <label for="applicant_name">नाम, थर</label>

                        <input type="text" value="" id="applicant_name" name="" class="input-text"
                            autofocus>
                    </div>
                </div>

                <span class="application_second_title">ठेगाना:</span>

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

                        <select id="a_district_id0" data-iteration="0" name=""
                            class="form-control a_district_id">
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

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ख. कर्जा कारोबार भएको मिति</label>

                        <input type="" value="" id="nepali-datepicker" name="" class="input-text"
                            autofocus>

                    </div>
                </div>



                <div class="col-6">
                    <div class="form-group">
                        <label for="">ग. कर्जा कारोबार भएको रकम</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <span class="application_main_title">घ. कारोवार गरेको माध्यम :</span>
                <div class="col-12">

                    <div class="form-group col-md-4">
                        <label for="">माध्यम</label>

                        <select id="" name="" class="form-control" required>
                            <option disabled selected value>माध्यम चयन गर्नुहोस्</option>
                            @foreach ($proofs as $proof)
                                <option value="{{ $proof->id }}">{{ $proof->title }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="">ङ. अन्य व्यक्तिलाई ऋण दिएको भए अन्य ऋणीको संख्या</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">कुल ऋण रकम</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="">च. लिखत वडा कार्यालयमा दर्ता भएको </label>

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
            {{-- Row of offender ends here --}}

            {{-- start of row --}}

            <div class="row">
                <span class="application_main_title">3. यो लेनदेन कारोबारको रकमबाट हालसम्म प्राप्त गरेको ब्याज रकम:</span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">क. नगद</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ख. चेक</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ग. जिन्सी</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">घ. अन्य</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

            </div>
            {{--  end of row --}}

            {{-- start of row --}}

            <div class="row">
                <span class="application_main_title">4. यो लेनदेनको कारोबारबाट हालसम्मको प्राप्त मुलधन रकम:</span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">क. नगद</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ख. चेक</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ग. जिन्सी</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">घ. अन्य</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

            </div>
            {{--  end of row --}}

            {{-- start of row --}}

            <div class="row">
                <span class="application_main_title">5. उजुरी कर्ता सँग असुल गर्न बाँकी कर्जा रकम: </span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">सावाँ</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">व्याज</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

            </div>
            {{--  end of row --}}


            {{-- start of row --}}

            <div class="row">
                <span class="application_main_title">6. ऋण/कर्जा दिएको बखत जग्गा राजिनामा/दृष्टिबन्धक पारित गरिएको
                    भए:</span>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">क. साविकको जग्गा धनीको नाम, थर</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ख. ऋणीको नाम, थर</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">ग. जग्गा पारित गरी लिएको व्यक्तिको नाम, थर</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">घ. लिखत रजिष्ट्रेशन गराई लिने व्यक्तिसँग तपाईको नाता, सम्बन्ध:</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="">ङ. जग्गाको कित्ता नं
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


                <span class="application_second_title">च. जग्गा रहेको स्थान</span>
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

                        <select id="a_district_id0" data-iteration="0" name=""
                            class="form-control a_district_id">
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


                <div class="col-12">
                    <div class="form-group">
                        <label for="">छ. जग्गा रजिष्ट्रेशन भएको मिति
                        </label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

            </div>
            {{--  end of row --}}




            {{-- Another Row Ends --}}

            <div class="row">
                <span class="application_main_title">7. ऋण/कर्जा दिएको बखत</span>
                <div class="col-12">

                    <div class="form-group">
                        <label for="">ऋणी सँग बैंक चेक लेखाई लिएको </label>

                        <select id="" name="" class="">
                            <option>छ</option>
                            <option>छैन</option>
                        </select>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">क. चेक उपलब्ध गराउने व्यक्तिको नाम, थर</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ख. चेक प्राप्त गर्ने व्यक्तिको नाम, थर</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ग. चेक काटेको मिति</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">घ. चेक बाउन्स भएको मिति</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">ङ. चेकमा उल्लेख भएको रकम</label>

                        <input type="" value="" id="" name="" class="input-text"
                            autofocus>

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">च. चेक सम्बन्धी अन्य विवरण</label>

                        <textarea>

                        </textarea>

                    </div>
                </div>



            </div>


            {{-- Another Row Ends --}}


            {{-- Row ends --}}
            <div class="row">
                <span class="application_main_title">8. ऋण/कर्जा कारोवारको सम्बन्धमा निज ऋणीको विरुद्धमा अदालतमा </span>

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
                            <option>फैसला भैसकेको</option>
                            <option>फैसला भई फैसला कार्यान्वयन भई सकेको</option>
                            <option>फैसला भई फैसला कार्यान्वयनको क्रममा रहेको</option>
                            <option>फैसला भई फैसला कार्यान्वयन हुन बाँकी रहेको</option>
                            <option>आशिंक रुपमा फैसला कार्यान्वयन भएको</option>

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

                <div class="col-12">
                    <div class="form-group">
                        <label for="">ग. नपुग बिगो वापत ऋणि कैदमा रहेको अवस्था </label>

                        <select name="">
                            <option>छ</option>
                            <option>छैन</option>
                        </select>

                    </div>
                </div>

            </div>


            {{-- Row ends --}}
            <div class="row">
                <span class="application_main_title">9. अदालतबाट मुद्दा फैसला भइसकेको भए </span>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">सजाय</label>

                        <select name="">
                            <option>विगो भराउने/जरिवाना/कैद तीनै प्रकारको सजाय भएको</option>
                            <option>बिगो भराउने र जरिवाना मात्र भएको</option>
                        </select>
                    </div>
                </div>

            </div>


              {{-- Row ends --}}
            <div class="row">
                <span class="application_main_title">10. कर्जा लेनदेनको क्रममा दृष्टिबन्धक/राजीनामा पारित गरेको भए घर/जग्गा हाल कसले भोगचलन गरिरहेको छ?</span>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">भोगचलन गर्ने</label>
                        <input type="" value="" id="" name="" class="input-text"
                        autofocus>
                    </div>
                </div>

            </div>


        {{-- Row Starts --}}
            <div class="row">
                <span class="application_main_title">11.रजिष्ट्रेशन पारित गर्दा छुट्टै शर्तनामाको</span>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">कागज गरिएको</label>
                        <select>
                            <option>थियो</option>
                            <option>थिएन</option>
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">गरिएको भए के शर्त राखिएको</label>
                        <textarea>
                            
                        </textarea>
                    </div>
                </div>

            </div>


        {{-- Row Starts --}}
            <div class="row">
                <span class="application_main_title">12. यो लेनदेन सम्बन्धमा</span>


                <div class="col-12">
                    <div class="form-group">
                        <label for="">अन्य केही कुरा खुलाउनुपर्ने भए</label>
                        <textarea>

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
