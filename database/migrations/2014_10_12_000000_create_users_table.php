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
            $table->string("Firstname");
            $table->string("Lastname");
            $table->string("Email");
            $table->string("Contact");
            $table->string("Gender");
            $table->string("Address")->nullable();
            $table->integer("isVerified");
            $table->integer('Section_ID');
            $table->integer('Batch_ID'); 
            $table->integer("Payment"); // 0 = Unpaid | 1 = Paid
            $table->integer("UserType"); // 0 = Admin | 1 = Instructor | 2 = Clients 
            $table->integer("firstlogin"); // 0 = true | 1 = false
            $table->string("Payment_Method")->nullable();
            $table->text('url')->nullable();
            $table->string("Password");
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
