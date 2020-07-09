<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-shopping-cart"></i> DETAIL ORDERS
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td class="bg-light" style="width: 25%">
                            NO. INVOICE
                        </td>
                        <td style="width: 1%">:</td>
                        <td>
                            {{ $invoice->invoice }}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            NAMA LENGKAP
                        </td>
                        <td>:</td>
                        <td>
                            {{ $invoice->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            NO. TELP / WA
                        </td>
                        <td>:</td>
                        <td>
                            {{ $invoice->phone }}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            KURIR / SERVICE / COST
                        </td>
                        <td>:</td>
                        <td>
                            {{ strtoupper($invoice->courier) }} | {{ $invoice->service }} -
                            {{ money_id($invoice->cost_courier) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            PROVINSI
                        </td>
                        <td>:</td>
                        <td>
                            @php
                            $response = Http::withHeaders([
                                'accept' => 'application/json',
                                'authorization' => env('RUANGAPI_KEY'),
                                'content-type' => 'application/json',
                            ])->get('https://ruangapi.com/api/v1/cities',[
                            'province' => $invoice->province
                            ]);


                            echo $response['data']['province']['name'];


                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            KOTA / KABUPATEN
                        </td>
                        <td>:</td>
                        <td>
                            @php
                            $response = Http::withHeaders([
                                'accept' => 'application/json',
                                'authorization' => env('RUANGAPI_KEY'),
                                'content-type' => 'application/json',
                            ])->get('https://ruangapi.com/api/v1/cities',[
                            'province' => $invoice->province,
                            'id' => $invoice->city
                            ]);

                            echo $response['data']['results']['name'];

                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            KECAMATAN
                        </td>
                        <td>:</td>
                        <td>
                            @php
                            $response = Http::withHeaders([
                                'accept' => 'application/json',
                                'authorization' => env('RUANGAPI_KEY'),
                                'content-type' => 'application/json',
                            ])->get('https://ruangapi.com/api/v1/districts', [
                            'city' => $invoice->city,
                            'id' => $invoice->district
                            ]);

                            echo $response['data']['results']['name'];


                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            ALAMAT LENGKAP
                        </td>
                        <td>:</td>
                        <td>
                            {{ $invoice->address }}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            TOTAL PEMBELIAN
                        </td>
                        <td>:</td>
                        <td>
                            {{ money_id($invoice->grand_total) }}
                        </td>
                    </tr>
                </table>

                <hr>
                <div class="breadcrumb">
                    
                    </div>
                <table class="table"
                    style="border-style: solid !important;border-color: rgb(198, 206, 214) !important;">
                    <tbody>

                        @foreach ($invoice->order as $order)

                        @php
                        $harga_set = $order->price * $order->discount / 100;
                        $harga_diskon = $order->price - $harga_set;
                        @endphp


                        <tr style="background: #edf2f7;">
                            <td class="b-none" width="15%">
                                <div class="wrapper-image-cart">
                                    <img src="{{ Storage::url('public/products/').$order->image }}"
                                        style="width: 100%;border-radius: .5rem">
                                </div>
                            </td>
                            <td class="b-none">
                                <h5><b>{{ $order->product_name }}</b></h5>
                                <table class="table-borderless" style="font-size: 14px">
                                    <tr>
                                        <td style="padding: .20rem">PRICE</td>
                                        <td style="padding: .20rem">:</td>
                                        <td style="padding: .20rem">{{ money_id($harga_diskon) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: .20rem">QTY</td>
                                        <td style="padding: .20rem">:</td>
                                        <td style="padding: .20rem"><b>{{ $order->unit_weight }}
                                                {{ $order->unit }}</b></td>
                                    </tr>
                                </table>

                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>

                <a href="{{ route('console.orders.index') }}" class="btn btn-dark btn-md"><i
                        class="fa fa-long-arrow-alt-left"></i>
                    KEMBALI</a>

            </div>
        </div>
    </div>
</div>
