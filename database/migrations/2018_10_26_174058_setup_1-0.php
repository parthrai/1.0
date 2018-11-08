<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Setup10 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('initials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('license_key')->default('');
            $table->timestamp('license_expiry')->default(null);
            $table->string('licensed_to')->default('');
            $table->string('company_name')->default('');
            $table->boolean('isSetup')->default(false);
            $table->string('options')->default('');



            $table->rememberToken();
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
        //

        Schema::dropIfExists('initials');
    }
}
