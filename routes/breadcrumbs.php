<?php
// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(trans('app.home'), route('dashboard'));
});

// Home > Profile
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('home');
    $trail->push(trans('app.profile'), route('profile.show'));
    $trail->push($user);
});

// Home > Activity Log
Breadcrumbs::for('activity-log', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('app.activity_log'));
});

// Home > Records
Breadcrumbs::for('records', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('app.records'));
});

// Home > New Protocol
Breadcrumbs::for('new-protocol', function (BreadcrumbTrail $trail, $type) {
    $trail->parent('home');
    $trail->push(trans('app.new-protocol', ['type' => trans('app.'.$type)]));
});

// Home > Show Protocol
Breadcrumbs::for('show-protocol', function (BreadcrumbTrail $trail, $protocol) {
    $trail->parent('home');
    $trail->push(trans('app.'.strtolower($protocol->type)),
        route('protocol.show', ['id' => $protocol->id]));
    $trail->push($protocol->protocol);
});

// Home > Edit Protocol
Breadcrumbs::for('edit-protocol', function (BreadcrumbTrail $trail, $protocol) {
    $trail->parent('home');
    $trail->push(trans('app.'.strtolower($protocol->type)),
        route('protocol.show', ['id' => $protocol->id]));
    $trail->push(trans('protocol.edit'));
});
