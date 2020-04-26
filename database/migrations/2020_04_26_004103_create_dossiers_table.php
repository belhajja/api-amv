<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('adherent_id');
            $table->unsignedBigInteger('beneficiaire_id')->nullable();
            $table->string('numero');
            $table->string('statut');
            $table->string('etat_initiale');
            $table->date('date_depot');
            $table->date('date_sinistre');
            $table->string('type');
            $table->date('date_sort');
            $table->string('frais');
            $table->string('mode_reglement');
            $table->string('reglement');
            $table->string('pathologie');
            $table->text('observation');
            $table->foreign('adherent_id')->references('id')->on('adherents')->onDelete('cascade');
            $table->foreign('beneficiaire_id')->references('id')->on('beneficiaires')->onDelete('cascade');
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
        Schema::dropIfExists('dossiers');
    }
}
