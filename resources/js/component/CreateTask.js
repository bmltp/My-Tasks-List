import axios from 'axios'
import React, { Component } from "react"
import { Link, Redirect } from 'react-router-dom'
import './App.css'


class CreateTask extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            token: this.props.location.token,
            userId: this.props.location.userId
        }
    }

    onSubmit(e) {
        const task = {
            title: this.refs.title.value,
            description: this.refs.description.value,
            status: this.refs.status.value,
            dueDate: this.refs.dueDate.value,
            user_id: this.state.userId
        }

        axios({
            method: 'post',
            url: '/api/tasks',
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

    render() {
        return (
            <div className="App">
                <br></br>
                <Link className="btn btn-secondary" role="button" to='/react'> Back </Link>
                <h2> Create Task</h2>
                <form onSubmit={this.onSubmit.bind(this)}>
                    <div >
                        <label className="font-weight-bold">Title:</label>
                        <br></br>
                        <input type='text' name='title' ref="title" />
                    </div>
                    <div>
                        <label className="font-weight-bold">Description:</label>
                        <br></br>
                        <textarea style={{height:150}} name='description' ref="description" />
                    </div>
                    <div>
                        <label className="font-weight-bold">Status:</label>
                        <br></br>
                        <select name='status' ref='status'>
                            <option> </option>
                            <option>Queue</option>
                            <option>In Progress</option>
                            <option>Completed</option>
                        </select>
                    </div>
                    <div>
                        <label className="font-weight-bold">Due Date:</label>
                        <br></br>
                        <input type='date' name='dueDate' ref='dueDate' />
                    </div>
                    <br></br>
                    <input className="btn btn-primary" type='submit' value='Save Task' />
                </form>
                <br></br>
            </div>
        )
    }
}

export default CreateTask;
