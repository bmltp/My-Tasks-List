<div class="modal fade" id="showModal">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Show Task
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <h3>
                            Title
                        </h3>
                        {{$task->title}}
                    </div>
                    <div class="form-group">
                        <h3>
                            Description
                        </h3>
                        {{$task->description}}
                    </div>

                    <div class="form-group">
                        <h3>
                            Status
                        </h3>
                        {{$task->status}}
                    </div>
                    <div class="form-group">
                        <h3>
                            Due Date
                        </h3>
                        {{$task->dueDate}}
                    </div>
                </form>
                </div>
            <div class="modal-footer">
                <a onclick="event.preventDefault();editTaskForm({{$task->id}});" href="#" class="edit open-modal btn btn-primary" data-toggle="modal" value="{{$task->id}}">Edit</a>
                <a onclick="event.preventDefault();deleteTaskForm({{$task->id}});" href="#" class="delete btn btn-warning" data-toggle="modal">Delete</a>
                <input id="task_id" name="task_id" type="hidden" value="0">
                <input class="btn btn-default" data-dismiss="modal" type="button" value="Close">
                </input>
                </input>
            </div>
        </div>
    </div>
</div>