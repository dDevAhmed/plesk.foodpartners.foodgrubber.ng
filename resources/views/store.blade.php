@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Store</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Store Details</h5>
                    <!-- Account -->
                    {{-- <div class="card-body"> --}}
                        {{-- <div class="d-flex align-items-start align-items-sm-center gap-4"> --}}
                            {{-- <img src="{{ Auth::user()->image ? asset('img/avatars/' . Auth::user()->image) : asset('img/avatars/default_profile_picture.png') }}" --}}
                            {{-- todo - store logo/cover --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <hr class="my-0" /> --}}
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('store.update', auth()->id()) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name" value="{{ optional( Auth::user()->userstore)->name }}" required/>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input class="form-control" type="text" name="phone" id="phone" value="{{ optional( Auth::user()->userstore)->phone }}" required />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input class="form-control" type="text" id="address" name="address" value="{{ optional( Auth::user()->userstore)->address }}" required/>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="city">City</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="city" name="city" class="form-control" value="{{ optional( Auth::user()->userstore)->city }}" required/>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{ optional( Auth::user()->userstore)->state }}" required/>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="postcode" class="form-label">Postcode</label>
                                    <input class="form-control" type="text" id="postcode" name="postcode" value="{{ optional( Auth::user()->userstore)->postcode }}"/>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="10" required>{{ optional( Auth::user()->userstore)->description  }}</textarea>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="food_cert_number" class="form-label">Food Certificate Number</label>
                                    <input type="text" class="form-control" id="food_cert_number" name="food_cert_number" value="{{ optional( Auth::user()->userstore)->food_cert_number }}" required/>
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="food_cert" class="form-label">Food Certificate</label>
                                    <input type="file" class="form-control" id="food_cert" name="food_cert"
                                    value="{{ optional( Auth::user()->userstore)->food_cert }}" required/>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="account_number" class="form-label">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number"
                                    value="{{ optional( Auth::user()->userstore)->account_number }}" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="sort_code" class="form-label">Sort Code</label>
                                    <input type="text" class="form-control" id="sort_code" name="sort_code"
                                    value="{{ optional( Auth::user()->userstore)->sort_code }}" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="bank" class="form-label">Bank</label>
                                    <input type="text" class="form-control" id="bank" name="bank"
                                    value="{{ optional( Auth::user()->userstore)->bank }}" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
