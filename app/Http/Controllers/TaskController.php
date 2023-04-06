<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Menampilkan daftar resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["tasks"] = Task::orderBy("id", "asc")->paginate(5);
        return view("tasks.index", $data);
    }
    /**
     * Perlihatkan formulir untuk membuat resource baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tasks.create");
    }
    /**
     * Simpan resource yang baru dibuat di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "task_name" => "required",
            "description" => "required",
            "author" => "required",
        ]);
        $task = new Task();
        $task->task_name = $request->task_name;
        $task->description = $request->description;
        $task->author = $request->author;
        $task->save();
        return redirect()
            ->route("tasks.index")
            ->with("sukses", "Task has been created successfully.");
    }
    /**
     * View the specified resource in storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view("tasks.show", compact("task"));
    }
    /**
     * View the form to edit a specified resource in storage
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view("tasks.edit", compact("task"));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "task_name" => "required",
            "description" => "required",
            "author" => "required",
        ]);
        $task = Task::find($id);
        $task->task_name = $request->task_name;
        $task->description = $request->description;
        $task->author = $request->author;
        $task->save();
        return redirect()
            ->route("tasks.index")
            ->with("sukses", "Task Has Been updated successfully");
    }
    /**
     * Delete the specified resource in storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()
            ->route("tasks.index")
            ->with("sukses", "Task has been deleted successfully");
    }
}
