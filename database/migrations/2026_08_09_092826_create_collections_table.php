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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('pp_no')->nullable();
            $table->string('phone_no')->nullable();

            $table->date('interview_date_from')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('category')->nullable();
            $table->string('medical')->nullable();
            $table->string('takamul')->nullable();
            $table->string('pc')->nullable();
            $table->string('dl')->nullable();
            $table->unsignedBigInteger('final_status_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

            $table->string('s_entry')->nullable();
            $table->date('entry_date')->nullable();
            $table->string('pic')->nullable();
            $table->string('tasheer')->nullable();
            $table->string('entry_final_status')->nullable();

            $table->date('mofa_date')->nullable();
            $table->string('mofa_status')->nullable();
            $table->text('comments')->nullable();

            $table->unsignedBigInteger('f_company_id')->nullable();
            $table->string('sent_for_mofa_agency')->nullable();
            $table->string('occupation')->nullable();
            $table->string('visa_inport')->nullable();
            $table->string('status_in_visa_section')->nullable();
            $table->dateTime('embassy_handover')->nullable();

            $table->string('stamping')->nullable();

            $table->string('training')->nullable();
            $table->string('finger')->nullable();
            $table->string('man_p')->nullable();

            $table->date('f_date_from')->nullable();
            $table->date('exp_date')->nullable();

            $table->string('fit_card')->nullable();
            $table->string('hand_over_to_visa_section')->nullable();
            $table->string('delivery')->nullable();
            $table->date('delivery_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
