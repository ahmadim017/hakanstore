<?php

namespace App\Http\Livewire\Console\Orders;

use Livewire\Component;
use App\Invoice;

class Show extends Component
{
    public $invoice;

    public function mount($id)
    {
        $this->invoice = Invoice::findOrfail($id);
    }
    public function render()
    {
        return view('livewire.console.orders.show');
    }
}
