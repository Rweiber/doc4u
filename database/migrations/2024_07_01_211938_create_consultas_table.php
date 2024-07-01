<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('medico_id');
            $table->timestamp('data_consulta')->nullable();
            $table->string('cpf_responsavel')->nullable();
            $table->string('nome_responsavel')->nullable();
            $table->timestamps();
            $table->timestamp('data_agendamento')->nullable();
            
            // Chaves estrangeiras
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('medico_id')->references('id')->on('medicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
