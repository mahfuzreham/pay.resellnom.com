<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->json(['name'=>'ResellPay','status'=>'online','api'=>url('/api/v1/health')]));
Route::get('/checkout/{payment}', fn (string $payment) => response()->json(['payment_id'=>$payment,'status'=>'pending','message'=>'Checkout session placeholder. Gateway adapters will be connected next.']));
