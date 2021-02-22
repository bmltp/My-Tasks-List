<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Edit Task
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="edit-error-bag">
                        <ul id="edit-task-errors">
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>
                            Title
                        </label>
                        <input class="form-control" id="title" name="title" required="" type="text">
                        </input>
                    </div>
                    <div class="form-group">
                        <label>
                            Description
                        </label>
                        <input class="form-control" id="description" name="description" required="" type="text">
                        </input>
                    </div>

                    <div class="form-group">
                        <label>
                            Status
                        </label>
                        <select class="form-control" id="status" name="status" required="" type="text">
                            <?php
                            $list = array("", "Queue", "In Progress", "Completed");
                            ?>
                            @foreach ($list as $status)
                            @if (old('status') == $status)
                            <option class="form-control" id="status" name="status" required="" type="text" value="{{old('status')}}" selected>{{old('status')}}</option>
                            @else
                            <option class="form-control" id="status" name="status" required="" type="text" value="{{$status}}">{{$status}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            Due Date
                        </label>
                        <input class="form-control" id="dueDate" type="date" value="{{old('dueDate')}}" min="<?php echo date('Y-m-d'); ?>" style="height:50px" name="dueDate">
                        </input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" id="editButton" type="button" value="add">
                        Update Task
                    </button>
 
                    <input id="task_id" name="task_id" type="hidden" value="0">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    </input>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>