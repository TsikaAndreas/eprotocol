<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocols', function (Blueprint $table) {
            $table->id();
            $table->string('protocol')->nullable()->unique();
            $table->date('protocol_date');
            $table->string('status');
            $table->string('type');
            $table->string('ingoing_protocol',255)->nullable();
            $table->date('ingoing_protocol_date')->nullable();
            $table->string('creator',255);
            $table->string('receiver',255);
            $table->text('title');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->timestamp('canceled_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocols');
    }
}
