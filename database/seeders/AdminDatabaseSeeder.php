<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\CommunityRule;
use App\Models\Page;
use App\Models\Question;
use App\Models\Setting;
use App\Models\SupportChat;
use Spatie\Permission\Models\Permission;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::create([
            "email"         => "admin@admin.com",
            "password"      => Hash::make("123456789") ,
            "type"          => "Super Admin"
        ]);
        $permissions = [
            "admin.create",
            "admin.show" ,
            "admin.edit" ,
            "admin.delete" ,
            "role.create",
            "role.show" ,
            "role.edit" ,
            "role.delete" ,
            "customer.create" ,
            "customer.show" ,
            "customer.edit" ,
            "customer.delete" ,
            "invoice.create" ,
            "invoice.show" ,
            "invoice.edit" ,
            "invoice.delete" ,
        ];
        foreach ($permissions as $key => $value) {
            Permission::create([
                    "name"          => $value ,
                    "guard_name"    => "web"
            ]);
        }
    }
}
