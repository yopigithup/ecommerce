<div class="py-6 bg-white sm:py-8 lg:py-12">
    <div class="max-w-screen-lg px-4 mx-auto md:px-8">
        <div class="grid gap-8 md:grid-cols-2">
            <div class="space-y-4">
                <div class="relative overflow-hidden bg-gray-100 rounded-lg">
                    <img src="{{ $product->image_url }}" loading="lazy" alt="{{ $product->name }}"
                        class="object-cover object-center w-full h-full" />
                    <span
                        class="absolute left-0 top-0 rounded-br-lg bg-red-500 px-3 py-1.5 text-sm uppercase tracking-wider text-white">{{ $product->is_on_sale ? 'Sale' : '' }}</span>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @foreach ($product->thumbnails as $thumbnail)
                        <div class="overflow-hidden bg-gray-100 rounded-lg">
                            <img src="{{ $thumbnail->url }}" loading="lazy" alt="{{ $product->name }}"
                                class="object-cover object-center w-full h-full" />
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="md:py-8">
                <div class="mb-2 md:mb-3">
                    <span class="mb-0.5 inline-block text-gray-500">{{ $product->brand }}</span>
                    <h2 class="text-2xl font-bold text-gray-800 lg:text-3xl">{{ $product->name }}</h2>
                </div>

                <div class="flex items-center mb-6 md:mb-10">
                    <div class="-ml-1 flex gap-0.5">
                        @for ($i = 0; $i < 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 {{ $i < $product->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <span class="ml-2 text-sm text-gray-500">{{ $product->rating }}</span>
                    <a href="#"
                        class="ml-4 text-sm font-semibold text-indigo-500 transition duration-100 hover:text-indigo-600 active:text-indigo-700">view
                        all {{ $product->reviews_count }} reviews</a>
                </div>

                <!-- Color selection -->
                <div class="mb-4 md:mb-6">
                    <span class="inline-block mb-3 text-sm font-semibold text-gray-500 md:text-base">Color</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($product->colors as $color)
                            <button type="button"
                                class="h-8 w-8 rounded-full border bg-{{ $color->hex_code }} ring-2 ring-transparent ring-offset-1 transition duration-100 hover:ring-gray-200"></button>
                        @endforeach
                    </div>
                </div>

                <!-- Size selection -->
                <div class="mb-8 md:mb-10">
                    <span class="inline-block mb-3 text-sm font-semibold text-gray-500 md:text-base">Size</span>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($product->sizes as $size)
                            <button type="button"
                                class="flex items-center justify-center w-12 h-8 text-sm font-semibold text-center text-gray-800 transition duration-100 bg-white border rounded-md hover:bg-gray-100 active:bg-gray-200">{{ $size }}</button>
                        @endforeach
                    </div>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <div class="flex items-end gap-2">
                        <span class="text-xl font-bold text-gray-800 md:text-2xl">${{ $product->price }}</span>
                        @if ($product->is_on_sale)
                            <span class="mb-0.5 text-red-500 line-through">${{ $product->original_price }}</span>
                        @endif
                    </div>
                    <span class="text-sm text-gray-500">incl. VAT plus shipping</span>
                </div>

                <!-- Shipping notice -->
                <div class="flex items-center gap-2 mb-6 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                    <span class="text-sm">2-4 day shipping</span>
                </div>

                <!-- Buttons -->
                <div class="flex gap-2.5">
                    <button wire:click="addToCart"
                        class="flex-1 inline-block px-8 py-3 text-sm font-semibold text-center text-white transition duration-100 bg-indigo-500 rounded-lg outline-none ring-indigo-300 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 sm:flex-none md:text-base">Add
                        to cart</button>

                    <a href="#"
                        class="inline-block px-4 py-3 text-sm font-semibold text-center text-gray-500 transition duration-100 bg-gray-200 rounded-lg outline-none ring-indigo-300 hover:bg-gray-300 focus-visible:ring active:text-gray-700 md:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </a>
                </div>

                <!-- Description -->
                <div class="mt-10 md:mt-16 lg:mt-20">
                    <div class="mb-3 text-lg font-semibold text-gray-800">Description</div>
                    <p class="text-gray-500">{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
