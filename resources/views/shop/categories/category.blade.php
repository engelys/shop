<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Category: {{ $category->name }} ({{ $category->count }})</h1>

    {{-- Product Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            {{-- Display product image (adjust path as needed) --}}
            <img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}"
                 class="w-full h-48 object-cover">

            @foreach($category->products as $product)
                <div class="p-6">

                    {{-- Display product name and link to individual product page --}}
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="{{ route('shop.products.show', $product->slug) }}" class="text-gray-800 hover:text-blue-600">
                            <h3 class="text-3xl font-bold mb-6">{{ $product->name }}</h3>
                        </a>
                    </h2>
                </div>
            @endforeach
        </div>
    </div>
</div>