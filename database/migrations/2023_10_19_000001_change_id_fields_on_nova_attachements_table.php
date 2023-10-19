<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nova_field_attachments', function (Blueprint $table) {
            $table->uuid('attachable_id')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nova_field_attachments', function (Blueprint $table) {
            $table->integer('attachable_id', false, true)
                ->change();
        });
    }
};
