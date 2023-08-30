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
        Schema::create('job_applicants', function (Blueprint $table) {
            $table->uuid('id');

            $table->uuid('job_opportunity_id')
                ->nullable()
                ->default(null);
            
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('file_name', 255);
            $table->string('file_path', 255);
            
            $table->timestamps();
            $table->softDeletes();

            /** Create indexes.
             * 
             */
            $table->primary('id');
            $table->foreign('job_opportunity_id')
                ->references('id')
                ->on('job_opportunities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applicants');
    }
};
