@extends('admin.layouts.master')


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
                <a href="{{ route('admin.discussion.create') }}"><button class="btn-success btn-sm"><i
                            class="fa fa-plus"></i>
                            सिर्जना गर्नुहाेस</button></a>
                <a href="{{ route('admin.discussion.index') }}"><button class="btn-info btn-sm"><i class="fa fa-list"></i>
                    सुची</button></a>

            </div>
        </div>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box" data-list="{&quot;valueNames&quot;:[&quot;title&quot;]}">
                                <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                                    {{-- <label for="search">To add Discussion search by Registration</label> --}}
                                    <input class="form-control search-input fuzzy-search" id="searchInput" type="search"
                                        placeholder="Search Registraion Here" aria-label="Search"> <span>Note* <br> Search
                                        Discussion through specific registration</span>
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
                            <table id="discussions-table" class="table table-bordered table-striped dataTable dtr-inline"
                                role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        {{-- <th class="sorting sorting_asc" tabindex="0">आईडी</th> --}}
                                        <th class="sorting sorting_asc" tabindex="0">दर्ता नं.</th>
                                        <th>छलफल मिति</th>
                                        <th>अन्तिम छलफल मिति</th>
                                        <th>साहुबाट माग भएको</th>
                                        <th>निवेदकले तिर्न खोजेको</th>
                                        <th>सहमती हुन नसक्नुका कारण</th>
                                        <th>सिर्जना</th>
                                        <th>कार्य</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    {{-- @push('scripts')
    {{ $dataTable->scripts() }}
@endpush --}}
@section('scripts')
    <script>
        $(document).ready(function() {

            var dataTable = $('#discussions-table').DataTable();
            dataTable.destroy();
            datatableInitation();
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

            $(document).on("click", '#registration-id', function(event) {
            event.preventDefault(); // Prevent the default behavior of the link
            var dataId = $(this).data('id'); // Get the data-id attribute as id
            var dataValue = $(this).data('value'); // Get the data-value attribute as registration id
            $('.release-form').show();
            $('#id').val(dataId)
            $('#registration_id').val(dataValue)
            var dataTable = $('#discussions-table').DataTable();
            dataTable.destroy();

            datatableInitation(dataId);
            $('#searchResults').html("");

            
        });

            function datatableInitation(registration_id = null) {
                //datatable setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#discussions-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.discussion.get') }}',
                        type: 'post',
                        data: {
                            id: registration_id
                        },
                    },
                    columns: [
                        {
                            data: 'registration_id',
                            name: 'registration_id'
                        },
                        {
                            data: 'discussion_date',
                            name: 'discussion_date'
                        },
                        {
                            data: 'previous_date',
                            name: 'previous_date'
                        },
                        {
                            data: 'offender_demand',
                            name: 'offender_demand'
                        },
                        {
                            data: 'applicant_willing_to_pay',
                            name: 'applicant_willing_to_pay'
                        },
                        {
                            data: 'reason_to_disagreement',
                            name: 'reason_to_disagreement'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'actions',
                            name: 'actions'
                        }
                    ],
                    initComplete: function() {
                        this.api().columns().every(function() {
                            var column = this;
                            var input = document.createElement("input");
                            $(input).appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    column.search($(this).val()).draw();
                                });
                        });
                    }
                });
            }
        });
        //onclicking the search list get registration id only
        
    </script>
@endsection
@endsection
