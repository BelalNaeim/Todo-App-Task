<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTodoRequest;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller {
    //

    public function index() {
        $Todos = Todo::select( 'id', 'title', 'description', 'status' )->where( 'user_id', '=', Auth::user()->id )->latest()->paginate( 5 );

        return view( 'todos.index', compact( 'Todos' ) );
    }

    public function create() {
        return view( 'todos.create' );
    }

    public function store( CreateTodoRequest $request ) {
        // return $request->all();

        Todo::create( [
            'title'=>$request->post( 'title' ),
            'description'=>$request->post( 'description' ),
            'status'=>0,
            'user_id'=>Auth::user()->id,
        ] );
        toastr()->success( 'Todo Craeted Successfully!' );
        return to_route( 'todos.index' );

    }

    public function show( $id ) {
        $todo = Todo::with( 'user' )->find( $id );
        if ( !$todo ) {
            return to_route( 'todos.index' );
            toastr()->error( 'An error has occurred please try again later.' );
        }
        return view( 'todos.show', compact( 'todo' ) );
    }

    public function edit( $id ) {
        $todo = Todo::find( $id );
        return response()->json( [
            'status'=>200,
            'todo'=>$todo
        ] );
    }

    public function update( CreateTodoRequest $request ) {
        $todo_id = $request->input( 'todo_id' );
        $todo = Todo::find( $todo_id );
        $todo->title = $request->input( 'e_title' );
        $todo->description = $request->input( 'e_description' );
        $todo->status = $request->input( 'e_status' );
        // dd( $request );
        $todo->update();
        toastr()->success( 'Todo Updated Successfully!' );
        return redirect()->back();

    }

    public function destory( Request $request ) {
        $id = $request->todo_id;

        $todo = Todo::find( $id );

        $todo->delete();

        toastr()->success( 'Todo details has been successfully deleted!' );
        return redirect()->back();

    }

}
