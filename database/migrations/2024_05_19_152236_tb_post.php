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

		Schema::create('ibr_site.tb_categoria', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_parent')->nullable()->default(null);
			$table->string('titulo', 100);
			$table->string('titulo_slug', 100)->unique();
			$table->string('descricao', 255)->nullable()->default(null);
			$table->string('icone', 50)->nullable()->default(null);
			$table->string('color', 50)->nullable()->default('#ffffff');
			$table->string('text_color', 50)->nullable()->default('#000000');
			$table->integer('ordem')->default(0);
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->enum('status', ['0', '1'])->default('1');

		});

		Schema::create('ibr_site.tb_post', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('id_parent')->nullable()->default(null);
			$table->string('autor');
			$table->string('titulo');
			$table->string('titulo_slug');
			$table->string('tipo')->nullable()->comment('Determina qual é o tipo de postagem');
			$table->string('categoria', 100)->nullable()->comment('Determina qual é a categoria das postagem');
			$table->string('subtitulo', 255)->nullable();
			$table->longText('conteudo')->nullable();
			$table->dateTime('data')->nullable()->default(null);
			$table->string('tags')->nullable()->default(null);
			$table->string('url')->nullable()->default(null);
			$table->integer('hits')->default(0);
			$table->integer('ordem')->default(0);
			$table->dateTime('publish_up')->nullable()->default(null);
			$table->dateTime('publish_down')->nullable()->default(null);
			$table->dateTime('created_at');
			$table->dateTime('updated_at')->nullable()->default(null);
			$table->enum('status', ['0', '1'])->default('1');

			$table->foreign('tipo')->on('tb_categoria')->references('titulo_slug');
			$table->foreign('categoria')->on('tb_categoria')->references('titulo_slug');

		});

		// Schema::create('ibr_site.tb_video', function (Blueprint $table) {
		// 	$table->id();
		// 	$table->unsignedBigInteger('id_parent')->nullable()->default(null);
		// 	$table->string('titulo', 100);
		// 	$table->string('titulo_slug', 100);
		// 	$table->string('descricao', 255)->nullable()->default(null);
		// 	$table->dateTime('data')->nullable()->default(null);
		// 	$table->string('tags')->nullable()->default(null);
		// 	$table->string('url')->nullable()->default(null);
		// 	$table->integer('hits')->default(0);
		// 	$table->integer('ordem')->default(0);
		// 	$table->dateTime('publish_up')->nullable()->default(null);
		// 	$table->dateTime('publish_down')->nullable()->default(null);
		// 	$table->dateTime('created_at');
		// 	$table->dateTime('updated_at')->nullable()->default(null);
		// 	$table->enum('status', ['0', '1'])->default('1');
		// });

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('ibr_site.tb_categoria');
		Schema::dropIfExists('ibr_site.tb_post');

	}
};
