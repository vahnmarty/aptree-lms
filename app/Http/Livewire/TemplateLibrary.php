<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TemplateLibrary extends Component
{
    public $filter;
    
    public function render()
    {
        return view('livewire.template-library');
    }
}
