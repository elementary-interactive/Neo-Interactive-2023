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
        Schema::table('case_studies', function (Blueprint $table) {
            $table->string('brief')
                ->nullable(true)
                ->default(null)
                ->change();
            $table->string('solution')
                ->nullable(true)
                ->default(null)
                ->change();
            $table->string('result')
                ->nullable(true)
                ->default(null)
                ->change();
            $table->string('old_content')
                ->nullable(true)
                ->default(null)
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
        Schema::table('case_studies', function (Blueprint $table) {
            $table->string('brief')
                ->nullable(false)
                ->change();
            $table->string('solution')
                ->nullable(false)
                ->change();
            $table->string('result')
                ->nullable(false)
                ->change();
            $table->string('old_content')
                ->nullable(false)
                ->change();
        });
    }
};
