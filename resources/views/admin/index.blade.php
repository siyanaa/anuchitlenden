@extends('admin.layouts.master')

@section('content')
    <style>
        /* For the cards in the dashboard */
        .ag-courses_box {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;

            padding: 10px 0;
        }

        .ag-courses_item {
            -ms-flex-preferred-size: calc(33.33333% - 30px);
            flex-basis: calc(33.33333% - 150px);

            margin: 0 5px 10px;

            overflow: hidden;

            border-radius: 28px;
        }

        .ag-courses-item_link {
            display: block;
            padding: 30px 20px;
            background-image: linear-gradient(-45deg, rgba(0, 160, 255, 0.86), #0048a2), url(../img/generic/bg-navbar.png);

            overflow: hidden;

            position: relative;
        }

        .ag-courses-item_link:hover,
        .ag-courses-item_link:hover .ag-courses-item_date {
            text-decoration: none;
            color: #FFF;
        }

        .ag-courses-item_link:hover .ag-courses-item_bg {
            -webkit-transform: scale(10);
            -ms-transform: scale(10);
            transform: scale(10);
        }

        .ag-courses-item_title {
            min-height: 87px;
            margin: 0 0 25px;

            overflow: hidden;

            font-weight: bold;
            font-size: 30px;
            color: #FFF;

            z-index: 2;
            position: relative;
        }

        .ag-courses-item_date-box {
            font-size: 18px;
            color: #FFF;

            z-index: 2;
            position: relative;
        }

        .ag-courses-item_date {
            font-weight: bold;
            color: #f9b234;

            -webkit-transition: color .5s ease;
            -o-transition: color .5s ease;
            transition: color .5s ease
        }

        .ag-courses-item_bg {
            height: 128px;
            width: 128px;
            background-color: #f9b234;

            z-index: 1;
            position: absolute;
            top: -75px;
            right: -75px;

            border-radius: 50%;

            -webkit-transition: all .5s ease;
            -o-transition: all .5s ease;
            transition: all .5s ease;
        }

        .ag-courses_item:nth-child(2n) .ag-courses-item_bg {
            background-color: #3ecd5e;
        }

        .ag-courses_item:nth-child(3n) .ag-courses-item_bg {
            background-color: #e44002;
        }

        .ag-courses_item:nth-child(4n) .ag-courses-item_bg {
            background-color: #952aff;
        }

        .ag-courses_item:nth-child(5n) .ag-courses-item_bg {
            background-color: #cd3e94;
        }

        .ag-courses_item:nth-child(6n) .ag-courses-item_bg {
            background-color: #4c49ea;
        }



        @media only screen and (max-width: 979px) {
            .ag-courses_item {
                -ms-flex-preferred-size: calc(50% - 30px);
                flex-basis: calc(50% - 30px);
            }

            .ag-courses-item_title {
                font-size: 24px;
            }
        }

        @media only screen and (max-width: 767px) {
            .ag-format-container {
                width: 96%;
            }

        }

        @media only screen and (max-width: 639px) {
            .ag-courses_item {
                -ms-flex-preferred-size: 100%;
                flex-basis: 100%;
            }

            .ag-courses-item_title {
                min-height: 72px;
                line-height: 1;

                font-size: 24px;
            }

            .ag-courses-item_link {
                padding: 22px 40px;
            }

            .ag-courses-item_date-box {
                font-size: 16px;
            }
        }

        .no_transaction {
            width: 100% !important;
        }
    </style>

    {{-- <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" >
        <button type="submit">Import CSV</button>
    </form> --}}


    <div class="container">
        <div class="ag-format-container">
            @if ($graphs['registration'] > 0)
                <div class="ag-courses_box">

                    <div class="ag-courses_item">
                        <a href="{{ route('admin.registrations.index') }}" class="ag-courses-item_link">
                            <div class="ag-courses-item_bg"></div>

                            <div class="ag-courses-item_title">
                                कुल दर्ता
                            </div>

                            <div class="ag-courses-item_date-box">

                                <span class="ag-courses-item_date">
                                    {{ $graphs['registration'] }}
                                </span>
                            </div>
                        </a>
                    </div>


                    <div class="ag-courses_item">

                        <a href="{{ route('admin.discussion.index') }}" class="ag-courses-item_link">
                            <div class="ag-courses-item_bg"></div>

                            <div class="ag-courses-item_title">
                                कुल छलफल
                            </div>

                            <div class="ag-courses-item_date-box">

                                <span class="ag-courses-item_date">
                                    {{ $activeDiscussion }}
                                </span>
                            </div>

                        </a>

                    </div>

                    <div class="ag-courses_item">

                        <a href="{{ route('admin.releases.index') }}" class="ag-courses-item_link">
                            <div class="ag-courses-item_bg"></div>

                            <div class="ag-courses-item_title">
                                कुल फर्छ्याेट
                            </div>

                            <div class="ag-courses-item_date-box">

                                <span class="ag-courses-item_date">
                                    {{ $graphs['releases'] }}
                                </span>
                            </div>

                        </a>

                    </div>

                    <div class="ag-courses_item">

                        <a href="#" class="ag-courses-item_link">
                            <div class="ag-courses-item_bg"></div>

                            <div class="ag-courses-item_title">
                                कुल सहमती हुन नसकेको
                            </div>

                            <div class="ag-courses-item_date-box">

                                <span class="ag-courses-item_date">
                                    {{ $activeRegistrationsCount }}
                                </span>
                            </div>

                        </a>

                    </div>


                </div>
            @else
                <div class="container-fluid p-5 text-center ">
                    <p style="font-weight: 800; text-decoration: underline; line-height: 5px;">दर्ता उजुरी भयेको छैन</p>
                </div>
            @endif

        </div>
    </div>




    <div class=" container-fluid d-flex mt-5 gap-5">
        <div style=" width: 500px;" class="myChart">
            <h5 class="">सबै दर्ताहरू, छलफलहरू & फर्छ्याेटहरू</h5>
            <canvas id="myChart"></canvas>
        </div>
        @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 4)
            <div style="">

                <div>
                    <label for="stateDropdown">प्रदेश चयन गर्नुहोस्:</label>
                    <select id="stateDropdown" onchange="showSelectedState(this.value)">
                        <option value="">प्रदेश चयन गर्नुहोस्</option>
                        @foreach ($countsByState as $state)
                            <option value="{{ $state->state_name }}">{{ $state->state_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <canvas id="selectedStatePieChart"></canvas>
                </div>
            </div>
        @endif



    </div>

    @if (Auth::user()->role == 3)
        <div class="col-md-12 d-flex mt-4">
            <div style="width: 500px; height: 500px;">
                <h5>लिन दिन नपर्ने गरी फर्छ्याेट</h5>
                <canvas id="notranreleasedisPieChart"></canvas>
            </div>
        </div>
    @endif

    @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 4)
        <div class="col-md-12 d-flex mt-4">
            <div class="mt-4" style="width: 600px;">
                <h5>लिन दिन नपर्ने गरी फर्छ्याेट</h5>
                <!-- Add a dropdown for selecting districts -->
                <select id="notranDistrictDropdown">
                    <option value="">जिल्ला चयन गर्नुहोस्</option>
                    @foreach ($districtsfornotran as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
                <canvas id="notranreleasePieChart"></canvas>
            </div>
        </div>
        <div id="noDataMessage" class="mb-4 mt-4" style="display: none;">
            No data to display.
        </div>
    @endif


    {{-- <div class="">{{ dd($pieChartDataForOffenderRefund) }}</div> --}}
    {{-- <div class="col-md-4">
        <canvas id="pieChartForOffenderRefund" style="height: 400px; width: 400px;"></canvas>
    </div> --}}


    {{-- <div style="border: 1px solid red; height: 400px;">
        <canvas class="no_transaction" style="border: 1px solid black;" id="release_no_transaction"></canvas>
    </div> --}}

    {{-- @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 4)
        <div class="col-md-12 d-flex mt-4">
            <div class="mt-4" style="width: 600px;">
                <h5>Offender Refund On Release</h5>
                <!-- Add a dropdown for selecting districts -->
                <select id="offenderRefundDistrictDropdown">
                    <option value="">Select District</option>
                    @foreach ($districtsfornotran as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
                <canvas id="offenderRefundPieChart"></canvas>
            </div>
        </div>
        <div id="noDataMessage" class="mb-4 mt-4" style="display: none;">
            No data to display.
        </div>
    @endif --}}



    @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 4)
        <h5 class="mt-5">दर्ता, छलफल & फर्छ्याेट जिल्ला अनुसार</h5>
        <div style="overflow-x: scroll; width: 100%; height: 400px;">
            <!-- Add this hidden input to store the JSON data -->
            <input type="hidden" id="districtData" value="{{ json_encode($districtData) }}">

            <canvas id="mySecondChart" style="overflow-x: scroll; width: 300%; height: 100%;"></canvas>
        </div>
    @endif





@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['कुल दर्ता, छलफल, फर्छ्याेट'],
                datasets: [{
                        label: 'दर्ता',
                        data: [{{ $graphs['registration'] }}],
                        backgroundColor: '#00FF00',
                    },
                    {
                        label: 'छलफल',
                        data: {{ $activeDiscussion }},
                        backgroundColor: '#00FFF0',
                    },
                    {
                        label: 'फर्छ्याेट',
                        data: [{{ $graphs['releases'] }}],
                        backgroundColor: '#FF0000',
                    },
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'बार चार्ट- दर्ता, छलफल र फर्छ्याेट'
                    }
                }
            }
        });


        const ctx3 = document.getElementById('release_no_transaction');

        // Fetch release counts data from the controller
        fetch('{{ route('admin.no_transaction') }}')
            .then(response => response.json())
            .then(data => {
                // Extract labels and data from the fetched data
                const labels = data.map(item => item.label);
                const counts = data.map(item => item.count);

                new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Release Count',
                            data: counts,
                            backgroundColor: '#FF0000',
                        }],
                    },
                    options: {
                        responsive: true,

                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Release Counts by Purpose',
                            },
                        },
                    },
                });
            })
            .catch(error => {
                console.error(error);
            });

        const countsByState = {!! json_encode($countsByState) !!};

        let selectedStateChart = null;

        function showSelectedState(selectedState) {
            const stateData = countsByState.find(state => state.state_name === selectedState);

            if (selectedStateChart !== null) {
                selectedStateChart.destroy();
            }

            const ctx = document.getElementById('selectedStatePieChart').getContext('2d');
            selectedStateChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['कुल दर्ता', 'कुल छलफल', 'कुल फर्छ्याेट', 'कुल सहमती हुन नसकेको'],
                    datasets: [{
                        data: [
                            stateData.registrations_count,
                            stateData.discussions_count,
                            stateData.releases_count,
                            stateData.active_registrations_count
                        ],
                        backgroundColor: [
                            '#FF5733',
                            '#FFC300',
                            '#00FF00',
                            '#FFA590' // Orange color for Active Registrations
                        ],
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: `पाइ चार्ट - ${selectedState}`
                        }
                    }
                }
            });
        }


        document.addEventListener("DOMContentLoaded", function() {
            // Retrieve the JSON data from the hidden input
            const districtDataJson = document.getElementById('districtData').value;
            const districtData = JSON.parse(districtDataJson);

            const ctx2 = document.getElementById('mySecondChart');
            const x_axis_lable = Object.keys(districtData);

            // Create an array to store the data for each district
            const registrationData = [];
            const discussionsData = [];
            const releasesData = [];

            // Populate the data arrays from the districtData object
            x_axis_lable.forEach((district) => {
                registrationData.push(districtData[district].registration);
                discussionsData.push(districtData[district].discussions);
                releasesData.push(districtData[district].releases);
            });

            const datasets = [{
                    label: 'दर्ता',
                    data: registrationData,
                    backgroundColor: getRandomColor(),
                },
                {
                    label: 'छलफल',
                    data: discussionsData,
                    backgroundColor: getRandomColor(),
                },
                {
                    label: 'फर्छ्याेट',
                    data: releasesData,
                    backgroundColor: getRandomColor(),
                },
            ];

            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: x_axis_lable,
                    datasets: datasets,
                },
                options: {
                    responsive: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            align: 'start',
                            text: 'दर्ता, छलफल & फर्छ्याेट जिल्ला अनुसार',
                        },
                    },
                    layout: {
                        padding: 10,
                    },
                },
            });

            function getRandomColor() {
                return '#' + Math.floor(Math.random() * 16777215).toString(16);
            }


        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctxNotran = document.getElementById('notranreleasePieChart').getContext('2d');

            // Initialize the chart with initial data or empty data
            var notranPieChart = new Chart(ctxNotran, {
                type: 'pie',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: [],
                    }],
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                    },
                    layout: {
                        padding: 10,
                    },
                    scales: {
                        x: {
                            display: false,
                        },
                        y: {
                            display: false,
                        },
                    },
                },
            });

            // Function to update the "लिन दिन नपर्ने गरी फर्छ्याेट" chart with new data
            function updateNotranChart(data) {
                if (data.length === 0) {
                    // Display a "No data" message or hide the chart
                    document.getElementById('notranreleasePieChart').style.display = 'none';
                    document.getElementById('noDataMessage').style.display = 'block';
                } else {
                    // Data is available, display the chart
                    document.getElementById('notranreleasePieChart').style.display = 'block';
                    document.getElementById('noDataMessage').style.display = 'none';
                }
                var releaseData = data;

                // console.log(releaseData);

                var purposeMappings = {
                    1: 'अनुचित लेनदेनको परिभाषा भित्र नपर्ने',
                    2: 'आपसी सहमतीमा मिलापत्र गर्न निवेदन फिर्ता',
                    3: 'निवेदकद्वारा निवेदन फिर्ता',
                    4: 'लिनदिन नपर्ने गरी मिलापत्र',
                    5: 'अदालतमा मुद्दा रहेकोमा छलफल गराउँदा सहमती हुन नसकेको',
                    6: 'जग्गा खरिद विक्री सम्बन्धी कारोवार भएको देखिएको',
                    7: 'साहुद्रारा मिनहा गरिएको',
                    8: 'छलफलकै क्रमम रहेको',
                    9: 'नखुलेको',
                    10: 'उपस्थित नभएको',
                    11: 'अन्य',
                    12: 'सावा ब्याज रकम दिने सहमति',
                    13: 'जग्गा फिर्ता पास गरिदिने'
                };

                var labels = releaseData.map(function(data) {
                    return purposeMappings[data.no_transaction_purpose_id];
                });

                var counts = releaseData.map(function(data) {
                    return data.count;
                });

                var colors = [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(0, 128, 0, 0.7)',
                ];

                var backgroundColors = labels.map(function(label, index) {
                    return colors[index % colors.length];
                });

                notranPieChart.data.labels = labels;
                notranPieChart.data.datasets[0].data = counts;
                notranPieChart.data.datasets[0].backgroundColor = backgroundColors;
                notranPieChart.update();
            }

            // Function to fetch data for the selected district for "लिन दिन नपर्ने गरी फर्छ्याेट"
            function getNotranDataForDistrict(districtId) {
                // Make an AJAX request to get data based on the selected district
                $.ajax({
                    url: '/admin/get-notran-data-for-district',
                    method: 'POST',
                    data: {
                        district_id: districtId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // Update the chart with the new data
                        updateNotranChart(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Listen for changes in the dropdown selection for "लिन दिन नपर्ने गरी फर्छ्याेट"
            document.getElementById('notranDistrictDropdown').addEventListener('change', function() {
                var selectedDistrictId = this.value;

                // Use the selected district ID to fetch data for the chart
                getNotranDataForDistrict(selectedDistrictId);
            });
        });
    </script>


    <script>
        var ctx34 = document.getElementById('notranreleasedisPieChart').getContext('2d');
        var releaseData1 = @json($notransaction_districtCount); // Convert PHP array to JavaScript
        console.log("zxc");
        // Mapping of No Transaction Purpose titles to no_transaction_purpose_id
        var purposeMappings1 = {
            1: 'अनुचित लेनदेनको परिभाषा भित्र नपर्ने',
            2: 'आपसी सहमतीमा मिलापत्र गर्न निवेदन फिर्ता',
            3: 'निवेदकद्वारा निवेदन फिर्ता',
            4: 'लिनदिन नपर्ने गरी मिलापत्र',
            5: 'अदालतमा मुद्दा रहेकोमा छलफल गराउँदा सहमती हुन नसकेको',
            6: 'जग्गा खरिद विक्री सम्बन्धी कारोवार भएको देखिएको',
            7: 'साहुद्रारा मिनहा गरिएको',
            8: 'छलफलकै क्रमम रहेको',
            9: 'नखुलेको',
            10: 'उपस्थित नभएको',
            11: 'अन्य',
            12: 'सावा ब्याज रकम दिने सहमति',
            13: 'जग्गा फिर्ता पास गरिदिने'
        };

        var labels1 = releaseData1.map(function(data) {
            return purposeMappings1[data.no_transaction_purpose_id];
        });

        var counts1 = releaseData1.map(function(data) {
            return data.count;
        });

        // Define an array of colors for all labels
        var colors1 = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(0, 128, 0, 0.7)',
            // Add more colors for different labels
        ];

        var backgroundColors1 = labels1.map(function(label, index) {
            // Assign colors to labels based on their order
            return colors1[index % colors1.length];
        });

        var pieChart1 = new Chart(ctx34, {
            type: 'pie',
            data: {
                labels: labels1,
                datasets: [{
                    data: counts1,
                    backgroundColor: backgroundColors1,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'right', // Adjust the legend position
                    },
                },
                // Rotate the labels
                layout: {
                    padding: 0, // Adjust padding for better appearance
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'right', // Change the position of the legend
                    },
                },
                scales: {
                    x: {
                        display: false, // Hide the x-axis
                    },
                    y: {
                        display: false, // Hide the y-axis
                    },
                },
            },
        });
    </script>



@endsection
