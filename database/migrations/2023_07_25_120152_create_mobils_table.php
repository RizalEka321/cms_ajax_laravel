<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voids
     */
    public function up()
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->char('id', 6)->primary();
            $table->string('merk', 20);
            $table->string('slug', 20);
            $table->string('nopol', 20);
            $table->string('warna', 20);
            $table->string('tahun', 5);
            $table->string('foto');
            $table->enum('bbm', ['Pertalite', 'Pertamax', 'Solar', 'Dexlite', 'Pertamax Racing', 'Pertamax Turbo', 'Pertamina Dex']);
            $table->integer('penumpang');
            $table->enum('jenis', ['Matic', 'Manual']);
            $table->text('deskripsi');
            $table->bigInteger('harga');
            $table->enum('status', ['Tersedia', 'Tidak Tersedia']);
            $table->enum('unggulan', ['Ya', 'Tidak']);
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
        Schema::dropIfExists('mobils');
    }
};
