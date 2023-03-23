<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('product.create') }}" class="btn btn-outline-primary btn-sm mb-3">
                        <i class="fa-solid fa-plus"></i>
                        New product
                    </a>
                    <x-search></x-search>
                    <p>Search returned {{ count($products) }} items</p>
                    <hr>
                    @include('product.partials.table')
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>