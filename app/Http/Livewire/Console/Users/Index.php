<?php

namespace App\Http\Livewire\Console\Users;

use Livewire\Component;
use App\User;
use Livewire\WithPagination;


class Index extends Component
{
    public $search;

    protected $updateQueryString = ['search'];

    public function destroy($id)
    {
        $user = User::findOrfail($id);
        if ($user) {
            $user->delete();
        }
        session()->flash('error','Data User Berhasil dihapus');
        return redirect()->back();
    }
    public function render()
    {
        if ($this->search != "") {
            $user = User::where('name','LIKE','%'. $this->search .'%')->latest()->paginate(10);
        } else {
            $user = User::latest()->paginate(10);
        }
        return view('livewire.console.users.index',['user' => $user]);
    }
}
