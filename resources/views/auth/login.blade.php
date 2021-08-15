<x-guest-layout>
    <x-auth.auth-card>
        <div class="md:flex w-full">
            <div class="hidden md:block w-1/2 bg-indigo-400 py-10 px-10">
                <img class="w-full h-full" src="{{asset('/assets/images/login.svg')}}" alt="Login door.">
            </div>
            <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                <div class="text-center mb-10">
                    <h1 class="mb-2 font-bold text-3xl text-gray-900">{{__('auth.login.login')}}</h1>
                    <p>{{__('auth.login.welcome')}}</p>
                </div>
                <!-- Session Status -->
                <x-auth.auth-session-status :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth.auth-validation-errors :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="flex">
                        <div class="w-full px-3 mb-5">
                            <i class="fas fa-user fa-sm"></i>
                            <x-auth.label for="email">{{__('auth.general.email')}}</x-auth.label>
                            <x-auth.input id="email" name="email" type="email" value="{{old('email')}}" placeholder="{{__('auth.general.email')}}"/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-full px-3">
                            <i class="fas fa-lock fa-sm"></i>
                            <x-auth.label for="password">{{__('auth.general.password')}}</x-auth.label>
                            <x-auth.input id="password" name="password" type="password" placeholder="{{__('auth.general.password')}}"/>
                        </div>
                    </div>
                    <div class="px-3 mt-4 mb-6 flex justify-between items-center">
                        <div class="flex items-center">
                            @if (\Illuminate\Support\Facades\Route::has('password.request'))
                                <a class="underline text-sm hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('auth.login.forgot_password') }}
                                </a>
                            @endif
                        </div>
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                   class="guest-remember">
                            <span class="ml-2 text-sm">{{ __('auth.login.remember_me') }}</span>
                        </label>
                    </div>

                    <div class="flex">
                        <div class="w-full px-3 mb-5">
                            <x-auth.button class="indigo-color-btn">{{__('auth.login.button')}}</x-auth.button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-auth.auth-card>
</x-guest-layout>
