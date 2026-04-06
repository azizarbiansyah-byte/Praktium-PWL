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
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_detail_id');
            $table->boolean('charge');
            $table->integer('amount');

            $table->foreign('loan_detail_id')->references('id')->on('loan_detail')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table('returns', function (Blueprint $table) {
            $table->dropForeign(['loan_detail_id']);
    });
        Schema::dropIfExists('returns');
    }
};
