<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMerekDefaultOnBarangsTable extends Migration
{
    public function up()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->string('merek')->default('none')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->string('merek')->default(null)->nullable()->change();
        });
    }
}

