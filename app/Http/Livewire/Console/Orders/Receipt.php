<?php

namespace App\Http\Livewire\Console\Orders;

use Livewire\Component;
use App\Invoice;

class Receipt extends Component
{
    public $invoiceId;
    public $receipt;

    public function mount($id)
    {
        $invoce = Invoice::findOrfail($id);
        $this->invoiceId = $invoce->id;
    }
    public function update()
    {
        $this->validate([
            'receipt' => 'required'
        ]);

        $invoce = Invoice::find($this->invoiceId);

        if ($invoce) {
            $invoce->update([
                'no_resi' => $this->receipt
            ]);
            session()->flash('success','No Resi Berhasil ditambahkan');
            return redirect()->back();
        }
    }
    public function render()
    {
        return view('livewire.console.orders.receipt');
    }
}
