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
        Schema::create('news', function (Blueprint $table) {
            $table->uuid('id');

            $table->uuid('site_id');

            $table->string('title');
            $table->string('slug');
            $table->text('lead');
            $table->text('content');
            $table->string('image');

            $table->char('status', 1)
                ->default(BasicStatus::default()->value);

            $table->timestamp('published_at')
                ->nullable()
                ->default(null);
            $table->timestamp('expired_at')
                ->nullable()
                ->default(null);

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
        Schema::dropIfExists('news');
    }
};
