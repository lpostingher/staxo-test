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
                                <input name="name" id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $product->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-auto">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="price" id="price"
                                        class="form-control money @error('price') is-invalid @enderror"
                                        value="{{ old('price', $product->price) }}">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-sm">
                                <label for="image" class="form-label">Product image</label>
                                <input class="form-control  @error('image') is-invalid @enderror" type="file"
                                    id="image" name="image" accept="image/png, image/jpeg">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-auto">
                                <img src="{{ $product->image_url }}" width="128">
                            </div>
                            @if ($product->image_path)
                                <div class="col-sm-auto">
                                    <a href="{{ route('product.removeImage', encrypt($product->id)) }}"
                                        onclick="return confirm('Are you sure  ou want to remove this image?');">Remove
                                        image</a>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-auto">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            <div class="col-sm-auto">
                                <a href="{{ route('product.index') }}" role="button"
                                    class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
