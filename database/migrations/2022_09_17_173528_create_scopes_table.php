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
        Schema::create('scopes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resource_id')->comment('PK=resources.id');
            $table->string('scope')->unique('scopes_name_unique')->comment('user.create');
            $table->string('display_name')->nullable()->comment('Get users details');
            $table->string('http_method', 100)->comment('GET | POST | PUT | DELETE');
            $table->string('action_name')->nullable();
            $table->string('url')->comment('group/*');
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
        Schema::dropIfExists('scopes');
    }
};
