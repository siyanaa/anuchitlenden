<!-- BEGIN: Alert -->
<div class="">
    @if (session()->has('success'))
        <div class="alert alert-success alert-icon d-flex gap-4" role="alert" style="width: 700px;">
            <div class="d-flex gap-4">
                <div class="alert-icon-aside">
                    <i class="far fa-flag"></i>
                </div>
                <div class="alert-icon-content">
                    {{ session('success') }}
                </div>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-icon d-flex gap-4" role="alert" style="width: 700px;">
            <div class="d-flex gap-4">
                <div class="alert-icon-aside">
                    <i class="far fa-flag"></i>
                </div>
                <div class="alert-icon-content">
                    {{ session('error') }}
                </div>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<!-- END: Alert -->