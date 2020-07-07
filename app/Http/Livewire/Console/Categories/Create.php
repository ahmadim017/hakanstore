<?php
 
namespace App\Http\Livewire\Console\Categories;
 
use Livewire\Component;
use App\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
 
class Create extends Component
{
 
    use WithFileUploads;
 
    public $name;
 
    public $image;
 
    public function store()
    {
 
        $this->validate([
            'image' => 'required|image|max:1024',
            'name' => 'required|min:3'
       ]);
 
        $this->image->store('public/categories');
 
        $category = Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name, '-'),
            'image' => $this->image->hashName()
        ]);
   
        if ($category) {
            session()->flash('success','Data Category Berhasil ditambahkan');
        } else {
            session()->flash('error','Data tidak bisa disimpan');
        }
        return redirect()->route('console.categories.index');
    }
   
 
    public function render()
    {
        return view('livewire.console.categories.create');
    }
}