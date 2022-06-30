<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Url extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('urls', function (Blueprint $table) {
        $table->id();
        $table->longText('url')->notNull();
        $table->string('identifier')->notNull();
        $table->string('short_url')->notNull();
        $table->timestamp('expiration')->notNull();
        $table->softDeletes();
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
    }
}
