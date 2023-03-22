<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <x-product-row :$product></x-product-row>
        @endforeach
    </tbody>
</table>
