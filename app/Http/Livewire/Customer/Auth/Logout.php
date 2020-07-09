<?php

namespace App\Http\Livewire\Customer\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.auth.login');
    }
    public function render()
    {
        return view('livewire.customer.auth.logout');
    }
}
