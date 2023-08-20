<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth('sanctum')->id());
        $tags = $user->tags;
        return response()->json([
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::find(auth('sanctum')->id());
        $tag = Tag::create([
            'user_id' => $user->id,
            'value' => $request->tag,
        ]);

        return response()->json([
            'data' => $tag,
            'success' => true,
            'message' => 'Tag created'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $tag = User::find(auth('sanctum')->id())->tags()->where('id', $tag->id)->firstOrFail();
        $tag->update(['value' => $request->tag]);

        return response()->json([
            'data' => $tag,
            'success' => true,
            'message' => 'Tag updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json([
            'data' => null,
            'success' => true,
            'message' => 'Tag deleted'
        ], 200);
    }
}
