<x-guest-layout>
    <x-auth.auth-card>
        <div class="md:flex w-full">
            <div class="w-full py-10 px-5 md:px-10">
                <div class="text-center mb-5">
                    <h1 class="mb-2 font-bold text-3xl text-gray-900">{{__('auth.reset_password.header')}}</h1>
                    <p>{{__('auth.reset_password.description')}}</p>
                </div>
                <!-- Session Status -->
                <x-auth.auth-session-status :status="session('status')" />

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="flex">
                        <div class="w-full px-3 mb-5">
                            <i class="fas fa-envelope fa-sm"></i>
                            <x-auth.label for="email">{{__('auth.reset_password.email')}}</x-auth.label>
                            <x-auth.input id="email" name="email" type="email" required error="email"
                                          value="{{old('email')}}" placeholder="{{__('auth.reset_password.email')}}"/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-full px-3 mb-5">
                            <i class="fas fa-lock fa-sm"></i>
                            <x-auth.label for="password">{{__('auth.reset_password.password')}}</x-auth.label>
                            <x-auth.input id="password" name="password" type="password" required error="password"
                                          placeholder="{{__('auth.reset_password.password')}}"/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-full px-3 mb-5">
                            <i class="fas fa-lock fa-sm"></i>
                            <x-auth.label for="password_confirmation">{{__('auth.reset_password.password_confirmation')}}</x-auth.label>
                            <x-auth.input id="password_confirmation" name="password_confirmation" required error="password_confirmation"
                                          type="password_confirmation" placeholder="{{__('auth.reset_password.password_confirmation')}}"/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-full px-3">
                            <x-auth.button class="green-color-btn">{{__('auth.reset_password.button')}}</x-auth.button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-auth.auth-card>
</x-guest-layout>
