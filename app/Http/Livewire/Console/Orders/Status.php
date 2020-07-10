<?php

namespace App\Http\Livewire\Console\Orders;

use Livewire\Component;
use App\Invoice;

class Status extends Component
{
    public $status;
    public $invoiceId;

    public function mount($id)
    {
        $invoice = Invoice::findOrfail($id);
        $this->invoiceId = $invoice->id;
        
    }

    public function update()
    {
        $this->validate([
            'status' => 'required'
        ]);
        
        $invoice = Invoice::find($this->invoiceId);
        if ($invoice) {

            $invoice->update([
                'status' => $this->status
            ]);
            session()->flash('success','Status Berhasil diupdate');
            return redirect()->route('console.orders.index');
        }

    }
    public function render()
    {
        return view('livewire.console.orders.status');
    }
}
