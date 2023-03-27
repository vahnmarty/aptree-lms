<?php

namespace App\Http\Livewire;

use Closure;
use Livewire\Component;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use File;

class ManageEnvironment extends Component implements HasForms
{
    use InteractsWithForms;

    public $FACEBOOK_ENABLE, $FACEBOOK_CLIENT_ID, $FACEBOOK_CLIENT_SECRET;
    public $TWITTER_ENABLE, $TWITTER_CLIENT_ID, $TWITTER_CLIENT_SECRET;
    public $GOOGLE_ENABLE, $GOOGLE_CLIENT_ID, $GOOGLE_CLIENT_SECRET;
    
    public function render()
    {
        return view('livewire.manage-environment');
    }

    public function mount()
    {
        $this->facebookForm->fill([
            'FACEBOOK_CLIENT_ID' => env('FACEBOOK_CLIENT_ID'),
            'FACEBOOK_CLIENT_SECRET' => env('FACEBOOK_CLIENT_SECRET'),
        ]);

        $this->twitterForm->fill([
            'TWITTER_CLIENT_ID' => env('TWITTER_CLIENT_ID'),
            'TWITTER_CLIENT_SECRET' => env('TWITTER_CLIENT_SECRET'),
        ]);

        $this->googleForm->fill([
            'GOOGLE_CLIENT_ID' => env('GOOGLE_CLIENT_ID'),
            'GOOGLE_CLIENT_SECRET' => env('GOOGLE_CLIENT_SECRET'),
        ]);
    }

    protected function getForms(): array 
    {
        return [
            'facebookForm' => $this->makeForm()
                ->schema($this->getFacebookFormSchema()),
            'twitterForm' => $this->makeForm()
                ->schema($this->getTwitterFormSchema()),
            'googleForm' => $this->makeForm()
                ->schema($this->getGoogleFormSchema()),
        ];
    }

    public function getFacebookFormSchema()
    {
        return [
            Toggle::make('FACEBOOK_ENABLE')->label('Enable')->reactive(),
            TextInput::make('FACEBOOK_CLIENT_ID')->label('FACEBOOK_CLIENT_ID')->disabled(fn (Closure $get) => !$get('FACEBOOK_ENABLE')),
            TextInput::make('FACEBOOK_CLIENT_SECRET')->label('FACEBOOK_CLIENT_SECRET')->disabled(fn (Closure $get) => !$get('FACEBOOK_ENABLE'))
        ];
    }

    public function getTwitterFormSchema()
    {
        return [
            Toggle::make('TWITTER_ENABLE')->label('Enable')->reactive(),
            TextInput::make('TWITTER_CLIENT_ID')->label('TWITTER_CLIENT_ID')->disabled(fn (Closure $get) => !$get('TWITTER_ENABLE')),
            TextInput::make('TWITTER_CLIENT_SECRET')->label('TWITTER_CLIENT_SECRET')->disabled(fn (Closure $get) => !$get('TWITTER_ENABLE'))
        ];
    }

    public function getGoogleFormSchema()
    {
        return [
            Toggle::make('GOOGLE_ENABLE')->label('Enable')->reactive(),
            TextInput::make('GOOGLE_CLIENT_ID')->label('GOOGLE_CLIENT_ID')->disabled(fn (Closure $get) => !$get('GOOGLE_ENABLE')),
            TextInput::make('GOOGLE_CLIENT_SECRET')->label('GOOGLE_CLIENT_SECRET')->disabled(fn (Closure $get) => !$get('GOOGLE_ENABLE'))
        ];
    }

    public function updateEnv($config, $value)
    {
        $envFilePath = base_path('.env');

        if (File::exists($envFilePath)) {
            $envContent = File::get($envFilePath);

            // replace the value of the config variable
            $envContent = preg_replace('/^' . $config . '=.*/m', $config . '=' . $value, $envContent);

            // write the updated content to the .env file
            File::put($envFilePath, $envContent);

            return response()->json(['message' => 'Environment variable updated.']);
        }
    }
}
