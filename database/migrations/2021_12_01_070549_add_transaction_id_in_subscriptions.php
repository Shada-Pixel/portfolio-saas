<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionIdInSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->string('transaction_id',160)->nullable()->after('subscription_plan_id');
            $table->integer('type')->nullable()->comment('1: Stripe, 2: Paypal')->after('transaction_id');
            $table->float('amount')->nullable()->after('type');
            $table->longText('meta')->nullable()->after('amount');

            $table->index(['transaction_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
            $table->dropColumn('type');
            $table->dropColumn('amount');
            $table->dropColumn('meta');
        });
    }
}
