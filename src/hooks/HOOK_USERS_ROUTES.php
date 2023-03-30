<?php
Route::get('/orders/{chUser}', [\App\Http\Controllers\Admin\UsersOrdersController::class, 'orders'])
    ->middleware('can:view'.\App\Models\Cart\Cart::class)
    ->name('orders');
