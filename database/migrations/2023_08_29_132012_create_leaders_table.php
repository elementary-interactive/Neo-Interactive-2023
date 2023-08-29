<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Neon\Models\Statuses\BasicStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leaders', function (Blueprint $table) {
            $table->uuid('id');

            $table->uuid('site_id');
            
            $table->string('name');
            $table->string('position');
            $table->string('image');
            $table->string('link_facebook')
                ->nullable()
                ->default(null);
            $table->string('link_linkedin')
                ->nullable()
                ->default(null);

            $table->char('status', 1)
                ->default(BasicStatus::default()->value);
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
        Schema::dropIfExists('leaders');
    }
};
