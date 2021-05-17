<x-guest-layout>
    <x-login.auth-card>

        <div class="text-center text-xl">
            <p class="text-xl font-bold">{{__('login.welcome')}}</p>
            <p class="uppercase my-6 text-3xl font-semibold">{{__('login.login')}}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" class="sm:mx-6 md:mx-14 lg:mx-2 xl:mx-8 leading-6">
            @csrf

            <!-- Email Address -->
            <div class="">
                <x-login.label for="email">
                    <i class="fas fa-user"></i>
                    <x-login.input id="email" class="block ml-2 mt-1 w-full"
                             type="email" placeholder="{{__('login.email')}}"
                             name="email" :value="old('email')"
                             required autofocus autocomplete="off" />
                </x-login.label>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-login.label for="password">
                    <i class="fas fa-lock"></i>
                    <x-login.input id="password" class="block ml-2 mt-1 w-full"
                                    type="password" placeholder="{{__('login.password')}}"
                                    name="password"
                                    required autocomplete="current-password" />
                </x-login.label>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4 flex justify-end items-center">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm
                           focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-white">{{ __('login.remember_me') }}</span>
                </label>
            </div>

            <div class="flex justify-center mt-5">
                <x-login.button>
                    {{ __('login.login_button') }}
                </x-login.button>
            </div>

            <div class="flex items-center justify-center mt-4">
                @if (\Illuminate\Support\Facades\Route::has('password.request'))
                    <a class="underline text-sm text-gray-300 hover:text-white" href="{{ route('password.request') }}">
                        {{ __('login.forgot_password') }}
                    </a>
                @endif
            </div>
        </form>
    </x-login.auth-card>
</x-guest-layout>
