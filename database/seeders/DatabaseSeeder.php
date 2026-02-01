<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => 'admin',
        ]);

        Pengaturan::factory()
                    ->count(5)
                    ->sequence(
            [   'kode' => 'nama_perusahaan',
                'value' => 'Nama Perusahaan'
            ],
            [   'kode' => 'logo',
                'value' => 'logo.png'
            ],
            [   'kode' => 'favicon',
                'value' => 'favicon.png'
            ],
            [   'kode' => 'tampil_stok',
                'value' => 'Ya'
            ],
            [   'kode' => 'guest_kode',
                'value' => 'UMUM'
            ],
        )->create();
    }
}
