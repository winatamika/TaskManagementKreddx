<?php

namespace App\Http\Controllers;

use App\Tasks;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class TasksController extends Controller
{
    // Retrieve all tasks
    public function index()
    {
        $tasks = Tasks::all();
        return response()->json($tasks);
    }

    // Create a new task
    public function store(Request $request)
    {

        $task_owner = $request->task_owner; 

        $user = User::where('name', $task_owner)->first();
        $user_id = null;

        if ($user) {
            $user_id = $user->id;
            $request->merge(['task_owner' => $user_id]); 

            $dueDate = Carbon::createFromFormat('d/m/Y', $request->due_date)->format('Y-m-d');
            $request->merge(['due_date' => $dueDate]); 


            $task = Tasks::create($request->all());
            Log::channel('custom_log')->info('Task created: ' .$task->id. ' ' . $task->title);
            return response()->json($task, 201);

        }else{
            return response()->json([
                'error' => 'User not found',
                'messages' => "User not found",
            ], 422); // 422 Unprocessable Entity
        }


    }

    public function filter(Request $request){

        $query = Tasks::query();

        // Filter by status
        if ($request->has('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        // Filter by priority
        if ($request->has('priority')) {
            $priority = $request->input('priority');
            $query->where('priority', $priority);
        }

        // Filter by expiration (today or within a week)
        if ($request->has('expiring')) {
            $expiring = $request->input('expiring');

            if ($expiring === 'today') {
                $query->whereDate('due_date', today());
            } elseif ($expiring === 'week') {
                $query->whereBetween('due_date', [today(), today()->addWeek()]);
            }
        }

        // Full-text search on title or description
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%");
            });
        }

        // Retrieve the filtered tasks
        $tasks = $query->get();

        return response()->json($tasks);

    }

    // Retrieve a specific task
    public function show($id)
    {
        $task = Tasks::findOrFail($id);
        return response()->json($task);
    }

    // Update a task
    public function update(Request $request, $id)
    {
        $task = Tasks::findOrFail($id);
        $task->update($request->all());
        Log::channel('custom_log')->info('Task updated: ' .$task->id. ' ' . $task->title);
        return response()->json($task, 200);
     
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Tasks::findOrFail($id);
        $task->delete();
        Log::channel('custom_log')->info('Task deleted: ' .$task->id. ' ' . $task->title);
        return response()->json(null, 204);
    }

}
