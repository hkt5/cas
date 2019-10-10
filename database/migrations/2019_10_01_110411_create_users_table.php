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
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable(false)->unique();
            $table->string('first_name', 255)->nullable(false);
            $table->string('last_name', 255)->nullable(false);
            $table->string('email', 255)->nullable(false)->unique();
            $table->string('phone', 255)->nullable(false)->unique();
            $table->string('password', 255)->nullable(false);
            $table->boolean('is_admin')->default(0)->nullable(false);
            $table->boolean('is_confirmed')->default(0);
            $table->boolean('is_active')->default(0);
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
