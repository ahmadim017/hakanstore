<?php

namespace App\Http\Livewire\Customer\Orders;

use App\Invoice;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Show extends Component
{
    /**
     * public variable
     */
    public $invoice;

    /**
     * mount or construct function
     */
    public function mount($id)
    {
        $this->invoice  = Invoice::find($id);
    }

    public function render()
    {
        return view('livewire.customer.orders.show');
    }
}