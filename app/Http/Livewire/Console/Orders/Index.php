<?php

namespace App\Http\Livewire\Console\Orders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Invoice;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $updateQueryString = ['search'];

    public function render()
    {
        if ($this->search != "") {
            $invoice = Invoice::where('invoice','LIKE','%'. $this->search . '%')->latest()->paginate(10);
        } else {
            $invoice = Invoice::latest()->paginate(10);
        }
        return view('livewire.console.orders.index',['invoice' => $invoice]);
    }
}
