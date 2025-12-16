<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddRoleToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // حقل نصي يخزن role؛ قيم متوقعة: admin, editor, user
            $table->string('role')->default('user')->after('password');
        });

        // إن كان لديك حقل is_admin موجود (من خطوات سابقة) - نُحدّث القيم تلقائياً
        try {
            DB::table('users')->where('is_admin', true)->update(['role' => 'admin']);
        } catch (\Exception $e) {
            // تجاهل إذا لم يكن العمود موجودًا أو حصل خطأ في DB أثناء الترحيل
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
}
