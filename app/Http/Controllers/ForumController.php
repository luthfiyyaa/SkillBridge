<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ForumPost;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $field = $request->input('field');

        $posts = ForumPost::when($search, function($query, $search) {
                return $query->where('title', 'like', "%$search%");
            })
            ->when($field, function($query, $field) {
                return $query->where('field', $field);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('forum.index', compact('posts'));
    }

    public function create()
    {
        return view('forum.buat-post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        ForumPost::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'field' => $request->field,
        ]);

        return redirect()->route('forum')->with('success', 'Postingan berhasil dibuat');
    }

    public function show($id)
    {
        $post = ForumPost::findOrFail($id);
        return view('forum.show', compact('post'));
    }
}
