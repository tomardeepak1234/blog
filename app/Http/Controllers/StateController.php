<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    // Show Form + List
    public function index()
    {
        $states = State::latest()->get();

        return view('state_master.index', compact('states'));
    }

    // Store State
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:states,name|max:255',
        ]);

        State::create([
            'name' => $request->name,
        ]);

        return redirect()->route('states.index')
                         ->with('success', 'State created successfully!');
    }

    // Edit State
    public function edit($id)
    {
        $editState = State::findOrFail($id); 
        $states = State::latest()->get();

        return view('state_master.index', compact('editState', 'states'));
    }

    public function update(Request $request, $id)
    {
        $editState = State::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:states,name,' . $id . '|max:255',
        ]);

        $editState->update([
            'name' => $request->name,
        ]);

        return redirect()->route('states.index')
                         ->with('success', 'State updated successfully!');
    }

    // Delete State
    public function destroy($id)
    {
        $state = State::findOrFail($id);
        $state->delete();

        return redirect()->route('states.index')
                         ->with('success', 'State deleted successfully!');
    }
}