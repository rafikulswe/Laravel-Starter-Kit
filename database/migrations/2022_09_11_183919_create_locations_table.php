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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_location_id')->nullable();
            $table->string('location_type_id')->nullable()->comment('Region, Country, State, City, Post Code');
            $table->string('code')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('geo_code', 10)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
            $table->string('description')->nullable();
            $table->string('currency')->nullable();

            $table->string('region_id')->nullable();
            $table->string('country_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('thana_id')->nullable();
            $table->string('area_id')->nullable();
            $table->string('postcode_id')->nullable();

            // $table->unsignedBigInteger('created_by')->nullable();
            // $table->unsignedBigInteger('updated_by')->nullable();
            // $table->unsignedBigInteger('deleted_by')->nullable();
            // $table->softDeletes();
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
        Schema::dropIfExists('locations');
    }
};
