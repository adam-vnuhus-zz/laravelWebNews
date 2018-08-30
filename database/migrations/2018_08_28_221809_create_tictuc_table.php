<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTictucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tintuc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('TieuDe');
            $table->string('TieuDeKhongDau');
            $table->text('TomTat');
            $table->text('NoiDung');
            $table->string('Hinh');
            $table->Integer('NoiBat')->default(0);
            $table->Integer('SoLuotXem')->default(0);
            $table->unsignedInteger('idLoaiTin');
            $table->foreign('idLoaiTin')->references('id')->on('loaitin');
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
        Schema::dropIfExists('tintuc');
    }
}
