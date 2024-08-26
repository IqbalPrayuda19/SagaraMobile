<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use App\Enums\Method;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Table Asset
        Schema::create('assets', function (Blueprint $table) {
            $table->uuid();
            $table->string('name');
            $table->uuid('location_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('restrict');
            $table->uuid('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('restrict');
            $table->string('custom_number');
            $table->string('account_fixed_asset');
            $table->string('description');
            $table->date('accuisition_date');
            $table->integer('accuisition_cost');
            $table->enum('method', Method::values());
            $table->integer('usage_period');
            $table->integer('usage_value_per_year');
            $table->string('depreciation_account');
            $table->string('accumulation_depreciation_account');
            $table->integer('accumulation_depreciation_value');
            $table->date('depreciation_date');
            $table->foreignId('created_by_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('assets');
    }
};
