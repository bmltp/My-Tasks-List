import axios from 'axios'
import React, { Component } from "react"
import { Link, Redirect } from 'react-router-dom'
import './App.css'
import Task from './Task';


class Tasks extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      userId: null,
      userName: null,
      tasks: [],
      button1: null,
      button2: null,
      token: localStorage.getItem("token"),
      loggedIn: false,
    };
    this.handleStatussChange = this.handleStatussChange.bind(this);
    this.handleDelete = this.handleDelete.bind(this);
  }
  componentDidMount() {
    if (this.state.token) {
      this.user();
      this.fetchTasks();
      this.setState({
        loggedIn: true
      });
  }
}

componentWillUnmount() {
  this.setState({
    userId: null,
    userName: null,
    button1: null,
    button2: null,
    loggedIn: false,
    token: null
  });
}

  shouldComponentUpdate() {
    return true
  }


  user() {
    axios({
      method: 'get',
      url: '/api/user',
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + this.state.token,
      }
    }).then(res => {
      if (res.data.id) {
        this.setState({
          userId: res.data.id,
          userName: res.data.name,
          loggedIn: true
        });
      }
    }).catch(err => {
      console.log(err)
    })
  }

  fetchTasks() {
    axios({
      method: 'get',
      url: '/api/tasks',
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + this.state.token,
      },
    }).then(res => {
      const tasks = res.data.tasks.data
      this.setState({ tasks })
    }).catch(err => {
      console.log(err)
    });
  }

  handleDelete(id) {

    axios({
      method: 'delete',
      url: '/api/tasks/' + id,
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + this.state.token,
      },
      params: {
        id
      },
    }).then(res => {
      if (res.data.success == true) {
        this.fetchTasks();
        this.setState({ state: this.state });
      }
    }).catch(err => {
      console.log(err)
    })
  }

  handleStatussChange(id, status) {
    axios({
      method: 'patch',
      url: '/api/tasks/' + id,
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + this.state.token,
      },
      params: {
        id,
        status,
      },
    }).then(res => {
      if (res.data.success == true) {
        this.fetchTasks();
        this.setState({ state: this.state });
      }
    }).catch(err => {
      console.log(err)
    })
  }

  handleLogout(e) {
    try {axios({
      method: 'get',
      url: '/api/logout',
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + this.state.token,
      }
    }).then(res => {
      if (res.data.success == true) {
        console.log('Successfully logout.')
      }
    }).catch(err => {
      console.log(err)
    })
  } catch {}
  finally {
    localStorage.removeItem("token", null);
      }
    this.setState({
      userId: null,
      userName: null,
      button1: null,
      button2: null,
      loggedIn: false,
      token: null
    });
    return <Redirect to="/react/login" />
    }

  renderTask(task, b1, b2) {

    if (task.status === "Queue") {
      b1 = "In Progress"
      b2 = "Completed"
    } else if (task.status === "In Progress") {
      b1 = "Queue"
      b2 = "Completed"
    } else if (task.status === "Completed") {
      b1 = "Queue"
      b2 = "In Progress"
    }
    return (
      <Task key={task.id} task={task} userId={this.state.userId} token={this.state.token} id={task.id} b1={b1} b2={b2} onStatusChange={this.handleStatussChange} onDelete={this.handleDelete} />
    );
  }

  render() {
    if (this.state.token == null) {
      return <Redirect to="/react/login" />
    }
    const tasklist = this.state.tasks.map(task => {
      return (
        this.renderTask(task, this.state.button1, this.state.button2)
      );
    });
    return (
      <div className='container'>
        <div className="row text-muted justify-content-center">
          <h3> Hi <strong>{this.state.userName}</strong> Your Tasks List.</h3>
        </div>
        <div className="row justify-content-center">
          <div>
              <a className="btn btn-secondary btn-sm" role="button" href="/">Home</a>
            </div>
            <div className="offset-1">
              <Link className="btn btn-success btn-sm" role="button" to=
                {{
                  pathname: `/react/tasks/create`,
                  token: this.state.token,
                  userId: this.state.userId
                }}>Create New Task</Link>
              </div>
              <div className="offset-1">
                <button className="btn btn-danger btn-sm" onClick={this.handleLogout.bind(this)}>Logout</button>
              </div>
          </div>
        <div className="row justify-content-center">
            {tasklist}        
        </div>
      </div>
    );
  }
}

export default Tasks;