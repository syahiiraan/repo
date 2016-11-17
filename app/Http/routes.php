<?php
use App\Task; //import out Task model
use Illuminate\Http\Request;

Route::get('/', function(){
	$tasks = Task::orderBy('created_at', 'asc')->get();
	//$tasks is an object
    return view('tasks.index', [
        'tasks' => $tasks
    ]);
});


Route::post('/task', function(Request $request) {
   $validator = Validator::make($request->all(),[
   		'name' => 'required|max:255',
   	]);

   if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //if there is no error, add data to db
    $task = new Task;
    //nama row db = nama dari request
    $task->name = $request->name; 
    $task->save();    

    return redirect('/');   
});

/**
 * Delete An Existing Task
 */
Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/');
});