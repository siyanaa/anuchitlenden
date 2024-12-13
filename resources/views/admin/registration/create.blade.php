@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
<div id="registration_form" class="registration_form" data-registration="true"></div>
    <div class="mt-4">
        <div class="d-flex justify-content-between mb-4">

            <div class="border-bottom border-primary">
                <h2>
                    {{ $page_title }}
                </h2>
            </div>
            <div>
                <a href="{{ url()->previous() }}"><button class="btn-primary btn-sm"><i class="fa fa-angle-double-left"></i>
                    पछाडी जानुहाेस</button></a>
            <a href="{{ route('admin.registrations.create') }}"><button class="btn-success btn-sm"><i
                        class="fa fa-plus"></i>
                    सिर्जना गर्नुहाेस</button></a>
            <a href="{{ route('admin.registrations.index') }}"><button class="btn-info btn-sm"><i
                        class="fa fa-list"></i>
                    सुची</button></a>

            </div>
        </div>
    </div>




    <div class="form-container">


        <div>

            <div class="title-step-container">

                <div class="form-list-container">

                    <div class="form-list">
                        <span class="step">दर्ता</span>
                        <span class="step">निवेदकको विवरण</span>
                        <span class="step">विपक्षी/साहुको विवरण</span>
                        <span class="step">लेनदेनको विवरण</span>
                    </div>
                </div>

            </div>
            <form id="regForm" method="POST" action="{{ route('admin.registrations.store') }}">
                @csrf
                <div class="form-items-container">

                    <div class="tab">
                        <div class="tab-title-container">
                            <p class="tab-title">दर्ता</p>
                        </div>

                        
                        <div class="" style="width: 100%; display: flex; flex-direction: column; align-items: center;">
                            <div style="width: 500px;">
                                <div class="form-group mt-3">
                                    <label>दर्ता नं. <span class="must">*</span></label>
        
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('registration_id') }}" id="registration_id"
                                            name="registration_id" class="input-text" autofocus required>
                                    </div>
                                    @if ($errors->has('registration_id'))
                                        <span class="help-block danger">
                                            <strong>{{ $errors->first('registration_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group mt-3 ">
                                    <label>कारोबार रकम रु. <span class="must">*</span></label>
        
                                    <div class="col-sm-10">
                                        <input type="number" value="{{ old('transaction_amount') }}" id="transaction_amount"
                                            name="transaction_amount" class="input-text" autofocus required>
                                    </div>
                                    @if ($errors->has('transaction_amount'))
                                        <span class="help-block danger">
                                            <strong>{{ $errors->first('transaction_amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group mt-3 ">
                                    <label>लेनदेन भएको मिति <span class="must">*</span></label>
        
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('tansaction_date') }}" id="nepali-datepicker"
                                            name="tansaction_date" class="input-text" required>
                                    </div>
                                    @if ($errors->has('tansaction_date'))
                                        <span class="help-block danger">
                                            <strong>{{ $errors->first('tansaction_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="tab">
                        <div class="tab-title-container">
                            <p class="tab-title">निवेदकको विवरण</p>

                        </div>

                        <div class="d-flex flex-wrap" id="addApplicant">

                            <div class="form-group col-md-4 col-xs-12 mt-2">
                                <label>निवेदकको नाम <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('applicant.a_f_name.0') }}" id="a_f_name"
                                        name="applicant[full_name][]" class="input-text" autofocus required>
                                </div>
                                @if ($errors->has('applicant.full_name.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('applicant.full_name.0') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group col-md-4 col-xs-12 mt-2">
                                <label>निवेदकको सम्पर्क नं. <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('applicant.contact.0') }}" id="a_contact"
                                        name="applicant[contact][]" class="input-text" pattern="^\d{10}$" placeholder="१० अंककाे नंबर" required>
                                </div>
                                @if ($errors->has('applicant.contact.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('applicant.contact.0') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12 mt-2">
                                <label>प्रदेश <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <select id="state_id0" name="applicant[state_id][]" data-iteration="0" class="form-control col-md-12 a_state_id"
                                        required>
                                        <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('applicant.state_id.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('applicant.state_id.0') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12 mt-2">
                                <label>जिल्ला <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <select id="a_district_id0"  data-iteration="0" name="applicant[district_id][]"
                                        class="form-control col-md-12 a_district_id" required>
                                        <option value="{{ old('applicant.district_id.0') }}">जिल्ला चयन गर्नुहोस्</option>
                                    </select>
                                </div>
                                @if ($errors->has('applicant.district_id.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('applicant.district_id.0') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12 mt-2">
                                <label>स्थानीय तह <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <select id="a_localbody_id0" data-iteration="0" name="applicant[localbody_id][]"
                                        class="form-control col-md-12 a_localbody_id" required>
                                        <option value="{{ old('applicant.localbody_id.0') }}">स्थानीय तह चयन गर्नुहोस्</option>
                                    </select>
                                </div>
                                @if ($errors->has('applicant.localbody_id.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('applicant.localbody_id.0') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12 mt-2">
                                <label>वडा <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <select id="a_wada_id" name="applicant[wada_id][]" class="form-control col-md-12"
                                        required>
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
                                @if ($errors->has('applicant.wada_id.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('applicant.wada_id.0') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="newApplicantRow"></div>

                        <button id="addApplicantRow" type="button" class="btn btn-info">अर्को निवेदक थप्नुहोस्</button>

                    </div>

                    <div class="tab">
                        <div class="tab-title-container">
                            <p class="tab-title">विपक्षी/साहुको विवरण</p>
                        </div>
                        <div class="d-flex flex-wrap"  id="addOffender">

                            <div class="form-group col-md-4 col-xs-12">
                                <label>विपक्षी/साहुको नाम <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('offender.wada_id.0') }}" id="o_f_name"
                                        name="offender[full_name][]" class="input-text" autofocus required>
                                </div>
                                @if ($errors->has('offender.wada_id.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('offender.wada_id.0') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12">
                                <label>विपक्षी/साहुको सम्पर्क नं. <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('offender.contact.0') }}" id="o_contact"
                                        name="offender[contact][]" class="input-text" pattern="^\d{10}$" placeholder="१० अंककाे नंबर" required>
                                </div>
                                @if ($errors->has('offender.contact.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('offender.contact.0') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12">
                                <label>प्रदेश <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <select id="o_state_id0" name="offender[state_id][]" data-iteration="0" class="form-control col-md-12 o_state_id"
                                        required>
                                        <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('offender.state_id.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('offender.state_id.0') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12">
                                <label>जिल्ला <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <select id="o_district_id0" name="offender[district_id][]" data-iteration="0"  class="form-control col-md-12 o_district_id" required>
                                        <option value="{{ old('offender.district_id.0') }}">जिल्ला चयन गर्नुहोस्</option>
                                    </select>
                                </div>
                                @if ($errors->has('offender.district_id.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('offender.district_id.0') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12">
                                <label>स्थानीय तह <span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <select id="o_localbody_id0" name="offender[localbody_id][]"
                                        class="form-control col-md-12" required>
                                        <option value="{{ old('offender.localbody_id.0') }}">स्थानीय तह चयन गर्नुहोस्</option>
                                    </select>
                                </div>
                                @if ($errors->has('offender.localbody_id.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('offender.localbody_id.0') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group col-md-4 col-xs-12">
                                <label>वडा<span class="must">*</span></label>

                                <div class="col-sm-10">
                                    <select id="o_wada_id0" name="offender[wada_id][]" class="form-control col-md-12"
                                        required>
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
                                @if ($errors->has('offender.wada_id.0'))
                                    <span class="help-block danger">
                                        <strong>{{ $errors->first('offender.wada_id.0') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div id="newOffenderRow"></div>

                        <button id="addOffenderRow" type="button" class="btn btn-info">अर्को विपक्षी/साहुको थप्नुहोस्</button>

                    </div>

                    <div class="tab">
                        <div class="tab-title-container">
                            <p class="tab-title">लेनदेनको विवरण</p>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>कारोवारको प्रमाण <span class="must">*</span></label>

                            <div class="col-sm-10">
                                <div id="inputFormRow">
                                    <div class="input-group mb-3">
                                        <select id="proof" name="proof[proof_id][]" class="form-control col-md-12"
                                            required>
                                            <option  disabled selected value>कारोवारको प्रमाण चयन गर्नुहोस्</option>
                                            @foreach ($proofs as $proof)
                                                <option value="{{ $proof->id }}">{{ $proof->title }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="proof[amount][]" class="form-control m-input" required
                                            id="def">
                                        <div class="input-group-append">
                                            <button id="removeRow" type="button" class="btn btn-danger">हटाउनुहोस्</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="newRow"></div>
                                <button id="addRow" type="button" class="btn btn-info">कारोवारको प्रमाण थप्नुहोस्</button>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-xs-12 mt-4">
                            <label class="mb-2">कारोवारको प्रकृती <span class="must">*</span></label>

                            <div class="purposeandnature" style="display: flex; gap: 30px; flex-wrap: wrap; color: black; font-weight: 500;">
                                @foreach ($natures as $nature)
                                    <input type="checkbox" name="nature_id[]"
                                        value="{{ $nature->id }}">{{ $nature->title }}<br>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-xs-12 mt-4">
                            <label class="mb-2">लेनदेनको प्रयोजन <span class="must">*</span></label>

                            <div class="purposeandnature" style="">
                                @foreach ($purposes as $purpose)
                                    <input type="checkbox" name="purpose_id[]"
                                        value="{{ $purpose->id }}">{{ $purpose->title }}<br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bottom-section-container">
                    <div class="bottom-button-container">
                        <button class="btn btn-secondary" type="button" id="prevBtn" onclick="nextPrev(-1)">
                            Previous
                        </button>
                        <button class="btn btn-primary" type="button" id="nextBtn"
                            onclick="nextPrev(1)">Next</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script>
        $(document).ready(function() {

            //for applicant dynamic drop down
            var counter = 0;    
            $(document).on('change', '.a_state_id', function() {
                var a_state_id = $(this).val();
                // Retrieve and log the data attribute value
                var currentiteration = $(this).data("iteration");
                var append_to = 'a_district_id'+currentiteration;
                var next_append = 'a_localbody_id'+currentiteration;
                fetchDistrict(a_state_id, append_to, next_append);
            });

            $(document).on('change', '.a_district_id', function() {
                var a_district_id = $(this).val();
                // Retrieve and log the data attribute value
                var currentiteration = $(this).data("iteration");
                var append_to = 'a_localbody_id'+currentiteration;
                fetchLocalGoverment(a_district_id, append_to);
            });


            //for offender dynamic drop down
            $(document).on('change', '.o_state_id', function() {
                var o_state_id = $(this).val();
                // Retrieve  current dynamic form
                var currentiteration = $(this).data("iteration");
                var append_to = 'o_district_id'+currentiteration;
                var next_append = 'o_localbody_id'+currentiteration;
                console.log(append_to);
                console.log(next_append);
                fetchDistrict(o_state_id, append_to, next_append);
            });

            $(document).on('change', '.o_district_id', function() {
                var o_district_id = $(this).val();
                // Retrieve current dynamic form
                var currentiteration = $(this).data("iteration");
                var append_to = 'o_localbody_id'+currentiteration;
                fetchLocalGoverment(o_district_id, append_to);
            });

            function fetchDistrict(stateId, append_to, next_append = null) {
                $.ajax({
                    url: '/admin/registration/get-districts/' + stateId,
                    type: 'GET',
                    success: function(response) {

                        var clearThisData = $('#' + append_to + '').empty();
                        var clearNextToThisData = $('#' + next_append + '').empty();
                        if (response.length > 0) {
                            $('#' + append_to + '').append('<option disabled selected value>जिल्ला चयन गर्नुहोस्</option>');
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
                            $('#' + append_to + '').append('<option disabled selected value>स्थानीय तह चयन गर्नुहोस्</option>');
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

            //for dynamic input field

            $('#abc').change(function() {
                $('#xyz').append(new Option("Demo", "demo"));
                $('#xyz').append(new Option("Demo1", "demo1"));
            });
            $('#xyz').click(function() {
                var val = $("#xyz option:selected").val();
                $('#def').val(val);
            });
            // for dynamic proof of transaction
            // add row in proof of transaction
            $("#addRow").click(function() {
                var html = '';
                html += '<div id="inputFormRow">';
                html += '<div class="input-group mb-3">';
                html +=
                    '<select id="proof_id" name="proof[proof_id][]" class="form-control col-md-12" required><option  disabled selected value>कारोवारको प्रमाण चयन गर्नुहोस्</option>@foreach ($proofs as $proof)<option value="{{ $proof->id }}">{{ $proof->title }}</option>@endforeach</select>';

                html +=
                    '<input type="text" name="proof[amount][]" class="form-control m-input" id="def" required>';

                html += '<div class="input-group-append">';
                html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
                html += '</div>';
                html += '</div>';

                $('#newRow').append(html);
            });

            // remove row in proof of transaction
            $(document).on('click', '#removeRow', function() {
                $(this).closest('#inputFormRow').remove();
            });
            
            //for dynamic applicant
            // add row in multiple application
            var counter = 0;
            $("#addApplicantRow").click(function() {
                counter++;

                var newIdcount = counter;
                var html = '';
                html += '<div class="d-flex  flex-wrap" id="addApplicant">';
                html += '<div class="form-group col-md-4 col-xs-12 mt-2"><label>निवेदकको नाम <span class="must">*</span></label><div class="col-sm-10"><input type="text" id="a_f_name" name="applicant[full_name][]" class="input-text" autofocus required></div></div>';
                html += '<div class="form-group col-md-4 col-xs-12 mt-2"> <label>निवेदकको सम्पर्क नं. <span class="must">*</span> </label><div class="col-sm-10"><input type="text" id="a_contact" name="applicant[contact][]" class="input-text" pattern="^\d{10}$" placeholder="10 Digit Number" required> </div></div>';

                html +='<div class="form-group col-md-4 col-xs-12 mt-2"><label>प्रदेश <span class="must">*</span> </label><div class="col-sm-10"><select id="state_id'+newIdcount+'" name="applicant[state_id][]" data-iteration="'+newIdcount+'"  class="form-control col-md-12 a_state_id"required><option disabled selected value>प्रदेश चयन गर्नुहोस्</option>@foreach ($states as $state)<option value="{{ $state->id }}">{{ $state->name }}</option>@endforeach</select></div></div>';

                html += '<div class="form-group col-md-4 col-xs-12 mt-2"><label>जिल्ला <span class="must">*</span> </label><div class="col-sm-10"><select id="a_district_id'+newIdcount+'"  data-iteration="'+newIdcount+'" name="applicant[district_id][]" class="form-control col-md-12 a_district_id" required><option disabled selected value>जिल्ला चयन गर्नुहोस्</option></select></div></div>';
                html += '<div class="form-group col-md-4 col-xs-12 mt-2"><label>स्थानीय तह <span class="must">*</span> </label><div class="col-sm-10"><select id="a_localbody_id'+newIdcount+'"  data-iteration="'+newIdcount+'" name="applicant[localbody_id][]" class="form-control col-md-12 a_localbody_id" required><option disabled selected value>स्थानीय तह चयन गर्नुहोस् </option></select></div></div>';
                html += '<div class="form-group col-md-4 col-xs-12 mt-2"><label>वडा <span class="must">*</span> </label><div class="col-sm-10"><select id="a_wada_id" name="applicant[wada_id][]" class="form-control col-md-12" required><option disabled selected value>वडा चयन गर्नुहोस्</option><option value="1">वडा नं. १</option><option value="2">वडा नं. २</option><option value="3">वडा नं. ३</option><option value="4">वडा नं. ४</option><option value="5">वडा नं. ५</option><option value="6">वडा नं. ६</option><option value="7">वडा नं. ७</option><option value="8">वडा नं. ८</option><option value="9">वडा नं. ९</option><option value="10">वडा नं. १०</option><option value="11">वडा नं. ११</option><option value="12">वडा नं. १२</option><option value="13">वडा नं. १३</option><option value="14">वडा नं. १४</option><option value="15">वडा नं. १५</option><option value="16">वडा नं. १६</option><option value="17">वडा नं. १७</option><option value="18">वडा नं. १८</option><option value="19">वडा नं. १९</option><option value="20">वडा नं. २०</option><option value="21">वडा नं. २१</option><option value="22">वडा नं. २२</option><option value="23">वडा नं. २३</option><option value="24">वडा नं. २४</option><option value="25">वडा नं. २५</option><option value="26">वडा नं. २६</option><option value="27">वडा नं. २७</option><option value="28">वडा नं. २८</option><option value="29">वडा नं. २९</option><option value="30">वडा नं. ३०</option><option value="31">वडा नं. ३१</option><option value="32">वडा नं. ३२</option><option value="33">वडा नं. ३३</option><option value="34">वडा नं. ३४</option><option value="35">वडा नं. ३५</option></select></div></div>';
                html += '<button id="removeApplicationRow" type="button" class="btn btn-danger">हटाउनुहोस्</button>';
                html += '</div>';

                $('#newApplicantRow').append(html);
            });

            // remove row in multiple applicant
            $(document).on('click', '#removeApplicationRow', function() {
                $(this).closest('#addApplicant').remove();
            });
            
            //for dynamic offender
            // add row in multiple offender
            var counter = 0;
            $("#addOffenderRow").click(function() {
                counter++;

                var newIdcount = counter;
                var html = '';
                html += '<div class="d-flex  flex-wrap" id="addOffender">';
                html += '<div class="form-group col-md-4 col-xs-12 mt-2"><label>विपक्षी/साहुको नाम <span class="must">*</span></label><div class="col-sm-10"><input type="text" id="o_f_name" name="offender[full_name][]" class="input-text" autofocus required></div></div>';
                html += '<div class="form-group col-md-4 col-xs-12 mt-2"> <label>विपक्षी/साहुको सम्पर्क नं. <span class="must">*</span> </label><div class="col-sm-10"><input type="text" id="o_contact" name="offender[contact][]" class="input-text" pattern="^\d{10}$" placeholder="10 Digit Number" required> </div></div>';

                html +='<div class="form-group col-md-4 col-xs-12 mt-2"><label>प्रदेश <span class="must">*</span> </label><div class="col-sm-10"><select id="state_id'+newIdcount+'" name="offender[state_id][]" data-iteration="'+newIdcount+'"  class="form-control col-md-12 o_state_id"required><option disabled selected value>प्रदेश चयन गर्नुहोस्</option>@foreach ($states as $state)<option value="{{ $state->id }}">{{ $state->name }}</option>@endforeach</select></div></div>';

                html += '<div class="form-group col-md-4 col-xs-12 mt-2"><label>जिल्ला <span class="must">*</span> </label><div class="col-sm-10"><select id="o_district_id'+newIdcount+'"  data-iteration="'+newIdcount+'" name="offender[district_id][]" class="form-control col-md-12 o_district_id" required><option  disabled selected value>जिल्ला चयन गर्नुहोस्</option></select></div></div>';
                html += '<div class="form-group col-md-4 col-xs-12 mt-2"><label>स्थानीय तह <span class="must">*</span> </label><div class="col-sm-10"><select id="o_localbody_id'+newIdcount+'"  data-iteration="'+newIdcount+'" name="offender[localbody_id][]" class="form-control col-md-12 o_localbody_id" required><option  disabled selected value>स्थानीय तह चयन गर्नुहोस् </option></select></div></div>';
                html += '<div class="form-group col-md-4 col-xs-12 mt-2"><label>वडा <span class="must">*</span> </label><div class="col-sm-10"><select id="o_wada_id" name="offender[wada_id][]" class="form-control col-md-12" required><option  disabled selected value>वडा चयन गर्नुहोस्</option><option value="1">वडा नं. १</option><option value="2">वडा नं. २</option><option value="3">वडा नं. ३</option><option value="4">वडा नं. ४</option><option value="5">वडा नं. ५</option><option value="6">वडा नं. ६</option><option value="7">वडा नं. ७</option><option value="8">वडा नं. ८</option><option value="9">वडा नं. ९</option><option value="10">वडा नं. १०</option><option value="11">वडा नं. ११</option><option value="12">वडा नं. १२</option><option value="13">वडा नं. १३</option><option value="14">वडा नं. १४</option><option value="15">वडा नं. १५</option><option value="16">वडा नं. १६</option><option value="17">वडा नं. १७</option><option value="18">वडा नं. १८</option><option value="19">वडा नं. १९</option><option value="20">वडा नं. २०</option><option value="21">वडा नं. २१</option><option value="22">वडा नं. २२</option><option value="23">वडा नं. २३</option><option value="24">वडा नं. २४</option><option value="25">वडा नं. २५</option><option value="26">वडा नं. २६</option><option value="27">वडा नं. २७</option><option value="28">वडा नं. २८</option><option value="29">वडा नं. २९</option><option value="30">वडा नं. ३०</option><option value="31">वडा नं. ३१</option><option value="32">वडा नं. ३२</option><option value="33">वडा नं. ३३</option><option value="34">वडा नं. ३४</option><option value="35">वडा नं. ३५</option></select></div></div>';
                html += '<button id="removeOffenderRow" type="button" class="btn btn-danger">हटाउनुहोस्</button>';
                html += '</div>';

                $('#newOffenderRow').append(html);
            });

            // remove row in multiple applicant
            $(document).on('click', '#removeOffenderRow', function() {
                $(this).closest('#addOffender').remove();
            });

        });

    </script>
@endsection
