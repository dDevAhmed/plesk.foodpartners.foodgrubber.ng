@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Store /</span> Orders</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-profile"
                                aria-selected="false">
                                New Orders
                                <span
                                    class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ $newOrdersCount }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-home"
                                aria-selected="true">
                                Orders
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
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
                                        @foreach ($newOrders as $newOrder)
                                            <tr>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong></strong>
                                                </td>
                                                <td>{{ $newOrder->order_date }}</td>
                                                <td>
                                                    &#8358; {{ $newOrder->total_amount }}
                                                </td>
                                                <td>{{ $newOrder->delivery_address }}</td> {{-- todo use ellisis for address --}}
                                                <td>
                                                    {{-- fixme - goes to order detail page / modal --}}
                                                    <a href="#">view</a>
                                                    {{-- <i class="fa-thin fa-binoculars"></i>  --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover dataTable">
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
                                        @foreach ($deliveredOrders as $deliveredOrder)
                                            <tr>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong></strong>
                                                </td>
                                                <td>{{ $deliveredOrder->order_date }}</td>
                                                <td>
                                                    &#8358; {{ $deliveredOrder->total_amount }}
                                                </td>
                                                <td>{{ $deliveredOrder->delivery_address }}</td> {{-- todo use ellisis for address --}}
                                                <td>
                                                    {{-- fixme - goes to order detail page / modal --}}
                                                    <a href="#">view</a>
                                                    {{-- <i class="fa-thin fa-binoculars"></i>  --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
