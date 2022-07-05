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
        Schema::table('document_tree', function (Blueprint $table) {
            $table->text('content_de')->nullable()->after('label_it');
            $table->text('content_en')->nullable()->after('content_de');
            $table->text('content_fr')->nullable()->after('content_en');
            $table->text('content_it')->nullable()->after('content_fr');
            $table->string('node_type')->default('node')->after('content_it');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_tree', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'content_de',
                'content_en',
                'content_fr',
                'content_it',
                'node_type'
            ]));
        });
    }
};
