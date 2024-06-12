<?php

namespace App\Http\Controllers\backend;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateArticleRequest;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $article = Article::with('category')->latest()->get();

            return DataTables::of($article)
                // Custom kolom yang memiliki relasi
                ->addIndexColumn() //Mengurutkan data
                ->addColumn('category_id', function ($article) {
                    return $article->category->name;
                })
                //Custom kolom status untuk menampilkan data boolean
                ->addColumn('status', function ($article) {
                    if ($article->status == 0) {
                        return '<span class="badge bg-danger">Not-Published</span>';
                    } else {
                        return '<span class="badge bg-success">Published</span>';
                    }
                })
                ->addColumn('button', function ($article) {
                    return '<div class="justify-content-center d-flex">
                            <a href="article/' .
                        $article->id .
                        '" class="btn btn-info"><i class="bi bi-info-circle-fill"></i></a>
                            <a href="article/' .
                        $article->id .
                        '/edit" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                            <a href="#" onclick="deleteArticle(this)" data-id="' .
                        $article->id .
                        '" class="btn btn-warning"><i class="bi bi-trash3-fill"></i></a>
                    </div>';
                })
                //Panggil colom yang memiliki relasi
                ->rawColumns(['category_id', 'status', 'button'])
                ->make();
        }
        return view('backend.article.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.article.create', [
            'category' => Category::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        $file = $request->file('image'); //ambil gambar
        $filename = uniqid() . '.' . $file->getClientOriginalExtension(); //ambil ekstensi jpg, png dll
        $file->storeAs('public/backend', $filename); //disimpan di folder public dengan nama unik/acak

        $data['image'] = $filename;
        $data['slug'] = Str::slug($data['title']);

        Article::create($data);

        return redirect(url('article'))->with('success', 'Artikel Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('backend.article.show', [
            'article' => Article::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('backend.article.update', [
            'article' => Article::find($id),
            'category' => Category::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image'); //ambil gambar
            $filename = uniqid() . '.' . $file->getClientOriginalExtension(); //ambil ekstensi jpg, png dll
            $file->storeAs('public/backend', $filename); //disimpan di folder public dengan nama unik/acak

            //unlink gambar/delete image old
            Storage::delete('public/backend/' . $request->oldImg);

            $data['image'] = $filename;
        } else {
            $data['image'] = $request->oldImg;
        }
        $data['slug'] = Str::slug($data['title']);

        Article::find($id)->update($data);

        return redirect(url('article'))->with('success', 'Artikel Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Article::find($id);
        Storage::delete('public/backend/' . $data->img);
        $data->delete();

        return response()->json([
            'message' => 'Data Artikel Berhasil Dihapus',
        ]);
    }
}
