<div class="card h-100">
    {{-- <img class="card-img-top"
        src="{{ $product->image1 ? asset('img/products/' . $product->image1) : asset('img/products/no-product-image.png') }}"
        alt="Product Image" style="height: 200px; object-fit:cover;" /> --}}
    @if ($product->image1)
        <img class="card-img-top" src="{{ $product->image1 }}" alt="Product Image"
            style="height: 200px; object-fit: cover;" />
    @else
        <img class="card-img-top" src="{{ asset('img/products/no-product-image.png') }}" alt="Product Image"
            style="height: 200px; object-fit: cover;" />
    @endif

    <div class="card-body text-start">
        <h6 class="card-subtitle text-muted mb-3">({{ $product->category }})</h6>
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">
            {{ $product->description ? Str::words($product->description, 10, '...') : 'No product description available' }}
        </p>
        <h5 class="card-title">&#8358;{{ $product->price }}</h5>
        <div class="btn-group flex justify-center" role="group" aria-label="First group">
            @if ($product->availability == 1)
                <button type="button" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Deactivate" wire:click="deactivate">
                    <i class="tf-icons bx bx-lock" style="color: #f0ad4e;"></i>
                </button>
            @else
                <button type="button" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Activate" wire:click="activate">
                    <i class="tf-icons bx bx-lock-open-alt" style="color: #14A44D;"></i>
                </button>
            @endif

            {{-- <button type="button" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="tf-icons bx bx-pencil" style="color: #17a2b8;"></i>
            </button> --}}

            <button type="button" class="btn btn-icon edit-product-btn" data-bs-toggle="modal"
                data-bs-target="#editProductModal" data-product-id="{{ $product->id }}">
                <i class="tf-icons bx bx-pencil" style="color: #17a2b8;"></i>
            </button>

            <button type="button" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                wire:click="delete">
                <i class="tf-icons bx bx-trash" style="color: #dc3545;"></i>
            </button>
        </div>
    </div>

    @if ($product->availability == 0)
        <div class="card-f bg-danger text-white text-center"
            style="height: 20px !important; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
            <p style="margin-top:-2px;">inactive</p>
        </div>
    @endif

    <div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="productForm" method="POST" action="{{ route('product.update', $product->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Hidden input for product ID -->
                    <input type="hidden" id="product_id" name="product_id">
                    <div class="modal-body">
                        <!-- Remaining form fields -->
                        <div class="row g-2">
                            <div class="col-md-6 mb-0">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $product->name }}" required />
                            </div>
                            <div class="col-md-6 mb-0">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">&#8358;</span>
                                    <input type="number" class="form-control"
                                        aria-label="Text input with 2 dropdown buttons" id="price" name="price"
                                        required />
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
                                    {{-- @foreach ($categories as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-md-12 mb-0">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="5" required></textarea>
                            </div>
                            <div class="col-md-6 mb-0">
                                <label for="image1" class="form-label">Image 1</label>
                                <input type="file" id="image1" name="image1" class="form-control" required />
                            </div>
                            <div class="col-md-6 mb-0">
                                <label for="image2" class="form-label">Image 2</label>
                                <input type="file" id="image2" name="image2" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Update product ID field in modal form based on selected product
        $('#editProductModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var productId = button.data('product-id'); // Extract product ID from data-* attributes
            var modal = $(this);
            modal.find('#product_id').val(productId); // Set the value of the product ID input field
            // Additional logic to fetch and populate other fields based on the selected product
        });
    </script>

</div>
