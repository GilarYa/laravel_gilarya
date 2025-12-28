<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RumahSakit;
use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create Rumah Sakit data
        $rumahSakits = [
            [
                'nama' => 'RS Harapan Bunda',
                'alamat' => 'Jl. Raya Bogor No. 123, Jakarta Timur',
                'email' => 'info@harapanbunda.com',
                'telepon' => '021-12345678',
            ],
            [
                'nama' => 'RS Siloam',
                'alamat' => 'Jl. Gatot Subroto No. 456, Jakarta Selatan',
                'email' => 'info@siloam.com',
                'telepon' => '021-87654321',
            ],
            [
                'nama' => 'RS Pondok Indah',
                'alamat' => 'Jl. Metro Pondok Indah, Jakarta Selatan',
                'email' => 'info@rspi.com',
                'telepon' => '021-11223344',
            ],
            [
                'nama' => 'RS Medistra',
                'alamat' => 'Jl. Gatot Subroto Kav. 59, Jakarta Selatan',
                'email' => 'info@medistra.com',
                'telepon' => '021-55667788',
            ],
            [
                'nama' => 'RS Premier Bintaro',
                'alamat' => 'Jl. MH Thamrin No. 1, Tangerang Selatan',
                'email' => 'info@premierbintaro.com',
                'telepon' => '021-99887766',
            ],
        ];

        foreach ($rumahSakits as $rs) {
            RumahSakit::create($rs);
        }

        // Create Pasien data
        $pasiens = [
            [
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Mangga Besar No. 10, Jakarta',
                'no_telp' => '08123456789',
                'rumah_sakit_id' => 1,
            ],
            [
                'nama' => 'Siti Aminah',
                'alamat' => 'Jl. Kebon Jeruk No. 25, Jakarta',
                'no_telp' => '08234567890',
                'rumah_sakit_id' => 1,
            ],
            [
                'nama' => 'Ahmad Yani',
                'alamat' => 'Jl. Sudirman No. 50, Jakarta',
                'no_telp' => '08345678901',
                'rumah_sakit_id' => 2,
            ],
            [
                'nama' => 'Dewi Lestari',
                'alamat' => 'Jl. Thamrin No. 75, Jakarta',
                'no_telp' => '08456789012',
                'rumah_sakit_id' => 2,
            ],
            [
                'nama' => 'Rudi Hartono',
                'alamat' => 'Jl. Pondok Indah No. 15, Jakarta',
                'no_telp' => '08567890123',
                'rumah_sakit_id' => 3,
            ],
            [
                'nama' => 'Maya Sari',
                'alamat' => 'Jl. Kebayoran No. 30, Jakarta',
                'no_telp' => '08678901234',
                'rumah_sakit_id' => 3,
            ],
            [
                'nama' => 'Joko Widodo',
                'alamat' => 'Jl. Menteng No. 1, Jakarta',
                'no_telp' => '08789012345',
                'rumah_sakit_id' => 4,
            ],
            [
                'nama' => 'Ani Yudhoyono',
                'alamat' => 'Jl. Cikini No. 20, Jakarta',
                'no_telp' => '08890123456',
                'rumah_sakit_id' => 5,
            ],
        ];

        foreach ($pasiens as $pasien) {
            Pasien::create($pasien);
        }
    }
}
