<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentitycardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitycards', function (Blueprint $table) {
            $table->id();
            $table->string('identity_number');
            $table->string('phone_number');
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identitycards');
    }
}
