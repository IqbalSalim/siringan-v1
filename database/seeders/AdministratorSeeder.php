<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->username = "Iqbal Salim";
        $administrator->name = "Admin";
        $administrator->email = "admin@gmail.com";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("admin");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Tumbihe, Kabila, Bone Bolango";
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
