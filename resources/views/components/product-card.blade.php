<div class="card">
  <img src="{{ $product->image_url }}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{ $product->price_formatted }}</h5>
    <p class="card-text cut-text">{{ $product->name }}</p>
    <a href="{{route('product.show', encrypt($product->id))}}" class="btn btn-primary btn-sm">
      <i class="fa-solid fa-circle-info"></i>
      More details
    </a>
  </div>
</div>