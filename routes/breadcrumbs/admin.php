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

// Dashboard > Events
Breadcrumbs::for('admin.events.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Events', route('admin.events.index'));
});

// Dashboard > Events > Create
Breadcrumbs::for('admin.events.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.events.index');
    $trail->push('Create', route('admin.events.create'));
});

// Dashboard > Events > Edit
Breadcrumbs::for('admin.events.edit', function (BreadcrumbTrail $trail, $event) {
    $trail->parent('admin.events.index');
    $trail->push('Edit', route('admin.events.edit', $event));
});

// Dashboard > Notices
Breadcrumbs::for('admin.notices.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Notices', route('admin.notices.index'));
});

// Dashboard > Notices > Create
Breadcrumbs::for('admin.notices.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.notices.index');
    $trail->push('Create', route('admin.notices.create'));
});

// Dashboard > Notices > Edit
Breadcrumbs::for('admin.notices.edit', function (BreadcrumbTrail $trail, $notice) {
    $trail->parent('admin.notices.index');
    $trail->push('Edit', route('admin.notices.edit', $notice));
});

// Dashboard > University Info
Breadcrumbs::for('admin.university-info.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('University Info', route('admin.university-info.edit'));
});

// Dashboard > Content Pages
Breadcrumbs::for('admin.content-pages.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Content Pages', route('admin.content-pages.index'));
});

// Dashboard > Content Pages > Edit
Breadcrumbs::for('admin.content-pages.edit', function (BreadcrumbTrail $trail, $contentPage) {
    $trail->parent('admin.content-pages.index');
    $trail->push('Edit', route('admin.content-pages.edit', $contentPage));
});

// Dashboard > Advertisements
Breadcrumbs::for('admin.advertisements.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Advertisements', route('admin.advertisements.index'));
});

// Dashboard > Advertisements > Create
Breadcrumbs::for('admin.advertisements.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.advertisements.index');
    $trail->push('Create', route('admin.advertisements.create'));
});

// Dashboard > Advertisements > Edit
Breadcrumbs::for('admin.advertisements.edit', function (BreadcrumbTrail $trail, $advertisement) {
    $trail->parent('admin.advertisements.index');
    $trail->push('Edit', route('admin.advertisements.edit', $advertisement));
});
