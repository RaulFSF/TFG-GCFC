<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;

class EditProfileModal extends ModalComponent
{
    use WithFileUploads;

    public $name;
    public $email;
    public $image;
    public $user;
    public $avatar;

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->image = $this->user->image;
    }

    public function render()
    {
        return view('livewire.edit-profile-modal',[
            'user' => auth()->user(),
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'min:3' , 'max:50'],
            'email' => ['required', 'email:rfc,dns', 'unique:users,email,'.$this->user->id.''],
        ],[
            'name.required' => 'Requerido',
            'name.min' => 'Mínimo 3 caractéres',
            'name.max' => 'Máximo 50 caractéres',
            'email.required' => 'Requerido',
            'email.email' => 'Debe ser un email válido',
            'email.unique' => 'Email ya existente',
        ]);

        if($this->avatar){
            $this->user->image = $this->avatar->store('/avatars', 'public');
            $this->user->save();
            $this->avatar = null;
        }
        sleep(1);
        $this->closeModal();
    }
}
