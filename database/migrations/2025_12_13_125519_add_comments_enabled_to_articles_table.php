<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsEnabledToArticlesTable extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            if (! Schema::hasColumn('articles', 'comments_enabled')) {
                $table->boolean('comments_enabled')->default(true)->after('user_id');
            }
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'comments_enabled')) {
                $table->dropColumn('comments_enabled');
            }
        });
    }
}
