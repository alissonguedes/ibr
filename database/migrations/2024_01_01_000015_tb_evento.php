<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	/**
	 * Run the migrations.
	 */
	public function up(): void
	{

		Schema::create('ibrwalber_site.tb_evento_categoria', function (Blueprint $table) {

			$table->id();
			$table->string('titulo');
			$table->string('descricao');
			$table->string('descricao_slug');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');

		});

		Schema::create('ibrwalber_site.tb_evento', function (Blueprint $table) {

			$table->id();
			$table->unsignedBigInteger('id_categoria');
			$table->string('evento', 50);
			$table->string('evento_slug');
			$table->string('descricao')->nullable();
			$table->string('local');
			$table->string('endereco');
			$table->dateTime('data_ini');
			$table->dateTime('data_fim');
			$table->dateTime('data_inscricao_ini');
			$table->dateTime('data_inscricao_fim');
			$table->text('observacao')->nullable();
			$table->enum('recorrencia', ['0', '1'])->default('0');
			$table->integer('recorrencia_periodo')->default(0);
			$table->integer('recorrencia_limite')->default(0);
			$table->string('cor', 25)->default('#ffffff');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->dateTime('publish_up')->nullable()->default(null);
			$table->dateTime('publish_down')->nullable()->default(null);
			$table->integer('vagas')->default(-1)->comment('Se -1, as vagas são ilimitadas.');
			$table->boolean('gratuito')->default(false);
			$table->decimal('valor', 10, 3)->default(0);
			$table->enum('status', ['0', '1'])->default('1');

			$table->foreign('id_categoria')->references('id')->on('tb_evento_categoria')->onUpdate('cascade')->onDelete('cascade');

		});

		Schema::create('ibrwalber_site.tb_inscrito', function (Blueprint $table) {

			$table->id();
			$table->unsignedBigInteger('id_uf');
			$table->unsignedBigInteger('id_cidade');
			$table->string('nome');
			$table->string('cpf');
			$table->string('rg');
			$table->string('email');
			$table->string('celular');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');

			$table->foreign('id_uf')->references('id')->on('tb_estado')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('id_cidade')->references('id')->on('tb_cidade')->onUpdate('cascade')->onDelete('cascade');

		});

		Schema::create('ibrwalber_site.tb_inscricao', function (Blueprint $table) {

			$table->id();
			$table->unsignedBigInteger('id_evento');
			$table->unsignedBigInteger('id_inscrito');
			$table->string('codigo_inscricao', 100);
			$table->enum('status', ['C', '0', '1', 'X'])->default('1')->comment('C - Cancelada, 0 - Pendente de confirmação, 1 - Confirmado/Aceito, X - Não aceito');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');

			$table->foreign('id_evento')->references('id')->on('tb_evento')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('id_inscrito')->references('id')->on('tb_inscrito')->onUpdate('cascade')->onDelete('cascade');

		});

		Schema::create('ibrwalber_site.tb_inscricao_pagamento', function (Blueprint $table) {

			$table->id();
			$table->unsignedBigInteger('id_inscricao');
			$table->timesTamp('data_pagamento');
			$table->double('valor_pago', 11, 3);
			$table->foreign('id_inscricao')->references('id')->on('tb_inscricao')->onUpdate('cascade')->onDelete('cascade');

		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{

		Schema::dropIfExists('ibrwalber_site.tb_evento_categoria');
		Schema::dropIfExists('ibrwalber_site.tb_evento');
		Schema::dropIfExists('ibrwalber_site.tb_inscrito');
		Schema::dropIfExists('ibrwalber_site.tb_inscricao');
		Schema::dropIfExists('ibrwalber_site.tb_inscricao_pagamento');

	}

};
