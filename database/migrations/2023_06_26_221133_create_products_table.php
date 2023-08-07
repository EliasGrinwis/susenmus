<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->foreignId('category_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->string('name');
            $table->double('price');
            $table->timestamps();
        });

//        DB::table('products')->insert(
//            [
//                [
//                    'category_id' => 1,
//                    'name' => 'test Product',
//                    'price' => 29.99,
//                ]
//            ]
//        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
