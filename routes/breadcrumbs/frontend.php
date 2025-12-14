<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
// with `($trail)` if you don't want to import it.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Profile
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Edit Profile', route('profile.edit'));
});

// Home > [Page Title]
Breadcrumbs::for('content_pages.show', function (BreadcrumbTrail $trail, $contentPage) {
    $trail->parent('home');
    $trail->push($contentPage->title, route('content_pages.show', $contentPage));
});

// Home > Membership Application
Breadcrumbs::for('membership.create', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Membership Application', route('membership.create'));
});

// Home > Membership Status
Breadcrumbs::for('membership.show', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Membership Status', route('membership.show'));
});

// Home > Events
Breadcrumbs::for('events.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Events', route('events.index'));
});

// Home > Events > [Event Title]
Breadcrumbs::for('events.show', function (BreadcrumbTrail $trail, $event) {
    $trail->parent('events.index');
    $trail->push($event->title, route('events.show', $event));
});

// Home > Notices
Breadcrumbs::for('notices.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Notices', route('notices.index'));
});

// Home > Notices > [Notice Title]
Breadcrumbs::for('notices.show', function (BreadcrumbTrail $trail, $notice) {
    $trail->parent('notices.index');
    $trail->push($notice->title, route('notices.show', $notice));
});

// Home > University
Breadcrumbs::for('university.show', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('University', route('university.show'));
});

// Home > Batch
Breadcrumbs::for('batch.show', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Batch', route('batch.show'));
});

// Home > Alumni
Breadcrumbs::for('alumni.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Alumni', route('alumni.index'));
});

// Home > Alumni > [User Name]
Breadcrumbs::for('alumni.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('alumni.index');
    $trail->push($user->name, route('alumni.show', $user));
});

// Home > Constitution
Breadcrumbs::for('constitution.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Constitution', route('constitution.index'));
});

// Home > Video Gallery
Breadcrumbs::for('video_gallery.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Video Gallery', route('video_gallery.index'));
});

// Home > Executive Committees
Breadcrumbs::for('executive-committees.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Executive Committees', route('executive-committees.index'));
});