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
            [
                'nama' => 'RS Mayapada',
                'alamat' => 'Jl. Lebak Bulus I Kav. 29, Jakarta Selatan',
                'email' => 'info@mayapada.com',
                'telepon' => '021-29217777',
            ],
            [
                'nama' => 'RS Hermina',
                'alamat' => 'Jl. Raya Jatinegara Barat No. 126, Jakarta Timur',
                'email' => 'info@hermina.co.id',
                'telepon' => '021-8191223',
            ],
            [
                'nama' => 'RS Mitra Keluarga Kemayoran',
                'alamat' => 'Jl. HBR Motik No. 2-4, Jakarta Pusat',
                'email' => 'info@mitrakeluarga.com',
                'telepon' => '021-6545555',
            ],
            [
                'nama' => 'RS Pertamina Jaya',
                'alamat' => 'Jl. Jend. Ahmad Yani No. 2, Jakarta Pusat',
                'email' => 'info@pertaminajaya.com',
                'telepon' => '021-4212938',
            ],
            [
                'nama' => 'RS Jakarta',
                'alamat' => 'Jl. Jend. Sudirman Kav. 49, Jakarta Selatan',
                'email' => 'info@rsjakarta.co.id',
                'telepon' => '021-5732241',
            ],
            [
                'nama' => 'RS Cipto Mangunkusumo',
                'alamat' => 'Jl. Diponegoro No. 71, Jakarta Pusat',
                'email' => 'info@rscm.co.id',
                'telepon' => '021-3155678',
            ],
            [
                'nama' => 'RS Fatmawati',
                'alamat' => 'Jl. RS Fatmawati Raya No. 4, Jakarta Selatan',
                'email' => 'info@fatmawati.go.id',
                'telepon' => '021-7501524',
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
            [
                'nama' => 'Eko Prasetyo',
                'alamat' => 'Jl. Kelapa Gading No. 88, Jakarta Utara',
                'no_telp' => '08111222333',
                'rumah_sakit_id' => 6,
            ],
            [
                'nama' => 'Rina Wulandari',
                'alamat' => 'Jl. Sunter Agung No. 45, Jakarta Utara',
                'no_telp' => '08222333444',
                'rumah_sakit_id' => 6,
            ],
            [
                'nama' => 'Agus Setiawan',
                'alamat' => 'Jl. Cempaka Putih No. 12, Jakarta Pusat',
                'no_telp' => '08333444555',
                'rumah_sakit_id' => 7,
            ],
            [
                'nama' => 'Lina Marlina',
                'alamat' => 'Jl. Jatinegara Barat No. 67, Jakarta Timur',
                'no_telp' => '08444555666',
                'rumah_sakit_id' => 7,
            ],
            [
                'nama' => 'Hendra Gunawan',
                'alamat' => 'Jl. Kemayoran No. 33, Jakarta Pusat',
                'no_telp' => '08555666777',
                'rumah_sakit_id' => 8,
            ],
            [
                'nama' => 'Fitri Handayani',
                'alamat' => 'Jl. Gunung Sahari No. 21, Jakarta Pusat',
                'no_telp' => '08666777888',
                'rumah_sakit_id' => 8,
            ],
            [
                'nama' => 'Dedi Mulyadi',
                'alamat' => 'Jl. Ahmad Yani No. 99, Jakarta Pusat',
                'no_telp' => '08777888999',
                'rumah_sakit_id' => 9,
            ],
            [
                'nama' => 'Sri Mulyani',
                'alamat' => 'Jl. Cawang No. 55, Jakarta Timur',
                'no_telp' => '08888999000',
                'rumah_sakit_id' => 9,
            ],
            [
                'nama' => 'Bambang Susilo',
                'alamat' => 'Jl. Sudirman Kav. 52, Jakarta Selatan',
                'no_telp' => '08999000111',
                'rumah_sakit_id' => 10,
            ],
            [
                'nama' => 'Kartini Sari',
                'alamat' => 'Jl. Kuningan No. 18, Jakarta Selatan',
                'no_telp' => '08000111222',
                'rumah_sakit_id' => 10,
            ],
            [
                'nama' => 'Yusuf Mansur',
                'alamat' => 'Jl. Diponegoro No. 77, Jakarta Pusat',
                'no_telp' => '08112233445',
                'rumah_sakit_id' => 11,
            ],
            [
                'nama' => 'Mega Wati',
                'alamat' => 'Jl. Salemba Raya No. 28, Jakarta Pusat',
                'no_telp' => '08223344556',
                'rumah_sakit_id' => 11,
            ],
            [
                'nama' => 'Irfan Hakim',
                'alamat' => 'Jl. Fatmawati No. 60, Jakarta Selatan',
                'no_telp' => '08334455667',
                'rumah_sakit_id' => 12,
            ],
            [
                'nama' => 'Nurul Aini',
                'alamat' => 'Jl. Cilandak No. 42, Jakarta Selatan',
                'no_telp' => '08445566778',
                'rumah_sakit_id' => 12,
            ],
            [
                'nama' => 'Wahyu Pratama',
                'alamat' => 'Jl. Tebet Barat No. 88, Jakarta Selatan',
                'no_telp' => '08556677889',
                'rumah_sakit_id' => 1,
            ],
            [
                'nama' => 'Dian Sastro',
                'alamat' => 'Jl. Pancoran No. 14, Jakarta Selatan',
                'no_telp' => '08667788990',
                'rumah_sakit_id' => 2,
            ],
            [
                'nama' => 'Rizky Febian',
                'alamat' => 'Jl. Pasar Minggu No. 36, Jakarta Selatan',
                'no_telp' => '08778899001',
                'rumah_sakit_id' => 3,
            ],
        ];

        foreach ($pasiens as $pasien) {
            Pasien::create($pasien);
        }
    }
}
