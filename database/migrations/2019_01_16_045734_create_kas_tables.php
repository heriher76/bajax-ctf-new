    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->integer('bayar');
            $table->enum('bulan',[1,2,3,4,5,6,7,8,9,10,11,12]);
            $table->integer('tahun');
            $table->enum('minggu',[1,2,3,4]);
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('set null')
            ->onDelete('set null');
        });
        Schema::create('keuangan', function (Blueprint $table) {
            $table->increments('id');
            $table->text('keterangan');
            $table->integer('harga');
            $table->enum('tipe',['Pemasukan','Pengeluaran']);
            $table->timestamps();
        });
        Schema::create('jumlah_uang', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uang');
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
        Schema::dropIfExists('kas');
        Schema::dropIfExists('kas');
    }
}
