<tr>
    <td>
        <img src="{{ $product->image_url }}" width="64">
    </td>
    <td class="product-row">{{ $product->name }}</td>
    <td class="product-row">{{ $product->price_formatted }}</td>
    <td class="product-row-actions">
        <a href="{{ route('product.edit', encrypt($product->id)) }}" target="_blank"
            class="btn btn-sm btn-outline-primary" title="Edit">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="#" class="btn btn-sm btn-outline-danger" title="Remove">
            <i class="fa-solid fa-trash"></i>
        </a>
    </td>
</tr>
