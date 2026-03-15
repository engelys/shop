<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">{{$product->name}}</h1>

    {{-- Product Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            {{-- Display product image (adjust path as needed) --}}
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"
                 class="w-full h-48 object-cover">

            <div class="p-6">
                {{-- Display product price --}}
                <p class="text-gray-700 mb-4">${{ number_format($product->price, 2) }}</p>

                {{-- Add to cart button (example form action) --}}
                {{--{{ route('cart.add', $product) }}--}}
                <form action="" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>