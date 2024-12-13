@extends('admin.layouts.master')

@section('content')
    <div class="form-container">

        <div class="form-items-tab-container">

            <div class="form-list-container">

                <div class="form-list">
                    <span class="step">Registration</span>
                    <span class="step">Applicant</span>
                    <span class="step">Offender</span>
                    <span class="step">Transaction</span>
                </div>
            </div>

            <div>

                <div class="registration-title-container">

                    <div class="registration-title">
                        <h1>Registration Form</h1>
                    </div>
                </div>

                <form id="regForm" action="">
                    <!-- Circles which indicates the steps of the form: -->


                    <div class="form-items-container">

                        <!-- One "tab" for each step in the form: -->
                        <div class="tab">
                            <p class="tab-title">Register</p>
                            <p>
                                <input placeholder="Registration Number" oninput="this.className = ''" name="reg_no"
                                    required />
                            </p>
                            <p>
                                <input type="date" placeholder="Regisration Date." oninput="this.className = ''"
                                    name="reg_date" required />
                            </p>
                        </div>

                        <div class="tab">
                            <p class="tab-title">Applicant Details</p>
                            <p>
                                <input placeholder="First Name" oninput="this.className = ''" name="applicant_firstname"
                                    required />
                            </p>
                            <p>
                                <input placeholder="Middle Name" oninput="this.className = ''"
                                    name="applicant_middlename" />
                            </p>
                            <p>
                                <input placeholder="Last Name" oninput="this.className = ''" name="applicant_lastname"
                                    required />
                            </p>
                            <p>
                                <input placeholder="Permanent Address" oninput="this.className = ''"
                                    name="applicant_address" />
                            </p>
                            <p>
                                <input placeholder="Ward No" oninput="this.className = ''" name="applicant_ward" />
                            </p>
                            <p>
                                <input placeholder="Local Government" oninput="this.className = ''"
                                    name="applicant_local" />
                            </p>
                            <p>
                                <input placeholder="District" oninput="this.className = ''" name="applicant_district" />
                            </p>
                            <p>
                                <input placeholder="State" oninput="this.className = ''" name="applicant_state" />
                            </p>
                            <p>
                                <input placeholder="Phone..." oninput="this.className = ''" name="applicant_contact_no" />
                            </p>
                        </div>

                        <div class="tab">
                            <p class="tab-title">Offender Details</p>
                            <p>
                                <input placeholder="First Name" oninput="this.className = ''" name="offender_firstname"
                                    required />
                            </p>
                            <p>
                                <input placeholder="Middle Name" oninput="this.className = ''" name="offender_middlename" />
                            </p>
                            <p>
                                <input placeholder="Last Name" oninput="this.className = ''" name="offender_lastname"
                                    required />
                            </p>
                            <p>
                                <input placeholder="Permanent Address" oninput="this.className = ''" name="offender_address"
                                    required />
                            </p>
                            <p>
                                <input placeholder="Ward No" oninput="this.className = ''" name="offender_ward" required />
                            </p>
                            <p>
                                <input placeholder="Local Government" oninput="this.className = ''" name="offender_local"
                                    required />
                            </p>
                            <p>
                                <input placeholder="District" oninput="this.className = ''" name="offender_district"
                                    required />
                            </p>
                            <p>
                                <input placeholder="State" oninput="this.className = ''" name="offender_state" required />
                            </p>
                            <p>
                                <input placeholder="Phone..." oninput="this.className = ''" name="offender_contact_no"
                                    required />
                            </p>
                        </div>

                        <div class="tab">
                            <p class="tab-title">Tansaction</p>
                            <p>
                                <input placeholder="Transaction Amount" oninput="this.className = ''"
                                    name="transaction_amount" required />
                            </p>
                            <p>
                                <input placeholder="Transaction Date" oninput="this.className = ''" name="transaction_date"
                                    required />
                            </p>
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

    </div>
@endsection
