<div class="card h-100">
    <img class="card-img-top"
        src="{{ $product->image1 ? asset('img/products/' . $product->image1) : asset('img/products/no-product-image.png') }}"
        alt="Product Image" style="height: 200px; object-fit:cover;" />
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

            <button type="button" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="tf-icons bx bx-pencil" style="color: #17a2b8;"></i>
            </button>

            <button type="button" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" wire:click="delete">
                <i class="tf-icons bx bx-trash" style="color: #dc3545;"></i>
            </button>
        </div>
    </div>
    @if ($product->availability == 0)
        <div class="card-f bg-danger text-white text-center" style="height: 20px !important; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
            <p style="margin-top:-2px;">inactive</p>
        </div>
    @endif
</div>
