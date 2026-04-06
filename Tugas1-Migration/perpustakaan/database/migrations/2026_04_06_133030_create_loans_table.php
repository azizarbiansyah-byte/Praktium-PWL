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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_npm');
            $table->date('loan_at');
            $table->date('return_at');
            $table->timestamps();

            $table->foreign('user_npm')->references('npm')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table('loans', function (Blueprint $table) {
            $table->dropForeign(['user_npm']);
    });
        Schema::dropIfExists('loans');
    }
};
