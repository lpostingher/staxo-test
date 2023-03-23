<tr>
    <td>
        <img src="{{ $product->image_url }}" width="64">
    </td>
    <td class="product-row">{{ $product->name }}</td>
    <td class="product-row">{{ $product->price_formatted }}</td>
    <td class="product-row">
        <div class="row">
            <div class="col-sm-2">
                <a href="{{ route('product.edit', encrypt($product->id)) }}" class="btn btn-sm btn-outline-primary"
                    title="Edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </div>
            <div class="col-sm-2">
                <form action="{{ route('product.destroy', encrypt($product->id)) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" title="Delete"
                        onclick="return confirm('Are you sure  ou want to remove this record?');">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </td>
</tr>
