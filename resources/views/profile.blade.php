<x-app-layout>
    <x-layouts.page-header :title="$title">
        <i class="fas fa-user fa-2x header-icon"></i>
    </x-layouts.page-header>

    <div class="breadcrumb">
        {{ Breadcrumbs::render('profile', $user->getFullName()) }}
    </div>

    <x-alerts.success :data="session('success')" />
    <x-alerts.failure :data="session('failure')" />

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
                                <input id="username" class="block mt-1 custom-input bg-gray-200"
                                       type="text" placeholder="{{trans('app.username')}}"
                                       name="username" value="{{$user->username}}" disabled>
                            </label>
                            <label for="email" class="custom-label">
                                {{trans('app.email')}}
                                <input id="email" class="block mt-1 custom-input"
                                       type="email" placeholder="{{trans('app.email')}}"
                                       name="email" value="{{$user->email}}">
                                @error('email') <span class="error">{{ $message }}</span> @enderror
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
                                           name="password" value="">
                                    <i class="far fa-eye active-eye"></i>
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
                                           name="new_password" value="">
                                    <i class="far fa-eye active-eye"></i>
                                </div>
                                @error('new_password') <span class="error">{{ $message }}</span> @enderror
                            </label>
                            <label for="new_password_confirmation" class="custom-label relative">
                                {{trans('app.new_password_confirmation')}}
                                <div class="relative">
                                    <input id="new_password_confirmation" class="block mt-1 custom-input"
                                           type="password" placeholder="{{trans('app.new_password_confirmation')}}"
                                           name="new_password_confirmation" value="">
                                    <i class="far fa-eye active-eye"></i>
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
</x-app-layout>
