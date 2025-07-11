<?php

use App\Models\Tenant\User;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => User::first());
