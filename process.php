<?php
// Mendefinisikan fungsi hitungPajak dengan parameter $bandara
function hitungPajak($bandara) {
	// Daftar pajak untuk setiap bandara
    $pajak = [
        "CGK" => 50000,
        "BDO" => 30000,
        "MLG" => 40000,
        "SUB" => 40000,
        "DPS" => 80000,
        "UPG" => 70000,
        "INX" => 90000,
        "BTJ" => 70000,
    ];
		// Mengembalikan nilai pajak berdasarkan kode bandara
    return $pajak[$bandara];
}

// Mendefinisikan fungsi hitungTotalHarga dengan parameter $harga_tiket, $bandara_asal, dan $bandara_tujuan
function hitungTotalHarga($harga_tiket, $bandara_asal, $bandara_tujuan) {
    $pajak_asal = hitungPajak($bandara_asal);
    $pajak_tujuan = hitungPajak($bandara_tujuan);
		// Menghitung total harga tiket dengan menambahkan harga tiket dan pajak dari bandara asal dan tujuan
    $total_harga = $harga_tiket + $pajak_asal + $pajak_tujuan;

		// Mengembalikan total harga
    return $total_harga;
}

// Memeriksa apakah request adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Mengambil data dari form yang dikirim
    $nama_maskapai = $_POST["nama_maskapai"];
    $bandara_asal = $_POST["bandara_asal"];
    $bandara_tujuan = $_POST["bandara_tujuan"];
    $harga_tiket = $_POST["harga_tiket"];

		// Menghitung pajak untuk bandara asal dan tujuan
    $pajak_asal = hitungPajak($bandara_asal);
    $pajak_tujuan = hitungPajak($bandara_tujuan);
		// Menghitung total harga tiket beserta pajak
    $total_harga = hitungTotalHarga($harga_tiket, $bandara_asal, $bandara_tujuan);

		// Membaca data lama dari file JSON
    $data_lama = json_decode(file_get_contents("data.json"), true);

		// Membaca data lama dari file JSON
    $data_baru = [
        $nama_maskapai,
        $bandara_asal,
        $bandara_tujuan,
        $harga_tiket,
        $pajak_asal + $pajak_tujuan,
        $total_harga
    ];

		// Menambahkan data baru ke dalam array data lama
    array_push($data_lama, $data_baru);

		// Mengurutkan data berdasarkan nama maskapai menggunakan usort
    usort($data_lama, function ($a, $b) {
        return $a[0] <=> $b[0];
    });

		// Menyimpan data yang telah di-update ke dalam file JSON
    file_put_contents("data.json", json_encode($data_lama));

		 // Mengarahkan pengguna kembali ke halaman index.php setelah data berhasil diolah
    header("Location: index.php");
    exit(); // Menghentikan eksekusi kode
}
?>
