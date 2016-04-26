<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePgsqlCharsetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pgsql_charsets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
		});

		DB::unprepared(file_get_contents('database/migrations/data/pgsql_charset_data.sql'));
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pgsql_charsets');
	}

}
