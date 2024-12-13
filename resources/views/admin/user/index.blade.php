@extends('admin.layouts.master')

<!-- Main content -->
@section('content')

    <div class="topbar" style="display: flex;">
        <a href="{{ route('admin.users.create') }}" style="text-decoration:none;width:auto;padding:5px;"><button type="button"
                class="btn btn-block btn-success btn-lg" style="width:auto;">प्रयोग कर्ता थप्नुहोस <i class="fas fa-user-plus"></i>

            </button>
        </a>
        {{-- <a href="{{ route('admin.users.viewDeleted') }}" style="text-decoration:none;width:auto;padding:5px"><button
                type="button" class="btn btn-block btn-warning btn-lg" style="width:auto;">Deleted Users <i
                    class="fas fa-users"></i>

            </button>
        </a> --}}
    </div>
    
    <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">प्रयोग कर्ता</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">नाम
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Browser: activate to sort column ascending">इमेल</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending">राेल</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                        स्टाटस</th>
                                    <th class="non-sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1">
                                        कार्य</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($users))
                                    @foreach ($users as $user)
                                        <tr class="odd">
                                            <td class="dtr-control sorting_1" tabindex="0">{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->roles->name }}</td>
                                            <td>
                                                @if ($user->is_active == 1)
                                                    सक्रिय
                                                @else
                                                    निष्कृय
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary btn-sm mx-1"
                                                    data-bs-toggle="modal" data-bs-target="#edit{{ $user->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#delete{{ $user->id }}">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </td>


                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            {{-- =====================================
                                                MODAL - EDIT
                            ====================================     --}}
                            @foreach ($users as $user)
                                <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">This can't be
                                                    undone.
                                                    Are you sure?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">No</button>
                                                <a href="{{ url('admin/users/edit/' . $user->id) }}">
                                                    <button type="button" class="btn btn-danger">Yes
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- =====================================
                                                    MODAL - DELETE
                            ====================================     --}}

                            @foreach ($users as $user)
                                <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">This can't be
                                                    undone. Are you sure?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">No</button>
                                                <a href="{{ url('admin/users/delete/' . $user->id) }}">
                                                    <button type="button" class="btn btn-danger">
                                                        Yes
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- Page specific script -->
    <script>
        $(function() {
            $.noConflict();
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
