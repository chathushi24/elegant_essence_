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
        Schema::connection('mongodb')->create('products', function (Blueprint $table) {
            $table->index('_id'); // MongoDB uses _id instead of id
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->string('image');
            $table->string('category');
            $table->integer('quantity');
            $table->json('available_sizes'); // Storing size as JSON array
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
