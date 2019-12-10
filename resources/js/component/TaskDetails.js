import axios from 'axios'
import React from "react"
import { Link, Redirect } from 'react-router-dom'
import './App.css'


class TaskDetails extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      token: this.props.location.token,
      id: this.props.location.task.id,
      title: this.props.location.task.title,
      description: this.props.location.task.description,
      status: this.props.location.task.status,
      dueDate: this.props.location.task.dueDate,
      userId: this.props.location.userId

    }
    this.handleDelete = this.handleDelete.bind(this);

  }

  handleDelete() {

    let taskId = this.state.id;
    axios({
      method: 'delete',
      url: `/api/tasks/${taskId}`,
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + this.state.token,
      },
      params: {
        taskId
      },
    }).then(res => {
      if (res.data.success == true) {
        this.props.history.push('/react');
      }
    }).catch(err => {
      console.log(err)
    })
  }

  render() {
    const completeStyle = {
      fontStyle: "italic",
      color: "cdcdcd",
      textDecoration: "line-through"
    }
    return (
      <div className="App">
        <br></br>
        <Link className="btn btn-secondary" role="button" to='/react'> Back </Link>

        <h3> Task details</h3>
        <hr></hr>
        <div>
          <div>
          <label className="font-weight-bold">Title:</label>
          <br></br>
          <p className="text-secondary">{this.state.title}</p>
          </div>
          <div>
          <label className="font-weight-bold">Description:</label>
          <p className="text-secondary">{this.state.description}</p>
          </div>
          <div>
          <label className="font-weight-bold">Status:</label>
          <p className="text-success">{this.state.status}</p>
          </div>
          <div>
          <label className="font-weight-bold">Due Date:</label>
          <p className="bg-light text-dark">{this.state.dueDate}</p>
          </div>
        </div>
        <div>
        <Link className="btn btn-primary btn-sm" role="button" to=
          {{
            pathname: `/react/tasks/edit/${this.state.id}`,
            token: this.state.token, task: this.props.location.task
          }}>Edit Task</Link> <button className="btn btn-danger btn-sm" onClick={this.handleDelete}>Delete Task</button>
          </div>
          <br></br>
      </div>
    )
  }
}

export default TaskDetails;
