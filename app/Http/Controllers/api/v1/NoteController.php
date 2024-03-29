<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Note;
use App\DTOs\Note\NoteDto;
use Illuminate\Http\Request;
use App\Filters\v1\NoteFilter;
use App\Services\Note\NoteService;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\NoteResource;
use App\Http\Resources\v1\NoteCollection;
use App\Http\Requests\Api\Note\NoteApiRequest;

class NoteController extends Controller {
    public function __construct(protected NoteService $service) {
    }
    public function index(Request $request) {
        $filter = new NoteFilter();
        $queryItems = $filter->transform($request);
        $notes = Note::with('tags')->where($queryItems)->where('user_id', auth('sanctum')->id())->latest()->paginate(20);
        $data = new NoteCollection($notes); //update data with notes if user found

        return response()->json([
            'data'    => $data,
            'success' => true
        ]);
    }



    public function show(Note $note) {
        return response()->json([
            'data'    => new NoteResource($note),
            'success' => true
        ]);
    }
    /**
     * Stores the incoming request
     */
    public function store(NoteApiRequest $request) {
        $note = $this->service->store(NoteDto::transformApiRequest($request));

        return response()->json([
            "data"    => new NoteResource($note),
            "success" => true
        ]);
    }
    /**
     * Updates the specified record
     */
    public function update(NoteApiRequest $request, Note $note) {
        $note = $this
            ->service
            ->update(
                note: $note,
                dto: NoteDto::transformApiRequest($request)
            );
        return response()->json([
            'data'    => new NoteResource($note),
            'success' => true,
            'message' => "Record Updated"
        ]);
    }

    public function destroy(Note $note) {
        $this->service->delete($note);
        return response()->json([
            'success' => true,
            'message' => "Record Deleted"
        ]);
    }
}
