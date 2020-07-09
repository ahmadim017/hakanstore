<?php

namespace App\Http\Livewire\Console\Payment;

use Livewire\Component;
use App\PaymentConfirmation;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $updateQueryString = ['search'];

    public function render()
    {
        if ($this->search != "") {
            $payment = PaymentConfirmation::where('invoice','LIKE','%'. $this->search .'%')->latest()->paginate(10);
        } else {
            $payment = PaymentConfirmation::latest()->paginate(10);
        }
        return view('livewire.console.payment.index',['payment' => $payment]);
    }
}
