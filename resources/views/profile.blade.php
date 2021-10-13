<x-app-layout>
    <x-layouts.page-header :title="$title">
        <i class="fas fa-user fa-2x header-icon"></i>
    </x-layouts.page-header>
    <div class="breadcrumb">
        {{ Breadcrumbs::render('profile', $user->getFullName()) }}
    </div>
    <div class="page-container">
        Page under construction.
    </div>
</x-app-layout>
