<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Our Categories</h1>

    {{-- Categories Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Loop through the products passed from the controller --}}
        @foreach ($categories as $category)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                {{-- Display product image (adjust path as needed) --}}
                {{-- <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover"> --}}

                <div class="p-6">
                    {{-- Display category name and link to individual category page --}}
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="{{ route('shop.categories.category', $category->slug) }}" class="text-gray-800 hover:text-blue-600">
                            {{ $category->name }}
                        </a>
                    </h2>

                    {{-- Display category products count --}}
                    <p class="text-gray-700 mb-4">Count: {{ $category->count }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
