<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    //
    public function index()
    {
        $notes = Note::all();
        return view('note.index', ['notes' => $notes]);
    }

    public function create()
    {
        return view('note.create');
    }

    public function store(Request $request)
    {
        $title = $request -> get('title');
        $content = $request -> get('content');

        $note = [
            'title' => $title,
            'content' => $content
        ];
        $note = Note::create($note);
        return $note;
    }

    public function show($id)
    {
        $note = Note::find($id);
        return view('note.show',  ['note' => $note]);
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);
        return view('note.edit', ['note' => $note]);
    }

    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);
        $updateNote = $request->all();
        $note->update($updateNote);

        return view('note.show',  ['note' => $note]);
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return redirect()->action('NoteController@index');
    }
}
