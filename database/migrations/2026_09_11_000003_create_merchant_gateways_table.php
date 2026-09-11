<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('merchant_gateways', function (Blueprint $table) { $table->id(); $table->foreignId('merchant_id')->constrained()->cascadeOnDelete(); $table->foreignId('gateway_provider_id')->constrained()->cascadeOnDelete(); $table->string('mode')->default('CLIENT_OWNED'); $table->decimal('fee_percent',8,4)->default(0); $table->decimal('fixed_fee',14,2)->default(0); $table->json('credentials')->nullable(); $table->boolean('enabled')->default(true); $table->timestamps(); $table->unique(['merchant_id','gateway_provider_id']); }); } public function down(): void { Schema::dropIfExists('merchant_gateways'); } };
