<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\task;
use App\Http\Resources\TaskResource;
use App\Http\Requests\TaskStoreRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $created_task = task::create($request->validated());
        return new TaskResource($created_task);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new TaskResource(task::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStoreRequest $request, ttask $task)
    {
        $task->update($request->validated());
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        task::where('id',$id)->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
