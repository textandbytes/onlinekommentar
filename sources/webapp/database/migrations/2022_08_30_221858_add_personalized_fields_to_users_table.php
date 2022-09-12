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
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->nullable()->after('email');
            $table->string('occupation')->nullable()->after('title');
            $table->string('practice')->nullable()->after('occupation');
            $table->string('linkedin_url')->nullable()->after('practice');
            $table->string('website_url')->nullable()->after('linkedin_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'title',
                'occupation',
                'practice',
                'linkedin_url',
                'website_url'
            ]));
        });
    }
};
