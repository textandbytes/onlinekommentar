<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_tree', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('parent_id')->default(0);
            $table->unsignedSmallInteger('sort')->default(0);
            $table->string('label_de', 1024)->nullable();
            $table->string('label_en', 1024)->nullable();
            $table->string('label_fr', 1024)->nullable();
            $table->string('label_it', 1024)->nullable();
            $table->timestamps();
        });

        // insert a root node into the document_tree table
        DB::table('document_tree')->insert([
            'id' => 1,
            'parent_id' => 0,
            'sort' => 0,
            'label_de' => '-',
            'label_en' => '-',
            'label_fr' => '-',
            'label_it' => '-',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_tree');
    }
};
