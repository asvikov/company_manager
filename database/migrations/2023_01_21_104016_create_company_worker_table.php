<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyWorkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_worker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('worker_id');

            //$table->foreign('company_id')->references('id')->on('companies');
            //$table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
            $table->unique(['company_id', 'worker_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_worker');
    }
}
