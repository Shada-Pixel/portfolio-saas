<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVcardUniqueIdToVCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('v_cards', function (Blueprint $table) {
            $table->string('v_card_unique_id', 20)->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('v_cards', function (Blueprint $table) {
            $table->dropColumn('v_card_unique_id');
        });
    }
}
