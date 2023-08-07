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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('categories')->insert(
            [
                [
                    'name' => 'Oorbellen',
                ],
                [
                    'name' => 'Kettingen',
                ],
                [
                    'name' => 'Ringen',
                ],
                [
                    'name' => 'Armbandjes',
                ],
                [
                    'name' => 'Kleding',
                ],
                [
                    'name' => 'Schoenen',
                ],
                [
                    'name' => 'Handtassen',
                ],
                [
                    'name' => 'Sjaals',
                ],
                [
                    'name' => 'Juweelhouders',
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
