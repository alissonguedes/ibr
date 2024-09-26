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
		Schema::create('ibr_site.tb_pastor', function (Blueprint $table) {
			$table->id();
			$table->string('nome');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->enum('status', ['0', '1']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('ibr_site.tb_pastor');
	}
};
