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
    $table->unsignedBigInteger('location_id');
    $table->foreign('location_id')->references('id')->on('locations')->onDelete('restrict');
    $table->unsignedBigInteger('categories_id');
    $table->foreign('categories_id')->references('id')->on('categories')->onDelete('restrict');
    $table->string('custom_number');
    $table->string('account_fixed_asset');
    $table->string('description');
    $table->date('accuisition_date');
    $table->unsignedBigInteger('accuisition_cost'); // Change this to unsignedBigInteger
    $table->string('non_depreciation');
    $table->string('method');
    $table->unsignedInteger('usage_period'); // Keep usage_period as unsignedInteger
    $table->unsignedBigInteger('usage_value_per_year'); // Change to unsignedBigInteger
    $table->string('depreciation_account');
    $table->string('accumulation_depreciation_account');
    $table->unsignedBigInteger('accumulation_depreciation_value'); // Change to unsignedBigInteger
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
