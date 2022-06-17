<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceListMailingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_list_mailing', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 36)->comment('Идентификатор пользователя');
            $table->longtext('payload')->comment('Экземпляр класс для экспорта excel');
            $table->unsignedBigInteger('interval')->comment('Периодичность отправки в минутах');
            $table->timestamp('mail_at')->nullable()->comment('Дата следующей отправки');
            $table->timestamp('mailed_at')->nullable()->comment('Дата последней отправки');
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
        Schema::dropIfExists('price_list_mailing');
    }
}
