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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation');
            $table->timestamps();
        });

        DB::table('sizes')->insert(
            [
                [
                    'name' => 'small',
                    'abbreviation' => 'S'
                ],
                [
                    'name' => 'medium',
                    'abbreviation' => 'M'
                ],
                [
                    'name' => 'large',
                    'abbreviation' => 'L'
                ],
                [
                    'name' => 'extra large',
                    'abbreviation' => 'XL'
                ],
                [
                    'name' => 'Taille Unique',
                    'abbreviation' => 'TU'
                ],
        ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
