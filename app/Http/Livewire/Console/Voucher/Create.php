<?php

namespace App\Http\Livewire\Console\Voucher;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Voucher;


class Create extends Component
{
    use WithFileUploads;

    public $tittle;
    public $voucher;
    public $nominal_voucher;
    public $total_minimal_shopping;
    public $content;
    public $image;

    public function store()
    {
        $this->validate([
            'tittle' => 'required',
            'voucher' => 'required',
            'nominal_voucher' => 'required',
            'total_minimal_shopping' => 'required',
            'content' => 'required',
            'image' => 'required|image|max:1024'
        ]);

        $this->image->store('public/vouchers');

        Voucher::create([
            'tittle' => $this->tittle,
            'voucher' => $this->voucher,
            'nominal_voucher' => $this->nominal_voucher,
            'total_minimal_shoping' => $this->total_minimal_shopping,
            'content' => $this->content,
            'image' => $this->image->hashName()
        ]);

        session()->flash('success','Data Voucher berhasil ditambahkan');
        return redirect()->route('console.voucher.index');
    }
    public function render()
    {
        return view('livewire.console.voucher.create');
    }
}
