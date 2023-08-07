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
        Schema::create('order_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('product_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->string('size');
            $table->string('image_path');
            $table->integer('amount')->default(1);
            $table->timestamps();
        });

//        DB::table('order_lines')->insert(
//            [
//                [
//                    'order_id' => 1,
//                    'product_id' => 1,
//                    'amount' => 4
//                ]
//            ]
//        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderlines');
    }
};
