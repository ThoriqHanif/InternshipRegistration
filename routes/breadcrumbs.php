<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard Admin
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.profile', function (BreadcrumbTrail $trail) {
    $trail->push('Profile', route('admin.profile'));
});

// INTERN
Breadcrumbs::for('intern.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Pemagang', route('intern.index'));
});

Breadcrumbs::for('intern.create', function (BreadcrumbTrail $trail) {
    $trail->parent('intern.index');
    $trail->push('Tambah Pemagang');
});

Breadcrumbs::for('intern.show', function (BreadcrumbTrail $trail) {
    $trail->parent('intern.index');
    $trail->push('Detail Pemagang');
});

Breadcrumbs::for('intern.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('intern.index');
    $trail->push('Edit Pemagang');
});

// POSISI

Breadcrumbs::for('position.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Posisi', route('position.index'));
});

Breadcrumbs::for('position.create', function (BreadcrumbTrail $trail) {
    $trail->parent('position.index');
    $trail->push('Tambah Posisi');
});

Breadcrumbs::for('position.show', function (BreadcrumbTrail $trail) {
    $trail->parent('position.index');
    $trail->push('Detail Posisi');
});

Breadcrumbs::for('position.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('position.index');
    $trail->push('Edit Posisi');
});

// PERIODE

Breadcrumbs::for('periode.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Periode', route('periode.index'));
});

Breadcrumbs::for('periode.create', function (BreadcrumbTrail $trail) {
    $trail->parent('periode.index');
    $trail->push('Tambah Periode');
});

Breadcrumbs::for('periode.show', function (BreadcrumbTrail $trail) {
    $trail->parent('periode.index');
    $trail->push('Detail Periode');
});

Breadcrumbs::for('periode.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('periode.index');
    $trail->push('Edit Periode');
});

// Aspek

Breadcrumbs::for('aspects.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Aspek Penilaian', route('aspects.index'));
});
Breadcrumbs::for('technical-aspects.create', function (BreadcrumbTrail $trail) {
    $trail->parent('aspects.index');
    $trail->push('Tambah Aspek Teknis', route('technical-aspects.create'));
});
Breadcrumbs::for('technical-aspects.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('aspects.index');
    $trail->push('Edit Aspek Teknis');
});

// USER

Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('User', route('users.index'));
});

Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push('Tambah User');
});

Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push('Detail User');
});

Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push('Edit User');
});

// ADMIN REPORT
Breadcrumbs::for('admin.report.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Report', route('admin.report.index'));
});

// ADMIN PROFILE
Breadcrumbs::for('reports.index', function (BreadcrumbTrail $trail) {
    $trail->push('Daily Report', route('reports.index'));
});

Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->push('Profile', route('profile'));
});

Breadcrumbs::for('blogs.index', function (BreadcrumbTrail $trail) {
    $trail->push('Blog', route('blogs.index'));
});

Breadcrumbs::for('blogs.create', function (BreadcrumbTrail $trail) {
    $trail->parent('blogs.index');
    $trail->push('Tambah Blog');
});

Breadcrumbs::for('blogs.show', function (BreadcrumbTrail $trail) {
    $trail->parent('blogs.index');
    $trail->push('Preview Blog');
});

Breadcrumbs::for('blogs.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('blogs.index');
    $trail->push('Edit Blog');
});