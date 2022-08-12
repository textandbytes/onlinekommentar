<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $role = Role::findByName('admin');
        $role->givePermissionTo('view-users');
        $role->givePermissionTo('create-users');
        $role->givePermissionTo('edit-users');
        $role->givePermissionTo('delete-users');        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $role = Role::findByName('admin');
        $role->revokePermissionTo('delete-users');
        $role->revokePermissionTo('edit-users');
        $role->revokePermissionTo('create-users');
        $role->revokePermissionTo('view-users');
    }
};
