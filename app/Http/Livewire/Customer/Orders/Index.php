<?php

namespace App\Http\Livewire\Customer\Orders;

use App\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $invoice = Invoice::where('customer_id', auth()->guard('customer')->user()->id)->latest()->paginate(5);

        return view('livewire.customer.orders.index', [
            'invoice' => $invoice
        ]);
    }
}
