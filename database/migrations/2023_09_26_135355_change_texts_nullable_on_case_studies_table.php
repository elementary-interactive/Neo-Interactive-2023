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
            $table->text('brief')
                ->nullable(true)
                ->default(null)
                ->change();
            $table->text('solution')
                ->nullable(true)
                ->default(null)
                ->change();
            $table->text('result')
                ->nullable(true)
                ->default(null)
                ->change();
            $table->text('old_content')
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
            $table->text('brief')
                ->nullable(false)
                ->change();
            $table->text('solution')
                ->nullable(false)
                ->change();
            $table->text('result')
                ->nullable(false)
                ->change();
            $table->text('old_content')
                ->nullable(false)
                ->change();
        });
    }
};
