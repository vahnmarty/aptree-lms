<?php

use App\Http\Livewire\Invitations;
use App\Http\Livewire\ManageTeams;
use App\Http\Livewire\SupportPage;

use App\Http\Livewire\TenantUsers;
use App\Http\Livewire\UserProfile;
use App\Http\Livewire\ManageBilling;
use App\Http\Livewire\ManageSettings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiController;
use App\Http\Livewire\TeamInvitations;
use App\Http\Livewire\TemplateLibrary;
use App\Http\Controllers\PageController;
use App\Http\Livewire\ManageEnvironment;
use App\Http\Livewire\Courses\EditCourse;
use App\Http\Livewire\Courses\ShowCourse;
use App\Http\Livewire\Pathway\ShowPathway;
use App\Http\Livewire\Courses\CoursePlayer;
use App\Http\Livewire\Courses\CreateCourse;
use App\Http\Livewire\Courses\ManageCourses;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Courses\CourseContents;
use App\Http\Livewire\Pathway\ManagePathways;
use App\Http\Livewire\Pathway\PathwayBuilder;
use App\Http\Controllers\InvitationController;
use App\Http\Livewire\Pathway\PathwayContents;
use App\Http\Controllers\EnvironmentController;
use App\Http\Livewire\Courses\ModuleItemPreview;
use App\Http\Controllers\SocialiteLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');

Route::get('login/{provider}', [SocialiteLoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialiteLoginController::class, 'handleProviderCallback']);
Route::get('login/facebook/delete/callback', [SocialiteLoginController::class, 'deleteFacebookData']);
Route::get('login/facebook/delete/status', [SocialiteLoginController::class, 'checkIfFacebookUserIsDeleted']);

Route::get('chatgpt', [AiController::class, 'chatgpt']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['prefix' => 'courses', 'middleware' => ['auth']], function(){
    Route::get('/', ManageCourses::class)->name('courses.index');
    Route::get('/create', CreateCourse::class)->name('courses.create');
    Route::get('/{id}', ShowCourse::class)->name('courses.show');
    Route::get('/{id}/edit', EditCourse::class)->name('courses.edit');
    Route::get('/{id}/contents', CourseContents::class)->name('courses.contents');
    Route::get('/{uuid}/play', CoursePlayer::class)->name('courses.play');
    Route::get('/module-preview/{id}', ModuleItemPreview::class)->name('courses.module-preview');
    
});

Route::group(['middleware' => ['auth']], function(){

    Route::get('template-library', TemplateLibrary::class)->name('template.library');
    Route::get('pathways', ManagePathways::class)->name('pathway.index');
    Route::get('pathway-builder/{id?}', PathwayBuilder::class)->name('pathway.builder');
    Route::get('pathway/{id}/contents', PathwayContents::class)->name('pathway.contents');
    Route::get('pathway/{id}', ShowPathway::class)->name('pathway.show');
    Route::get('my-teams', ManageTeams::class)->name('teams.index');
    Route::get('my-teams/{id}/invitations', TeamInvitations::class)->name('teams.invitations');
    Route::get('profile', UserProfile::class)->name('profile.index');
    Route::get('settings', ManageSettings::class)->name('settings');
    Route::get('users', TenantUsers::class)->name('users.index');
    Route::get('billing', ManageBilling::class)->name('billing.index');
    Route::get('invitations', Invitations::class)->name('invitations.index');
    Route::get('support', SupportPage::class)->name('support');
    Route::get('env', ManageEnvironment::class)->name('env.index');
});

// Route::get('invitation/{token}', [InvitationController::class, 'accept'])->name('invitation.accept');
// Route::get('invitation/registration/{token}', [InvitationController::class, 'register'])->name('invitation.register');
// Route::post('invitation/registration', [InvitationController::class, 'store'])->name('invitation.store');

Route::get('/team-invitations/{invitation}', [InvitationController::class, 'accept'])
                            ->middleware(['signed'])
                            ->name('team-invitations.accept');

Route::post('/team-invitations/{invitationId}/register', [InvitationController::class, 'register'])->name('team-invitations.register');