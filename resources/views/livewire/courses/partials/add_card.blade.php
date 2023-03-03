<div class="p-2 border-2 rounded-md border-emerald-700">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <x-heroicon-s-plus class="w-5 h-5" />
            <p class="text-sm">Add a New Card</p>
        </div>
        <div class="flex gap-1">

            <!-- Modals -->
            <x-modal-lg ref="content">
                <x-slot name="title">
                    Content Editor
                </x-slot>
                <div class="pt-4">
                    @livewire('tenant.courses.content-editor', ['moduleId' => $module_id])
                </div>
            </x-modal-lg>
            <x-modal ref="upload">
                <x-slot name="title">
                    Upload Document
                </x-slot>
                <div class="pt-4">
                    @livewire('tenant.courses.upload-document', ['moduleId' => $module_id])
                </div>
            </x-modal>

            <x-modal-lg ref="video">
                <x-slot name="title">
                    Add Video
                </x-slot>
                <div class="pt-4">
                    @livewire('tenant.courses.video-editor', ['moduleId' => $module_id])
                </div>
            </x-modal-lg>

            <x-modal-lg ref="question">
                <x-slot name="title">
                    Questions and Answers
                </x-slot>
                <div class="pt-4">
                    @livewire('tenant.courses.question-editor', ['moduleId' => $module_id])
                </div>
            </x-modal-lg>
            
            <!-- Modals -->

            <x-dropup>
                <x-slot name="button">
                    <button @click="open = !open"
                        class="w-10 h-10 px-2 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                        <span class="font-bold group text-emerald-700">A</span>
                    </button>
                </x-slot>
                <div class="relative px-3 py-3 bg-gray-300 rounded-md shadow-xs">
                    <div class="flex flex-col space-y-1">
                        <button type="button"
                            x-on:click="hide()"
                            wire:click="createContent('image-text')"
                            class="p-2 bg-white border rounded-md hover:bg-emerald-50">
                            <div class="flex">
                                <x-heroicon-s-photograph class="w-4 h-4" />
                                <x-heroicon-s-menu-alt-2 class="w-4 h-4" />
                            </div>
                        </button>
                        <button type="button"
                            x-on:click="hide()"
                            wire:click="createContent('text-image')"
                            class="p-2 bg-white border rounded-md hover:bg-emerald-50">
                            <div class="flex">
                                <x-heroicon-s-menu-alt-2 class="w-4 h-4" />
                                <x-heroicon-s-photograph class="w-4 h-4" />
                            </div>
                        </button>
                        <button type="button"
                            x-on:click="hide()"
                            wire:click="createContent('text')"
                            class="flex justify-center p-2 text-center bg-white border rounded-md hover:bg-emerald-50">
                            <div class="flex">
                                <x-heroicon-s-menu-alt-2 class="w-4 h-4" />
                            </div>
                        </button>
                        <button type="button"
                            x-on:click="hide()"
                            wire:click="createContent('image')"
                            class="flex justify-center p-2 text-center bg-white border rounded-md hover:bg-emerald-50">
                            <div class="flex">
                                <x-heroicon-s-photograph class="w-4 h-4" />
                            </div>
                        </button>
                    </div>
                </div>
            </x-dropup>

            <x-dropup>
                <x-slot name="button">
                    <button @click="open = !open"
                        class="w-10 h-10 px-2 py-2 bg-gray-200 rounded-md text-emerald-700 hover:bg-gray-300">
                        <x-heroicon-s-video-camera />
                    </button>
                </x-slot>
                <div class="relative w-32 px-3 py-3 bg-gray-300 rounded-md shadow-xs">
                    <div class="flex flex-col space-y-1">
                        <button type="button"
                            x-on:click="$dispatch('openmodal-video'); hide()"
                            class="p-2 text-sm bg-white border rounded-md hover:bg-emerald-50">
                            <span>Add Video</span>
                        </button>
                        <button type="button"
                            disabled
                            class="p-2 text-sm bg-white border rounded-md opacity-50 cursor-not-allowed hover:bg-emerald-50">
                            <span>Record a Video</span>
                        </button>
                    </div>
                </div>

            </x-dropup>

            <x-dropup>
                <x-slot name="button">
                    <button @click="open = !open"
                        class="w-10 h-10 px-2 py-2 bg-gray-200 rounded-md text-emerald-700 hover:bg-gray-300">
                        <x-heroicon-o-document-text />
                    </button>
                </x-slot>
                <div class="relative w-32 px-3 py-3 bg-gray-300 rounded-md shadow-xs">
                    <div class="flex flex-col space-y-1">
                        <button type="button"
                            x-on:click="$dispatch('openmodal-upload')"
                            class="p-2 text-sm bg-white border rounded-md hover:bg-emerald-50">
                            <span>Upload</span>
                        </button>
                    </div>
                </div>
            </x-dropup>

            <x-dropup>
                <x-slot name="button">
                    <button @click="open = !open"
                        class="w-10 h-10 px-2 py-2 bg-gray-200 rounded-md text-emerald-700 hover:bg-gray-300">
                        <x-heroicon-s-question-mark-circle />
                    </button>
                </x-slot>
                <div class="relative w-32 px-3 py-3 bg-gray-300 rounded-md shadow-xs">
                    <div class="flex flex-col space-y-1">
                        <button type="button"
                            x-on:click="hide()"
                            wire:click="createQuestion(`{{ \App\Enums\QuestionType::MultipleChoice }}`)"
                            class="p-2 text-xs bg-white border rounded-md hover:bg-emerald-50">
                            <span>Multiple Choice</span>
                        </button>
                        <button type="button"
                            disabled
                            class="p-2 text-xs bg-white border rounded-md opacity-50 cursor-not-allowed hover:bg-emerald-50">
                            <span>AI Question Generator</span>
                        </button>
                        <button type="button"
                            disabled
                            class="p-2 text-xs bg-white border rounded-md opacity-50 cursor-not-allowed hover:bg-emerald-50">
                            <span>True / False</span>
                        </button>
                        <button type="button"
                            disabled
                            class="p-2 text-xs bg-white border rounded-md opacity-50 cursor-not-allowed hover:bg-emerald-50">
                            <span>Likert Scale</span>
                        </button>
                    </div>
                </div>
            </x-dropup>
        </div>
    </div>
</div>