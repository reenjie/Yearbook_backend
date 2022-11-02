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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("Firstname");
            $table->string("Lastname");
            $table->string("Email")->nullable();
            $table->string("Contact")->nullable();
            $table->foreignId('Batch_ID')
            ->constrained('batches')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('Section_ID')
            ->constrained('sections')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->text('Honors')->nullable();
            $table->text('photo')->nullable();
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
        Schema::dropIfExists('students');
    }
};
