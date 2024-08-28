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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('borrow_date')->nullable(false);
            $table->date('return_date')->nullable(false);
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('books_id')->nullable(false);
            $table->unsignedBigInteger('penalties_id')->nullable(false);
            $table->unsignedBigInteger('members_id')->nullable(false);
            $table->timestamps();


            $table->foreign('books_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penalties_id')->references('id')->on('penalties')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('members_id')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
