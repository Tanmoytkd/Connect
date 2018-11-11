<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkToNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simple_notifications', function (Blueprint $table) {
            $table->string('link', 256)->nullable()->default('#');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('simple_notifications', function (Blueprint $table) {
            $table->dropColumn('link');
        });
    }
}
