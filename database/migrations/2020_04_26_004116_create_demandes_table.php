<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('objet');
            $table->text('description');
            $table->date('date_demande');
            $table->string('statut');
            $table->date('date_reponse');
            $table->date('date_resolution');
            $table->text('reponse');
            $table->unsignedBigInteger('societe_id')->nullable();
            $table->unsignedBigInteger('adherent_id')->nullable();
            $table->unsignedBigInteger('dossier_id')->nullable();
            $table->foreign('adherent_id')->references('id')->on('adherents')->onDelete('cascade');
            $table->foreign('societe_id')->references('id')->on('societes')->onDelete('cascade');
            $table->foreign('dossier_id')->references('id')->on('dossiers')->onDelete('cascade');
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
        Schema::dropIfExists('demandes');
    }
}
