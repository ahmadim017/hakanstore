<div class="mb-5">
    <div class="container-fluid" style="margin-top: 80px;">

            <div class="jumbotron rounded-lg shadow" style="background-color: #566479;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="card border-0 shadow rounded-full">
                            <div class="card-body">
                                <img src="{{ Storage::url('public/categories/'.$category_image) }}" style="width: 70px">
                            </div>
                        </div>
                    </div>
                    <div class="text-center text-white mt-3 font-weight-bold" style="font-size: 24px">{{ $category_name }}</div>
                </div>
            </div>

        <div class="row">

            @foreach ($products as $product)

            @php
            $harga_set = $product->price * $product->discount / 100;
            $harga_diskon = $product->price - $harga_set;
            @endphp

            <div class="col-6 col-md-3 mb-4">
                <div class="card h-100 border-0 shadow rounded-md">
                    <div class="card-img">
                    <a href="{{route('frontend.home.show', $product->id)}}"> <img src="{{ Storage::url('public/products/'.$product->image) }}" class="w-100 rounded-t-md"
                            style="height: 15em;object-fit:cover"></a>
                    </div>
                    <div class="card-body">
                        <div class="card-title font-weight-bold" style="font-size:20px">
                            {{ $product->title }}
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
