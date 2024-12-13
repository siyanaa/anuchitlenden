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
                <a href="{{ route('admin.discussion.create') }}"><button class="btn-success btn-sm"><i class="fa fa-plus"></i>
                    सिर्जना गर्नुहाेस</button></a>
                <a href="{{ route('admin.discussion.index') }}"><button class="btn-info btn-sm"><i class="fa fa-list"></i>
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
                                <label for="search">To add Discussion search by Registration</label>
                                <input class="form-control search-input fuzzy-search" id="searchInput" type="search"
                                    placeholder="Search Registration Here" aria-label="Search"> <span>Note* <br> Search
                                    registration to add discussion to specific registration</span>
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
                        <div class="discussion-form mt-4 p-3" style="display: none;">
                            <form id="discussionForm" method="POST" action="{{ route('admin.discussion.store') }}">
                                @csrf
                                <input type="hidden" name="debug" value="1">

                                <!-- Display previous dates -->
                                <div>छलफल भएको मिति </div>
                                <div id="previousDates"></div>


                                <div class="d-flex flex-column p-3">


                                    <div class="d-flex col-md-12 mb-4">

                                        <div class="form-group col-md-6">
                                            <label>दर्ता नं. <span class="must">*</span></label>

                                            <div class="col-md-6">
                                                <input type="text" value="{{ old('id') }}" id="id"
                                                    name="id" hidden>
                                                <input type="text" value="{{ old('registration_id') }}"
                                                    id="registration_id" name="registration_id" class="input-text" autofocus
                                                    readonly required>
                                            </div>
                                            @if ($errors->has('registration_id'))
                                                <span class="help-block danger">
                                                    <strong>{{ $errors->first('registration_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>छलफल मिति <span class="must">*</span></label>

                                            <div class="col-md-6">
                                                <input type="text" value="{{ old('discussion_date') }}"
                                                    id="nepali-datepicker" name="discussion_date" class="input-text"
                                                    required>
                                            </div>
                                            @if ($errors->has('discussion_date'))
                                                <span class="help-block danger">
                                                    <strong>{{ $errors->first('discussion_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex col-md-12 mb-4">

                                        <div class="form-group col-md-6">
                                            <label>विपक्षी साहुबाट माग रकम <span class="must">*</span></label>

                                            <div class="col-sm-10">
                                                <input type="radio" id="offender_demand_reveal"
                                                    name="offender_demand_reveal" value="yes">
                                                <label for="offender_demand_reveal">खुलेको</label><br>
                                                <input type="radio" id="offender_demand_reveal"
                                                    name="offender_demand_reveal" value="no">
                                                <label for="offender_demand_reveal">नखुलेको</label><br>
                                            </div>
                                            @if ($errors->has('offender_demand_reveal'))
                                                <span class="help-block danger">
                                                    <strong>{{ $errors->first('offender_demand_reveal') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6" id="offender_demand_group" style="display: none;">
                                            <label>साहुबाट माग भएको</label>

                                            <div class="col-sm-10">
                                                <input type="number" value="{{ old('offender_demand') }}"
                                                    id="offender_demand" name="offender_demand" class="input-text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">

                                        <div class="form-group col-md-6">
                                            <label>निवेदकले तिर्न खोजेको</label>

                                            <div class="">
                                                <input type="number" value="{{ old('applicant_willing_to_pay') }}"
                                                    id="applicant_willing_to_pay" name="applicant_willing_to_pay"
                                                    class="input-text">
                                            </div>
                                            @if ($errors->has('applicant_willing_to_pay'))
                                                <span class="help-block danger">
                                                    <strong>{{ $errors->first('applicant_willing_to_pay') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 mt-4">
                                            <label>सहमती हुन नसक्नुका कारण</label>

                                            <div class="">
                                                <textarea style="max-width: 30%;" type="text" class="form-control note-editable" name="reason_to_disagreement"
                                                    id="summernote" placeholder="Add Description">
                                                </textarea>
                                            </div>
                                            @if ($errors->has('reason_to_disagreement'))
                                                <span class="help-block danger">
                                                    <strong>{{ $errors->first('reason_to_disagreement') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="deactivateRegistration" style="font-size: 16px; font-weight: 600;">यो
                                            दर्ताको छलफल फर्छ्याेट हुन सकेन:</label>
                                        <input type="checkbox" id="deactivateRegistration" name="deactivateRegistration"
                                            value="1" class="larger-checkbox">
                                    </div>


                                </div>

                                <div class="bottom-section-container p-4">
                                    <div class="bottom-button-container">
                                        <button class="btn btn-primary" type="submit" id="">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <script>
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
            $('.discussion-form').show();
            $('#id').val(dataId)
            $('#registration_id').val(dataValue)


            // Clear previous dates display
            $('#previousDates').empty();

            // Make an AJAX request to get previous dates
            $.ajax({
                    url: '{{ route('admin.discussion.getPreviousDates') }}',
                    method: 'GET',
                    data: {
                        registration_id: dataId
                    },
                    success: function(response) {
                        var previousDates = response.previousDates;
                        $('#previousDates').empty();

                        if (previousDates.length > 0) {
                            var previousDatesList = $('<ul>');
                            previousDates.forEach(function(date) {
                                previousDatesList.append($('<li>').text(date));
                            });
                            $('#previousDates').append(previousDatesList);
                        } else {
                            $('#previousDates').append('<p>No previous dates found.</p>');
                        }
                    
                },
                error: function() {
                    $('#previousDates').append('<p>Something went wrong while fetching previous dates.</p>');
                }
            });


            $('#searchResults').html("");
        });


        $(document).ready(function() {
            $('input[name="offender_demand_reveal"]').change(function() {
                if ($(this).val() === 'yes') {
                    $('#offender_demand_group').show();
                } else {
                    $('#offender_demand_group').hide();
                }
            });
        });
    </script>
@endsection
