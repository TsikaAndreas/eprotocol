<x-app-layout>
    <x-layouts.page-header :title="$title">
        <i class="fas fa-user fa-2x header-icon"></i>
    </x-layouts.page-header>

    <div class="breadcrumb">
        {{ Breadcrumbs::render('profile', $user->getFullName()) }}
    </div>

    <x-alerts.success :data="session('success')"></x-alerts.success>
    <x-alerts.failure :data="session('failure')"></x-alerts.failure>

    <div class="page-container">
        <div id="account-details">
            <div class="account-header">
                <i class="fas fa-user-cog"></i>
                {{trans('app.account_details')}}
            </div>
            <hr class="header-line">
            <div class="content">
                <form id="update-details-form" action="{{route('profile.update')}}" method="POST">
                    @csrf
                    <div class="form-section m-4">
                        <div class="form-group grid grid-cols-2 gap-x-8">
                            <label for="username" class="custom-label">
                                {{trans('app.username')}}
                                <input id="username" class="block mt-1 custom-input bg-gray-100"
                                       type="text" placeholder="{{trans('app.username')}}"
                                       name="username" value="{{$user->username}}" readonly>
                            </label>
                            <label for="pref_lang" class="custom-label">
                                {{trans('app.preferable_language')}}
                                <select id="pref_lang" class="block mt-1 custom-input"
                                        type="text" name="pref_lang">
                                    @foreach (\Illuminate\Support\Facades\Config::get('languages') as $lang => $language)
                                        <option value="{{$lang}}" {{($lang === $user->preferable_language) ? 'selected' : null}}>
                                            {{trans('app.'.$lang)}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pref_lang') <span class="error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>
                    <div class="form-section m-4">
                        <div class="form-group grid grid-cols-2 gap-x-8">
                            <label for="firstname" class="custom-label">
                                {{trans('app.firstname')}}
                                <input id="firstname" class="block mt-1 custom-input"
                                       type="text" placeholder="{{trans('app.firstname')}}"
                                       name="firstname" value="{{$user->firstname}}">
                                @error('firstname') <span class="error">{{ $message }}</span> @enderror
                            </label>
                            <label for="lastname" class="custom-label">
                                {{trans('app.lastname')}}
                                <input id="lastname" class="block mt-1 custom-input"
                                       type="text" placeholder="{{trans('app.lastname')}}"
                                       name="lastname" value="{{$user->lastname}}">
                                @error('lastname') <span class="error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>
                    <div class="form-section m-4">
                        <div class="form-group grid grid-cols-2 gap-x-8">
                            <label for="email" class="custom-label">
                                <span>
                                    {{trans('app.email')}}
                                </span>
                                @if(empty($user->email_verified_at))
                                    <span class="border rounded-xl px-1 py-0.5 text-xs text-yellow-500 border-yellow-500">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{trans('app.unverified')}}
                                    </span>
                                @else
                                    <span class="border rounded-xl px-1 py-0.5 text-xs text-green-600 border-green-600">
                                        <i class="fas fa-check-circle"></i>
                                        {{trans('app.verified')}}
                                    </span>
                                @endif
                                <input id="email" class="block mt-1 custom-input"
                                       type="email" placeholder="{{trans('app.email')}}"
                                       name="email" value="{{$user->email}}">
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                                @if(empty($user->email_verified_at))
                                    <div id="resend_verify_email" class="flex text-sm text-indigo-500">
                                        <div class="cursor-pointer hover:text-indigo-700">
                                            <i class="fas fa-envelope"></i>
                                            <span class="underline">
                                                {{__('auth.verify_email.button')}}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="form-section my-4 text-center">
                        <button form="update-details-form" class="submit-button">
                            {{trans('app.update_details_btn')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div id="password-change">
            <div class="account-header">
                <i class="fas fa-key"></i>
                {{trans('app.password_change')}}
            </div>
            <hr class="header-line">
            <div class="content">
                <form id="change-password-form" action="{{route('password.change')}}" method="POST">
                    @csrf
                    <div class="form-section m-4">
                        <div class="form-group grid grid-cols-2 gap-x-8">
                            <label for="password" class="custom-label relative">
                                {{trans('app.password')}}
                                <div class="relative">
                                    <input id="password" class="block mt-1 custom-input"
                                           type="password" placeholder="{{trans('app.password')}}"
                                           name="password" value="" autocomplete="current-password">
                                    <i class="far fa-eye-slash active-eye cursor-pointer"></i>
                                </div>
                                @error('password') <span class="error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>
                    <div class="form-section m-4">
                        <div class="form-group grid grid-cols-2 gap-x-8">
                            <label for="new_password" class="custom-label">
                                {{trans('app.new_password')}}
                                <div class="relative">
                                    <input id="new_password" class="block mt-1 custom-input"
                                           type="password" placeholder="{{trans('app.new_password')}}"
                                           name="new_password" value="" autocomplete="new-password">
                                    <i class="far fa-eye-slash active-eye cursor-pointer"></i>
                                </div>
                                @error('new_password') <span class="error">{{ $message }}</span> @enderror
                            </label>
                            <label for="new_password_confirmation" class="custom-label relative">
                                {{trans('app.new_password_confirmation')}}
                                <div class="relative">
                                    <input id="new_password_confirmation" class="block mt-1 custom-input"
                                           type="password" placeholder="{{trans('app.new_password_confirmation')}}"
                                           name="new_password_confirmation" value="" autocomplete="new-password">
                                    <i class="far fa-eye-slash active-eye cursor-pointer"></i>
                                </div>
                                @error('new_password_confirmation') <span class="error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>
                    <div class="form-section my-4 text-center">
                        <button form="change-password-form" class="reset-password-button">
                            {{trans('app.change_password_btn')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('footer-scripts')
        <script type="text/javascript" src="{{ asset('js/profile-bundle.js') }}"></script>
    @endpush
</x-app-layout>
