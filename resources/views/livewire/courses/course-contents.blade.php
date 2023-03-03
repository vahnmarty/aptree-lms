<div>
    <header class="flex justify-between px-8 py-6 bg-white">
        <h1 class="text-3xl font-bold leading-7 text-emerald-900 sm:leading-9">Add New Course</h1>
        <div>
            @if($course->status == '0')
            <button wire:click="publish" type="button" class="btn-primary">Publish Now</button>
            @endif

            @if($course->status == '1')
            <a href="{{ route('courses.show', $course->id) }}" class="btn-primary">Open Course</a>
            @endif
        </div>
    </header>
    
    <div>
    
        <x-modal ref="module-create">
            <x-slot name="title">
                Create Module
            </x-slot>
            <div class="pt-4">
                @livewire('tenant.courses.create-module', ['id' => $course->id])
            </div>
        </x-modal>
    
    
        <x-modal ref="module-edit">
            <x-slot name="title">
                Edit Module
            </x-slot>
            <div class="pt-4">
                @livewire('tenant.courses.edit-module')
            </div>
        </x-modal>
    
    
        <div class="px-8 py-12 bg-gray-100 text-emerald-900">
            <nav class="flex items-center space-x-4" aria-label="Tabs">
    
                <div>
                    <span class="rounded-sm bg-gray-300 px-1.5 py-0.5 text-sm font-bold text-emerald-900">1</span>
                    <span class="ml-2 font-bold text-gray-500">Overview</span>
                </div>
                <div>
                    <span class="rounded-sm bg-emerald-900 px-1.5 py-0.5 text-sm font-bold text-white">2</span>
                    <span class="ml-2 font-bold text-emerald-900">Content</span>
                </div>
            </nav>
            <section class="mt-8">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-2">
                        <div class="bg-white rounded-md">
                            <header class="flex justify-between px-4 py-4">
                                <h3 class="font-bold">Modules</h3>
                                <div>
                                    <button x-data x-on:click="$dispatch('openmodal-module-create')" type="button"
                                        class="p-1 text-sm rounded-md bg-emerald-600 hover:bg-emerald-800">
                                        <x-heroicon-s-plus class="w-4 h-4 text-white" />
                                    </button>
                                </div>
                            </header>
                            <div x-data="{ module_id: @entangle('module_id') }" class="px-4 py-4">
                                @if(count($modules))
                                <div wire:sortable 
                                    wire:end.stop="reorderTable($event.target.sortable.toArray())" 
                                    class="space-y-2">
                                    @foreach($modules as $module)
                                    <div
                                        wire:sortable.item="{{ $module->id }}"
                                        wire:sortable.handle
                                        wire:key="module-{{ $module->id  . '_' . time() }}"
                                        wire:click="selectModule({{ $module->id }})"
                                        :class="module_id == {{ $module->id }} ? 'border-2 border-orange-400 bg-orange-50' : ''"
                                        class="px-2 py-2 border rounded-md cursor-pointer hover:bg-gray-50">
                                        <div 
                                            class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <x-heroicon-o-menu class="w-6 h-6 mr-2 text-gray-900" />
                                                <p>{{ $module->title }}</p>
                                            </div>
                                            <div>
                                                <button type="button"
                                                    wire:click="editModule(`{{ $module->id }}`)"
                                                    aria-title="Edit Module">
                                                    <x-heroicon-o-pencil class="w-6 h-6 text-gray-500 hover:text-gray-900" />
                                                </button>
                                                <button type="button" 
                                                    x-data
                                                    x-on:click="if(confirm('Confirm Delete?')){ $wire.deleteModule('{{ $module->id }}') }"
                                                    aria-title="Delete Module">
                                                    <x-heroicon-o-trash class="w-6 h-6 text-gray-500 hover:text-gray-900" />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="bg-gray-100">
                                    <button x-data x-on:click="$dispatch('openmodal-module-create')" type="button"
                                        class="relative block w-full p-12 text-center border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor"
                                            fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6" />
                                        </svg>
                                        <span class="block mt-2 text-sm font-medium text-gray-900">Add New Module</span>
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4">
                        @if ($module_id)
                            <div class="bg-white border rounded-md">
                                <header class="p-4">
                                    <h2 class="font-bold text-emerald-900">{{ $selected_module->title }}</h2>
                                </header>
                                <div wire:sortable 
                                     wire:end.stop="reorderModuleItems($event.target.sortable.toArray())"  
                                    class="p-4">
                                    @foreach($selected_module->items()->ordered()->get() as $card)
                                    <div 
                                        wire:sortable.item="{{ $card->id }}"
                                        wire:sortable.handle
                                        wire:key="card-{{ $card->id  . '_' . time() }}"
                                        class="px-4 py-2 mb-4 border-2 border-gray-300 rounded-md shadow-sm cursor-pointer">
                                        <div class="flex items-center justify-between gap-4">
                                            <div class="flex col-span-3">
                                                <div class="mr-4">
                                                    @include('livewire.tenant.courses.partials.icon_card')
                                                </div>
                                                <div>
                                                    <p class="text-orange-500">{{ $card->type->key }}</p>
                                                    <p>{{ $card->title }}</p>
                                                </div>
                                            </div>
                                           
                                            <div class="flex gap-2">
                                                <a href="{{ route('courses.module-preview', $card->id) }}"
                                                    target="_blank">
                                                    <x-heroicon-o-eye class="w-6 h-6 text-gray-600"/>
                                                </a>
                                                <button x-data
                                                    x-on:click="if(confirm('Continue delete?')){ $wire.deleteCard('{{ $card->id }}') }"
                                                    type="button" >
                                                    <x-heroicon-o-trash class="w-6 h-6 text-gray-600"/>
                                                </button>
                                                <button type="button" wire:click="editCard('{{ $card->id }}')">
                                                    <x-heroicon-o-pencil class="w-6 h-6 text-gray-600"/>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @include('livewire.tenant.courses.partials.add_card')
                                </div>
                            </div>
                        @else
                            <div class="bg-gray-100">
                                <button type="button"
                                    class="relative block w-full p-12 text-center border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6" />
                                    </svg>
                                    <span class="block mt-2 text-sm font-medium text-gray-900">Select Module First</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
    
</div>