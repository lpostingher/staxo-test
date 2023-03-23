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
                            <form action="{{ route('order.create') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ encrypt($product->id) }}">
                                <div class="row">
                                    <h4>{{ $product->name }}</h4>
                                </div>
                                <div class="row">
                                    <h3>{{ $product->price_formatted }}</h3>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input id="quantity" name="quantity" type="number"
                                               class="form-control @error('quantity') is-invalid @enderror" min="1"
                                               max="100" step="1"
                                                value="{{ old('quantity', 1) }}">
                                        @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-auto">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            Buy
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
