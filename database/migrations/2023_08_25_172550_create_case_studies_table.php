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
        Schema::create('case_studies', function (Blueprint $table) {
            $table->uuid('id');

            $table->uuid('site_id');
            $table->uuid('partner_id');
            
            $table->string('title');
            $table->string('slug')
                ->nullable()
                ->default(null);
            $table->text('brief');
            $table->text('solution');
            $table->text('result');

            $table->boolean('show_on_main')
                ->default(false);

            $table->tinyInteger('order', false, true);

            $table->timestamps();
            $table->softDeletes();

            /** Create indexes.
             * 
             */
            $table->primary('id');
            $table->foreign('site_id')
                ->references('id')
                ->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};
