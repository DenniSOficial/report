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
        Schema::create('report_commitment_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_commitment_id');
            $table->unsignedBigInteger('document_status_id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('title');
            $table->string('url');
            $table->string('code_document');
            $table->integer('created_user_id');
            $table->integer('updated_user_id')->nullable();
            $table->foreign('report_commitment_id')->references('id')->on('report_commitments')->onDelete('cascade');
            $table->foreign('document_status_id')->references('id')->on('document_statuses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_commitment_documents');
    }
};
