<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Tag;
use App\Models\User;
use App\DTOs\Tag\TagDto;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use App\Services\Tag\TagService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tag\TagApiRequest;

class TagController extends Controller {

    public function __construct(protected TagService $service) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $user = User::find(auth('sanctum')->id());
        $tags = $user->tags;
        return response()->json([
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagApiRequest $request) {
        $tag = $this->service->store(TagDto::transformApiRequest($request));

        return response()->json([
            'data'    => $tag,
            'success' => true,
            'message' => 'Tag created'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagApiRequest $request, Tag $tag) {
        $tag = User::find(auth('sanctum')->id())->tags()->where('id', $tag->id)->firstOrFail();
        $tag = $this->service->update(TagDto::transformApiRequest($request), $tag);

        return response()->json([
            'data'    => $tag,
            'success' => true,
            'message' => 'Tag updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag) {
        $this->service->delete($tag);

        return response()->json([
            'data'    => null,
            'success' => true,
            'message' => 'Tag deleted'
        ], 200);
    }
}
