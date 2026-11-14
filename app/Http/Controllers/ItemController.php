<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::orderBy('name', 'asc')->get();
        return view('admin.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('cat_name', 'asc')->get();
        return view('admin.item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'required|boolean',
        ],
        [
            'name.required' => 'Nama menu harus diisi.',
            'name.string' => 'Nama menu harus berupa teks.',
            'name.max' => 'Nama menu tidak boleh lebih dari 255 karakter.',
            'description.string' => 'Deskripsi menu harus berupa teks.',
            'price.required' => 'Harga menu harus diisi.',
            'price.numeric' => 'Harga menu harus berupa angka.',
            'price.min' => 'Harga menu tidak boleh kurang dari 0.',
            'category_id.required' => 'Kategori menu harus dipilih.',
            'category_id.exists' => 'Kategori menu yang dipilih tidak valid.',
            'img.image' => 'File yang diunggah harus berupa gambar.',
            'img.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
            'img.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'is_active.required' => 'Status aktif menu harus dipilih.',
            'is_active.boolean' => 'Status aktif menu harus berupa nilai boolean (true/false).',
        ]
        );

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = date('Ymd_His') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img_item_upload'), $imageName);
            $validatedData['img'] = $imageName;
        }

       $item = Item::create($validatedData);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::orderBy('cat_name', 'asc')->get();
        return view('admin.item.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'required|boolean',
        ]);

       if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = date('Ymd_His') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img_item_upload'), $imageName);
            $validatedData['img'] = $imageName;
        }

        $item->name = $validatedData['name'];
        $item->update($validatedData);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function updateStatus($id)
    {
        $item = Item::findOrFail($id);
        $item->is_active = !$item->is_active; // Toggle the status
        $item->save();

        return redirect()->route('items.index')->with('success', "Item status updated " . ($item->is_active ? 'to Active' : 'to Inactive') . " successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
