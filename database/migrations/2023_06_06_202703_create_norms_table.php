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
        Schema::create('norms', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('code');
            $table->string('applicable_standard');
            $table->string('short_name');
            $table->text('large_name');
            $table->text('place_application');
            $table->date('expedition');
            $table->date('notification')->nullable();
            $table->text('url')->nullable();
            $table->unsignedBigInteger('authority_id');
            $table->integer('created_user_id');
            $table->integer('updated_user_id')->nullable();
            $table->foreign('authority_id')->references('id')->on('authorities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('norms');
    }
};
