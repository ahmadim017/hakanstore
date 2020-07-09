<?php

namespace App\Http\Livewire\Console\Users;

use Livewire\Component;
use App\User;

class Edit extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount($id)
    {
        $user = User::findOrfail($id);
        if ($user) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        }
        
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'. $this->userId
        ]);

        $user = User::find($this->userId);

        if ($user) {
            if ($this->password == Null) {
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email
                ]);
            } else {
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => bcrypt($this->password)
                ]);
            }
            session()->flash('success','Data User Berhasil diupdate');
            return redirect()->route('console.users.index');
           
        }
    }
    public function render()
    {
        return view('livewire.console.users.edit');
    }
}
