@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
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
                <a href="{{ route('admin.releases.create') }}"><button class="btn-success btn-sm"><i class="fa fa-plus"></i>
                    सिर्जना गर्नुहाेस</button></a>
                <a href="{{ route('admin.releases.index') }}"><button class="btn-info btn-sm"><i class="fa fa-list"></i>
                    सुची</button></a>

            </div>
        </div>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="search-box" data-list="{&quot;valueNames&quot;:[&quot;title&quot;]}">
                            <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                                <input class="form-control search-input fuzzy-search" id="searchInput" type="search"
                                    placeholder="Search Registration Here" aria-label="Search"> <span>Note* <br> Search
                                    registration to release specific registration</span>
                            </form>

                            <div class="btn-close-falcon-container position-absolute end-0 top-50 translate-middle shadow-none"
                                data-bs-dismiss="search"><button class="btn btn-link btn-close-falcon p-0"
                                    aria-label="Close"></button></div>

                            <div class="dropdown-menu border font-base start-0 mt-2 py-0 overflow-hidden w-100">
                                <div class="scrollbar list py-3" style="max-height: 24rem;">
                                </div>
                                <div id="searchResults"></div>
                                <div class="text-center mt-n3">
                                    <p class="fallback fw-bold fs-1 d-none">No Result Found.</p>
                                </div>
                            </div>
                        </div>
                        <div class="release-form mt-4" style="display: none;">
                            <form id="releaseForm" method="POST" action="{{ route('admin.releases.store') }}">
                                @csrf
                                <div class="d-flex flex-wrap">
                                    <div class="form-group col-md-4 col-xs-12">
                                        <label>दर्ता नं.<span class="must">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" value="{{ old('id') }}" id="id" name="id"
                                                hidden>
                                            <input type="text" value="{{ old('registration_id') }}" id="registration_id"
                                                name="registration_id" class="input-text" autofocus readonly required>
                                        </div>
                                        @if ($errors->has('registration_id'))
                                            <span class="help-block danger">
                                                <strong>{{ $errors->first('registration_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-xs-12">
                                        <label>सहमती/फर्छ्यौट मिति <span class="must">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" value="{{ old('release_agreement_date') }}"
                                                id="nepali-datepicker" name="release_agreement_date" class="input-text"
                                                required>
                                        </div>
                                        @if ($errors->has('release_agreement_date'))
                                            <span class="help-block danger">
                                                <strong>{{ $errors->first('release_agreement_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4 col-xs-12">
                                        <label>अदालतमा मुद्दा विचाराधिन <span class="must">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="btn-group">
                                                <input type="radio" class="btn-check" name="issue_in_court" id="option1"
                                                    value="0" autocomplete="off" checked />
                                                <label class="btn btn-secondary" for="option1">नभएको</label>

                                                <input type="radio" class="btn-check" name="issue_in_court" id="option2"
                                                    value="1" autocomplete="off" />
                                                <label class="btn btn-secondary" for="option2">भएको</label>
                                            </div>
                                        </div>
                                        @if ($errors->has('issue_in_court'))
                                            <span class="help-block danger">
                                                <strong>{{ $errors->first('issue_in_court') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="d-flex flex-wrap full--width">
                                        <div class="form-group col-md-6 col-xs-12">
                                            <label>सहमती कार्यान्वयनको अवस्था <span class="must">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="btn-group">
                                                    <input type="radio" class="btn-check" name="agreement_applied_status"
                                                        id="agreement_applied_status1" value="0" autocomplete="off" />
                                                    <label class="btn btn-secondary" for="agreement_applied_status1">लागू
                                                        हुने मिति</label>

                                                    <input type="radio" class="btn-check" name="agreement_applied_status"
                                                        id="agreement_applied_status2" value="1" autocomplete="off"
                                                        checked />
                                                    <label class="btn btn-secondary" for="agreement_applied_status2">
                                                        तत्काल</label>
                                                </div>
                                            </div>
                                            @if ($errors->has('agreement_applied_status'))
                                                <span class="help-block danger">
                                                    <strong>{{ $errors->first('agreement_applied_status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 col-xs-12" id="applied_due_date"
                                            style="display: none;">
                                            <label>लागू हुने मिति<span class="must">*</span></label>

                                            <div class="col-sm-10">
                                                <input type="text" value="{{ old('applied_due_date') }}"
                                                    id="due-date" name="applied_due_date" class="input-text">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ////// --}}
                                    <div class="d-flex flex-wrap  full--width">
                                        <div class="form-group col-md-6 col-xs-12">
                                            <label>फर्छ्याेट मापदण्ड <span class="must">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="btn-group">
                                                    <input type="radio" class="btn-check" name="release_criteria"
                                                        id="release_criteria" value="0" autocomplete="off"
                                                        checked />
                                                    <label class="btn btn-secondary" for="release_criteria">लिनदिन नपर्ने
                                                        गरी फर्छ्यौट</label>

                                                    <input type="radio" class="btn-check" name="release_criteria"
                                                        id="release_criteria2" value="1" autocomplete="off" />
                                                    <label class="btn btn-secondary" for="release_criteria2">
                                                        लिनदिन पर्ने गरी फर्छ्यौट</label>
                                                </div>
                                            </div>
                                            @if ($errors->has('release_criteria'))
                                                <span class="help-block danger">
                                                    <strong>{{ $errors->first('release_criteria') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 col-xs-12" id="reason_to_no_transaction"
                                            style="display: none;">
                                            <label>लिनदिन नपर्ने गरी फर्छ्यौट भएको कारण <span
                                                    class="must">*</span></label>

                                            <div class="col-sm-10">
                                                <select id="reason_to_no_transaction" name="no_transaction_purpose_id"
                                                    data-iteration="0" class="form-control col-md-12 o_state_id">
                                                    <option disabled selected value>लिनदिन नपर्ने गरी फर्छ्यौट भएको कारण चयन
                                                        गर्नुहोस्</option>
                                                    @foreach ($reason_to_no_transactions as $reason)
                                                        <option value="{{ $reason->id }}" style="font-weight: 600; ">
                                                            {{ $reason->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="transaction-details" id="transaction-details" style="display: none;">
                                            <div class="form-group col-md-12 col-xs-12">
                                                <label>निवेदकले भूक्तानी गरेको/गर्ने विवरण<span class="must">*</span>
                                                </label>

                                                <div class="col-sm-10">
                                                    <div id="inputFormRow">
                                                        <div class="input-group mb-3">
                                                            <select id="proof"
                                                                name="applicant_recive_on_release[nature_id][]"
                                                                class="form-control col-md-12"
                                                                onchange="showHideInput(this)">
                                                                <option disabled selected value>प्राप्त प्रकृति चयन
                                                                    गर्नुहोस्</option>
                                                                @foreach ($natures as $nature)
                                                                    <option value="{{ $nature->id }}"
                                                                        data-kitta="{{ $nature->id === 4 ? 'yes' : 'no' }}"
                                                                        style="font-weight: 600; ">
                                                                        {{ $nature->title }}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="text"
                                                                name="applicant_recive_on_release[amount][]"
                                                                class="form-control m-input" id="def">
                                                            {{-- FOR KITTA --}}
                                                            <div class="kitta-container" id="kitta-stuff"
                                                                style=" width:auto;">
                                                                {{-- <label for="kitta">कित्ता</label> --}}
                                                                <input type="number"
                                                                    name="applicant_recive_on_release[kitta][]"
                                                                    id="kitta" class="kitta-input"
                                                                    style="margin-left: 5px; width: 80px;"
                                                                    placeholder="कित्ता">
                                                            </div>
                                                            <div class="input-group-append">
                                                                <button id="removeRow" type="button"
                                                                    class="btn btn-danger">हटाउनुहोस्</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="newRow"></div>
                                                    <button id="addRow" type="button" class="btn btn-info">थप प्राप्त
                                                        प्रकृति</button>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-12 col-xs-12">
                                                <label>साहुद्वारा फिर्ता भएको विवरण <span class="must">*</span> </label>

                                                <div class="col-sm-10">
                                                    <div id="inputFormRow1">
                                                        <div class="input-group mb-3">
                                                            <select name="offender_refund_on_release[nature_id][]"
                                                                class="form-control col-md-12"
                                                                onchange="showHideInputKitta(this)">
                                                                <option disabled selected value>फिर्ता प्रकृति चयन गर्नुहोस्
                                                                </option>
                                                                @foreach ($natures as $nature)
                                                                    <option value="{{ $nature->id }}"
                                                                        data-kittaoff="{{ $nature->id === 4 ? 'yes' : 'no' }}"
                                                                        style="font-weight: 600;">
                                                                        {{ $nature->title }}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="text"
                                                                name="offender_refund_on_release[amount][]"
                                                                class="form-control m-input" id="def">
                                                            {{-- FOR KITTA --}}
                                                            <div class="kitta-container" id="kittaoff"
                                                                style="width:auto;">
                                                                <input type="number"
                                                                    name="offender_refund_on_release[kitta][]"
                                                                    class="kittaoff-input"
                                                                    style="margin-left: 5px; width: 80px;"
                                                                    placeholder="कित्ता">
                                                            </div>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger removeRow1"
                                                                    type="button">हटाउनुहोस्</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="newRow1"></div>
                                                    <button id="addRow1" type="button" class="btn btn-info">
                                                        थप फिर्ता प्रकृति
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mt-4">
                                            <label>कैफियत/अन्य कुनै खुलाउनुपर्ने विवरण भए</label>

                                            <div class="">
                                                <textarea style="max-width: 30%;" type="text" class="form-control note-editable" name="remarks"
                                                    id="summernote" placeholder="Add Remarks">
                                                </textarea>
                                            </div>
                                            @if ($errors->has('remarks'))
                                                <span class="help-block danger">
                                                    <strong>{{ $errors->first('remarks') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end mt-4 mb-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>


    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
    <script>


        function showHideInput(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var parentContainer = selectElement.closest('.input-group'); // Find the closest parent container
            var kittaPlaceholder = parentContainer.querySelector(
            '.kitta-container'); // Find the kitta placeholder div within the parent container

            // Check the data-kitta attribute of the selected option
            if (selectedOption.getAttribute('data-kitta') === 'yes') {
                kittaPlaceholder.style.display = 'flex'; // Show the kitta input field placeholder
                kittaPlaceholder.style.alignItems = 'center';
            } else {
                kittaPlaceholder.style.display = 'none'; // Hide the kitta input field placeholder
            }
        }

        // Trigger the showHideInput function for all select elements on page load
        $(document).ready(function() {
            $('select[name^="applicant_recive_on_release[nature_id]"]').each(function() {
                showHideInput(this);
            });
        });


        function showHideInputKitta(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var parentContainer = selectElement.closest('.input-group');
            var kittaPlaceholder = parentContainer.querySelector('.kitta-container');

            if (selectedOption.getAttribute('data-kittaoff') === 'yes') {
                kittaPlaceholder.style.display = 'flex';
                kittaPlaceholder.style.alignItems = 'center';
            } else {
                kittaPlaceholder.style.display = 'none';
            }
        }

        // Trigger the showHideInputKitta function for all select elements on page load
        $(document).ready(function() {
            $('select[name^="offender_refund_on_release[nature_id]"]').each(function() {
                showHideInputKitta(this);
            });
        });



        $(document).ready(function() {
            //searching for registration id
            $('#searchInput').on('input', function() {
                var searchTerm = $(this).val(); // Get the value of the input field

                // Make an AJAX request
                $.ajax({
                    url: '{{ route('admin.utilities.search') }}', // Replace with the actual URL
                    method: 'GET',
                    data: {
                        query: searchTerm
                    },
                    success: function(response) {
                        $('#searchResults').html(response);

                    },
                    error: function() {
                        $('#searchResults').html("<p>Something wrong!!! Try again</p>");
                    }
                });
            });
        });

        //onclicking the search list get registration id only
        $(document).on("click", '#registration-id', function(event) {
            event.preventDefault(); // Prevent the default behavior of the link
            var dataId = $(this).data('id'); // Get the data-id attribute as id
            var dataValue = $(this).data('value'); // Get the data-value attribute as registration id
            $('.release-form').show();
            $('#id').val(dataId)
            $('#registration_id').val(dataValue)

            $('#searchResults').html("");
        });
        //on change releases criteria actio fire for dynamic form according to crieria 
        $(document).on("change", 'input[name="agreement_applied_status"]', function(event) {
            // Get the value of the selected radio button
            var selectedValue = $('input[name="agreement_applied_status"]:checked').val();

            var input_due_date = $('#due-date');
            

            // if 0 due date is applied sho show the date input field
            if (selectedValue == 0) {
                $('#applied_due_date').fadeIn();
                input_due_date.nepaliDatePicker("remove");
                input_due_date.nepaliDatePicker({});

            } else if (selectedValue == 1) {
                $('#applied_due_date').hide();
            }
        });



        //on default checked release criteria show the form
        // if 0 notransaction so show reason to no tranaction
        var checkedValue = $("input[name='release_criteria']:checked").val();
        if (checkedValue == 0) {
            $('#reason_to_no_transaction').show();
            $('#transaction-details').hide();
            // Perform other actions for male
        } else if (selectedValue == 1) {
            $('#reason_to_no_transaction').hide();
            $('#transaction-details').show();
        }


        //on change releases criteria actio fire for dynamic form according to crieria 
        $(document).on("change", 'input[name="release_criteria"]', function(event) {
            // Get the value of the selected radio button
            var selectedValue = $('input[name="release_criteria"]:checked').val();

            // if 0 notransaction so show reason to no tranaction
            if (selectedValue == 0) {
                $('#reason_to_no_transaction').show();
                $('#transaction-details').hide();
                // Perform other actions for male
            } else if (selectedValue == 1) {
                $('#reason_to_no_transaction').hide();
                $('#transaction-details').show();
            }
        });


        $("#addRow").click(function() {
            var html = '';
            html += '<div class="input-group mb-3">';
            html +=
                '<select name="applicant_recive_on_release[nature_id][]" class="form-control col-md-12" onchange="showHideInput(this)"><option disabled selected value>फिर्ता प्रकृति चयन गर्नुहोस्</option>@foreach ($natures as $nature)<option value="{{ $nature->id }}" data-kitta="{{ $nature->id === 4 ? 'yes' : 'no' }}">{{ $nature->title }}</option>@endforeach</select>';
            html +=
                '<input type="text" name="applicant_recive_on_release[amount][]" class="form-control m-input" id="def">';
            html += '<div class="kitta-container">'; // Placeholder for kitta input field
            html +=
                '<input type="number" name="applicant_recive_on_release[kitta][]" id="kitta" class="kitta-input" style="width: 80px; margin-left: 5px;" placeholder="कित्ता">';
            html += '</div>';
            html += '<div class="input-group-append">';
            html += '<button class="btn btn-danger removeRow" type="button">हटाउनुहोस्</button>';
            html += '</div>';
            html += '</div>';
            $('#newRow').append(html);
        });

        // Add a click handler for dynamically added remove buttons
        $(document).on('click', '.removeRow', function() {
            $(this).closest('.input-group').remove();
        });


        $("#addRow1").click(function() {
            var html = '';
            html += '<div class="input-group mb-3">';
            html +=
                '<select name="offender_refund_on_release[nature_id][]" class="form-control col-md-12" onchange="showHideInputKitta(this)"><option disabled selected value>फिर्ता प्रकृति चयन गर्नुहोस्</option>@foreach ($natures as $nature)<option value="{{ $nature->id }}" data-kittaoff="{{ $nature->id === 4 ? 'yes' : 'no' }}">{{ $nature->title }}</option>@endforeach</select>';
            html +=
                '<input type="text" name="offender_refund_on_release[amount][]" class="form-control m-input" id="def">';
            html += '<div class="kitta-container">';
            html +=
                '<input type="number" name="offender_refund_on_release[kitta][]" class="kittaoff-input" style="width: 80px; margin-left: 5px;" placeholder="कित्ता">';
            html += '</div>';
            html += '<div class="input-group-append">';
            html += '<button class="btn btn-danger removeRow1" type="button">हटाउनुहोस्</button>';
            html += '</div>';
            html += '</div>';
            $('#newRow1').append(html);
        });

        // Add a click handler for dynamically added remove buttons
        $(document).on('click', '.removeRow1', function() {
            $(this).closest('.input-group').remove();
        });
    </script>
@endsection
