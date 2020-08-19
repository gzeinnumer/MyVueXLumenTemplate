<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_apis', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->text('api_name');
            $table->text('end_point');
            $table->text('method');
            $table->text('user_id');
            $table->text('request');
            $table->text('response');
            $table->string('api_response_id');
            $table->string('response_code');
            $table->text('message');
            $table->string('request_time');
            $table->string('response_time');
            $table->string('http_coderesponse');
            $table->string('http_msgresponse');
            $table->text('keterangan');
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
        Schema::dropIfExists('log_apis');
    }
}
