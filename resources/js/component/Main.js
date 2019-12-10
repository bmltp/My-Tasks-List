import React, { Component } from 'react';
import { Switch, Route } from 'react-router-dom';
import Tasks from './Tasks';
import TaskDetails from './TaskDetails';
import CreateTask from './CreateTask';
import EditTask from './EditTask';
import Login from './Login';

const Main = () => (
    <main>
        <Switch>
            <Route exact path='/react' component={Tasks} />
            <Route exact path='/react/login' component={Login} />
            <Route exact path='/react/tasks/create' component={CreateTask} />
            <Route exact path='/react/tasks/:id' component={TaskDetails} />
            <Route exact path='/react/tasks/edit/:id'component={EditTask} />
        </Switch>
    </main>
)
export default Main;