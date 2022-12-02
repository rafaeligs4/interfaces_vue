<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('apellido')->nullable();
            $table->string('cedula')->nullable();
            $table->string('no_licencia')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->string('foto_licencia')->nullable();
            $table->string('rol')->default('vendedor');
            $table->boolean('estado')->default(true);
            $table->date('fecha_nac')->nullable();
            $table->date('fecha_venc')->nullable();
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
        Schema::dropIfExists('users');
    }
};
