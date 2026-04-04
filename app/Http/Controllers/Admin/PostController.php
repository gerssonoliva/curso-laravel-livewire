<?php

namespace App\Http\Controllers\Admin;

use App\Events\UploadImage;
use App\Http\Controllers\Controller;
use App\Jobs\ResizeImage;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware() {
        return [
            new Middleware('can:manage posts')
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $data['user_id'] = auth()->id();

        $post = Post::create($data);

        session()->flash('swal', [
            'title' => 'Post creado',
            'text' => 'El post ha sido creado exitosamente.',
            'icon' => 'success',
        ]);

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Gate::authorize('author', $post);

        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                Rule::requiredIf(function() use ($post) {
                    return !$post->published_at;
                }),
                'string',
                'max:255',
                Rule::unique('posts')
                    ->ignore($post->id)
            ],
            'image' => 'nullable|image',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt' => 'required_if:is_published,1|string',
            'content' => 'required_if:is_published,1|string',
            'tags' => 'nullable|array',
            'tags.*' => 'required|string|max:50',  
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image_path) {
                Storage::delete($post->image_path);
            }
            $extension = $request->image->extension();
            $nameFile = $post->slug . '.' .$extension;
            while (Storage::exists('posts/' . $nameFile)) {
                $nameFile = str_replace('.'. $extension, '-copia.'. $extension, $nameFile);
            }

            $data['image_path'] = Storage::putFileAs('posts', $request->image, $nameFile);

            // ResizeImage::dispatch($data['image_path']);
            UploadImage::dispatch($data['image_path']);
        }

        $post->update($data);

        $tagIds = collect($request->tags)->map(function($tagName) {
            return Tag::firstOrCreate(['name' => $tagName])->id;
        })->toArray();
        $post->tags()->sync($tagIds);

        session()->flash('swal', [
            'title' => 'Post actualizado',
            'text' => 'El post ha sido actualizado exitosamente.',
            'icon' => 'success',
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Gate::authorize('author', $post);

        if($post->image_path) {
            Storage::delete($post->image_path);
        }
        $post->delete();

        session()->flash('swal', [
            'title' => 'Post eliminado',
            'text' => 'El post ha sido eliminado exitosamente.',
            'icon' => 'success',
        ]);

        return redirect()->route('admin.posts.index');
    }
}
