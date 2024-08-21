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
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->text('task_description')->nullable();
            $table->unsignedBigInteger('assigned_user')->nullable();
            $table->unsignedBigInteger('assigned_building');
            $table->unsignedBigInteger('assigned_team');
            $table->unsignedBigInteger('task_status');
            $table->timestamps();

            $table->foreign('assigned_user')->references('id')->on('users');
            $table->foreign('task_status')->references('id')->on('task_status');
            $table->foreign('assigned_building')->references('id')->on('building');
            $table->foreign('assigned_team')->references('id')->on('team');

            $table->index(['task_name', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIndex(['task_name', 'created_at']);
        Schema::dropIfExists('task');
    }
};
