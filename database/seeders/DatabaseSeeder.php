<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder { public function run(): void { foreach ([['code'=>'bkash','name'=>'bKash','driver'=>'bkash'],['code'=>'nagad','name'=>'Nagad','driver'=>'nagad'],['code'=>'surjopay','name'=>'SurjoPay','driver'=>'surjopay'],['code'=>'stripe','name'=>'Stripe','driver'=>'stripe']] as $provider) { DB::table('gateway_providers')->updateOrInsert(['code'=>$provider['code']], $provider + ['enabled'=>true,'created_at'=>now(),'updated_at'=>now()]); } } }
