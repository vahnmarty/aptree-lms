

<div>
    <header class="flex justify-between px-8 py-6">
        <h1 class="text-3xl font-bold leading-7 text-darkgreen sm:leading-9">Template Library</h1>
    </header>
    <div class="px-8 py-12 bg-gray-100">
        <section>

            <div class="pb-6 border-b-2 border-gray-300">
                <h3 class="text-xl font-bold text-darkgreen">Pathways</h3>
                <p class="mt-2">Series of courses.</p>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-8">

                @foreach($pathways as $pathway)
                <div class="p-6 bg-white border rounded-md">
                    <div>
                        <x-heroicon-s-template class="w-10 h-10 text-gray-400"/>
                    </div>
                    <h3 class="mt-2 text-lg font-bold text-darkgreen">{{ $pathway->title }}</h3>
                    <div class="mt-2 text-gray-600">
                        {{ $pathway->description }}
                    </div>
                    <div class="flex justify-between mt-8">
                        <div class="flex gap-3">
                            <div class="flex items-center gap-1">
                                <x-heroicon-s-template class="w-4 h-4 text-gray-400"/>
                                <span class="text-sm">0/{{ $pathway->courses_count }} Courses</span>
                            </div>
                        </div>
                        <div>
                            <x-dropdown>
                                <x-slot name="button">
                                    <button>
                                        <x-heroicon-s-dots-vertical class="w-4 h-4 text-gray-400"/>
                                    </button>
                                </x-slot>
                                <div>
                                    <a href="{{ route('pathway.show', $pathway->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 group" role="menuitem"
                                        tabindex="-1" id="menu-item-0">
                                        <x-heroicon-s-eye  class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-500"/>
                                        View
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 group" role="menuitem"
                                        tabindex="-1" id="menu-item-0">
                                        <x-heroicon-s-duplicate  class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-500"/>
                                        Assign
                                    </a>
                                </div>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </section>
    </div>
</div>

