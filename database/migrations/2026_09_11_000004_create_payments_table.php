<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('payments', function (Blueprint $table) { $table->id(); $table->foreignId('merchant_id')->nullable()->constrained()->nullOnDelete(); $table->string('payment_id')->unique(); $table->string('reference')->nullable(); $table->unsignedBigInteger('amount_minor'); $table->string('currency',3)->default('BDT'); $table->string('gateway')->nullable(); $table->string('status')->default('pending'); $table->string('idempotency_key')->nullable()->unique(); $table->json('metadata')->nullable(); $table->timestamps(); $table->index(['merchant_id','status']); }); } public function down(): void { Schema::dropIfExists('payments'); } };
