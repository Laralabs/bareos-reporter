<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMysqlCollationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mysql_collations', function(Blueprint $table)
		{
			$table->string('COLLATION_NAME', 32)->default('');
			$table->string('CHARACTER_SET_NAME', 32)->default('');
			$table->bigInteger('ID')->default(0)->primary();
			$table->bigInteger('SORTLEN')->default(0);
		});

		DB::unprepared(file_get_contents('database/migrations/data/mysql_collation_data.sql'));
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mysql_collations');
	}

}
