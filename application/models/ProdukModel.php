<?php
use Phpml\Classification\Ensemble\RandomForest;

class ProdukModel extends CI_Model {

    public function simpanProduk($data) {
        $this->db->insert('data_produk', $data);
    }
    public function simpanKategori($data) {
        $jumlahKategori = $this->getJumlahKategori();
        if ($jumlahKategori < 5) {
            return $this->db->insert('kategori_produk', $data);
        } else {
            return false; // Jumlah kategori sudah mencapai batas (5).
            
        }
    }
    public function getProduk() {
        $this->db->select('data_produk.*, kategori_produk.nama_kategori AS kategori, admin.nama AS nama_kategori');
        $this->db->from('data_produk');
        $this->db->join('admin', 'admin.id = data_produk.created_by');
        $this->db->join('kategori_produk', 'kategori_produk.id_kategori = data_produk.id_kategori', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    public function getKategoriProduk() {
        $query = $this->db->get('kategori_produk');
        return $query->result();
    }
    public function getKategoriProdukById($id_kategori) {
        $this->db->where('id_kategori', $id_kategori);
        $query = $this->db->get('kategori_produk');
        return $query->row();
    }
    public function getKategoriProdukArray() {
        $query = $this->db->get('kategori_produk');
        return $query->result_array();
    }
    public function getKategoriPenjualProdukArray()
    {
        $this->db->select('admin.nama AS nama_kategori');
        $this->db->from('data_produk');
        $this->db->join('admin', 'admin.id = data_produk.created_by');
        $this->db->group_by('admin.nama');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getJumlahKategori() {
        return $this->db->count_all('kategori_produk');
    }
    public function getProdukTerlaris() {
        $this->db->select('produk_terlaris.*, data_produk.nama_jamu , data_produk.harga AS harga_asli, data_produk.foto, admin.nama AS admin_update');
        $this->db->from('produk_terlaris');
        $this->db->join('data_produk', 'data_produk.id_produk = produk_terlaris.id_produk', 'left');
        $this->db->join('admin', 'admin.id = produk_terlaris.updated_by', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }
    public function getProdukTerlarisById($id_produk) {
        $this->db->select('produk_terlaris.*, data_produk.nama_jamu, data_produk.harga AS harga_asli, data_produk.foto');
        $this->db->from('produk_terlaris');
        $this->db->join('data_produk', 'data_produk.id_produk = produk_terlaris.id_produk', 'LEFT');
        $this->db->where('produk_terlaris.id_produk', $id_produk);
        $query = $this->db->get();
        return $query->row();
    }
    public function getProdukById($id_produk) {
        $this->db->select('data_produk.*, kategori_produk.nama_kategori AS kategori, admin_membuat.nama AS admin_membuat, admin_update.nama AS admin_update');
        $this->db->where('data_produk.id_produk', $id_produk);
        $this->db->from('data_produk');
        $this->db->join('kategori_produk', 'kategori_produk.id_kategori = data_produk.id_kategori', 'left');
        $this->db->join('admin AS admin_membuat', 'admin_membuat.id = data_produk.created_by', 'left');
        $this->db->join('admin AS admin_update', 'admin_update.id = data_produk.updated_by', 'left');
        $query = $this->db->get();
        return $query->row();
    }
    public function getProdukByAdmin($created_by) {
        $this->db->select('data_produk.*, kategori_produk.nama_kategori AS kategori, admin_membuat.nama AS admin_membuat, admin_update.nama AS admin_update');
        $this->db->where('admin_membuat.id', $created_by);
        $this->db->from('data_produk');
        $this->db->join('kategori_produk', 'kategori_produk.id_kategori = data_produk.id_kategori', 'left');
        $this->db->join('admin AS admin_membuat', 'admin_membuat.id = data_produk.created_by', 'left');
        $this->db->join('admin AS admin_update', 'admin_update.id = data_produk.updated_by', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    public function cekRelasiDenganDataProduk($id_kategori) {
        // Mengecek apakah ada produk yang terkait dengan kategori ini
        $this->db->where('id_kategori', $id_kategori);
        $query = $this->db->get('data_produk');
        return $query->num_rows() > 0;
    }
    public function updateKategori($id_kategori, $update_data) {
        $this->db->where('id_kategori', $id_kategori);
        $this->db->update('kategori_produk', $update_data);
        // Mengembalikan status pembaruan (TRUE jika berhasil, FALSE jika gagal)
        return $this->db->affected_rows() > 0;
    }
    public function hapusKategori($id_kategori) {
        $this->db->where('id_kategori', $id_kategori);
        $this->db->delete('kategori_produk');
    }
    public function getProdukTerlarisForUpdate($id_produk) {
        $this->db->select('produk_terlaris.*, data_produk.harga AS harga_asli');
        $this->db->from('produk_terlaris');
        $this->db->join('data_produk', 'data_produk.id_produk = produk_terlaris.id_produk');
        $this->db->where('produk_terlaris.id_produk', $id_produk);
        $query = $this->db->get();
        return $query->row();
    }
    // Fungsi untuk melakukan pengecekan relasi antara data_produk dan produk_terlaris
    public function cekRelasiProdukTerlaris($id_produk) {
        $produk = $this->getProdukById($id_produk);
        $produk_terlaris = $this->getProdukTerlarisById($id_produk);
        if ($produk && $produk_terlaris) {
            return true; // Terdapat relasi antara data_produk dan produk_terlaris
            
        } else {
            return false; // Tidak terdapat relasi
            
        }
    }
    public function updateProduk($id_produk, $data) {
        $this->db->where('id_produk', $id_produk);
        $this->db->update('data_produk', $data);
    }
    public function updateTerlaris($id_produk, $data) {
        $this->db->update('produk_terlaris', $data);
        $this->db->where('id_produk', $id_produk);
        return true;
    }
    public function hapusProduk($id_produk) {
        $this->db->where('id_produk', $id_produk);
        $this->db->delete('data_produk');
    }
    public function cekDataReferensi($id_produk) {
        // Query untuk memeriksa apakah ada data terkait di tabel referensi
        // Gantikan dengan query sesuai dengan struktur tabel referensi Anda
        $query = $this->db->get_where('produk_terlaris', array('id_produk' => $id_produk));
        return $query->num_rows() > 0;
    }
    public function getTotalDataProduk() {
        return $this->db->count_all('data_produk');
    }
    public function getLastProductID() {
        $this->db->select_max('id_produk');
        $this->db->like('id_produk', 'JM', 'after'); // Hanya ambil ID yang dimulai dengan "JM"
        $this->db->where('LENGTH(id_produk)', 5); // Filter hanya ID produk dengan panjang 5 karakter
        $query = $this->db->get('data_produk');
        $result = $query->row_array();
        // Jika tidak ada data dengan ID "JM", kembalikan nilai awal yaitu "JM000"
        if ($result['id_produk'] === null) {
            return 'JM0000';
        }
        return $result['id_produk'];
    }
    // public function generateNextProductID($lastProductID)
    // {
    //     // Hapus awalan "JM" dan ubah ke dalam bentuk angka
    //     $lastNumber = intval(substr($lastProductID, 2));
    //     // Increment nomor ID
    //     $nextNumber = $lastNumber + 1;
    //     // Gabungkan dengan awalan "JM" dan kembalikan sebagai stringg
    //     $nextProductID = 'JM' . sprintf('%03d', $nextNumber);
    //     return $nextProductID;
    // }

    public function sqlSearch($keyword){
        $this->db->like('id_produk', $keyword);
        $this->db->or_like('nama_jamu', $keyword);
        $this->db->or_like('satuan', $keyword);
        $this->db->or_like('harga', $keyword);
        $this->db->or_like('deskripsi', $keyword);
        $this->db->or_like('manfaat1', $keyword);
        $this->db->or_like('manfaat2', $keyword);
        $this->db->or_like('manfaat3', $keyword);
        // Tambahkan join dengan tabel kategori_produk untuk mengambil nama_produk
        $this->db->join('kategori_produk', 'kategori_produk.id_kategori = data_produk.id_kategori', 'left');

        // Tambahkan kondisi pencarian juga pada kolom kategori dari tabel kategori_produk
        $this->db->or_like('kategori_produk.nama_kategori', $keyword);

        // Mengganti 'nama_kategori' menjadi 'kategori' pada hasil query
        $this->db->select('data_produk.*, kategori_produk.nama_kategori AS kategori');
        $queryResults = $this->db->get('data_produk')->result();
        return $queryResults;
    }
    public function searchProduk($keyword){
        $this->db->like('id_produk', $keyword);
        $this->db->or_like('nama_jamu', $keyword);
        $this->db->or_like('satuan', $keyword);
        $this->db->or_like('harga', $keyword);
        $this->db->or_like('deskripsi', $keyword);
        $this->db->or_like('manfaat1', $keyword);
        $this->db->or_like('manfaat2', $keyword);
        $this->db->or_like('manfaat3', $keyword);
    
        // Tambahkan join dengan tabel kategori_produk untuk mengambil nama_produk
        $this->db->join('kategori_produk', 'kategori_produk.id_kategori = data_produk.id_kategori', 'left');
    
        // Tambahkan kondisi pencarian juga pada kolom kategori dari tabel kategori_produk
        $this->db->or_like('kategori_produk.nama_kategori', $keyword);
    
        // Mengganti 'nama_kategori' menjadi 'kategori' pada hasil query
        $this->db->select('data_produk.*, kategori_produk.nama_kategori AS kategori');
    
        return $this->db->get('data_produk')->result();
    }
    public function knnSearch($keyword) {        
        // Implementasikan algoritma k-NN untuk mencari produk berdasarkan keyword
        // Tokenisasi dan preprocessing pada keyword pencarian
        $queryTokens = explode(' ', strtolower($keyword)); // Tokenisasi dan konversi ke huruf kecil
    
        // Ambil data produk dari database
        $this->db->select('data_produk.*, kategori_produk.nama_kategori AS kategori, harga, foto');
        // Tambahkan join dengan tabel kategori_produk untuk mengambil nama_produk
        $this->db->join('kategori_produk', 'kategori_produk.id_kategori = data_produk.id_kategori', 'left');
    
        $this->db->from('data_produk');
        $products = $this->db->get()->result_array();
        $results = array();
    
        // Lakukan perhitungan jarak antara keyword pencarian dan atribut-atribut yang diinginkan
        foreach ($products as $product) {
            $namaJamuTokens = explode(' ', strtolower($product['nama_jamu'])); // Tokenisasi nama jamu
            $productDescTokens = explode(' ', strtolower($product['deskripsi'])); // Tokenisasi nama jamu
            $productKategoriTokens = explode(' ', strtolower($product['kategori'])); // Tokenisasi nama jamu
            $manfaat1Tokens = explode(' ', strtolower($product['manfaat1'])); // Tokenisasi manfaat1
            $manfaat2Tokens = explode(' ', strtolower($product['manfaat2'])); // Tokenisasi manfaat2
            $manfaat3Tokens = explode(' ', strtolower($product['manfaat3'])); // Tokenisasi manfaat3

            // Hitung jarak kosinus antara keyword pencarian dan semua atribut
            $intersectionNamaJamu = array_intersect($queryTokens, $namaJamuTokens);
            $intersectionDesc = array_intersect($queryTokens, $productDescTokens);
            $intersectionKategori = array_intersect($queryTokens, $productKategoriTokens);
            $intersectionManfaat1 = array_intersect($queryTokens, $manfaat1Tokens);
            $intersectionManfaat2 = array_intersect($queryTokens, $manfaat2Tokens);
            $intersectionManfaat3 = array_intersect($queryTokens, $manfaat3Tokens);

            // Hitung similarity untuk setiap atribut
            $cosineSimilarityNamaJamu = count($intersectionNamaJamu) / (sqrt(count($queryTokens)) * sqrt(count($namaJamuTokens)));
            $cosineSimilarityDesc = count($intersectionDesc) / (sqrt(count($queryTokens)) * sqrt(count($productDescTokens)));
            $cosineSimilarityKategori = count($intersectionKategori) / (sqrt(count($queryTokens)) * sqrt(count($productKategoriTokens)));
            $cosineSimilarityManfaat1 = count($intersectionManfaat1) / (sqrt(count($queryTokens)) * sqrt(count($manfaat1Tokens)));
            $cosineSimilarityManfaat2 = count($intersectionManfaat2) / (sqrt(count($queryTokens)) * sqrt(count($manfaat2Tokens)));
            $cosineSimilarityManfaat3 = count($intersectionManfaat3) / (sqrt(count($queryTokens)) * sqrt(count($manfaat3Tokens)));

            // Hitung similarity total
            $totalSimilarity = (
                $cosineSimilarityNamaJamu +
                $cosineSimilarityDesc +
                $cosineSimilarityKategori +
                $cosineSimilarityManfaat1 +
                $cosineSimilarityManfaat2 +
                $cosineSimilarityManfaat3
            ) / 5; // Jumlah atribut yang dihitung

            // Simpan hasil pencarian yang memiliki similarity lebih besar dari 0
            if ($totalSimilarity > 0) {
                $results[] = array(
                    'id_produk' => $product['id_produk'],
                    'nama_jamu' => $product['nama_jamu'],
                    'satuan' => $product['satuan'],
                    'kategori' => $product['kategori'],
                    'harga' => $product['harga'],
                    'foto' => $product['foto'],
                    'Similarity' => $totalSimilarity
                );
            }
        }

        // Urutkan hasil berdasarkan similarity secara descending
        usort($results, function($a, $b) {
            if ($a['Similarity'] == $b['Similarity']) {
                return 0;
            }
            return ($a['Similarity'] > $b['Similarity']) ? -1 : 1;
        });
    
        return $results;
    }
    
    public function searchRandomForest($knnResults) {
        // Latih model Random Forest dengan data pelatihan
        // Pastikan Anda memiliki model Random Forest yang sesuai di sini
    
        // Buat array untuk menyimpan hasil akhir
        $finalResults = array();
    
        // Gunakan model Random Forest untuk memprediksi relevansi produk
        foreach ($knnResults as $result) {
            // Ubah data hasil pencarian K-NN menjadi format yang sesuai dengan model Random Forest
            $dataPoint = array(
                'id_produk' => $result['id_produk'],
                'nama_jamu' => $result['nama_jamu'],
                'satuan' => $result['satuan'],
                'kategori' => $result['kategori'],
                'harga' => $result['harga'],
                'foto' => $result['foto'],
                // ... tambahkan fitur-fitur lain yang relevan
            );

            $RFmodel = new RandomForest();
            // $model->trainModel($samples, $labels);
    
            // Gunakan model Random Forest untuk memprediksi relevansi produk
            $relevancyScore = $RFmodel->predict($dataPoint);
    
            // Gabungkan hasil pencarian K-NN dan prediksi relevansi dari Random Forest
            $finalResults[0] = array(
                'id_produk' => $result['id_produk'],
                'nama_jamu' => $result['nama_jamu'],
                'satuan' => $result['satuan'],
                'kategori' => $result['kategori'],
                'harga' => $result['harga'],
                'foto' => $result['foto'],
                'Similarity' => $result['Similarity'],
                'Relevancy' => $relevancyScore,
            );
        }
    
        // Urutkan hasil akhir berdasarkan relevansi atau bobot yang Anda tentukan
        // Fungsi pembanding kustom untuk mengurutkan berdasarkan Relevancy
        function sortByRelevancy($a, $b) {
            if ($a['Relevancy'] == $b['Relevancy']) {
                return 0;
            }
            return ($a['Relevancy'] > $b['Relevancy']) ? -1 : 1;
        }

        // Gunakan usort() untuk mengurutkan hasil akhir berdasarkan Relevancy
        usort($finalResults, 'sortByRelevancy');

        // Jika Anda ingin mengurutkan berdasarkan Similarity juga, Anda bisa menambahkan aturan lainnya di sini.

        return $finalResults;
    
    }
    

    public function searchKategori($keyword) {
        $this->db->like('id_kategori', $keyword);
        $this->db->or_like('nama_kategori', $keyword);
        $this->db->or_like('deskripsi_kategori', $keyword);
        return $this->db->get('kategori_produk')->result();
    }
    public function getRandomProduk($limit) {
        $this->db->order_by('RAND()');
        $this->db->limit($limit);
        return $this->db->get('data_produk')->result();
    }
    public function isProdukTerlaris($id_produk) {
        $this->db->where('id_produk', $id_produk);
        $result = $this->db->get('produk_terlaris');
        return $result->num_rows() > 0;
    }
    public function getProdukTerlarisRow1() {
        $this->db->select('id_produk');
        $this->db->from('produk_terlaris');
        $this->db->limit(1);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id_produk;
        } else {
            return null;
        }
    }
    // Terkait Sitemap Untuk Setiap Penambahan Produk
    public function tambahSitemap($data) {
        $this->db->insert('sitemap_urlproduk', $data);
    }
    public function getSitemap() {
        $this->db->select('sitemap_urlproduk.*, data_produk.id_produk, DATE_FORMAT(data_produk.created_at, "%Y-%m-%dT%H:%i:%s+00:00") AS formatted_created_at, DATE_FORMAT(data_produk.updated_at, "%Y-%m-%dT%H:%i:%s+00:00") AS formatted_updated_at');
        $this->db->from('sitemap_urlproduk');
        $this->db->join('data_produk', 'sitemap_urlproduk.id_produk = data_produk.id_produk', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    public function hapusSitemap($id_produk) {
        $this->db->where('id_produk', $id_produk);
        $querry = $this->db->delete('sitemap_urlproduk');
        if ($querry) {
            return true;
        } else {
            return false;
        }
    }
    public function setXML() {
        // Ambil data dari model
        $data_sitemap_produk = $this->getSitemap();;
        // Buat konten sitemap XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml.= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        // Tambahkan entri sitemap tambahan
        $xml.= '<url>' . "\n";
        $xml.= '   <loc>' . base_url() . '</loc>' . "\n";
        $xml.= '   <lastmod>2023-10-04T17:12:14+00:00</lastmod>' . "\n";
        $xml.= '   <changefreq>daily</changefreq>' . "\n";
        $xml.= '   <priority>1.0</priority>' . "\n";
        $xml.= '</url>' . "\n";
        $xml.= '<url>' . "\n";
        $xml.= '   <loc>' . base_url('index.php/Home') . '</loc>' . "\n";
        $xml.= '   <lastmod>2023-10-04T17:12:14+00:00</lastmod>' . "\n";
        $xml.= '   <changefreq>daily</changefreq>' . "\n";
        $xml.= '   <priority>1.0</priority>' . "\n";
        $xml.= '</url>' . "\n";
        $xml.= '<url>' . "\n";
        $xml.= '   <loc>' . base_url('index.php/Home/Belanja') . '</loc>' . "\n";
        $xml.= '   <lastmod>2023-10-04T17:12:14+00:00</lastmod>' . "\n";
        $xml.= '   <changefreq>daily</changefreq>' . "\n";
        $xml.= '   <priority>0.9</priority>' . "\n";
        $xml.= '</url>' . "\n";
        $xml.= '<url>' . "\n";
        $xml.= '   <loc>' . base_url('index.php/Home/TentangKami') . '</loc>' . "\n";
        $xml.= '   <lastmod>2023-10-04T17:12:14+00:00</lastmod>' . "\n";
        $xml.= '   <changefreq>monthly</changefreq>' . "\n";
        $xml.= '   <priority>0.8</priority>' . "\n";
        $xml.= '</url>' . "\n";
        $xml.= '<url>' . "\n";
        $xml.= '<loc>' . base_url('index.php/Home/KontakKami') . '</loc>' . "\n";
        $xml.= '   <lastmod>2023-10-04T17:12:14+00:00</lastmod>' . "\n";
        $xml.= '   <changefreq>monthly</changefreq>' . "\n";
        $xml.= '   <priority>0.7</priority>' . "\n";
        $xml.= '</url>' . "\n";
        foreach ($data_sitemap_produk as $produk) {
            $xml.= '<url>' . "\n";
            $xml.= '   <loc>' . base_url('index.php/Home/SingleProduk/' . $produk->id_produk) . '</loc>' . "\n";
            $xml.= '   <lastmod>' . ($produk->formatted_updated_at === NULL ? $produk->formatted_created_at : $produk->formatted_updated_at) . '</lastmod>' . "\n";
            $xml.= '   <changefreq>monthly</changefreq>' . "\n";
            $xml.= '   <priority>0.6</priority>' . "\n";
            $xml.= '</url>' . "\n";
        }
        $xml.= '</urlset>';
        // Simpan konten sitemap XML ke file di direktori root
        $file_path = FCPATH . 'sitemap.xml';
        file_put_contents($file_path, $xml);
    }
}
