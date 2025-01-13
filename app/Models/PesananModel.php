<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table      = 'pesanan';   
    protected $primaryKey = 'id_pesanan';

    protected $useAutoIncrement = true; 
    protected $returnType     = 'array';  

    protected $allowedFields = [
        'id_user', 
        'tanggal_pesanan', 
        'total_item',
        'total', 
        'tarif_pengiriman', 
        'total_bayar', 
        'bukti_pembayaran', 
        'status_pesanan', 
        'id_ekspedisi', 
        'alamat_pengiriman',
        'no_resi'
    ];

    protected $createdField  = 'created_at'; 
    protected $updatedField  = 'updated_at';

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesananModel::class, 'id_pesanan', 'id_pesanan');
    }

    public function getPesanan($bulan = null, $tahun = null, $ekspedisi = null, $statusPesanan = null)
    {
        $builder = $this->db->table('pesanan')
            ->select('pesanan.*, ekspedisi.nama_ekspedisi, users.nama_lengkap')
            ->join('ekspedisi', 'ekspedisi.id_ekspedisi = pesanan.id_ekspedisi')
            ->join('users', 'users.id_user = pesanan.id_user', 'left'); // Left join to include all pesanan even without a matching user

        if ($bulan) {
            $builder->where('MONTH(pesanan.tanggal_pesanan)', $bulan);
        }

        if ($tahun) {
            $builder->where('YEAR(pesanan.tanggal_pesanan)', $tahun);
        }

        if ($ekspedisi) {
            $builder->where('pesanan.id_ekspedisi', $ekspedisi);
        }

        if ($statusPesanan) {
            $builder->where('pesanan.status_pesanan', $statusPesanan);
        }

        return $builder->get()->getResultArray();
    }

    public function getProdukPerKategori()
    {
        return $this->db->table('detail_pesanan')
            ->select('kategori.nm_kategori, COUNT(detail_pesanan.id_product) AS jumlah_produk')
            ->join('product', 'product.id_product = detail_pesanan.id_product')
            ->join('kategori', 'kategori.id_kategori = product.id_kategori')
            ->groupBy('kategori.id_kategori')
            ->get()
            ->getResultArray();
    }

    public function getProductsOrderedBySales()
    {
        return $this->select('product.*, SUM(detail_pesanan.quantity) as total_sales')
                    ->join('detail_pesanan', 'detail_pesanan.id_product = product.id_product', 'left')
                    ->join('pesanan', 'pesanan.id_pesanan = detail_pesanan.id_pesanan', 'left')
                    ->where('product.status', 'Aktif')
                    ->where('pesanan.status_pesanan', 'Selesai')
                    ->groupBy('product.id_product')
                    ->orderBy('total_sales', 'DESC')
                    ->findAll();
    }



}
