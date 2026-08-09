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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('country');
            $table->string('company_name');
            $table->text('waqala_visa_number');
            $table->string('profession');
            $table->string('ref_no')->unique()->nullable();
            $table->date('initiate_date');
            $table->enum('status', ['activated', 'closed'])->default('activated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
