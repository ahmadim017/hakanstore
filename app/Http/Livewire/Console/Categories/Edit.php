<?php

namespace App\Http\Livewire\Console\Categories;

use Livewire\Component;
use App\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{

    use WithFileUploads;

    public $name;
    public $image;
    public $categoryId;

    public function mount($id)
    {
        $category = Category::findOrfail($id);

        if ($category) {
            $this->categoryId = $category->id;
            $this->name = $category->name;
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $category = Category::findOrfail($this->categoryId);

        if ($category) {
            if ($this->image == null) {
                $category->update([
                    'name' => $this->name,
                    'slug' => Str::slug($this->name, '-'),
                ]);
            } else {
                $this->image->store('public/categories');

                $category->update([
                    'name' => $this->name,
                    'slug' => Str::slug($this->name, '-'),
                    'image' => $this->image->hashName()
                ])
            }
            session()->flash('success','Data berhasil diupdate');
            return redirect()->back();
        }
    }
    public function render()
    {
        return view('livewire.console.categories.edit');
    }
}
