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
        Schema::create('baby_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('유저 아이디');
            $table->string('name');
            $table->enum('type', ['대변', '소변'])->index();
            $table->enum('success_yn', ['Y', 'N'])->default('N');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baby_lists');
    }
};
