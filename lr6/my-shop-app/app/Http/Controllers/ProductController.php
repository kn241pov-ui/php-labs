<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    // Відкрити сторінку з формою
    public function create()
    {
        return view('products.create');
    }

    // Зберегти дані в базу
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Зберігаємо фото в storage/app/public/products
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        \App\Models\Product::create($data);

        return redirect()->route('products.index')->with('success', 'Послугу додано успішно!');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
