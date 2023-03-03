<x-auth-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="text-center">
            <h1 class="text-3xl font-bold text-primary">Welcome Back!</h1>
            <p class="mt-2 text-gray-600">Let's build something great</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="mt-8">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            
            <div class="mt-4">
                <button type="submit" class="btn-primary">Sign in</button>
            </div>

            <div class="relative flex items-center justify-center py-3 mt-3">
                <div class="w-full border-b border-gray-300 "></div>
                <p class="flex-shrink-0 px-6 text-sm text-gray-600 bg-white">Or do it via other accounts</p>
                <div class="w-full border-b border-gray-300 "></div>
            </div>

            <div class="flex justify-center gap-4">
                <a href="">
                    <span class="sr-only">Google</span>
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="8" fill="white"/>
                        <g clip-path="url(#clip0_4953_12633)">
                        <path d="M29.7874 20.225C29.7874 19.5666 29.7291 18.9416 29.6291 18.3333H20.2124V22.0916H25.6041C25.3624 23.325 24.6541 24.3666 23.6041 25.075V27.575H26.8207C28.7041 25.8333 29.7874 23.2666 29.7874 20.225Z" fill="#4285F4"/>
                        <path d="M20.2124 30C22.9124 30 25.1707 29.1 26.8207 27.575L23.604 25.075C22.704 25.675 21.5624 26.0417 20.2124 26.0417C17.604 26.0417 15.3957 24.2833 14.604 21.9083H11.2874V24.4833C12.929 27.75 16.304 30 20.2124 30Z" fill="#34A853"/>
                        <path d="M14.6041 21.9083C14.3957 21.3083 14.2874 20.6667 14.2874 20C14.2874 19.3333 14.4041 18.6917 14.6041 18.0917V15.5167H11.2874C10.6041 16.8667 10.2124 18.3833 10.2124 20C10.2124 21.6167 10.6041 23.1333 11.2874 24.4833L14.6041 21.9083Z" fill="#FBBC05"/>
                        <path d="M20.2124 13.9583C21.6874 13.9583 23.004 14.4667 24.0457 15.4583L26.8957 12.6083C25.1707 10.9917 22.9124 10 20.2124 10C16.304 10 12.929 12.25 11.2874 15.5167L14.604 18.0917C15.3957 15.7167 17.604 13.9583 20.2124 13.9583Z" fill="#EA4335"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_4953_12633">
                        <rect width="20" height="20" fill="white" transform="translate(10 10)"/>
                        </clipPath>
                        </defs>
                    </svg>
                </a>
                <a href="">
                    <span class="sr-only">Apple</span>
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_4953_12640)">
                        <rect width="40" height="40" rx="8" fill="white"/>
                        <path d="M29.3613 16.1824C29.2188 16.2904 26.7031 17.6754 26.7031 20.7549C26.7031 24.3168 29.9042 25.577 30 25.6082C29.9853 25.685 29.4915 27.3339 28.3122 29.0141C27.2608 30.4926 26.1626 31.9688 24.4921 31.9688C22.8215 31.9688 22.3916 31.0207 20.4631 31.0207C18.5837 31.0207 17.9155 32 16.3874 32C14.8594 32 13.7931 30.6319 12.5673 28.9517C11.1473 26.9787 10 23.9136 10 21.0045C10 16.3384 13.1053 13.8638 16.1614 13.8638C17.7853 13.8638 19.1389 14.9055 20.1585 14.9055C21.1289 14.9055 22.6422 13.8014 24.4896 13.8014C25.1898 13.8014 27.7054 13.8638 29.3613 16.1824ZM23.6126 11.826C24.3766 10.9403 24.9171 9.71137 24.9171 8.48245C24.9171 8.31203 24.9023 8.13921 24.8704 8C23.6273 8.0456 22.1484 8.80888 21.2566 9.81938C20.5564 10.5971 19.903 11.826 19.903 13.0717C19.903 13.2589 19.9349 13.4461 19.9496 13.5062C20.0283 13.5206 20.156 13.5374 20.2837 13.5374C21.3991 13.5374 22.8019 12.8077 23.6126 11.826Z" fill="black"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_4953_12640">
                        <rect width="40" height="40" rx="8" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                        
                </a>
                <a href="">
                    <span class="sr-only">Facebook</span>
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="8" fill="white"/>
                        <path d="M18.02 31.88C12.32 30.86 8 25.94 8 20C8 13.4 13.4 8 20 8C26.6 8 32 13.4 32 20C32 25.94 27.68 30.86 21.98 31.88L21.32 31.34H18.68L18.02 31.88Z" fill="url(#paint0_linear_4953_12643)"/>
                        <path d="M24.6798 23.36L25.2198 20H22.0398V17.66C22.0398 16.7 22.3998 15.98 23.8398 15.98H25.3998V12.92C24.5598 12.8 23.5998 12.68 22.7598 12.68C19.9998 12.68 18.0798 14.36 18.0798 17.36V20H15.0798V23.36H18.0798V31.82C18.7398 31.94 19.3998 32 20.0598 32C20.7198 32 21.3798 31.94 22.0398 31.82V23.36H24.6798Z" fill="white"/>
                        <defs>
                        <linearGradient id="paint0_linear_4953_12643" x1="20.0006" y1="31.1654" x2="20.0006" y2="7.99558" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#0062E0"/>
                        <stop offset="1" stop-color="#19AFFF"/>
                        </linearGradient>
                        </defs>
                    </svg>
                        
                </a>
            </div>

            <div class="flex justify-center mt-8 divide-x">

                <p class="pr-8 text-sm">New User? <a href="" class="font-bold text-darkgreen">Sign Up!</a></p>
                <p class="pl-8 text-sm"><a href="{{ route('password.request') }}" class="font-bold text-darkgreen">Reset Password</a></p>
            </div>

        </form>
    </x-authentication-card>
</x-auth-layout>
