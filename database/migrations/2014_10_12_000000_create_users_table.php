<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',160);
            $table->string('last_name',160);
            $table->string('region_code',100)->nullable();
            $table->string('phone',160)->nullable();
            $table->date('dob')->nullable();
            $table->string('email',100)->unique();
            $table->string('password',100);
            $table->boolean('available_as_freelancer')->nullable();
            $table->double('experience')->nullable();
            $table->string('job_title',100)->nullable();
            $table->longText('about_me')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('language',100)->default('en');
            $table->string('user_name', 20)->unique();
            $table->string('tenant_id',100);

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('state_id')->references('id')->on('states')
                ->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('city_id')->references('id')->on('cities')
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
        Schema::dropIfExists('users');
    }
}
