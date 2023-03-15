<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'id' => 1,
            'name' => 'Admin Admin',
            'email' => 'admin_sec@xpto.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('secXpto'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        $admin->givePermissionTo('admin');
    
        User::factory()->count(15)->create()->each(function ($user) {
            $user->givePermissionTo('student');
        });
    }
}
