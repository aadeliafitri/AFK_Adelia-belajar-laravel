<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home');
    }

    public function main() {
        $count_produk = Product::count();
        $total_category = Category::count();
        $total_harga = Product::sum('price');
        $total_stok = Product::sum('stock');
        // dd($count_produk);
        $produk_kategori = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->selectRaw('product_categories.category_name, COUNT(products.category_id) as total_produk')
        ->groupBy('product_categories.category_name')
        ->pluck('total_produk', 'category_name');
        // dd($produk_kategori);
        $chartData = [];

        foreach ($produk_kategori as $kategori => $total_produk) {
            $chartData[] = ['name' => $kategori, 'y' => $total_produk];
        }

        $harga_produk = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->selectRaw('product_categories.category_name, SUM(products.price) as total_harga_produk')
        ->groupBy('product_categories.category_name')
        ->pluck('total_harga_produk', 'category_name');
        // dd($harga_produk);

        $chartHarga = [];

        foreach ($harga_produk as $kategori => $total_harga_produk) {
            $total_harga_produk = floatval($total_harga_produk);

            $chartHarga[] = ['name' => $kategori, 'y' => $total_harga_produk];
        }
        // dd($chartHarga);
        $produk_stock = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->selectRaw('product_categories.category_name, SUM(products.stock) as jumlah_produk')
        ->groupBy('product_categories.category_name')
        ->pluck('jumlah_produk', 'category_name');
        // dd($produk_kategori);
        $chartStock = [];

        foreach ($produk_stock as $kategori => $jumlah_produk) {
            $chartStock[] = ['name' => $kategori, 'y' => floatval($jumlah_produk)];
        }
        // dd($chartStock);

        return view('pages.dashboard', compact(
            'count_produk',
            'total_category',
            'total_harga',
            'total_stok',
            // 'produk_kategori'
        ))->with([
            'chartData' => json_encode($chartData),
            'chartHarga' => json_encode($chartHarga),
            'chartStock' => json_encode($chartStock),
        ]);
    }

    public function product() {
        return view('pages.product');
    }
}
