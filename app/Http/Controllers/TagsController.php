<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function index()
    {
        $tags = json_encode(Tag::all()->pluck('name', 'id')->toArray());

        return view('tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        Tag::create(['name' => $request->name]);

        return response()->json([
            'success' => true,
            'data' => [
                'tags' => Tag::all()->pluck('name', 'id')->toArray()
            ],
        ]);
    }

    public function update(Request $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();

        return response()->json([
            'success' => true,
            'data' => [
                'tags' => Tag::all()->pluck('name', 'id')->toArray()
            ],
        ]);
    }
}
