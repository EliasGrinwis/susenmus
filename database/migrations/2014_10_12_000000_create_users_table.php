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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->default(2)->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->string('name');
            $table->string('customer_number')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                [
                    'name' => 'Elias Grinwis Plaat Stultjes',
                    'customer_number' => '211145578',
                    'email' => 'eliasgrinwis27@gmail.com',
                    'password' => Hash::make('Appelkeek18!'),
                    'role_id' => 1,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'John Doe',
                    'customer_number' => '48484815184',
                    'email' => 'johndoe@example.com',
                    'password' => Hash::make('password123'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Jane Smith',
                    'customer_number' => '48488851851',
                    'email' => 'janesmith@example.com',
                    'password' => Hash::make('password456'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Michael Johnson',
                    'customer_number' => '1177818181',
                    'email' => 'michaeljohnson@example.com',
                    'password' => Hash::make('password789'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Emily Davis',
                    'customer_number' => '1841181818181',
                    'email' => 'emilydavis@example.com',
                    'password' => Hash::make('passwordabc'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Robert Wilson',
                    'customer_number' => '89189181818',
                    'email' => 'robertwilson@example.com',
                    'password' => Hash::make('passworddef'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Sophia Martinez',
                    'customer_number' => '8189181181',
                    'email' => 'sophiamartinez@example.com',
                    'password' => Hash::make('passwordghi'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Matthew Thompson',
                    'customer_number' => '51515198181',
                    'email' => 'matthewthompson@example.com',
                    'password' => Hash::make('passwordjkl'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Olivia Anderson',
                    'customer_number' => '14894894892814198',
                    'email' => 'oliviaanderson@example.com',
                    'password' => Hash::make('passwordmno'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'James Rodriguez',
                    'customer_number' => '915615118611',
                    'email' => 'jamesrodriguez@example.com',
                    'password' => Hash::make('passwordpqr'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Ava Lee',
                    'customer_number' => '4517111818486165415',
                    'email' => 'avalee@example.com',
                    'password' => Hash::make('passwordstu'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Ethan Taylor',
                    'customer_number' => '114118498454',
                    'email' => 'ethantaylor@example.com',
                    'password' => Hash::make('passwordvwx'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Mia Moore',
                    'customer_number' => '5191891182891',
                    'email' => 'miamoore@example.com',
                    'password' => Hash::make('passwordyz1'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Alexander Clark',
                    'customer_number' => '59894849',
                    'email' => 'alexanderclark@example.com',
                    'password' => Hash::make('password234'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Charlotte Lewis',
                    'customer_number' => '5151817841',
                    'email' => 'charlottelewis@example.com',
                    'password' => Hash::make('password567'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Daniel Young',
                    'customer_number' => '115615181',
                    'email' => 'danielyoung@example.com',
                    'password' => Hash::make('password890'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Sofia Baker',
                    'customer_number' => '4915615616818',
                    'email' => 'sofiabaker@example.com',
                    'password' => Hash::make('passwordxyz'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'William Turner',
                    'customer_number' => '5454815151',
                    'email' => 'williamturner@example.com',
                    'password' => Hash::make('password123'),
                    'role_id' => 2,
                    'current_team_id' => null,
                    'profile_photo_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
