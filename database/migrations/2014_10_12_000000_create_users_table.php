<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'customer']);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Set auto increment starting value
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1000'); // Start from 1000, for example
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
