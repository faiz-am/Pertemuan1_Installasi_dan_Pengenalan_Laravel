<?php

namespace App\Http\Controllers;
<<<<<<< HEAD

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
=======
use Illuminate\Http\Request;
use App\Models\Categories;
>>>>>>> 9d1354ce109fd530f117504662a9eb181b2dfa78

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
<<<<<<< HEAD
        // Mendapatkan query pencarian
        $q = $request->get('q', ''); // Menangani parameter pencarian dengan default kosong

        // Mencari produk berdasarkan nama dan deskripsi jika ada pencarian
        $products = Product::when($q, function ($query, $q) {
            return $query->where('name', 'like', "%{$q}%")
                         ->orWhere('description', 'like', "%{$q}%");
        })->paginate(10); // Menampilkan hasil produk dengan pagination
        
        return view('dashboard.products.index', compact('products', 'q'));
=======
        $categories = Categories::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%')
                      ->orWhere('description', 'like', '%' . $request->q . '%');
            })
            ->paginate(10);

        return view('dashboard.categories.index', [
            'categories' => $categories,
            'q' => $request->q
        ]);
>>>>>>> 9d1354ce109fd530f117504662a9eb181b2dfa78
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        $categories = Categories::all();
        return view('dashboard.products.create', compact('categories')); 
=======
        return view('dashboard.categories.create');
>>>>>>> 9d1354ce109fd530f117504662a9eb181b2dfa78
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        // Validasi input produk
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validasi gambar upload
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(
                [
                    'errors' => $validator->errors(),
                    'errorMessage' => 'Validasi Error, Silahkan lengkapi data terlebih dahulu'
=======
        /**
         * cek validasi input
         */
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',
            'sku' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'required|exists:product_categories,id',
            'image_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        /**
         * jika validasi gagal,
         * maka redirect kembali dengan pesan error
         */
        if ($validator->fails()) {
            return redirect()->back()->with(
                [
                    'errors'=>$validator->errors(),
                    'errorMessage'=>'Validasi Error, Silahkan lengkapi data terlebih dahulu'
>>>>>>> 9d1354ce109fd530f117504662a9eb181b2dfa78
                ]
            );
        }

<<<<<<< HEAD
        $product = new Product;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->product_category_id = $request->product_category_id;
        $product->is_active = $request->has('is_active') ? $request->is_active : true;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/products', $imageName, 'public');
            $product->image_url = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with(
            [
                'success' => 'Produk berhasil ditambahkan.'
            ]
        );
=======
        $category = new Categories;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->sku = $request->sku;
        $category->price = $request->price;
        $category->stock = $request->stock;
        $category->product_category_id = $request->product_category_id;
        $category->image_url = $request->image_url;
        $category->is_active = $request->is_active;

        $category->save();

        return redirect()->back()
            ->with(
                [
                    'successMessage'=>'Data Berhasil Disimpan'
                ]
            );
>>>>>>> 9d1354ce109fd530f117504662a9eb181b2dfa78
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
<<<<<<< HEAD
        //
=======
        $category = Categories::find($id);
>>>>>>> 9d1354ce109fd530f117504662a9eb181b2dfa78
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
<<<<<<< HEAD
        $product = Product::findOrFail($id);
        $categories = Categories::all();

        return view('dashboard.products.edit', compact('product', 'categories'));
=======
        $category = Categories::find($id);

        return view('dashboard.categories.edit',[
            'category'=>$category
        ]);
>>>>>>> 9d1354ce109fd530f117504662a9eb181b2dfa78
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
<<<<<<< HEAD
        $product = Product::findOrFail($id);

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(
                [
                    'errors' => $validator->errors(),
                    'errorMessage' => 'Validasi Error, Silahkan lengkapi data terlebih dahulu'
=======
        /**
         * cek validasi input
         */
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',
            'sku' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'required|exists:product_categories,id',
            'image_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        /**
         * jika validasi gagal,
         * maka redirect kembali dengan pesan error
         */
        if ($validator->fails()) {
            return redirect()->back()->with(
                [
                    'errors'=>$validator->errors(),
                    'errorMessage'=>'Validasi Error, Silahkan lengkapi data terlebih dahulu'
>>>>>>> 9d1354ce109fd530f117504662a9eb181b2dfa78
                ]
            );
        }

<<<<<<< HEAD
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->sku = $request->sku;
        $product->product_category_id = $request->product_category_id;
        $product->is_active = $request->has('is_active') ? $request->is_active : true;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/products', $imageName, 'public');
            $product->image_url = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')
            ->with(
                [
                    'successMessage' => 'Data Berhasil Diupdate'
=======
        $category = Categories::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->sku = $request->sku;
        $category->price = $request->price;
        $category->stock = $request->stock;
        $category->product_category_id = $request->product_category_id;
        $category->image_url = $request->image_url;
        $category->is_active = $request->is_active ?? true;

        $category->save();

        return redirect()->back()
            ->with(
                [
                    'successMessage'=>'Data Berhasil Disimpan'
>>>>>>> 9d1354ce109fd530f117504662a9eb181b2dfa78
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
<<<<<<< HEAD
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index')
            ->with('successMessage', 'Data Berhasil Dihapus');
    }
}
=======
        $category = Categories::find($id);

        $category->delete();

        return redirect()->back()
            ->with(
                [
                    'successMessage'=>'Data Berhasil Dihapus'
                ]
            );
    }
}
>>>>>>> 9d1354ce109fd530f117504662a9eb181b2dfa78
