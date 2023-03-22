<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->id ? $product->name : 'New Product' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ $formRoute }}" method="post" enctype="multipart/form-data">
                        @method($product->id ? 'PUT' : 'POST')
                        @csrf
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" id="name" type="text" class="form-control"
                                    value="{{ old('name', $product->name) }}">
                            </div>
                            <div class="col-sm-auto">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="price" id="price" class="form-control money"
                                        value="{{ old('price', $product->price) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-sm">
                                <label for="image" class="form-label">Product image</label>
                                <input class="form-control" type="file" id="image" name="image" accept="image/png, image/jpeg">
                            </div>
                            <div class="col-sm-auto">
                                <img src="{{ $product->image_url }}" width="128">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-auto">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
