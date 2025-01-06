<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->morphs('model');
            $table->char('uuid',36)->nullable()->unique();
            $table->string('collection_name', 160);
            $table->string('name',160);
            $table->string('file_name',160);
            $table->string('mime_type',160)->nullable();
            $table->string('disk',160);
            $table->string('conversions_disk',160)->nullable();
            $table->unsignedBigInteger('size');
            $table->longText('manipulations');
            $table->longText('custom_properties');
            $table->longText('generated_conversions');
            $table->longText('responsive_images');
            $table->unsignedInteger('order_column')->nullable();

            $table->nullableTimestamps();
        });
    }
}
