<?php

namespace App\Http\Livewire\Console\Voucher;

use Livewire\Component;
use App\Voucher;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;
    public $tittle;
    public $voucher;
    public $nominal_voucher;
    public $total_minimal_shopping;
    public $content;
    public $image;
    public $voucherId;

    public function mount($id)
    {
        $voucher = Voucher::findOrfail($id);
        if ($voucher) {
            $this->voucherId              = $voucher->id;
            $this->tittle                 = $voucher->tittle;
            $this->voucher                = $voucher->voucher;
            $this->nominal_voucher        = $voucher->nominal_voucher;
            $this->total_minimal_shopping = $voucher->total_minimal_shoping;
            $this->content                = $voucher->content;
        }
    }

    public function update()
    {
        $this->validate([
            'tittle' => 'required',
            'voucher' => 'required',
            'nominal_voucher' => 'required',
            'total_minimal_shopping' => 'required',
            'content' => 'required'
        ]);

        $voucher = Voucher::findOrfail($this->voucherId);

        if ($voucher) {
            if ($this->image == Null) {
                $voucher->update([
                'tittle' => $this->tittle,
                'voucher' => $this->voucher,
                'nominal_voucher' => $this->nominal_voucher,
                'total_minimal_shoping' => $this->total_minimal_shopping,
                'content' => $this->content
                ]);
            } else {
                
                Storage::disk('public')->delete('vouchers/'. $voucher->image);
                $this->image->store('public/vouchers');
                $voucher->update([
                    'tittle' => $this->tittle,
                    'voucher' => $this->voucher,
                    'nominal_voucher' => $this->nominal_voucher,
                    'total_minimal_shoping' => $this->total_minimal_shopping,
                    'content' => $this->content,
                    'image' => $this->image->hashName()
                    ]); 
            }
            session()->flash('success','Data Berhasil diupdate');
            return redirect()->route('console.voucher.index');
        }
        
    }
    public function render()
    {
        return view('livewire.console.voucher.edit');
    }
}
