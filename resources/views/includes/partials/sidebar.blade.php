<div x-data="{ 
        isMobile: false,
        expand: false,
        grow(){
            if(!this.isMobile){
                this.expand = true;
            }
        },
        shrink(){
            this.expand = false;
        },
        checkMobileScreen(){
            this.isMobile = window.innerWidth <= 1024;
        }
     }" 
    x-on:mouseenter="grow()"
    x-on:mouseleave="shrink()"
    x-init="checkMobileScreen()"
    x-on:resize.window="checkMobileScreen()"
    :class="expand ? 'w-64' : 'w-14'"
    class="block min-h-screen transition-all duration-300 ease-in-out bg-white border-r md:overflow-hidden ">
    <div class="flex flex-col flex-grow min-h-screen py-5 overflow-y-auto">
        <div class="flex justify-start pl-3">
            <div class="flex items-center bg-transparent rounded-md">
                <button x-on:click="$store.sidebarExpanded.toggle()" type="button">
                    <img class="flex-shrink-0 w-auto h-8" src="{{ asset('img/logo.png') }}" alt="Company name">
                </button>
            </div>
        </div>

        <nav class="flex flex-col flex-1 mt-5 overflow-y-auto divide-y divide-gray-300" aria-label="Sidebar">
            <div class="flex-1 space-y-1">

                <x-sidebar-item label="Home" link="{{ url('dashboard') }}" :active="request()->is('dashboard*') ">
                    <x-slot name="icon">
                        <x-heroicon-s-home class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-500"/>
                    </x-slot>
                </x-sidebar-item>

                <x-sidebar-item label="Template Library" link="{{ route('template.library') }}" :active="request()->is('template-library*') ">
                    <x-slot name="icon">
                        <x-heroicon-s-collection class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-500"/>
                    </x-slot>
                </x-sidebar-item>

                <x-sidebar-item label="My Profile" link="{{ route('profile.index') }}" :active="request()->is('profile*') ">
                    <x-slot name="icon">
                        <x-heroicon-s-user-circle class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-500"/>
                    </x-slot>
                </x-sidebar-item>

                <x-sidebar-item label="Teams" link="{{ route('teams.index') }}" :active="request()->is('teams*') ">
                    <x-slot name="icon">
                        <x-heroicon-s-user-group class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-500"/>
                    </x-slot>
                </x-sidebar-item>

                <x-sidebar-item label="Course Builder" link="{{ route('courses.index') }}" :active="request()->is('courses*') ">
                    <x-slot name="icon">
                        <x-heroicon-s-academic-cap class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-500"/>
                    </x-slot>
                </x-sidebar-item>


            </div>


            <div class="flex flex-shrink-0 pt-6 pb-5 mt-6">
                <div class="flex-shrink-0 w-full space-y-1">

                    @if (auth()->user()->hasRole('admin'))
                        <x-sidebar-item label="Settings" link="{{ route('settings') }}" :active="request()->is('settings*') ">
                            <x-slot name="icon">
                                <x-heroicon-s-cog class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-500"/>
                            </x-slot>
                        </x-sidebar-item>

                        <x-sidebar-item label="Users" link="{{ route('users.index') }}" :active="request()->is('users*') ">
                            <x-slot name="icon">
                                <x-heroicon-s-users class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-500"/>
                            </x-slot>
                        </x-sidebar-item>

                        <x-sidebar-item label="Users" link="{{ url('billing') }}" :active="request()->is('billing*') ">
                            <x-slot name="icon">
                                <x-heroicon-s-credit-card class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-500"/>
                            </x-slot>
                        </x-sidebar-item>

                    @endif

                    @if (null)
                        <a href="{{ route('invitations.index') }}"
                            class="flex items-center px-2 py-2 text-sm text-gray-500 rounded-md group hover:bg-gray-100">
                            <svg class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-500"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                            </svg>

                            <span class="hidden md:block" x-show="expand" x-transition>Invitations </span>

                            <span
                                class="flex items-center justify-center w-5 h-5 ml-4 text-xs text-white bg-red-500 rounded-full">2</span>
                        </a>
                    @endif
                    
                    <x-sidebar-item label="Support" link="{{ route('support') }}" :active="request()->is('support*') ">
                        <x-slot name="icon">
                            <x-heroicon-s-chat-alt-2 class="flex-shrink-0 w-6 h-6 ml-1 mr-4 text-gray-500"/>
                        </x-slot>
                    </x-sidebar-item>

                </div>
            </div>
        </nav>
    </div>
</div>
