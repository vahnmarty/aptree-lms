<?php

namespace App\Http\Livewire;

use App\Models\Pathway;
use Livewire\Component;

class TemplateLibrary extends Component
{
    public $filter;
    
    # Data
    public $pathways = [];
    
    public function render()
    {
        return view('livewire.template-library');
    }

    public function mount()
    {
        $this->pathways = Pathway::with('courses', 'goal')->withCount('courses')->get();
    }
}
