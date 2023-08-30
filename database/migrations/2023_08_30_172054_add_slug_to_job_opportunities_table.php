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
        Schema::table('job_opportunities', function (Blueprint $table) {
            $table->string('slug')
                ->nullable()
                ->default(null)
                ->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_opportunities', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
