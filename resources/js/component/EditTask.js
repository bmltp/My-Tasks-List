import axios from 'axios'
import React from "react"
import { Link, Redirect } from 'react-router-dom'
import './App.css'


class EditTask extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      token: this.props.location.token,
      userId: this.props.location.userId,
      id: this.props.location.task.id,
      title: this.props.location.task.title,
      description: this.props.location.task.description,
      status: this.props.location.task.status,
      dueDate: this.props.location.task.dueDate,
    }
    this.handleInputChange = this.handleInputChange.bind(this);
  }

  componentDidMount() {
    window.onpopstate = this.onBackButtonEvent
  }

  shouldComponentUpdate() {
    return true
  }

  onBackButtonEvent(e) {
    e.preventDefault()
    window.location = '/react'
  }


  onSubmit(e) {
    const task = {
      title: this.state.title,
      description: this.state.description,
      status: this.state.status,
      dueDate: this.state.dueDate,
      user_id: this.state.userId
    }
    axios({
      method: 'patch',
      url: `/api/tasks/${this.state.id}`,
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + this.state.token,
      },
      data: task
    }).then(res => {
      if (res.data.success == true) {
        this.props.history.push('/react');
      }
    }).catch(err => {
      console.log(err)
    })
    e.preventDefault();
  }

  handleInputChange(e) {
    const target = e.target;
    const value = target.value;
    const name = target.name;

    this.setState({
      [name]: value
    });
  }

  render() {
    return (
      <div className="App">
        <br></br>
        <Link className="btn btn-secondary" role="button" to='/react'> Back </Link>
        <h2> Edit Task</h2>
        <form onSubmit={this.onSubmit.bind(this)}>
          <div>
            <label className="font-weight-bold">Title:</label>
            <br></br>
            <input type='text' name='title' ref="title" value={this.state.title} onChange={this.handleInputChange} />
          </div>
          <div>
            <label className="font-weight-bold">Description:</label>
            <br></br>
            <textarea name='description' style={{height:150}} ref="description" value={this.state.description} onChange={this.handleInputChange} />

          </div>
          <div>
            <label className="font-weight-bold">Status:</label>
            <br></br>
            <select name='status' ref='status' value={this.state.status} onChange={this.handleInputChange} >
              <option> </option>
              <option>Queue</option>
              <option>In Progress</option>
              <option>Completed</option>
            </select>
          </div>
          <div>
            <label className="font-weight-bold">Due Date:</label>
              <br></br>
            <input type='date' name='dueDate' ref='dueDate' value={this.state.dueDate} onChange={this.handleInputChange} />
          </div>
          <br></br>
          <input className="btn btn-primary" type='submit' value='Save Task' />
        </form>
        <br></br>
      </div>
    )
  }
}

export default EditTask;
