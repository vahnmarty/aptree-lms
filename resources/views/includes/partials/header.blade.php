<header class="px-6 py-4 bg-white md:py-8 md:px-16">
    <div class="flex items-center justify-between">
        <section>
            <form>
                <div class="relative hidden md:w-96">
                    <input type="search"  class="pl-4 border-gray-300 rounded-md w-96" placeholder="Search">
                </div>
                <x-heroicon-s-search class="w-5 h-5 text-gray-500"/>
            </form>
        </section>
        <section>
            <div class="flex items-center justify-end gap-6">
                <a href="{{ route('courses.index') }}" class="hidden text-sm text-darkgreen md:block">
                    My Courses
                </a>

                <a href="{{ route('support') }}" class="hidden text-sm text-darkgreen md:block">
                    Support
                </a>

                <a href="">
                    <x-heroicon-s-bell class="w-5 h-5 text-darkgreen"/>
                </a>

                <a href="">
                    <div class="flex items-center justify-center w-8 h-8 text-xs bg-indigo-200 rounded-full text-darkgreen g-5">VM</div>
                </a>

            </div>
        </section>
    </div>
</header>