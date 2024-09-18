<?php

namespace App\Http\Controllers\Back;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.category.index', [
            'categories' => Category::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
        ]);

        $data['slug'] = Str::slug($data['name']);
        Category::create($data);

        return back()->with('success', 'Category created successfully');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
        ]);

        $data['slug'] = Str::slug($data['name']);
        Category::find($id)->update($data);

        return back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);

        return back()->with('success', 'Category deleted successfully');
    }
}
