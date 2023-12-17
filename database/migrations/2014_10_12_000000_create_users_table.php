<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('address');
            $table->string('gender')->nullable();
            $table->string('dealer')->nullable();
            $table->decimal('annual_income', 10, 2)->nullable();
            $table->string('password');
            $table->string('image_url')->nullable();
            $table->string('user_type')->default('customer');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('partner_name');
            $table->string('partner_email')->nullable();
            $table->string('partner_phone')->nullable();
            $table->string('partner_address');
            $table->string('partner_type');
            $table->timestamps();
        });

        Schema::create('body_styles', function (Blueprint $table) {
            $table->id();
            $table->string('body_style');
            $table->timestamps();
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('color_name');
            $table->timestamps();
        });

        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('part_name');
            $table->string('part_type');
            $table->unsignedBigInteger('supplier');
            $table->date('manufactured_date');
            $table->timestamps();

            $table->foreign('supplier')->references('id')->on('partners')->onDelete('cascade');
        });

        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('variant_name');
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        Schema::create('brand_models', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->unsignedBigInteger('brand');
            $table->string('image_url')->nullable();
            $table->unsignedBigInteger('manufacturer');
            $table->timestamps();

            $table->foreign('brand')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('manufacturer')->references('id')->on('partners')->onDelete('cascade');
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('vin')->primary();
            $table->unsignedBigInteger('model');
            $table->unsignedBigInteger('variant');
            $table->unsignedBigInteger('color');
            $table->unsignedBigInteger('body');
            $table->year('model_year');
            $table->decimal('price', 15, 2);
            $table->string('status')->nullable();
            $table->string('image_url')->nullable();
            $table->date('manufactured_date');
            $table->timestamps();

            $table->foreign('model')->references('id')->on('brand_models')->onDelete('cascade');
            $table->foreign('variant')->references('id')->on('variants')->onDelete('cascade');
            $table->foreign('color')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('body')->references('id')->on('body_styles')->onDelete('cascade');
        });

        Schema::create('vehicle_parts', function (Blueprint $table) {
            $table->id();
            $table->string('vin');
            $table->unsignedBigInteger('part');
            $table->timestamps();

            $table->foreign('vin')->references('vin')->on('vehicles')->onDelete('cascade');
            $table->foreign('part')->references('id')->on('parts')->onDelete('cascade');
        });

        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dealer');
            $table->string('vin')->unique();
            $table->boolean('sold_status')->default(false);
            $table->boolean('available')->default(false);
            $table->string('retail_price')->nullable();
            $table->timestamps();

            $table->foreign('vin')->references('vin')->on('vehicles')->onDelete('cascade');
            $table->foreign('dealer')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->string('transaction_id')->primary();
            $table->unsignedBigInteger('customer');
            $table->unsignedBigInteger('dealer');
            $table->timestamp('purchase_date');
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('customer')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dealer')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('purchased_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('transaction');
            $table->unsignedBigInteger('inventory_id');
            $table->decimal('price', 15, 2);
            $table->timestamps();

            $table->foreign('transaction')->references('transaction_id')->on('transactions')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('individuals');
        Schema::dropIfExists('dealers');
        Schema::dropIfExists('manufacturers');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('body_styles');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('parts');
        Schema::dropIfExists('variants');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('brand_models');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('vehicle_parts');
        Schema::dropIfExists('inventories');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('purchased_vehicles');
    }
};
