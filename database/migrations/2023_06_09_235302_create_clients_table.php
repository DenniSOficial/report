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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('document');
            $table->integer('identifier');
            $table->string('name');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->integer('created_user_id');
            $table->integer('updated_user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
