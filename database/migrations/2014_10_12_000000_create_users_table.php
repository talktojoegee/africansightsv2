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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->unsignedBigInteger('tenant_id');
            $table->string('api_token')->nullable();
            $table->string('username')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            //$table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            $table->string('image')->nullable();
            $table->double('sms_unit')->default(5);
            $table->tinyInteger('is_admin')->default(2)->comment('1=manager,2=residence,3=owner,4=vendor');
            $table->string('mobile_no')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('account_status')->default(1)->comment('1=active,0=pending,2=deactivated');
            $table->string('active_sub_key')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->rememberToken();
            $table->timestamps();
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
};
