<div class="mb-5">
    <div class="container-fluid" style="margin-top: 70px;">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @php $active = "active" @endphp
                @foreach ($sliders as $slider)
                <div class="carousel-item {{ $active }}">
                    <a href="{{ $slider->link }}">
                        <img src="{{ Storage::url('public/sliders/').$slider->image }}"
                            class="d-block w-100 rounded-lg">
                    </a>
                </div>
                {{ $active = "" }}
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row text-center">
            @foreach ($global_categories as $category)
            <div class="col-4 col-md-2 mb-4">
                <a href="/category/{{ $category->slug }}" class="text-decoration-none text-dark">
                    <div class="card h-100 border-0 shadow p-2 rounded-lg">
                        <div class="card-img">
                            <img src="{{ Storage::url('public/categories/'.$category->image) }}"
                                class="w-50">
                            <div class="title-category mt-2 font-weight-bold">{{ $category->name }}</div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            @foreach ($products as $product)

            @php
            $harga_set = $product->price * $product->discount / 100;
            $harga_diskon = $product->price - $harga_set;
            @endphp

            <div class="col-4 col-md-2 mb-4">
                <div class="card h-100 border-0 shadow rounded-md">
                    <div class="card-img">
                    <a href="{{route('frontend.home.show', $product->id)}}"><img src="{{ Storage::url('public/products/'.$product->image) }}" class="w-100 rounded-t-md"
                            style="height: 15em;object-fit:cover"></a>
                    </div>
                    <div class="card-body">
                        <div class="card-title font-weight-bold" style="font-size:20px">
                            {{ $product->tittle }}
                        </div>
                        <div class="satuan" style="color: #999">{{ $product->unit_weight }} {{ $product->unit }}</div>


                        @if ($product->discount > 0)
                        <div class="discount mt-2" style="color: #999"><s>{{ money_id($product->price) }}</s> <span
                                style="background-color: #F69C07" class="badge badge-pill badge-warning text-white">Save
                                {{ $product->discount }} %</span>
                        </div>
                        @endif


                        <div class="price font-weight-bold mt-3" style="color: #47b04b;font-size:20px">
                            {{ money_id($harga_diskon) }}</div>
                        <button wire:click="addToCart({{ $product->id }})" class="btn btn-success btn-md mt-3 btn-block shadow-md">Beli</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row justify-content-center mt-5">
            @if($products->hasMorePages())
                <button wire:click="loadMore()" class="btn btn-dark btn-lg shadow-md">Load More</button>
            @endif
        </div>
    </div>
</div>
