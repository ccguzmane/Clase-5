<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuario extends Migration {


	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->string('correo');      
			$table->string('password');
                        $table->rememberToken();
      $table->timestamps();    
		});
    
		Schema::create('publicacion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('publicacion');
			$table->boolean('tipo'); 
      $table->integer('usuario_id')->unsigned();
      $table->integer('padre')->unsigned()->nullable();
      $table->foreign('usuario_id')->references('id')->on('usuario');
      $table->foreign('padre')->references('id')->on('publicacion');
      $table->timestamps();    
		});
		Schema::create('me_gusta', function(Blueprint $table)
		{
			$table->increments('id');
      $table->integer('publicacion_id')->unsigned();
      $table->integer('usuario_id')->unsigned();
      $table->foreign('publicacion_id')->references('id')->on('publicacion');
      $table->foreign('usuario_id')->references('id')->on('usuario');
      $table->timestamps();    
		});
	
                DB::table('usuario')
                        ->insert([
                            'nombre' => 'Christian',
                            'correo' => 'ccguzmane@unal.edu.co',
                            'password' => Hash::make('12345')
                ]);                
                                
                DB::table('usuario')
                        ->insert([
                            'nombre' => 'Christian',
                            'correo' => 'christiangescobar@hotmail.com',
                            'password' => Hash::make('123456')        
                ]);
                }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('me_gusta');
		Schema::drop('publicacion');
		Schema::drop('usuario');
	}

}
