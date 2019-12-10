$(document).ready(function () {
    $("#addButton").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/ajax/ajax',
            data: {
                title: $("#addForm input[name=title]").val(),
                description: $("#addForm input[name=description]").val(),
                status: $("#addForm select[name=status]").val(),
                dueDate: $("#addForm input[name=dueDate]").val(),
            },
            dataType: 'json',
            success: function (data) {
                $('#addForm').trigger("reset");
                $("#addForm .close").click();
                window.location.reload();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                console.log(errors);
                $('#add-task-errors').html('');
                $.each(errors.messages, function (key, value) {
                    $('#add-task-errors').append('<li>' + value + '</li>');
                });
                $("#add-error-bag").show();
            }
        });
    });
    $("#editButton").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/ajax/ajax/' + $("#editForm input[name=task_id]").val(),
            data: {
                title: $("#editForm input[name=title]").val(),
                description: $("#editForm input[name=description]").val(),
                status: $("#editForm select[name=status]").val(),
                dueDate: $("#editForm input[name=dueDate]").val(),
            },
            dataType: 'json',
            success: function (data) {
                $('#editForm').trigger("reset");
                $("#editForm .close").click();
                window.location.reload();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                console.log(errors)
                $('#edit-task-errors').html('');
                $.each(errors.messages, function (key, value) {
                    $('#edit-task-errors').append('<li>' + value + '</li>');
                });
                $("#edit-error-bag").show();
            }
        });
    });
    $("#deleteButton").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: '/ajax/ajax/' + $("#deleteForm input[name=task_id]").val(),
            dataType: 'json',
            success: function (data) {
                $("#deleteForm .close").click();
                window.location.reload();
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});

function addTaskForm() {
    $(document).ready(function () {
        $("#add-error-bag").hide();
        $('#addModal').modal('show');
    });
}

function editTaskForm(task_id) {
    $.ajax({
        type: 'GET',
        url: '/ajax/ajax/' + task_id,
        success: function (data) {
            $("#edit-error-bag").hide();
            $("#editForm input[name=title]").val(data.task.title);
            $("#editForm input[name=description]").val(data.task.description);
            $("#editForm select[name=status]").val(data.task.status);
            $("#editForm input[name=dueDate]").val(data.task.dueDate);
            ``
            $("#editForm input[name=task_id]").val(data.task.id);
            $('#editModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function deleteTaskForm(task_id) {
    $.ajax({
        type: 'GET',
        url: '/ajax/ajax/' + task_id,
        success: function (data) {
            $("#deleteForm #delete-title").html("Delete Task (" + data.task.title + ")?");
            $("#deleteForm input[name=task_id]").val(data.task.id);
            $('#deleteModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });
}
