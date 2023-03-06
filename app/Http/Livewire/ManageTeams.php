<?php

namespace App\Http\Livewire;

use Str;
use Auth;
use App\Models\Team;
use Livewire\Component;
use App\Models\Invitation;
use App\Events\InvitationCreated;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ManageTeams extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    use LivewireAlert;
    
    public function render()
    {
        return view('livewire.manage-teams');
    }

    protected function getTableQuery()
    {
        return Team::query();
    } 

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('users_count')->counts('users')->label('Members'),
            TextColumn::make('owner.name')
        ];
    }

    protected function getTableHeader()
    {
        return null;
    }

    protected function getTableHeading()
    {
        return 'My Teams';
    }
    

    // protected function getTableContentGrid(): ?array
    // {
    //     return [
    //         'md' => 2,
    //         'xl' => 3,
    //     ];
    // }

    protected function getTableActions(): array
    {
        return [
            ActionGroup::make([
                CreateAction::make()
                    ->label('Add Member')
                    ->modalHeading('Add Member')
                    ->form([
                        TextInput::make('email')->email()->placeholder('Input a valid email address')
                    ])
                    ->action(function(Team $record, array $data){
                        $email = $data['email'];

                        $invitation = Invitation::firstOrCreate(
                            [ 'team_id' => $record->id, 'email' => $email],
                            [ 'token' => Str::random(40)]
                        );

                        InvitationCreated::dispatch($invitation);
                    }),
                    //->disableCreateAnother(),
                Action::make('view_invitations')
                    ->url( fn($record) => route('teams.invitations', $record->id) ),
            ])
            ->visible(fn(): bool => auth()->user()->isAdmin())
        ];
    }

    protected function getTableHeaderActions() : array
    {
        return [
            Action::make('create_team')
                ->label('Create Team')
                ->visible(fn(): bool => auth()->user()->isAdmin())
                ->form([
                    TextInput::make('name')->required(),
                ])
                ->mountUsing(fn (ComponentContainer $form, $record) => $form->fill([
                    'owner_id' => auth()->id(),
                ]))
                ->action(function(array $data){
                    Auth::user()->teams()->create([
                        'name' => $data['name']
                    ]);

                    $this->alert('success', 'Team created successfully!');
                })
                ->color('primary')
                ->button()
        ];
    }

    protected function isTablePaginationEnabled(): bool 
    {
        return false;
    } 
}
