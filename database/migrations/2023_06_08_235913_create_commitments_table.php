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
        Schema::create('commitments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('norm_id');
            $table->unsignedBigInteger('phase_id');
            $table->unsignedBigInteger('frequency_id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('code');
            $table->text('summary');
            $table->text('description');
            $table->text('coordinate_utm')->nullable();
            $table->text('coordinate_nutm')->nullable();
            $table->string('related_impact')->nullable();
            $table->integer('created_user_id');
            $table->integer('updated_user_id')->nullable();
            $table->foreign('norm_id')->references('id')->on('norms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commitments');
    }
};
