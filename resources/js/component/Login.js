import React, { Component } from 'react';
import { Link, Redirect } from 'react-router-dom'
import axios from 'axios'
import './App.css'


class Login extends Component {
    constructor(props) {
        super(props)
        this.state = {
            name: '',
            email: '',
            password: '',
            loggedIn: false,
            password_confirmation: '',
            token: null,
        }
        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(e) {
        const name = e.target.name;
        const value = e.target.value;
        this.setState({
            [name]: value
        })
    }

    handleLogin(e) {
        
        axios.post('/api/login',
            {
                email: this.state.email,
                password: this.state.password
            }).then(res => {
                if (res.data.success == true) {
                    localStorage.setItem("token", res.data.user.token);
                    this.setState({
                        token: res.data.user.token,
                        loggedIn: true
                    });
                }
            }).catch(err => {
                console.log(err)
            })
        e.preventDefault()
    }

    handleRegister(e) {
        
        axios.post('/api/register',
            {
                name: this.state.name,
                email: this.state.email,
                password: this.state.password,
                password_confirmation: this.state.password_confirmation
            }).then(res => {
                if (res.data.success == true) {
                    localStorage.setItem("token", res.data.user.token);
                    this.setState({
                        token: res.data.user.token,
                        loggedIn: true
                    });
                }
            }).catch(err => {
                console.log(err)
            })
        e.preventDefault();
    }
    render() {
        if (this.state.loggedIn) {
            return <Redirect to={{ pathname: "/react", token: 'token', loggedIn: true }} />
        }
        return (
            <div className='container'>
                <div className="row justify-content-center">
                <a className="btn btn-secondary btn-sm" role="button" href="/">Home</a>
                </div>
                <div className=" App row">
                <div className="col-sm-12 col-md-6 col-lg-6">
                <h1>Login</h1>
                <form onSubmit={this.handleLogin.bind(this)}>
                    <div className='mx-auto'>
                        <label >Email:</label>
                        <br></br>
                        <input type="email" name='email' placeholder='user@mail.com' value={this.state.email} onChange={this.handleChange} />
                        <br></br>
                        <label>Password:
                        </label>
                        <br></br>
                        <input type="password" name="password" placeholder="Password" value={this.state.password} onChange={this.handleChange} />
                    </div>
                    <br></br>
                    <input  type="submit" value="Login" />
                </form>
                <br></br>
                </div>
                <div className=" App col-sm-12 col-md-6 col-lg-6">
                <h1>Create New Account</h1>
                <form onSubmit={this.handleRegister.bind(this)}>
                    <div className='mx-auto'>
                        <label >Username:</label>
                        <br></br>
                        <input type="text" name='name' placeholder='Username' value={this.state.name} onChange={this.handleChange} />
                        <br></br>
                        <label >Email:</label>
                        <br></br>
                        <input type="text" name='email' placeholder='user@mail.com' value={this.state.email} onChange={this.handleChange} />
                        <br></br>
                        <label>Password:
                        </label>
                        <br></br>
                        <input type="password" name="password" placeholder="Password" value={this.state.password} onChange={this.handleChange} />
                        <br></br>
                        <label>Confirm Password:
                        </label>
                        <br></br>
                        <input type="password" name="password_confirmation" placeholder="Repeat Password" value={this.state.password_confirmation} onChange={this.handleChange} />
                    </div>
                    <br></br>
                    <input type="submit" value="Register" />
                </form>
                <br></br>
                </div>
                </div>
            </div>
        )
    }
}
export default Login;