<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('quiz_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('query_pool_id');
            $table->unsignedInteger('quiz_attempt_group_id');
            $table->text('query');
            $table->boolean('is_correct')->default(false);
            $table->text('output');
            $table->boolean('has_error')->default(false);
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
        Schema::dropIfExists('quiz_attempts');
    }
}
