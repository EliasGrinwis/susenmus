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
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('size_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity')->default(1);
            $table->integer('max_quantity_available');
            $table->timestamps();
        });

//        DB::table('product_sizes')->insert(
//            [
//                [
//                    'product_id' => '1',
//                    'size_id' => '1',
//                    'max_quantity_available' => 10,
//                ],
//                [
//                    'product_id' => '1',
//                    'size_id' => '2',
//                    'max_quantity_available' => 13,
//                ],
//
//                [
//                    'product_id' => '1',
//                    'size_id' => '2',
//                    'max_quantity_available' => 12,
//                ],
//                [
//                    'product_id' => '1',
//                    'size_id' => '2',
//                    'max_quantity_available' => 15,
//                ],
//            ]
//        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
