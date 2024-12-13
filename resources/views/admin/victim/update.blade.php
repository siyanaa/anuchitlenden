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
            <form id="regForm" method="POST" action="{{ route('admin.registrations.update') }}">
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
                                        <input type="text" value="{{ $registration->id }}" id="registration_id" name="id" hidden>
                                        <input type="text"
                                            value="{{ substr($registration->registration_id, strpos($registration->registration_id, '_') + 1) }}"
                                            id="registration_id" name="registration_id" class="input-text" autofocus required>
                                    </div>
                                    @if ($errors->has('registration_id'))
                                        <span class="help-block danger">
                                            <strong>{{ $errors->first('registration_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group mt-3">
                                    <label>कारोबार रकम रु. <span class="must">*</span></label>

                                    <div class="col-sm-10">
                                        <input type="text" value="{{ $registration->transaction_amount }}" id="transaction_amount"
                                            name="transaction_amount" class="input-text" autofocus required>
                                    </div>
                                    @if ($errors->has('transaction_amount'))
                                        <span class="help-block danger">
                                            <strong>{{ $errors->first('transaction_amount') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group mt-3">
                                    <label>लेनदेन भएको मिति <span class="must">*</span></label>

                                    <div class="col-sm-10">
                                        <input type="text" value="{{ \Carbon\Carbon::parse($registration->tansaction_date)->format('Y-m-d') }}" id="nepali-datepicker"
                                            name="tansaction_date" class="input-text" required>
                                    </div>
                                    @if ($errors->has('transaction_date'))
                                        <span class="help-block danger">
                                            <strong>{{ $errors->first('transaction_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab">

                        <div id="applicant_ids">

                            <div class="tab-title-container">
                                <p class="tab-title">निवेदकको विवरण</p>
                            </div>
                            @foreach ($registration->applicant as $key => $applicants)
                                <div class="d-flex flex-wrap" id="addApplicant1">
                                    <div class="form-group col-md-4 col-xs-12">
                                        <label>निवेदकको नाम <span class="must">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $applicants->full_name }}" id="a_f_name"
                                                name="applicant[full_name][]" class="input-text" autofocus required>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-4 col-xs-12">
                                        <label>निवेदकको सम्पर्क नं. <span class="must">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $applicants->contact }}" id="a_contact"
                                                name="applicant[contact][]" class="input-text" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-xs-12">
                                        <label>प्रदेश <span class="must">*</span></label>

                                        <div class="col-sm-10">
                                            <select id="state_id{{ $key }}" name="applicant[state_id][]"
                                                data-iteration="{{ $key }}"
                                                class="form-control col-md-12 a_state_id" required>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"
                                                        {{ $applicants->state_id == $state->id ? ' selected' : '' }}>
                                                        {{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-xs-12">
                                        <label>जिल्ला <span class="must">*</span></label>


                                        <div class="col-sm-10">
                                            <select id="a_district_id{{ $key }}"
                                                data-iteration="{{ $key }}" name="applicant[district_id][]"
                                                class="form-control col-md-12 a_district_id" required>
                                                @foreach ($applicants->district_bystate($applicants->state_id) as $state_district)
                                                    <option value="{{ $state_district->id }}"
                                                        {{ $applicants->district_id == $state_district->id ? ' selected' : '' }}>
                                                        {{ $state_district->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-xs-12">
                                        <label>स्थानीय तह <span class="must">*</span></label>

                                        <div class="col-sm-10">
                                            <select id="a_localbody_id{{ $key }}"
                                                data-iteration="{{ $key }}" name="applicant[localbody_id][]"
                                                class="form-control col-md-12 a_localbody_id" required>
                                                @foreach ($applicants->localbody_bydistrict($applicants->district_id) as $locallevel)
                                                    <option value="{{ $locallevel->id }}"
                                                        {{ $applicants->localbody_id == $locallevel->id ? ' selected' : '' }}>
                                                        {{ $locallevel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-xs-12">
                                        <label>वडा <span class="must">*</span></label>

                                        <div class="col-sm-10">
                                            <select id="a_wada_id" name="applicant[wada_id][]"
                                                class="form-control col-md-12" required>
                                                @for ($i = 0; $i < 15; $i++)
                                                    <option value="{{ $i + 1 }}"
                                                        {{ $applicants->wada_id == $i + 1 ? ' selected' : '' }}>Wada No.
                                                        {{ $i + 1 }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    @if ($key > 0)
                                        <button id="removeApplicationRow1" type="button"
                                            class="btn btn-danger">हटाउनुहोस्</button>
                                    @endif
                                </div>
                            @endforeach

                            <div id="newApplicantRow"></div>

                            <button id="addApplicantRow" type="button" class="btn btn-info">अर्को निवेदक थप्नुहोस्</button>
                        </div>
                    </div>

                    <div class="tab">
                        <div class="tab-title-container">
                            <p class="tab-title">विपक्षी/साहुको विवरण</p>
                        </div>

                        @foreach ($registration->offender as $key => $offenders)
                            <div class="d-flex flex-wrap" id="addOffender1">
                                <div class="form-group col-md-4 col-xs-12">
                                    <label>विपक्षी/साहुको नाम <span class="must">*</span></label>

                                    <div class="col-sm-10">
                                        <input type="text" value="{{ $offenders->full_name }}" id="o_f_name"
                                            name="offender[full_name][]" class="input-text" autofocus required>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-xs-12">
                                    <label>विपक्षी/साहुको सम्पर्क नं. <span class="must">*</span></label>

                                    <div class="col-sm-10">
                                        <input type="text" value="{{ $offenders->contact }}" id="o_contact"
                                            name="offender[contact][]" class="input-text" required>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-xs-12">
                                    <label>प्रदेश <span class="must">*</span></label>

                                    <div class="col-sm-10">
                                        <select id="o_state_id{{ $key }}" name="offender[state_id][]"
                                            data-iteration="{{ $key }}"
                                            class="form-control col-md-12 o_state_id" required>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}"
                                                    {{ $offenders->state_id == $state->id ? ' selected' : '' }}>
                                                    {{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-xs-12">
                                    <label>जिल्ला <span class="must">*</span></label>

                                    <div class="col-sm-10">
                                        <select id="o_district_id{{ $key }}" name="offender[district_id][]"
                                            data-iteration="{{ $key }}"
                                            class="form-control col-md-12 o_district_id" required>
                                            @foreach ($offenders->district_bystate($offenders->state_id) as $state_district)
                                                <option value="{{ $state_district->id }}"
                                                    {{ $offenders->district_id == $state_district->id ? ' selected' : '' }}>
                                                    {{ $state_district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-xs-12">
                                    <label>स्थानीय तह <span class="must">*</span></label>

                                    <div class="col-sm-10">
                                        <select id="o_localbody_id{{ $key }}"
                                            data-iteration="{{ $key }}" name="offender[localbody_id][]"
                                            class="form-control col-md-12" required>
                                            @foreach ($offenders->localbody_bydistrict($offenders->district_id) as $locallevel)
                                                <option value="{{ $locallevel->id }}"
                                                    {{ $offenders->localbody_id == $locallevel->id ? ' selected' : '' }}>
                                                    {{ $locallevel->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group col-md-4 col-xs-12">
                                    <label>वडा<span class="must">*</span></label>

                                    <div class="col-sm-10">
                                        <select id="o_wada_id0" name="offender[wada_id][]" class="form-control col-md-12"
                                            required>
                                            @for ($i = 0; $i < 15; $i++)
                                                <option value="{{ $i + 1 }}"
                                                    {{ $offenders->wada_id == $i + 1 ? ' selected' : '' }}>Wada No.
                                                    {{ $i + 1 }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                @if ($key > 0)
                                    <button id="removeOffenderRow1" type="button" class="btn btn-danger">हटाउनुहोस्</button>
                                @endif
                            </div>
                        @endforeach

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
                                @foreach ($registration->transaction_proofss as $key => $trans_proof)
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                            <select id="proof" name="proof[proof_id][]"
                                                class="form-control col-md-12" required>
                                                @foreach ($proofs as $proof)
                                                    <option value="{{ $proof->id }}"
                                                        {{ $trans_proof->proof_id == $proof->id ? ' selected' : '' }}>
                                                        {{ $proof->title }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="proof[amount][]"
                                                value="{{ $trans_proof->amount }}" class="form-control m-input" required
                                                id="def">
                                            <div class="input-group-append">
                                                <button id="removeRow" type="button"
                                                    class="btn btn-danger">हटाउनुहोस्</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div id="newRow"></div>
                                <button id="addRow" type="button" class="btn btn-info">कारोवारको प्रमाण थप्नुहोस्</button>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-xs-12 mt-4">
                            <label class="mb-2">कारोवारको प्रकृती <span class="must">*</span></label>
                            <div class="purposeandnature" style="display: flex; gap: 30px; flex-wrap: wrap; color: black; font-weight: 500;">
                                @foreach ($natures as $nature)
                                    <input type="checkbox" name="nature_id[]" value="{{ $nature->id }}"
                                        {{ in_array($nature->id, $registration->transaction_nature->pluck('nature_id')->toArray()) ? 'checked' : '' }}>{{ $nature->title }}
                                @endforeach
                            </div>

                        </div>

                        <div class="form-group col-md-12 col-xs-12 mt-4">
                            <label class="mb-2">लेनदेनको प्रयोजन <span class="must">*</span></label>

                            <div class="purposeandnature">
                                @foreach ($purposes as $purpose)
                                    <input type="checkbox" name="purpose_id[]" value="{{ $purpose->id }}"
                                        {{ in_array($purpose->id, $registration->transaction_purpose->pluck('purpose_id')->toArray()) ? 'checked' : '' }}>{{ $purpose->title }}<br>
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
                var append_to = 'a_district_id' + currentiteration;
                var next_append = 'a_localbody_id' + currentiteration;
                fetchDistrict(a_state_id, append_to, next_append);
            });

            $(document).on('change', '.a_district_id', function() {
                var a_district_id = $(this).val();
                // Retrieve and log the data attribute value
                var currentiteration = $(this).data("iteration");
                var append_to = 'a_localbody_id' + currentiteration;
                fetchLocalGoverment(a_district_id, append_to);
            });


            //for offender dynamic drop down
            $(document).on('change', '.o_state_id', function() {
                var o_state_id = $(this).val();
                // Retrieve  current dynamic form
                var currentiteration = $(this).data("iteration");
                var append_to = 'o_district_id' + currentiteration;
                var next_append = 'o_localbody_id' + currentiteration;
                console.log(append_to);
                console.log(next_append);
                fetchDistrict(o_state_id, append_to, next_append);
            });

            $(document).on('change', '.o_district_id', function() {
                var o_district_id = $(this).val();
                // Retrieve current dynamic form
                var currentiteration = $(this).data("iteration");
                var append_to = 'o_localbody_id' + currentiteration;
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
                    '<select id="proof_id" name="proof[proof_id][]" class="form-control col-md-12" required><option  disabled selected value>Select Proof Of Transaction</option>@foreach ($proofs as $proof)<option value="{{ $proof->id }}">{{ $proof->title }}</option>@endforeach</select>';

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
            $("#addApplicantRow").click(function() {
                var lastSelect = $('#applicant_ids').find('.a_state_id:last');
                var dataIteration = lastSelect.data('iteration');
                dataIteration++

                var newIdcount = dataIteration;
                var html = '';
                html += '<div class="d-flex  flex-wrap" id="addApplicant">';
                html +=
                    '<div class="form-group col-md-4 col-xs-12"><label>Applicant Name <em>*</em></label><div class="col-sm-10"><input type="text" id="a_f_name" name="applicant[full_name][]" class="input-text" autofocus required></div></div>';
                html +=
                    '<div class="form-group col-md-4 col-xs-12"> <label>Applicant Contact No. <em>*</em> </label><div class="col-sm-10"><input type="text" id="a_contact" name="applicant[contact][]" class="input-text" required> </div></div>';

                html +=
                    '<div class="form-group col-md-4 col-xs-12"><label>Applicant State <em>*</em> </label><div class="col-sm-10"><select id="state_id' +
                    newIdcount + '" name="applicant[state_id][]" data-iteration="' + newIdcount +
                    '"  class="form-control col-md-12 a_state_id"required><option disabled selected value>Select State</option>@foreach ($states as $state)<option value="{{ $state->id }}">{{ $state->name }}</option>@endforeach</select></div></div>';

                html +=
                    '<div class="form-group col-md-4 col-xs-12"><label>Applicant District <em>*</em> </label><div class="col-sm-10"><select id="a_district_id' +
                    newIdcount + '"  data-iteration="' + newIdcount +
                    '" name="applicant[district_id][]" class="form-control col-md-12 a_district_id" required><option disabled selected value>Select District</option></select></div></div>';
                html +=
                    '<div class="form-group col-md-4 col-xs-12"><label>Applicant Local Goverment <em>*</em> </label><div class="col-sm-10"><select id="a_localbody_id' +
                    newIdcount + '"  data-iteration="' + newIdcount +
                    '" name="applicant[localbody_id][]" class="form-control col-md-12 a_localbody_id" required><option disabled selected value>Select Local Government </option></select></div></div>';
                html +=
                    '<div class="form-group col-md-4 col-xs-12"><label>Applicant Wada No. <em>*</em> </label><div class="col-sm-10"><select id="a_wada_id" name="applicant[wada_id][]" class="form-control col-md-12" required><option disabled selected value>Select Local Government Wada</option><option value="1">Wada No.1</option><option value="2">Wada No.2</option><option value="3">Wada No.3</option><option value="4">Wada No.4</option><option value="5">Wada No.5</option><option value="6">Wada No.6</option><option value="7">Wada No.7</option><option value="8">Wada No.8</option><option value="9">Wada No.9</option><option value="10">Wada No.10</option><option value="11">Wada No.11</option><option value="12">Wada No.12</option></select></div></div>';
                html +=
                    '<button id="removeApplicationRow" type="button" class="btn btn-danger">Remove</button>';
                html += '</div>';

                $('#newApplicantRow').append(html);
            });

            // remove row in multiple applicant
            $(document).on('click', '#removeApplicationRow', function() {
                $(this).closest('#addApplicant').remove();
            });
            $(document).on('click', '#removeApplicationRow1', function() {
                $(this).closest('#addApplicant1').remove();
            });

            //for dynamic offender
            // add row in multiple offender
            $("#addOffenderRow").click(function() {
                var lastSelect = $('#applicant_ids').find('.a_state_id:last');
                var dataIteration = lastSelect.data('iteration');
                dataIteration++

                var newIdcount = dataIteration;
                var html = '';
                html += '<div class="d-flex  flex-wrap" id="addOffender">';
                html +=
                    '<div class="form-group col-md-4 col-xs-12"><label>Applicant Name <em>*</em></label><div class="col-sm-10"><input type="text" id="o_f_name" name="offender[full_name][]" class="input-text" autofocus required></div></div>';
                html +=
                    '<div class="form-group col-md-4 col-xs-12"> <label>Applicant Contact No. <em>*</em> </label><div class="col-sm-10"><input type="text" id="o_contact" name="offender[contact][]" class="input-text" required> </div></div>';

                html +=
                    '<div class="form-group col-md-4 col-xs-12"><label>Applicant State <em>*</em> </label><div class="col-sm-10"><select id="state_id' +
                    newIdcount + '" name="offender[state_id][]" data-iteration="' + newIdcount +
                    '"  class="form-control col-md-12 o_state_id"required><option  disabled selected value>Select State</option>@foreach ($states as $state)<option value="{{ $state->id }}">{{ $state->name }}</option>@endforeach</select></div></div>';

                html +=
                    '<div class="form-group col-md-4 col-xs-12"><label>Applicant District <em>*</em> </label><div class="col-sm-10"><select id="o_district_id' +
                    newIdcount + '"  data-iteration="' + newIdcount +
                    '" name="offender[district_id][]" class="form-control col-md-12 o_district_id" required><option  disabled selected value>Select District</option></select></div></div>';
                html +=
                    '<div class="form-group col-md-4 col-xs-12"><label>Applicant Local Goverment <em>*</em> </label><div class="col-sm-10"><select id="o_localbody_id' +
                    newIdcount + '"  data-iteration="' + newIdcount +
                    '" name="offender[localbody_id][]" class="form-control col-md-12 o_localbody_id" required><option  disabled selected value>Select Local Government </option></select></div></div>';
                html +=
                    '<div class="form-group col-md-4 col-xs-12"><label>Applicant Wada No. <em>*</em> </label><div class="col-sm-10"><select id="o_wada_id" name="offender[wada_id][]" class="form-control col-md-12" required><option  disabled selected value>Select Local Government Wada</option><option value="1">Wada No.1</option><option value="2">Wada No.2</option><option value="3">Wada No.3</option><option value="4">Wada No.4</option><option value="5">Wada No.5</option><option value="6">Wada No.6</option><option value="7">Wada No.7</option><option value="8">Wada No.8</option><option value="9">Wada No.9</option><option value="10">Wada No.10</option><option value="11">Wada No.11</option><option value="12">Wada No.12</option></select></div></div>';
                html +=
                    '<button id="removeOffenderRow" type="button" class="btn btn-danger">Remove</button>';
                html += '</div>';

                $('#newOffenderRow').append(html);
            });

            // remove row in multiple applicant
            $(document).on('click', '#removeOffenderRow', function() {
                $(this).closest('#addOffender').remove();
            });

            $(document).on('click', '#removeOffenderRow1', function() {
                $(this).closest('#addOffender1').remove();
            });

        });
    </script>
@endsection
