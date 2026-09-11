<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/health', fn () => response()->json(['success'=>true,'service'=>'ResellPay','version'=>'v1','environment'=>app()->environment()]));
    Route::post('/payments', function (Request $request) {
        $data = $request->validate(['amount'=>['required','numeric','min:1'],'currency'=>['nullable','string','size:3'],'reference'=>['nullable','string','max:100'],'gateway'=>['nullable','string','max:50']]);
        $id = 'pay_'.str()->lower(str()->random(24));
        return response()->json(['success'=>true,'data'=>['payment_id'=>$id,'status'=>'pending','amount'=>(float)$data['amount'],'currency'=>strtoupper($data['currency'] ?? 'BDT'),'reference'=>$data['reference'] ?? null,'gateway'=>$data['gateway'] ?? 'auto','checkout_url'=>url('/checkout/'.$id)]], 201);
    });
});
