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
		Schema::create('ibr_site.tb_pais', function (Blueprint $table) {
			$table->id();
			$table->string('codigo', 2);
			$table->string('pais', 50);
			$table->enum('status', ['0', '1'])->default('1');
		});

		Schema::create('ibr_site.tb_estado', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_pais');
			$table->string('estado', 50);
			$table->string('uf')->nullable();
			$table->enum('status', ['0', '1'])->default('1');

			$table->foreign('id_pais')->references('id')->on('tb_pais');

		});

		Schema::create('ibr_site.tb_cidade', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_pais');
			$table->unsignedBigInteger('id_estado');
			$table->string('cidade', 50);
			$table->decimal('latitude', 10, 7);
			$table->decimal('longitude', 10, 7);
			$table->enum('status', ['0', '1'])->default('1');

			$table->foreign('id_pais')->references('id')->on('tb_pais');
			$table->foreign('id_estado')->references('id')->on('tb_estado');

		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('ibr_site.tb_pais');
		Schema::dropIfExists('ibr_site.tb_estado');
		Schema::dropIfExists('ibr_site.tb_cidade');
	}
};
