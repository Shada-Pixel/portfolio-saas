<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVCardAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_card_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('v_card_id')->nullable();
            $table->string('icon')->nullable();
            $table->string('icon_color')->nullable();
            $table->string('label_text')->nullable();
            $table->string('value_text')->nullable();
            $table->timestamps();

            $table->foreign('v_card_id')->references('id')->on('v_cards')
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
        Schema::dropIfExists('v_card_attributes');
    }
}
