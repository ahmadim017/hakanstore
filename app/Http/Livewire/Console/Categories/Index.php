<?php

namespace App\Http\Livewire\Console\Categories;

use Livewire\Component;
use App\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $updatesQueryString = ['search'];

    public function destroy($id)
    {
        $category = Category::findOrfail($id);

        if ($category) {
           storage::disk('public')->delete('categories/'. $category->name);
           $category->delete();
        }
        return redirect()->back()->session()->flash('success','Data category berhasil dihapus');
    }

    public function render()
    {
        if ($this->search != "") {
            $category = Category::where('name','LIKE','%' . $this->search .'%')->latest()->paginate(10);
        } else {
            $category = Category::latest()->paginate(10);
        }
        return view('livewire.console.categories.index',['category' => $category]); 
    }
}
