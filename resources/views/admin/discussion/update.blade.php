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

                        <div class="discussion-form mt-4">
                            <form id="discussionForm" method="POST" action="{{ route('admin.discussion.update') }}">
                                @csrf
                                <input type="hidden" name="debug" value="1">

                                <div class="d-flex flex-column p-3">


                                    <div class="d-flex col-md-12 mb-4">

                                        <div class="form-group col-md-6">
                                            <label>दर्ता नं. <span class="must">*</span></label>

                                            <div class="col-md-6">
                                                <input type="text" value="{{ $discussion->id }}" id="id"
                                                    name="id" hidden>
                                                <input type="text" value="{{ $discussion->registration_id }}"
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
                                                <input type="text" value="{{ $discussion->discussion_date }}"
                                                    id="nepali-datepicker" name="discussion_date" class="input-text" required>
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
                                            <label>विपक्षी साहुबाट माग रकम</label>

                                            <div class="col-sm-10">
                                                <input type="radio" id="offender_demand_reveal_yes"
                                                    name="offender_demand_reveal" value="yes"
                                                    {{ $discussion->offender_demand_reveal === 'yes' ? 'checked' : '' }}>
                                                <label for="offender_demand_reveal_yes">खुलेको</label><br>
                                                <input type="radio" id="offender_demand_reveal_no"
                                                    name="offender_demand_reveal" value="no"
                                                    {{ $discussion->offender_demand_reveal === 'no' ? 'checked' : '' }}>
                                                <label for="offender_demand_reveal_no">नखुलेको</label><br>
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
                                                <input type="number" value="{{ $discussion->offender_demand }}"
                                                    id="offender_demand" name="offender_demand" class="input-text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">

                                        <div class="form-group col-md-6">
                                            <label>निवेदकले तिर्न खोजेको</label>

                                            <div class="">
                                                <input type="number" value="{{ $discussion->applicant_willing_to_pay }}"
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
                                                <textarea style="max-width: 30%;" type="text" class="form-control note-editable" name="reason_to_disagreement" id="summernote" placeholder="Add Description">
                                                    {{ $discussion->reason_to_disagreement }}
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
                                        <label for="deactivateRegistration" style="font-size: 16px; font-weight: 600;">यो दर्ताको छलफल फर्छ्याेट हुन सकेन:</label>
                                        <input type="checkbox" id="deactivateRegistration" name="deactivateRegistration" value="1" class="larger-checkbox" @if(old('deactivateRegistration')) checked @endif>
                                    </div>
                                    


                                </div>
                                <div class="bottom-section-container p-4">
                                    <div class="bottom-button-container">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
            // Function to toggle the visibility of the offender_demand_group
            function toggleOffenderDemandGroup() {
                if ($('input[name="offender_demand_reveal"]:checked').val() === 'yes') {
                    $('#offender_demand_group').show();
                } else {
                    $('#offender_demand_group').hide();
                }
            }
    
            // Call the function on page load
            toggleOffenderDemandGroup();
    
            // Bind change event to the radio buttons
            $('input[name="offender_demand_reveal"]').change(function() {
                toggleOffenderDemandGroup();
            });
        });
    </script>
    
@endsection
