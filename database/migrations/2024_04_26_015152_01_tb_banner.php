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

		Schema::create('ibr_site.tb_file', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('id_object');
			$table->string('categoria', 50)->default('post')->comment('Determina qual é a categoria de arquivo');
			// $table->string('titulo');
			// $table->string('titulo_slug');
			// $table->string('descricao')->nullable()->default(null);
			$table->string('key');
			$table->string('signature');
			$table->string('imgname');
			$table->string('imgtype');
			$table->integer('imgsize');
			// $table->string('autor');
			// $table->integer('ordem')->default(0);
			$table->string('tags')->nullable()->default(null);
			$table->string('url')->nullable()->default(null);
			$table->integer('hits')->default(0);
			// $table->dateTime('publish_up')->nullable()->default(null);
			// $table->dateTime('publish_down')->nullable()->default(null);
			$table->dateTime('created_at');
			$table->dateTime('updated_at')->nullable()->default(null);
			$table->enum('status', ['0', '1']);
		});

		Schema::create('ibr_site.tb_file_chunk', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('id_file');
			$table->integer('id_chunk');
			$table->binary('filedata');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('ibr_site.tb_file');
		Schema::dropIfExists('ibr_site.tb_file_chunk');
	}
};
