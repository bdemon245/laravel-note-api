<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Filters\v1\NoteFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\NoteResource;
use App\Http\Resources\v1\NoteCollection;
use App\Http\Requests\v1\StoreNoteRequest;
use App\Http\Requests\v1\UpdateNoteRequest;
use Illuminate\Support\Facades\Crypt;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $isAuth = auth('sanctum')->user() !== null;
        //default data if user not found
        $data = [
            'success' => false,
            'message' => 'Please login to sync notes'
        ];
        $filter = new NoteFilter();
        $queryItems = $filter->transform($request);
        if ($isAuth) {
            $notes = Note::with('tags')->where($queryItems)->where('user_id', auth('sanctum')->id())->latest();
            $data = new NoteCollection($notes->paginate()->appends($request->query()));//update data with notes if user found
        }

        return response($data);
    }


    /**
     * Display the specified resource
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        $content = null;
        $status = 200;

        if ($note->user_id === auth('sanctum')->id()) {
            $content = new NoteResource($note);
        } else {
            $content = [
                'success' => false,
                'message' => "Requested record can't be found"
            ];
            $status = 404;
        }
        return response($content, $status);
    }
    /**
     * Stores the incoming request
     */
    public function store(StoreNoteRequest $request)
    {
        $note = Note::create([
            'user_id' => auth('sanctum')->id(),
            'title' => $request->title,
            'content' => Crypt::encryptString($request->content),
        ]);
        $content = new NoteResource($note);
        return response($content, 201);
    }
    /**
     * Updates the specified record
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $content = null;
        $status = 200;
        if ($note->user_id === auth('sanctum')->id()) {
            $note->update([
                'title' => $request->title,
                'content' => Crypt::encryptString($request->content),
            ]);
            $content = [
                'success' => true,
                'message' => "Record Updated"
            ];
        } else {
            $content = [
                'success' => false,
                'message' => "Requested record can't be found"
            ];
            $status = 404;
        }
        return response($content, $status);
    }

    public function destroy(Note $note)
    {
        $content = null;
        $status = 200;

        if ($note->user_id === auth('sanctum')->id()) {
            $note->delete();
            $content = [
                'success' => true,
                'message' => "Record Deleted"
            ];
        } else {
            $content = [
                'success' => false,
                'message' => "Requested record can't be found"
            ];
            $status = 404;
        }
        return response($content, $status);
    }
}
