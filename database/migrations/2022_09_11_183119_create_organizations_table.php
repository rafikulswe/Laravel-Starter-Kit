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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->comment('FK = locations.id');
            $table->unsignedBigInteger('division_id')->comment('FK = locations.id');
            $table->unsignedBigInteger('district_id')->comment('FK = locations.id');
            $table->unsignedBigInteger('thana_id')->comment('FK = locations.id');
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->string('mobile', 32)->nullable();
            $table->string('email', 64)->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->tinyInteger('valid')->default(1)->comment = '1=Yes, 0=No';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
};
