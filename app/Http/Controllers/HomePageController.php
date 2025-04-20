<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    //fungsi untuk menampilkan halaman homepage 
    public function index() 
    { 
        $categories = [ 
            [ 
                'id'=> 1, 
                'name' => 'pria', 
                'slug' => 'Pakaian Pria', 
                'description' => 'Ini adalah produk pakaian pria', 
                'image' => 'https://example.com/image1.jpg', 
            ], 
            [ 
                'id'=> 2, 
                'name' => 'wanita', 
                'slug' => 'Pakaian Wanita', 
                'description' => 'Ini adalah produk pakaian wanita', 
                'image' => 'https://example.com/image2.jpg', 
            ], 
            [ 
                'id'=> 3, 
                'name' => 'anak-anak', 
                'slug' => 'Pakaian Anak-Anak', 
                'description' => 'Ini adalah produk pakaian anak-anak', 
                'image' => 'https://example.com/image3.jpg', 
            ], 
            [ 
                'id'=> 4, 
                'name' => 'aksesori', 
                'slug' => 'Aksesori', 
                'description' => 'Ini adalah produk aksesori', 
                'image' => 'https://example.com/image4.jpg', 
            ], 
            [ 
                'id'=> 5, 
                'name' => 'sepatu', 
                'slug' => 'Sepatu', 
                'description' => 'Ini adalah produk sepatu', 
                'image' => 'https://example.com/image5.jpg', 
            ] 
        ]; 
        
        return view('homepage', [ 
            'categories' => $categories, 
        ]);
        
     } 
     public function products() 
    { 
       return view('products'); 
    } 
    public function product($slug){ 
        return view('product', ['slug' => $slug]); 
    } 
  
    public function categories() 
    { 
        return view('categories'); 
    } 
  
    public function category($slug) 
    { 
        return view('web.category_by_slug', ['slug' => $slug]); 
    } 
  
    public function cart() 
    { 
        return view('web.cart'); 
    } 
    
    public function checkout() 
    { 
        return view('web.checkout'); 
    } 
 } 
