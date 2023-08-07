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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('status_id')->default(1)->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->boolean('isOrdered')->default(false);
            $table->date('order_date')->nullable();
            $table->timestamps();
        });


//        DB::table('orders')->insert(
//            [
//                [
//                    'user_id' => 1,
//                    'status_id' => 1,
//                    'order_date' => '2023/05/26'
//                ]
//            ]
//        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
