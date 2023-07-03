<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedToColumnIntoTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_to')->nullable()->references('id')->on('services')->after('is_locked');
        });
    }

   
}
