<?php

use App\Http\Api\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::resource('company', CompanyController::class, ['only' => ['store']]);
