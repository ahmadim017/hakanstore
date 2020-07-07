<?php

namespace App\Http\Livewire\Console\Voucher;

use Livewire\Component;
use Livewire\WithPagination;
use App\Voucher;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $updateQueryString = ['search'];

    public function destroy($id)
    {
        $voucher = Voucher::findOrfail($id);

        if ($voucher) {
            Storage::disk('public')->delete('vouchers/'. $voucher->image);
            $voucher->delete();
        }
        session()->flash('error','Data Berhasil dihapus');
        return redirect()->back();
    }
    public function render()
    {
        if ($this->search != "") {
            $voucher = Voucher::where('tittle','LIKE','%'. $this->search .'%')->latest()->paginate(10);
        } else {
            $voucher = Voucher::latest()->paginate(10);
        }
        return view('livewire.console.voucher.index',['voucher' => $voucher]);
    }
}
