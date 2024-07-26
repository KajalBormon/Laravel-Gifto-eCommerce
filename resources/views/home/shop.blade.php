<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      @if(session('status'))
      <div>
        <p class="text-success">
          {{ session('status') }}
        </p>
      </div>
      @endif
      <div class="row">
        @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{ route('product_details',$product->id) }}">
              <div class="img-box">
                <img src="{{ asset('/storage/'.$product->image) }}" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  {{ $product->title }}
                </h6>
                <h6>
                  Price
                  <span>
                    ${{ $product->price }}
                  </span>
                </h6>
                
              </div>
            </a>
            <a href="{{ route('add_cart',$product->id) }}" class="btn btn-warning">Add to Cart</a>
          </div>
        </div>
        @endforeach
      </div>
{{--       <div class="btn-box">
        <a href="">
          View All Products
        </a>
      </div> --}}
    </div>
  </section>