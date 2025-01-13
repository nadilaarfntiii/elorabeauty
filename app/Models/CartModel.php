<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart'; 
    protected $primaryKey = 'id_cart'; 
    protected $allowedFields = ['id_user', 'id_kategori', 'id_product','gambar_1', 'qty', 'total'];

    public function getCartByUser($userId)
    {
        return $this->db->table('cart')
            ->select('cart.id_product, cart.qty, cart.total, product.harga')  // Include 'harga' from product table
            ->join('product', 'product.id_product = cart.id_product')  // Join with the 'product' table to get 'harga'
            ->where('cart.id_user', $userId)
            ->get()
            ->getResultArray();
    }

    // Method lain untuk menghapus cart jika perlu
    public function clearCart($userId)
    {
        return $this->where('id_user', $userId)->delete();
    }

    public function getCartDetails($userId = null)
    {
        $builder = $this->db->table($this->table)
            ->select('cart.*, users.nama_lengkap AS nama_user, kategori.nm_kategori, product.nama_product, product.diskon, product.gambar_1, product.harga')
            ->join('users', 'users.id_user = cart.id_user')
            ->join('kategori', 'kategori.id_kategori = cart.id_kategori')
            ->join('product', 'product.id_product = cart.id_product');

        if ($userId) {
            $builder->where('cart.id_user', $userId);
        }

        return $builder->get()->getResultArray();
    }

    public function countCartItems($userId)
    {
        // Hitung jumlah produk unik di keranjang berdasarkan user_id
        $builder = $this->db->table($this->table);
        $builder->where('id_user', $userId);
        $builder->select('COUNT(DISTINCT id_product) AS total_products'); // Menghitung produk unik
        $result = $builder->get()->getRowArray();
        return $result['total_products'] ?? 0; // Jika null, kembalikan 0
    }
    

    public function countCartQty($userId)
    {
        $builder = $this->db->table($this->table);
        $builder->selectSum('qty'); // Hitung total qty
        $builder->where('id_user', $userId); // Filter berdasarkan id_user

        $result = $builder->get()->getRowArray();
        return $result['qty'] ?? 0; // Jika null, kembalikan 0
    }
}
