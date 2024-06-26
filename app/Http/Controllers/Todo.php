<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Todo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$todos = DB::table('todos')->get();
        $todos = DB::table('todos')->where('status', false)->get(); // Get pending tasks
    $completedTasks = DB::table('todos')->where('status', true)->get(); // Get completed tasks

    return view('app', compact('todos', 'completedTasks'));
        
//return view('app', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the form
    $request->validate([
        'task' => 'required|max:200'
    ]);
    // store the data
    DB::table('todos')->insert([
        'task' => $request->task,
        'status' => false
    ]);

    // redirect
    return redirect('/')->with('status', 'Task added!');

    }

    /**
     * Display the specified resource.
     */

    
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the form
    $request->validate([
        'task' => 'required|max:200'
    ]);

    // update the data
    DB::table('todos')->where('id', $id)->update([
        'task' => $request->task
    ]);

    // redirect
    return redirect('/')->with('status', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     */



    public function destroy(string $id)
    {
        // delete the todo
    DB::table('todos')->where('id', $id)->delete();

    // redirect
    return redirect('/')->with('status', 'Task deleted successfully!!!');
    }

    public function complete1(string $id)
    {
        // delete the todo
    DB::table('todos')->where('id', $id)->delete();

    // redirect
    return redirect('/')->with('status', 'Task completed!!!');
    }

    public function complete(string $id)
    {
        {
        
            DB::table('todos')->where('id', $id)->update([
                'status' => true
            ]);
    
            return redirect()->back()->with('status', 'Task marked as completed successfully.');
        }
    }
}
