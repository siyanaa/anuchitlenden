@php
    // Assuming $userRoleID contains the user's role_id
    $userRoleID = auth()->user()->role; // Replace with your actual logic
@endphp

<div class="form-wrap">
    @csrf
    <div class="d-flex flex-wrap">

        @if($userRoleID != 3)
        <div class="form-group col-md-4 col-xs-12">
            <label>प्रदेश<span class="must">*</span> </label>

            <div class="col-sm-10">
                <select id="state_id" name="state_name" data-iteration="0" class="form-control">
                    <option disabled selected value>प्रदेश छान्नुहाेस</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}" data-value="{{ $state->id }}" {{ old('state_name') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                    @endforeach
                </select>
                
            </div>
        </div>

        <div class="form-group col-md-4 col-xs-12">
            <label>जिल्ला <span class="must">*</span> </label>

            <div class="col-sm-10">
                <select id="district_id" name="district_name" data-iteration="0" class="form-control col-md-12">
                    <option value="{{ old('district_name') }}"  {{ old('district_name') == old('district_name') ? 'selected' : '' }}>{{ old('district_name')}}</option>
                </select>
            </div>
        </div>

        @endif

        <div class="form-group col-md-4 col-xs-12">
            <label>लेनदेनको प्रकृती <span class="must">*</span> </label>

            <div class="col-sm-10">
                <select id="proof" name="nature_type"
                    class="form-control col-md-12">
                    <option disabled selected value>लेनदेनको प्रकृती छान्नुहाेस</option>
                    @foreach ($natures as $nature)
                        <option value="{{ $nature->title }}" {{ old('nature_type') == $nature->title ? 'selected' : '' }}>
                            {{ $nature->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-group col-md-4 col-xs-12">
            <label>लेनदेनको प्रमाण <span class="must">*</span> </label>

            <div class="col-sm-10">
                <select id="proof" name="proof_type"
                    class="form-control col-md-12">
                    <option disabled selected value>लेनदेनको प्रमाण छान्नुहाेस</option>
                    @foreach ($proofs as $proof)
                        <option value="{{ $proof->title }}" {{ old('proof_type') == $proof->title ? 'selected' : '' }}>
                            {{ $proof->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-group col-md-4 col-xs-12">
            <label>लेनदेनको प्रयोजन <span class="must">*</span> </label>

            <div class="col-sm-10">
                <select id="proof" name="purpose_type"
                    class="form-control col-md-12">
                    <option disabled selected value>लेनदेनको प्रयोजन छान्नुहाेस</option>
                    @foreach ($purposes as $purpose)
                        <option value="{{ $purpose->title }}" {{ old('purpose_type') == $purpose->title ? 'selected' : '' }}>
                            {{ $purpose->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-4 col-xs-12">
            <label>शब्द छान्नुहाेस</label><span class="must">* रजिष्ट्रेशन नं, पुरा नाम</span>

            <div class="col-sm-10">
                <input type="text" value="{{ old('search_text') }}" id="search_text"
                    name="search_text" class="input-text" autofocus>
            </div>
        </div>

        <div class="form-group col-md-4 col-xs-12">
            <label>लेनदेन मिति सुरु <span class="must">*</span></label>
        
            <div class="col-sm-10">
                <input type="text" value="{{ old('transaction_date_start') }}"
                    id="nepali-datepicker-start" name="transaction_date_start" class="input-text nepali-datepicker">
            </div>
        </div>
        
        <div class="form-group col-md-4 col-xs-12">
            <label>लेनदेन मिति अन्त्य  <span class="must">*</span></label>
        
            <div class="col-sm-10">
                <input type="text" value="{{ old('transaction_date_end') }}"
                    id="nepali-datepicker-end" name="transaction_date_end" class="input-text nepali-datepicker">
            </div>
        </div>

        <div class="form-group col-md-4 col-xs-12">
            <label>लिनदिन नपर्ने फर्छ्यौट</label>
            
            <div class="col-sm-10">
                <select id="no_transaction_purpose" name="no_transaction_purpose" class="form-control col-md-12">
                    <option disabled selected value>लेनदेनको उद्देश्य छान्नुहोस</option>
                    @foreach ($noTransactionPurposes as $purpose)
                        <option value="{{ $purpose->title }}" {{ old('no_transaction_purpose') == $purpose->title ? 'selected' : '' }}>
                            {{ $purpose->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        

    </div>

    <div class="col-md-12" style="display: flex; flex-direction:column; align-items:flex-end;">

        <div class="mt-2">
            <button type="submit" class="btn btn-primary">खाेजी गर्नुहाेस</button>
        </div>
            
        <div class="mt-2">

            <a type="button" href="{{ route('admin.reports.clear-search') }}" id="clear-search" class="btn btn-secondary">खोज रिसेट </a>
        </div>

    </div>
</div>
<hr>


