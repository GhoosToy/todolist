<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListResource;
use Illuminate\Http\Response;
use App\models\todolist;
use App\Http\Requests\ListStoreRequest;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ListResource::collection(todolist::with('Tasks')->get());
    }// CategoryResource::collection(Category::with('Todolists')->get());

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListStoreRequest $request)
    {
        $created_list = todolist::create($request->validated());
        return new ListResource($created_list);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ListResource(todolist::with('tasks')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListStoreRequest $request, todolist $list)
    {
        $list->update($request->validated());
        return new ListResource($list);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        todolist::where('id',$id)->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
