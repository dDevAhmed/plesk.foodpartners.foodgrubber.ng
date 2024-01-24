@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orders /</span> Store</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Recent Orders</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date / Time</th>
                                    <th>Amount</th>
                                    <th>Delivery Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                {{-- @foreach ($orders as $order)
                                    {
                                    }
                                @endforeach --}}
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong></strong></td>
                                    <td>Albert Cook</td>
                                    <td>
                                        &#8358; 6000
                                    </td>
                                    <td>Abuja, Asoko...</td>    {{-- todo use ellisis for address --}}
                                    <td>
                                        {{-- fixme - goes to order detail page / modal --}}
                                        <a href="#">view</a>
                                        {{-- <i class="fa-thin fa-binoculars"></i>  --}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
