<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css"
    integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!------ Include the above in your HEAD tag ---------->



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('To Do App') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">

                            @if (count($Todos) > 0)
                                <div class="col-md-12">
                                    <h4>All ToDos</h4>
                                    <button type="button" class="btn btn-info float-right mx-2 my-2"><a
                                            href="{{ route('todos.create') }}" style="text-decoration: none"> <b> Add
                                                New To
                                                Do</b></a></button>

                                    <div class="table-responsive">


                                        <table id="mytable" class="table table-bordred table-striped">

                                            <thead>

                                                <th><input type="checkbox" id="checkall" /></th>
                                                <th>No=>id</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>status</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </thead>
                                            <tbody class="row_position">
                                                @foreach ($Todos as $todo)
                                                    <tr id="<?php echo $todo->id; ?>">

                                                        <td><input type="checkbox" class="checkthis" />
                                                        </td>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $todo->title }}</td>
                                                        <td>{{ \Illuminate\Support\Str::limit($todo->description, 20) }}
                                                        </td>
                                                        <td>
                                                            @if ($todo->status == 1)
                                                                <span class="badge badge-success">Completed</span>
                                                            @else
                                                                <span class="badge badge-danger">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <p data-placement="top" data-toggle="tooltip"
                                                                title="view">
                                                                <a href="{{ route('todos.show', $todo->id) }}">
                                                                    <button class="btn btn-success btn-xs"
                                                                        data-title="Edit" data-toggle="modal"
                                                                        data-target="#view"><img
                                                                            src="{{ asset('images/eye.svg') }}"
                                                                            alt="" srcset=""></button></a>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p data-placement="top" data-toggle="tooltip"
                                                                title="Edit">
                                                                <button class="btn btn-primary btn-xs editbtn"
                                                                    data-title="Edit" data-toggle="modal"
                                                                    data-target="#edit" value="{{ $todo->id }}"><img
                                                                        src="{{ asset('images/edit.svg') }}"
                                                                        alt="" srcset=""></button>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p data-placement="top" data-toggle="tooltip"
                                                                title="Delete">
                                                                <button class="btn btn-danger btn-xs"
                                                                    data-title="Delete" data-toggle="modal"
                                                                    data-target="#delete"><img
                                                                        src="{{ asset('images/trash-2.svg') }}"
                                                                        alt="" srcset=""></button>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>

                                        <div class="d-flex">
                                            {!! $Todos->links() !!}
                                        </div>


                                    </div>
                                @else
                                    <h4>No Todos To display</h4>
                            @endif
                        </div>
                    </div>

                    <!--Edit  Modal-->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="edit"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                    <h4 class="modal-title custom_align" id="Heading">Edit Your To Do Detail</h4>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ url('update-todo') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="todo_id" name="todo_id">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input class="form-control " type="text" name="e_title" id="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="Description">Description</label>
                                            <textarea rows="2" class="form-control" name="e_description" id="description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-select" name="e_status" id="status"
                                                aria-label="Default select example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">Completed</option>
                                                <option value="0">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer ">
                                        <button type="submit" class="btn btn-warning btn-lg"
                                            style="width: 100%;"><span
                                                class="glyphicon glyphicon-ok-sign"></span> Update</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>



                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true"><span class="glyphicon glyphicon-remove"
                                            aria-hidden="true"></span></button>
                                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                                </div>
                                <form action="{{ route('todos.delete') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                    <div class="modal-body">

                                        <div class="alert alert-danger"><span><img
                                                    src="{{ asset('images/alert-triangle.svg') }}" alt=""
                                                    srcset=""></span> Are you sure you want to
                                            delete this Record?</div>

                                    </div>
                                    <div class="modal-footer ">
                                        <button type="submit" class="btn btn-success"><span
                                                class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                                class="glyphicon glyphicon-remove"></span> No</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    $(".row_position").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $(".row_position>tr").each(function() {
                selectedData.push($(this).attr("id"));
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.editbtn', function() {
            var todo_id = $(this).val();
            // alert(todo_id);
            $('#editModal').modal('show');

            $.ajax({
                type: "GET",
                url: "/update-todo/" + todo_id,
                success: function(response) {
                    // console.log(todo_id);
                    $('#title').val(response.todo.title);
                    $('#description').val(response.todo.description);
                    $('#status').val(response.todo.status);
                    $('#todo_id').val(todo_id);


                }
            });
        });
    });
</script>
