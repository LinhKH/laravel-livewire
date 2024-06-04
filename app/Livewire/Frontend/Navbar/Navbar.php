<?php

namespace App\Livewire\Frontend\Navbar;

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $showDropdown = false;

    public function toogleMenu()
    {
        $this->showDropdown = !$this->showDropdown;
    }
    public function render()
    {
        return view('livewire.frontend.navbar.navbar');
    }
}
