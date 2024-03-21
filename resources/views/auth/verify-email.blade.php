<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('vendors/sneat/assets/') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Food Partners | Foodgrubber</title>

    <meta name="description" content="" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('vendors/sneat/assets/vendor/fonts/boxicons.css') }}" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/sneat/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendors/sneat/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('vendors/sneat/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendors/sneat/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('vendors/sneat/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('vendors/sneat/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('vendors/sneat/assets/js/config.js') }}"></script>

    <!-- datatable -->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" /> --}}
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

  </head>

  <body>
    <!-- Content -->

     <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="https://foodgrubbergreen.com/" class="app-brand-link gap-2">
                                <img src="{{ asset('img/logo.png') }}" alt="foodgrubber logo" width="120px">
                                {{-- <span class="app-brand-text demo text-body fw-bolder">Foodgrubber</span> --}}
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2 text-center">Verify Email</h4>
                        <p class="mb-4">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <button class="btn btn-primary d-grid w-100"
                                style="background: #454545; color: #fef301; border: none;">Resend Verification Email</button>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="mt-4 text-center" style="background: transparent; color: #01c324; border: none;">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>

                        {{-- <div class="text-center">
                            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center" style="color: #01c324;">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                <span>Back to login</span>
                            </a>
                        </div> --}}
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <!-- build:js vendors/sneat/assets/vendor/js/core.js -->
    <script src="{{ asset('vendors/sneat/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendors/sneat/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendors/sneat/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendors/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('vendors/sneat/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    
    <!-- Vendors JS -->
    <script src="{{ asset('vendors/sneat/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('vendors/sneat/assets/js/main.js') }}"></script>
    
    <!-- Page JS -->
    <script src="{{ asset('vendors/sneat/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- datatable -->
    {{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> --}}
    <!-- Page level plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/plugins/datatables/datatables-demo.js') }}"></script>

    <!-- UI Modals -->
    <script src="{{ asset('vendors/sneat/assets/js/ui-modals.js') }}"></script>

    <!-- UI Modals -->
    <script src="{{ asset('vendors/sneat/assets/js/ui-toasts.js') }}"></script>
    
  </body>
</html>

