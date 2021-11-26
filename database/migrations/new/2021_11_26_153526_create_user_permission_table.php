<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permission', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('permission_id');

            //SETTING THE PRIMARY KEYS
            $table->primary(['user_id','permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_permission');
    }
}
