<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
// with `($trail)` if you don't want to import it.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Dashboard > Users
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Users', route('admin.users.index'));
});

// Dashboard > Users > Create
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Create', route('admin.users.create'));
});

// Dashboard > Users > Edit
Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Edit', route('admin.users.edit', $user));
});

// Dashboard > Roles
Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Roles', route('admin.roles.index'));
});

// Dashboard > Roles > Create
Breadcrumbs::for('admin.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.roles.index');
    $trail->push('Create', route('admin.roles.create'));
});

// Dashboard > Roles > Edit
Breadcrumbs::for('admin.roles.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('admin.roles.index');
    $trail->push('Edit', route('admin.roles.edit', $role));
});

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Profile
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Profile', route('profile.edit'));
});

// Dashboard > Banners
Breadcrumbs::for('admin.hero-banners.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Banners', route('admin.hero-banners.index'));
});

// Dashboard > Banners > Create
Breadcrumbs::for('admin.hero-banners.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.hero-banners.index');
    $trail->push('Create', route('admin.hero-banners.create'));
});

// Dashboard > Banners > Edit
Breadcrumbs::for('admin.hero-banners.edit', function (BreadcrumbTrail $trail, $heroBanner) {
    $trail->parent('admin.hero-banners.index');
    $trail->push('Edit', route('admin.hero-banners.edit', $heroBanner));
});

// Dashboard > Memberships
Breadcrumbs::for('admin.memberships.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Memberships', route('admin.memberships.index'));
});

// Dashboard > Memberships > Show
Breadcrumbs::for('admin.memberships.show', function (BreadcrumbTrail $trail, $membership) {
    $trail->parent('admin.memberships.index');
    $trail->push('Show', route('admin.memberships.show', $membership));
});
