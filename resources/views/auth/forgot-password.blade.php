<x-guest-layout>
    <x-auth.auth-card>
        <div class="md:flex w-full">
            <div class="w-full py-10 px-5 md:px-10">
                <div class="text-center mb-5">
                    <h1 class="mb-2 font-bold text-3xl text-gray-900">{{__('auth.forgot_password.header')}}</h1>
                    <p>{{__('auth.forgot_password.description')}}</p>
                </div>
                <!-- Session Status -->
                <x-auth.auth-session-status :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="flex">
                        <div class="w-full px-3 mb-5">
                            <i class="fas fa-envelope fa-sm"></i>
                            <x-auth.label for="email" >{{__('auth.general.email')}}</x-auth.label>
                            <x-auth.input id="email" name="email" error="email" type="email" placeholder="{{__('auth.general.email')}}"/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-full px-3 flex">
                            <x-auth.button class="green-color-btn">{{__('auth.forgot_password.button')}}</x-auth.button>
                            <a href="{{ route('login') }}" class="guest-button indigo-color-btn">{{__('auth.forgot_password.back')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-auth.auth-card>
</x-guest-layout>
