<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email');
            $table->string('confirmation_token')->unique()->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->string('city')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('is_admin')->default(0);
            $table->integer('status')->default(1);
            $table->double('lat')->default(53, 3);
            $table->double('lon')->default(-1, 4);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
