import axios from 'axios'
import React, { Component } from "react"
import { Link, Redirect } from 'react-router-dom'
import './App.css'

class Task extends React.Component {
    constructor(props) {
      super(props)
      this.clicked1 = this.clicked1.bind(this);
      this.clicked2 = this.clicked2.bind(this);
      this.delete = this.delete.bind(this);
    }

    clicked1() {
      this.props.onStatusChange(this.props.task.id, this.props.b1);
    }

    clicked2() {
      this.props.onStatusChange(this.props.task.id, this.props.b2);
    }

    delete() {
      this.props.onDelete(this.props.task.id);
    }


    render() {
      const completeStyle = {
        fontStyle: "italic",
        color: "cdcdcd",
        textDecoration: "line-through"
      }
      return (
        
        <div className="col-xm-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
          <Link className= "btn btn-link" role="button" to={{
            pathname: `/react/tasks/${this.props.task.id}`,
            task: this.props.task, token: this.props.token, userId: this.props.userId
          }}
          > <h2 style={this.props.task.status === "Completed" ? completeStyle : null}>{this.props.task.title}  </h2> </Link>
          <p style={this.props.task.status === "Completed" ? completeStyle : null}>Description: {this.props.task.description} </p>
          <p>Status: {this.props.task.status} </p>
          <p>Due Date: {this.props.task.dueDate}</p>
          <div className="row justify-content-center">
          <button className="btn btn-outline-primary btn-sm" onClick={this.clicked1}>{this.props.b1}</button>
          <button className="btn btn-outline-primary btn-sm" onClick={this.clicked2}>{this.props.b2}</button>
          <Link
          className="btn btn-outline-primary btn-sm" role="button" to=
            {{
              pathname: `/react/tasks/edit/${this.props.task.id}`,
              token: this.props.token, task: this.props.task, userId: this.props.userId
            }}> Edit Task
            </Link>  <button className="btn btn-outline-danger btn-sm" onClick={this.delete}>Delete Task</button>
            </div>
          <hr></hr>
        </div>
      )
    }
  }

export default Task;
