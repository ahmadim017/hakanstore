<?php

namespace App\Http\Livewire\Console;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('console.login');
    }
    public function render()
    {
        return view('livewire.console.logout');
    }
}
