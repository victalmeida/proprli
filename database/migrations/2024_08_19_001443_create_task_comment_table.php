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
        Schema::create('task_comment', function (Blueprint $table) {
            $table->id();
            $table->text('task_description')->nullable();
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('task');
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users');
            $table->foreign('task')->references('id')->on('task');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_comment');
    }
};
