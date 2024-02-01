<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->string('name');
            $table->string('description');
            $table->integer('numberOfDays');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('travels');
    }
};
