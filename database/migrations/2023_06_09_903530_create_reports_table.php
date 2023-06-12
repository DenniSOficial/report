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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_manager_id');
            $table->unsignedBigInteger('report_status_id');
            $table->unsignedBigInteger('type_report_id');
            $table->unsignedBigInteger('client_id');
            $table->string('code');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('client_executive_id');
            $table->string('client_executive');
            $table->string('quote_number');
            $table->string('to_name');
            $table->date('expedition');
            $table->date('notification')->nullable();
            $table->date('shipping')->nullable();
            $table->string('laboratory_report_number')->nullable();
            $table->integer('created_user_id')->nullable();
            $table->integer('updated_user_id')->nullable();
            $table->foreign('report_manager_id')->references('id')->on('report_managers')->onDelete('cascade');
            $table->foreign('report_status_id')->references('id')->on('report_statuses')->onDelete('cascade');
            $table->foreign('type_report_id')->references('id')->on('type_reports')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
