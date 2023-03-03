<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CourseCategory;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Concerns\InteractsWithForms;

class TenantSettings extends Component implements HasForms
{
    use InteractsWithForms;

    public $image;
    
    public function render()
    {
        return view('livewire.tenant-settings');
    }

    protected function getLogoFormSchema(): array
    {
        return [
            FileUpload::make('image')->required(),
        ];
    }

    protected function getLibraryFormSchema(): array
    {
        return [
            CheckboxList::make('courses')
                ->options(function(){
                    return tenancy()->central(function(){
                        return CourseCategory::get()->pluck('name', 'id');
                    });
                })
                ->columns(3)
        ];
    }

    public function getPermissionFormSchema()
    {
        return [
            Toggle::make('full_access')
                ->label('Allow users full access to the available library (will be shown on the bottom of the page)')
                ->inline()
                ->columnSpan('full')
        ];
    }

    protected function getForms(): array 
    {
        return [
            'logoForm' => $this->makeForm()
                ->schema($this->getLogoFormSchema()),
            'libraryForm' => $this->makeForm()
                ->schema($this->getLibraryFormSchema()),
            'permissionForm' => $this->makeForm()
                ->schema($this->getPermissionFormSchema()),
        ];
    } 
}
