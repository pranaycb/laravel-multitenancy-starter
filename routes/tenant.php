<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => app('currentTenant'));
