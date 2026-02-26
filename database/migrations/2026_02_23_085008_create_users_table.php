<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();

        $table->string('first_name');
        $table->string('last_name');
        $table->string('username')->unique();
        $table->string('email')->unique();
        $table->string('phone')->nullable();

        $table->unsignedBigInteger('role_id');
        $table->unsignedBigInteger('state_id')->nullable();

        $table->string('profile_image')->nullable();
        $table->text('bio')->nullable();

        $table->string('password');

       
        $table->timestamps();

        // Foreign Keys
        $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
