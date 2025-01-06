<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pricing_plan_id');
            $table->string('attribute_icon');
            $table->string('attribute_name');
            $table->timestamps();

            $table->foreign('pricing_plan_id')->references('id')->on('pricing_plans')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_attributes');
    }
}
