<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueryPoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('query_pools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('question');
            $table->text('output');
            $table->unsignedTinyInteger('difficulty');
            $table->text('query')->nullable();
            $table->integer('points')->default(0);
            $table->integer('deductible')->nullable();
            $table->unsignedInteger('time')->nullable();
            $table->unsignedInteger('data_pool_id');
            $table->boolean('is_quiz_query')->default(false);
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
        Schema::dropIfExists('query_pools');
    }
}
