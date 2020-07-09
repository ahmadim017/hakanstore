<?php

namespace App\Http\Livewire\Console\Payment;

use Livewire\Component;
use App\PaymentConfirmation;

class Show extends Component
{
    public $payment;

    public function mount($id)
    {
        $this->payment = PaymentConfirmation::findOrfail($id);
    }

    public function render()
    {
        return view('livewire.console.payment.show');
    }
}
