<?php

namespace App\Http\Livewire\Console\Sliders;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Slider;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $image;
    public $link;
    public $status;

    public function store()
    {
        $this->validate([
            'link' => 'required',
            'image' => 'required'
        ]);

        $this->image->store('public/sliders');
        Slider::create([
            'link' => $this->link,
            'status' => 'ACTIVE',
            'image' => $this->image->hashName()
        ]);
        session()->flash('success','Slider Berhasil ditambahkan');
        return redirect()->back();
    }

    public function edit($id)
    {
        $slider = Slider::findOrfail($id);
        if ($slider) {
            $slider->update([
                'status' => $this->status,
            ]);
        } 
        session()->flash('error','Slider Berhasil dihapus');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $slider = Slider::findOrfail($id);
        if ($slider) {
            storage::disk('public')->delete('sliders/'. $slider->image);
            $slider->delete();
        }
        session()->flash('error','Slider Berhasil dihapus');
        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.console.sliders.index',['slider' => Slider::latest()->paginate(2)]);
    }
}
