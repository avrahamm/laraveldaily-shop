<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V2\ProductController;

Route::apiResource('products', ProductController::class);
