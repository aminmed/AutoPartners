<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->enum('home', ['yes', 'no']);
            $table->string('title');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('fabricant_id');
            $table->foreign('fabricant_id')->references('id')->on('fabricants');
            $table->string('version'); 
            $table->string('puissance'); 
            $table->enum('energie', ['Diesel', 'Essence','Essence et GPL','GPL','Eléctrique','Hybride : Essence et électrique','Hybride : Diesel et électrique']);
            $table->integer('kilometrage');
            $table->integer('millesime');
            $table->enum('boite', ['Manuelle', 'Automatique']);
            $table->integer('nbPortes');
            $table->string('dateCirculation'); 
            $table->string('couleur');
            $table->enum('premiereMain', ['yes', 'no']);
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('images');
            $table->string('video')->nullable();
            $table->integer('prix');
            $table->integer('promotion')->nullable();
            $table->text('options')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
