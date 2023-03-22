<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <img src="{{ $product->image_url }}" width="75%">
                        </div>
                        <div class="col-sm">
                            <div class="row">
                                <h4>{{ $product->name }}</h4>
                            </div>
                            <div class="row">
                                <h3>{{ $product->price_formatted }}</h3>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" min="0" max="100" step="1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-success">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        Buy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
