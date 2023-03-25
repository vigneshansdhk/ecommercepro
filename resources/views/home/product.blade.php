<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <div class="mt-4">
                <form action="{{url('search-product')}}" method="get">
                    <input style="width:500px;" type="text" name="search" placeholder="search for something">
                    <input type="submit" value="search">
                </form>
            </div>
        </div>
        <div class="row">
            @foreach ($product as $pdt)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('/product-details') }}/{{ $pdt->id }}" class="option1">
                                    Products Details
                                </a>
                                <form action="{{url('add-cart')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="pdt_id" value="{{ $pdt->id }}">
                                        <div class="col-md-4">
                                            <input type="number" name="quantity" value="1" min="1">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" value="Add Cart">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="product/{{ $pdt->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $pdt->title }}
                            </h5>
                            @if ($pdt->discount_price != null)
                                <h6 style="color: red;">
                                    <span>Discount Price</span> <br>
                                    ${{ $pdt->discount_price }}
                                </h6>
                                <h6 style="text-decoration: line-through; color:blue">
                                    ${{ $pdt->price }}
                                </h6>
                            @else
                                <h6 style="color: blue;">
                                    ${{ $pdt->price }}
                                </h6>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
            {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}

        </div>
        <div class="btn-box">
            <a href="">
                View All products
            </a>
        </div>
    </div>
</section>
