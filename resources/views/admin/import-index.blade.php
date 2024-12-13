@extends('admin.layouts.master')
@section('content')
    <style>
        table {
            border: 1px solid #000;
            width: 100%;
            /* Make the table width 100% of its container */
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            /* Add padding for better spacing */
        }
    </style>

    <div class="container text-center">
        <div class="mt-5">
            <a href="{{ asset('dummy.xlsx') }}" download class="btn btn-primary">यहाँबाट उदाहरण डाउनलोड गर्नुहोस्</a>
        </div>
    </div>

    <div class="container p-5">

        <h4><b>इम्पाेर्ट गर्नका लागी CSV मा Heading मा यस्तो Format मा हाल्नुहोला</b></h4>
        <p>sn, registration_no, a_name, a_state, a_district, a_local_govn, a_ward, o_name, o_state, o_district,
            o_local_govn, o_ward,
            tran_date, tran_purp, tran_proof, a_tran_amount, o_demand_amount, r_nature, r_amount, r_date, or_nature,
            or_amount,
            issue_in_court, remarks, r_criteria, no_tran_id</p>


        <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" id="fileInput">
            <button type="submit" id="submitButton" disabled>Import CSV</button>
        </form>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-4"> <!-- Adjust column width to control the table size -->
                <table class="table table-sm"> <!-- Apply 'table-sm' class to make the table smaller -->
                    <thead>
                        <tr>
                            <th scope="col">लेनदेनको प्रकृती</th>
                            <th scope="col">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($natures as $nature)
                            <tr>
                                <td>{{ $nature->title }}</td>
                                <td>{{ $nature->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">लेनदेनको प्रमाण</th>
                            <th scope="col">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proofs as $proof)
                            <tr>
                                <td>{{ $proof->title }}</td>
                                <td>{{ $proof->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">लेनदेनको प्रयोजन</th>
                            <th scope="col">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purposes as $purpose)
                            <tr>
                                <td>{{ $purpose->title }}</td>
                                <td>{{ $purpose->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="container mt-3">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>प्रदेश</th>
                    <th>प्रदेश ID</th>
                    <th>जिल्ला</th>
                    <th>जिल्ला ID</th>
                    <th>स्थानीय तह | ID </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{-- <label for="stateSelect">प्रदेश:</label> --}}
                        <select id="stateSelect" class="form-select form-select-sm">
                            <option disabled selected value>प्रदेश चयन गर्नुहोस्</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <h5><span id="selectedStateId"></span></h5>
                    </td>
                    <td>
                        {{-- <label for="districtSelect">जिल्ला:</label> --}}
                        <select id="districtSelect" class="form-select form-select-sm">
                            <option value="" disabled selected>जिल्ला चयन गर्नुहोस्</option>
                        </select>
                    </td>
                    <td>
                        <h5><span id="selectedDistrictId"></span></h5>
                    </td>
                    <td>
                        <h5><span id="selectedLocalGovernmentId"></span></h5>
                        <ul id="localGovernmentsList">
                            <!-- Local Governments will be displayed here -->
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    
    
    
    
    
    



    <script>
        function validateForm() {
            var fileInput = document.getElementById('fileInput');
            var submitButton = document.getElementById('submitButton');

            // Check if a file has been selected
            if (fileInput.files.length === 0) {
                alert("Please select a file before submitting.");
                return false;
            }

            // If a file is selected, allow form submission
            return true;
        }

        // Enable the submit button when a file is selected
        document.getElementById('fileInput').addEventListener('change', function() {
            var submitButton = document.getElementById('submitButton');
            submitButton.disabled = this.files.length === 0;
        });
    </script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const stateSelect = document.getElementById('stateSelect');
        const selectedStateId = document.getElementById('selectedStateId');
        const districtSelect = document.getElementById('districtSelect');
        const selectedDistrictId = document.getElementById('selectedDistrictId');
        const localGovernmentSelect = document.getElementById('localGovernmentSelect');
        const selectedLocalGovernmentId = document.getElementById('selectedLocalGovernmentId');

        stateSelect.addEventListener('change', function() {
            const selectedState = stateSelect.value;
            selectedStateId.innerText = selectedState;

            // Fetch districts based on the selected state
            fetch(`/admin/get-districts/${selectedState}`)
                .then(response => response.json())
                .then(data => {
                    districtSelect.innerHTML =
                        '<option value="" disabled selected>Select a District</option>';
                    data.forEach(district => {
                        districtSelect.innerHTML +=
                            `<option value="${district.id}">${district.name}</option>`;
                    });
                });
        });

        districtSelect.addEventListener('change', function() {
            const selectedDistrict = districtSelect.value;
            selectedDistrictId.innerText = selectedDistrict;

            // Fetch local governments based on the selected district
            fetch(`/admin/get-local-governments/${selectedDistrict}`)
                .then(response => response.json())
                .then(data => {
                    localGovernmentSelect.innerHTML =
                        '<option value="" disabled selected>Select a Local Government</option>';
                    data.forEach(localGovernment => {
                        localGovernmentSelect.innerHTML +=
                            `<option value="${localGovernment.id}">${localGovernment.name}</option>`;
                    });
                });
        });
    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stateSelect = document.getElementById('stateSelect');
        const selectedStateId = document.getElementById('selectedStateId');
        const districtSelect = document.getElementById('districtSelect');
        const selectedDistrictId = document.getElementById('selectedDistrictId');
        const localGovernmentsList = document.getElementById('localGovernmentsList'); // Add this element

        stateSelect.addEventListener('change', function() {
            const selectedState = stateSelect.value;
            selectedStateId.innerText = selectedState;

            // Fetch districts based on the selected state
            fetch(`/admin/get-districts/${selectedState}`)
                .then(response => response.json())
                .then(data => {
                    districtSelect.innerHTML =
                        '<option value="" disabled selected>Select a District</option>';
                    data.forEach(district => {
                        districtSelect.innerHTML +=
                            `<option value="${district.id}">${district.name}</option>`;
                    });
                });
        });

        districtSelect.addEventListener('change', function() {
            const selectedDistrict = districtSelect.value;
            selectedDistrictId.innerText = selectedDistrict;

            // Clear the existing list of local governments
            localGovernmentsList.innerHTML = '';

            // Fetch all local governments for the selected district
            fetch(`/admin/get-local-governments/${selectedDistrict}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(localGovernment => {
                        // Add each local government and its ID to the list
                        localGovernmentsList.innerHTML +=
                            `<p>${localGovernment.name} : <span>${localGovernment.id}</span></p>`;
                    });
                });
        });
    });
</script>


@endsection
