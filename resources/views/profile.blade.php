@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Profile</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <form action="{{ route('profile.avatar.update') }}" method="POST" id="avatarForm"
                            enctype="multipart/form-data">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ Auth::user()->avatar ? asset('img/avatars/' . Auth::user()->avatar) : asset('img/avatars/default_profile_picture.png') }}"
                                    alt="user-avatar" class="d-block rounded" height="100" width="100"
                                    id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0"
                                        id="avatarUpload">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="avatarInput" class="account-file-input" hidden
                                            accept="image/png, image/jpeg" name="avatar" />
                                    </label>
                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('profile.update', auth()->id()) }} ">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ optional(Auth::user())->name }}" disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input class="form-control" type="text" name="phone" id="phone"
                                        value="{{ optional(Auth::user())->phone }}" required />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ optional(Auth::user())->email }}" disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="address">Address</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="address" name="address" class="form-control"
                                            value="{{ optional(Auth::user())->address }}" required />
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ optional(Auth::user())->city }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">State</label>
                                    <input class="form-control" type="text" id="state" name="state"
                                        value="{{ optional(Auth::user())->state }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="country">Country</label>
                                    {{-- fixme - use the coutries api =  https://restcountries.com/v3.1/all --}}
                                    <select id="country" class="select2 form-select" name="country">
                                        {{-- fixme - add country list --}}
                                        <option value="">{{ optional(Auth::user())->country ?? 'Select Country' }}
                                        </option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                        <option value="China">China</option>
                                        <option value="France">France</option>
                                        <option value="Germany">Germany</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="postcode" class="form-label">Post Code</label>
                                    <input type="text" class="form-control" id="postcode" name="postcode"
                                        maxlength="6" value="{{ optional(Auth::user())->postcode }}" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update Profile</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">Login Credentials</h5>
                    <div class="card-body">
                        <form id="formPasswordSettings" method="POST" action="{{ route('profile.password.update') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" id="password" name="password"
                                        required />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="password_confirmation" required />
                                    <span id="passwordError" style="color: red;"></span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#avatarUpload').on('click', function() {
                    alert('button clicked');
                    $('#avatarInput').trigger('click');
                });

                $('#avatarInput').on('change', function(event) {
                    var selectedImageFile = event.target.files[0];
                    if (selectedImageFile) {
                        var imageObjectURL = URL.createObjectURL(selectedImageFile);
                        $('#avatarImage').attr('src', imageObjectURL);
                        $('#avatarForm').submit(); // submit the form
                    }
                });
            });
        </script>

        <script>
            // fixme - use live
            $(document).ready(function() {
                $('#password_confirmation').on('input', function() {
                    var password = $('#password').val();
                    var passwordConfirmation = $(this).val();

                    if (password !== passwordConfirmation) {
                        $('#passwordError').text('Passwords do not match');
                        $('#formPasswordSettings button[type="submit"]').prop('disabled', true);
                    } else {
                        $('#passwordError').text('');
                        $('#formPasswordSettings button[type="submit"]').prop('disabled', false);
                    }
                });
            });
        </script>
    @endpush
@endsection
