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
        Schema::table('livecontrols_user_groups', function (Blueprint $table) {
            $table->string('darkmode_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('livecontrols_user_groups', function (Blueprint $table) {
            $table->dropColumn('darkmode_color');
        });
    }
};
