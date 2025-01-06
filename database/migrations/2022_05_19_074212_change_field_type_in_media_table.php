<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldTypeInMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->string('model_type',160)->change();
        });
        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->string('model_type',160)->change();
        });
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->string('model_type',160)->change();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->string('name',160)->change();
            $table->string('guard_name',160)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            //
        });
    }
}
