@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Store /</span> Store</h4>

        @if (session('error') || session('success'))
            <div class="alert {{ session('error') ? 'alert-danger' : 'alert-success' }}">
                {{ session('error') ? session('error') : session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Store Details</h5>

                    <!-- Store Logo / cover -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <img class="d-block rounded border" height="160" width="160" id="storeLogo"
                                    alt="Store Logo"
                                    src="{{ isset(Auth::user()->userstore->logo) ? Auth::user()->userstore->logo : asset('img/default_store_logo.jpg') }}" />
                                <br>

                                <form id="logoForm" action="{{ route('store.logo.update') }}" method="POST"
                                    enctype="multipart/form-data" style="display: none;">
                                    @csrf
                                    <input type="file" id="logo" name="logo" class="form-control"
                                        accept="image/*">
                                </form>

                                <button type="button" class="btn btn-primary" id="logoUpload">Change Logo</button>
                            </div>

                            <div class="col-md-8">
                                <img src="img/default_store_cover.jpg" alt="user-avatar" class="d-block rounded border"
                                    height="160" width="360" id="uploadedAvatar" />
                                <br>
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new cover</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        {{-- <input type="file" id="upload" class="account-file-input" hidden
                                            accept="image/png, image/jpeg" /> --}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('store.update', auth()->id()) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ optional(Auth::user()->userstore)->name }}" required />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input class="form-control" type="text" name="phone" id="phone"
                                        value="{{ optional(Auth::user()->userstore)->phone }}" required />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input class="form-control" type="text" id="address" name="address"
                                        value="{{ optional(Auth::user()->userstore)->address }}" required />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="city">City</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="city" name="city" class="form-control"
                                            value="{{ optional(Auth::user()->userstore)->city }}" required />
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        value="{{ optional(Auth::user()->userstore)->state }}" required />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="postcode" class="form-label">Postcode</label>
                                    <input class="form-control" type="text" id="postcode" name="postcode"
                                        value="{{ optional(Auth::user()->userstore)->postcode }}" />
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="10" required>{{ optional(Auth::user()->userstore)->description }}</textarea>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="food_cert_number" class="form-label">Food Certificate Number</label>
                                    <input type="text" class="form-control" id="food_cert_number"
                                        name="food_cert_number"
                                        value="{{ optional(Auth::user()->userstore)->food_cert_number }}" required />
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="food_cert" class="form-label">Food Certificate</label>
                                    <input type="file" class="form-control" id="food_cert" name="food_cert"
                                        value="{{ optional(Auth::user()->userstore)->food_cert }}" required />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="account_number" class="form-label">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number"
                                        value="{{ optional(Auth::user()->userstore)->account_number }}" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="sort_code" class="form-label">Sort Code</label>
                                    <input type="text" class="form-control" id="sort_code" name="sort_code"
                                        value="{{ optional(Auth::user()->userstore)->sort_code }}" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="bank" class="form-label">Bank</label>
                                    <input type="text" class="form-control" id="bank" name="bank"
                                        value="{{ optional(Auth::user()->userstore)->bank }}" />
                                </div>
                            </div>
                            <div class="mt-2">
                                @if (!Auth::user()->userstore)
                                    <button type="submit" class="btn btn-primary me-2">Create store</button>
                                @else
                                    <button type="submit" class="btn btn-primary me-2">Update store</button>
                                @endif
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
            @if (session('success'))
                showToast("{{ session('success') }}", "success");
            @elseif (session('fail'))
                showToast("{{ session('fail') }}", "fail");
            @endif
        </script> --}}

    <script>
        document.getElementById('logoUpload').addEventListener('click', function() {
            document.getElementById('logo').click();
        });

        document.getElementById('logo').addEventListener('change', function() {
            document.getElementById('logoForm').submit();
        });
    </script>
@endsection
