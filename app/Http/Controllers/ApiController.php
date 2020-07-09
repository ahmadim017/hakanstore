<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Voucher;
use App\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => env('RUANGAPI_KEY'),
            'content_type' => 'application/json',
        ])->get('https://ruangapi.com/api/v1/provinces');
        return $response;
    }

    public function getCities(Request $request)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => env('RUANGAPI_KEY'),
            'content-type' => 'application/json',
        ])->get('https://ruangapi.com/api/v1/cities',[
            'province' => $request->province
        ]);


        return $response;
    }

    /**
     * get district
     */
    public function getDistricts(Request $request)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => env('RUANGAPI_KEY'),
            'content-type' => 'application/json',
        ])->get('https://ruangapi.com/api/v1/districts', [
            'city' => $request->city
        ]);


        return $response;
    }

    /**
     * get shipping
     */
    public function getShipping(Request $request)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => env('RUANGAPI_KEY'),
            'content-type' => 'application/json',
        ])->post('https://ruangapi.com/api/v1/shipping', [
            'origin'      => 113, //kabupaten demak
            'destination' => $request->destination,
            'weight'      => $request->weight,
            'courier'     => $request->courier,
        ]);


        return $response;
    }

    /**
     * get waybill
     */
    public function getWaybill(Request $request)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => env('RUANGAPI_KEY'),
            'content-type' => 'application/json',
        ])->post('https://ruangapi.com/api/v1/waybill', [
            'waybill' => $request->no_resi,
            'courier' => $request->courier
        ]);

        return $response;
    }

    public function check_voucher(Request $request)
    {
        $voucher = Voucher::where('voucher', $request->voucher)->first();
        if ($voucher) {
            return response()->json([
                'success' => true,
                'data' => $voucher,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
            ], 200);
        }
    }

    public function checkout(Request $request)
    {
        $length = 10;
        $random = '';
        for ($i=0; $i < $length; $i++) { 
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand('a'), ord('z'));
        }

        $invoice = 'INVOICE-'.Str::upper($random);

        $data_invoice = Invoice::create([
            'invoice'       => $invoice,
            'customer_id'   => auth()->guard('customer')->user()->id,
            'courier'       => $request->courier,
            'service'       => $request->service,
            'cost_courier'  => $request->cost,
            'weight'        => $request->weight,
            'name'          => $request->name,
            'phone'         => $request->phone,
            'province'      => $request->province,
            'city'          => $request->city,
            'district'      => $request->district,
            'address'       => $request->address,
            'note'          => $request->note,
            'grand_total'   => $request->grand_total + rand(10,99),
            'status'        => 'pending'

        ]);

        foreach(Cart::get()['products'] as $cart){
            $harga_set = $cart->price * $cart->discount / 100;
            $harga_diskon = $cart->price - $harga_set;

            $data_invoice->order->create([
                'invoice' => $invoice,
                'product_id' => $cart->id,
                'product_name' => $cart->tittle,
                'image' => $cart->image,
                'unit' => $cart->unit,
                'unit_weight' => $cart->unit_weight,
                'price' => $harga_diskon,
            ]);

        }

        Cart::clear();

        return response()->json([
            'success' => true,
            'data' => $data_invoice,
        ], 200);
    }
}
