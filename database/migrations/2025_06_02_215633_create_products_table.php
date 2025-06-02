<?php

use Composer\Semver\Constraint\Constraint;
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
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->string('description');

            $table->foreignId('brand_id')
                ->constrained('brands');

            $table->foreignId('category_id')
                ->constrained('categories');
                
            $table->decimal('purchaseValue', 10, 2);
            $table->decimal('salePrice', 10,2);
            $table->decimal('profitMargin', 5,2);

            $table->integer('numberUnits');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
