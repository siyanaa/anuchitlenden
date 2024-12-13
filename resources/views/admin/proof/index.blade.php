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
                <a href="" class="btn btn-primary add-list" data-bs-toggle="modal" data-bs-target="#createTransproof">
                    <i class="fa-solid fa-plus"></i>
                    सिर्जना गर्नुहाेस
                </a>

            </div>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">सि.नं.</th>
                            <th scope="col">शीर्षक</th>
                            <th scope="col">कार्य</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proofs as $transactionproof)
                            <tr>
                                <th scope="row">
                                    {{ $loop->iteration }}
                                </th>
                                <td>{{ $transactionproof->title }}</td>
                                <td>
                                    <div class="d-flex">
                                        {{-- <a href="{{ route('admin.category.show', $product->id) }}"
                                                    class="btn btn-outline-success btn-sm mx-1">
                                                    <i class="fa-solid fa-eye"></i>
                                        </a> --}}
                                        <button type="button" class="btn btn-outline-primary btn-sm mx-1"
                                            data-bs-toggle="modal" data-bs-target="#edit{{ $transactionproof->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        {{-- <button type="button" class="btn btn-outline-primary btn-sm mx-1"
                                            data-bs-toggle="modal" data-bs-target="#edit{{ $transactionpurpose->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button> --}}
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $transactionproof->id }}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    {{-- =====================================
                                MODAL - EDIT
                    ====================================     --}}
                    {{-- @foreach ($purposes as $transactionpurpose)
                        <div class="modal fade" id="edit{{ $transactionpurpose->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">This can't be undone.
                                            Are you sure?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                        <a href="{{ url('admin/transaction-purpose/edit/' . $transactionpurpose->id) }}">
                                            <button type="button" class="btn btn-danger">Yes
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}

                    {{-- =====================================
                            MODAL - DELETE
                ====================================     --}}

                    @foreach ($proofs as $transactionproof)
                        <div class="modal fade" id="delete{{ $transactionproof->id }}" tabindex="-1"
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
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                        <a href="{{ url('admin/proof/destroy/' . $transactionproof->id) }}">
                                            <button type="button" class="btn btn-danger">
                                                Yes
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{-- =====================================
                            MODAL - ADD
                ====================================     --}}
                    <div class="modal fade" id="createTransproof" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">लेनदेनको प्रमाण सिर्जना</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-footer">
                                    <form id="quickForm" novalidate="novalidate" method="POST"
                                        action="{{ route('admin.proof.store') }}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="">
                                                    <div class="form-group">
                                                        <input type="text" name="title" class="form-control"
                                                            id="exampleInputName" placeholder="लेनदेनको प्रमाण"
                                                            value="{{ old('title') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">सिर्जना गर्नुहाेस</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- =====================================
                            MODAL - UPDATE
                ====================================     --}}
                    @foreach ($proofs as $transactionproof)
                        <div class="modal fade" id="edit{{ $transactionproof->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">लेनदेनको प्रमाण सम्पादन</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-footer">
                                        <form id="quickForm" novalidate="novalidate" method="POST"
                                            action="{{ route('admin.proof.update', ['id' => $transactionproof->id]) }}">

                                            @csrf
                                            <input type="hidden" name="id" value="{{ $transactionproof->id }}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="">
                                                        <div class="form-group">
                                                            <input type="text" name="title" class="form-control"
                                                                id="exampleInputName" placeholder="लेनदेनको प्रमाण"
                                                                value="{{ $transactionproof->title }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">सम्पादन गर्नुहाेस</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
