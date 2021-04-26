@extends('layouts.admin')

@section('content')

    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">

        <!-- General elements -->
        <h4
            class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
        >
            {{ isset($product) ? 'Update Product' : 'Add Product' }}
        </h4>
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
        >
          <form action="{{ isset($product) ? route('product.update', $product->slug) : route('product.store') }}" method="post">
            @csrf
            @if(isset($product))
                @method('PATCH')
            @endif
              <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Product Name</span>
            <input name="name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Jane Doe"
                value="{{ isset($product) ? $product->name : '' }}"
            />
            </label>

            @if(isset($product))
                <input name="slug"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Jane Doe"
                    value="{{ $product->slug}}"
                />
            @endif

            <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Product Price</span>
            <input name="price"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="50"
                 value="{{ isset($product) ? $product->price : '' }}"
            />
            </label>

            <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Description</span>
            <textarea name="description"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                rows="3"
                placeholder="Enter some long form content."
            >{{ isset($product) ? $product->description : '' }}</textarea>
            </label>

            <button type="submit">Save Product</button>
          <form>

        </div>


    </main>

@endsection