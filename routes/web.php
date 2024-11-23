<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('/sso-upi', \App\Livewire\Auth\SsoUpi::class)->name('sso.upi')->middleware('cas.auth');
Route::get('/sso-google', \App\Livewire\Auth\SsoGoogle::class)->name('sso.google');


Route::get('/staff', \App\Livewire\Staff\Idx::class)->name('staff');
Route::get('/mobile/staff', \App\Livewire\Mobile\Staff\Idx::class)->name('mobile.staff');
Route::get('/mobile/staff/research/review', \App\Livewire\Mobile\Staff\Research\Review\Idx::class)->name('mobile.staff.research.review');
Route::get('/mobile/staff/research/supervise', \App\Livewire\Mobile\Staff\Research\Supervise\Idx::class)->name('mobile.staff.research.supervise');
Route::get('/mobile/staff/event/pre-defense', \App\Livewire\Mobile\Staff\Event\PreDefense\Idx::class)->name('mobile.staff.event.pre-defense');
Route::get('/mobile/staff/event/final-defense', \App\Livewire\Mobile\Staff\Event\FinalDefense\Idx::class)->name('mobile.staff.event.final-defense');

Route::get('/mobile/sa/staff/login-as', \App\Livewire\Mobile\SuperAdmin\Staff\LoginAs::class)->name('mobile.sa.staff.login-as');