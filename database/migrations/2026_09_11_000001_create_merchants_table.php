<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('merchants', function (Blueprint $table) { $table->id(); $table->string('name'); $table->string('slug')->unique(); $table->string('email')->nullable(); $table->string('phone')->nullable(); $table->enum('mode',['CLIENT_OWNED','RESELLPAY'])->default('CLIENT_OWNED'); $table->string('status')->default('active'); $table->timestamps(); }); } public function down(): void { Schema::dropIfExists('merchants'); } };
