<header class="px-16 py-8 bg-white">
    <div class="flex items-center justify-between">
        <section>
            <form action="">
                <div class="relative">
                    <input type="search"  class="pl-4 border-gray-300 rounded-md w-96" placeholder="Search">
                </div>
            </form>
        </section>
        <section>
            <div class="flex items-center justify-end gap-6">
                <a href="{{ route('courses.index') }}" class="text-sm text-darkgreen">
                    My Courses
                </a>

                <a href="{{ route('support') }}" class="text-sm text-darkgreen">
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