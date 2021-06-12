<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_dossiers', function (Blueprint $table) {
            $table->id();
            $table->string('type_sort');
            $table->date('date_sort');
            $table->integer('delai');
            $table->string('medecin');
            $table->string('motif');
            $table->text('observation');
            $table->boolean('hidden');
            $table->unsignedBigInteger('dossier_id');
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
        Schema::dropIfExists('tracking_dossiers');
    }
}
