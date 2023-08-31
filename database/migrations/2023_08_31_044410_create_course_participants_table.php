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
        Schema::create('course_participants', function (Blueprint $table) {
            $table->uuid('id');

            $table->uuid('course_id')
                ->nullable()
                ->default(null);

            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone', 255);

            $table->timestamps();
            $table->softDeletes();

            /** Create indexes.
             * 
             */
            $table->primary('id');
            $table->foreign('course_id')
                ->references('id')
                ->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_participants');
    }
};
