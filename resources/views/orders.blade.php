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
                                        @if ($newOrdersCount == 0)
                                            <tr><td colspan="5"><p class="text-center p-2">No orders yet</p></td></tr>
                                        @else
                                            @foreach ($newOrders as $newOrder)
                                                <tr data-bs-toggle="collapse" data-bs-target="#collapse{{ $newOrder->id }}"
                                                    class="accordion-toggle">
                                                    <td>{{ $loop->index + 1 . '.' }}</td>
                                                    <td>{{ $newOrder->order_date }}</td>
                                                    <td>&#8358; {{ $newOrder->total_amount }}</td>
                                                    <td>{{ $newOrder->delivery_address }} {{-- todo use ellisis for address --}}</td>
                                                    <td>
                                                        <a class="me-1" href="#collapse{{ $newOrder->id }}" role="button"
                                                            aria-expanded="false"
                                                            aria-controls="collapse{{ $newOrder->id }}"
                                                            style="color: var(--foodgrubber-secondary-color);">
                                                            View Items
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr class="collapse" id="collapse{{ $newOrder->id }}">
                                                    <td colspan="6">
                                                        <div class="table-responsive">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Product</th>
                                                                        <th>Quantity</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php($serialLetter = 'A')
                                                                    @foreach ($newOrder->items as $orderItem)
                                                                        <tr>
                                                                            <td>{{ $serialLetter++ }}</td>
                                                                            <td>{{ $orderItem->product }}</td>
                                                                            <td>{{ $orderItem->quantity }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        {{-- <a class="btn btn-primary me-1" href="#acceptOrder{{ $newOrder->id }}" --}}
                                                        <form action="{{ route('orders.order.accept', $newOrder->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT') <input type="hidden" name="newOrderId"
                                                                value="{{ $newOrder->id }}">
                                                            <button type="submit" class="btn btn-primary"
                                                                style="background-color: var(--foodgrubber-tertiary-color); color: var(--foodgrubber-primary-color);">Accept
                                                                Order</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
                                                <td>{{ $loop->index + 1 . '.' }}</td>
                                                <td>{{ $deliveredOrder->order_date }}</td>
                                                <td>
                                                    &#8358; {{ $deliveredOrder->total_amount }}
                                                </td>
                                                <td>{{ $deliveredOrder->delivery_address }}</td> {{-- todo use ellisis for address --}}
                                                <td>
                                                    <a href="#"
                                                        style="color: var(--foodgrubber-secondary-color);">View</a>
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
