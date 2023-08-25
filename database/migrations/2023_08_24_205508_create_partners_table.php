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
        Schema::create('partners', function (Blueprint $table) {
            $table->uuid('id');
            
            $table->string('name');
            $table->string('link');
            $table->string('logo')
                ->nullable()
                ->default(null);

            $table->timestamps();
            $table->softDeletes();

            /** Create indexes.
             * 
             */
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
