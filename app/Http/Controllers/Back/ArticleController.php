<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $article = Article::with('Category')->latest()->get();
            return DataTables::of($article)
                // kustom kolom
                ->addColumn('category_id', function ($article) {
                    return $article->Category->name;
                })
                ->addColumn('status', function ($article) {
                    return $article->status == 0 ? '<span class="badge bg-danger"> Private </span>' : '<span class="badge bg-success"> Published </span>';
                })
                ->addColumn('action', function ($article) {
                    return '<div class="text-center">
                        <button data-id="' . $article->id . '" class="btn btn-info btn-sm" id="delete">Detail</button>
                        <button data-id="' . $article->id . '" class="btn btn-success btn-sm" id="delete">Edit</button>
                        <button data-id="' . $article->id . '" class="btn btn-danger btn-sm" id="delete">Delete</button>
                        </div>';
                })
                ->addIndexColumn()
                // panggil kustom kolom
                ->rawColumns(['category_id', 'status', 'action'])
                ->make();
        }
        return view('back.article.index', [
            'articles' => Article::with('Category')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.article.create', [
            'categories' => Category::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();
        $file = $request->file('img');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/front/', $fileName);

        $data['img'] = $fileName;
        $data['slug'] = Str::slug($data['title']);

        Article::create($data);

        return redirect(url('articles'))->with('success', 'Article created successfully');
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
