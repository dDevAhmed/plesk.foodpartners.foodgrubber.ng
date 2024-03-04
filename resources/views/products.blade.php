@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Store /</span> Products</h4>

        <div class="row">
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    Add Product
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Add New Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('product.add') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row g-2">
                                        <div class="col-md-6 mb-0">
                                            <label for="name" class="form-label">Product Name</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                required />
                                        </div>
                                        <div class="col-md-6 mb-0">
                                            <label for="price" class="form-label">Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">&#8358;</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Text input with 2 dropdown buttons" id="price"
                                                    name="price" required />
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-0">
                                            <label for="price" class="form-label">Measurement</label>
                                            <input type="text" class="form-control" id="measurement" name="measurement"
                                                placeholder="kg, wrap, carton..." required />
                                        </div>
                                        <div class="col-md-4 mb-0">
                                            <label for="cuisine" class="form-label">Cuisine</label>
                                            {{-- fixme - cuisine and category and measurement are coming from admin database --}}
                                            <select class="form-select" id="cuisine" name="cuisine"
                                                aria-label="Default select example">
                                                <option value="">...select product cuisine...</option>
                                                <option value="African">African</option>
                                                <option value="Indian">Indian</option>
                                                <option value="Chinese">Chinese</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-0">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-select" id="category" name="category"
                                                aria-label="Default select example" required>
                                                <option value="">...select product category...</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category }}">{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-0">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" rows="5" required></textarea>
                                        </div>
                                        <div class="col-md-6 mb-0">
                                            <label for="image1" class="form-label">Image 1</label>
                                            <input type="file" id="image1" name="image1" class="form-control"
                                                required />
                                        </div>
                                        <div class="col-md-6 mb-0">
                                            <label for="image2" class="form-label">Image 2</label>
                                            <input type="file" id="image2" name="image2" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Add product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Search -->
                @livewire('search-product')
                <!-- /Search -->

                <div class="row mb-5">
                    @if (Auth::user()->product)
                        @foreach ($products as $product)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                @livewire('product-card', ['product' => $product])
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- {{ $products->links() }} --}}

                <!-- Basic Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">

                        <li class="page-item first">
                            <a class="page-link" href="{{ $products->url(1) }}"><i
                                    class="tf-icon bx bx-chevrons-left"></i></a>
                        </li>
                        <li class="page-item prev">
                            <a class="page-link" href="{{ $products->previousPageUrl() }}"><i
                                    class="tf-icon bx bx-chevron-left"></i></a>
                        </li>

                        @foreach ($products->getUrlRange($products->currentPage(), 5) as $page => $url)
                            @if ($page <= $products->lastPage())
                                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach


                        <li class="page-item next">
                            <a class="page-link" href="{{ $products->nextPageUrl() }}"><i
                                    class="tf-icon bx bx-chevron-right"></i></a>
                        </li>
                        <li class="page-item last">
                            <a class="page-link" href="{{ $products->url($products->lastPage()) }}"><i
                                    class="tf-icon bx bx-chevrons-right"></i></a>
                        </li>
                    </ul>
                </nav>

                <!--/ Basic Pagination -->
            </div>
        </div>
    </div>
@endsection
