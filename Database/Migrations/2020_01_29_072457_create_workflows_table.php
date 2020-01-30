<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('division_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('approver_id')->nullable();
            $table->string('application_name');
            $table->integer('sequence')->default(1);
            $table->string('approval_caption');
            $table->boolean('back_to_requestor')->default(0);
            $table->text('description')->nullable();

            $table->string('role')->nullable();
            $table->boolean('type')->default(0);                    // IF emp == 0 then role 1

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workflows');
    }
}
