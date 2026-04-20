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
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['bookshelf_id']);
        });

        Schema::table('loan_detail', function (Blueprint $table) {
            $table->dropForeign(['loan_id']);
            $table->dropForeign(['book_id']);
        });

        Schema::table('returns', function (Blueprint $table) {
            $table->dropForeign(['loan_detail_id']);
        });

        Schema::rename('bookshelfs', 'bookshelves');
        Schema::rename('loan_detail', 'loan_details');
        Schema::rename('returns', 'return_books');

        Schema::table('books', function (Blueprint $table) {
            $table->foreign('bookshelf_id')->references('id')->on('bookshelves')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('loan_details', function (Blueprint $table) {
            $table->foreign('loan_id')->references('id')->on('loans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('return_books', function (Blueprint $table) {
            $table->foreign('loan_detail_id')->references('id')->on('loan_details')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['bookshelf_id']);
        });

        Schema::table('loan_details', function (Blueprint $table) {
            $table->dropForeign(['loan_id']);
            $table->dropForeign(['book_id']);
        });

        Schema::table('return_books', function (Blueprint $table) {
            $table->dropForeign(['loan_detail_id']);
        });

        Schema::rename('bookshelves', 'bookshelfs');
        Schema::rename('loan_details', 'loan_detail');
        Schema::rename('return_books', 'returns');

        Schema::table('books', function (Blueprint $table) {
            $table->foreign('bookshelf_id')->references('id')->on('bookshelfs')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('loan_detail', function (Blueprint $table) {
            $table->foreign('loan_id')->references('id')->on('loans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('returns', function (Blueprint $table) {
            $table->foreign('loan_detail_id')->references('id')->on('loan_detail')->onUpdate('cascade')->onDelete('cascade');
        });
    }
};