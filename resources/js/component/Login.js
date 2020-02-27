import React, { Component } from 'react';
import { Link, Redirect } from 'react-router-dom'
import axios from 'axios'
import './App.css'


class Login extends Component {
    constructor(props) {
        super(props)
        this.state = {
            loginEmail: '',
            loginPassword: '',
            registerName: '',
            registerEmail: '',
            registerPassword: '',
            passwordConfirmation: '',
            loggedIn: false,
            errorFields: {},
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

    validateLogin(e) {
        let errors = {};
        let inputsAreValid = true;
        if (this.state.loginEmail.length < 1) {
            inputsAreValid = false;
            errors["loginEmailError"] = "Email is empty. It shoud be in the form of xyz@xyz.xyz";
        }

        if (this.state.loginEmail.length > 0){

            if ((this.state.loginEmail.indexOf("@") === -1) || (this.state.loginEmail.indexOf(".") === -1)) {
                inputsAreValid = false;
                errors["loginEmailError"] = "Email is invalid. It shoud be in the form of xyz@xyz.xyz";
            }
        }
        if (this.state.loginPassword.length < 1) {
            inputsAreValid = false;
            errors["loginPasswordError"] = "Password is empty. It should be at least 8 characters."
        }
        if (this.state.loginPassword.length > 0) {

            if (this.state.loginPassword.length < 8 ) {
                inputsAreValid = false;
                errors["loginPasswordError"] = "Password is too short. It should be at least 8 characters."
            }
        }
        this.setState({
             errorFields: errors
          });
        return inputsAreValid;
    };

    validateRegister(e) {
        let inputsAreValid = true;
        let errors = {};
        if (this.state.registerName.length < 1) {
            inputsAreValid = false;
            errors["registerNameError"] = "Name is empty. It should be at least one characters."
        }
        if ((this.state.registerEmail.length < 1)) {
            inputsAreValid = false;
            errors["registerEmailError"] = "Email is empty. It shoud be in the form of xyz@xyz.xyz";
        }
        if (this.state.registerEmail.length > 0) {
            if ((this.state.registerEmail.indexOf("@") === -1) || (this.state.registerEmail.indexOf(".") === -1)) {
                inputsAreValid = false;
                errors["registerEmailError"] = "Email is invalid. It shoud be in the form of xyz@xyz.xyz";
            }
        }
        if (this.state.registerPassword.length < 1 ) {
            inputsAreValid = false;
            errors["registerPasswordError"] = "Password is empty. It should be at least 8 characters."
        }
        if (this.state.registerPassword.length > 0) {
            if (this.state.registerPassword.length < 8) {
                inputsAreValid = false;
                errors["registerPasswordError"] = "Password is too short. It should be at least 8 characters."
            }
        }
        if (this.state.passwordConfirmation.length < 1) {
            inputsAreValid = false;
            errors["passwordConfirmtionError"] = "Password confirmation is empty. It should be same as the password entered above."
        }
        if (this.state.passwordConfirmation.length > 0) {
            if (this.state.registerPassword !== this.state.passwordConfirmation) {
                inputsAreValid = false;
                errors["passwordConfirmtionError"] = "Password confirmation not is matching. It should be same as the password entered above."
            }
        }
        this.setState({
            errorFields: errors
          });

        return inputsAreValid;
    };

    handleLogin(e) {
        e.preventDefault()
        if (this.validateLogin(e)) {
          axios.post('/api/login',
              {
                  email: this.state.loginEmail,
                  password: this.state.loginPassword
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
        } else {
          console.log("Invalid login details.")
        }
    }

    handleRegister(e) {
        e.preventDefault();
        if (this.validateRegister(e)) {
          axios.post('/api/register',
              {
                  name: this.state.registerName,
                  email: this.state.registerEmail,
                  password: this.state.registerPassword,
                  password_confirmation: this.state.passwordConfirmation
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
          } else {
            console.log("Invalid register details.")
          }
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
                        <input type="email" name='loginEmail' placeholder='xyz@xyz.xyz' value={this.state.loginEmail} onChange={this.handleChange} />
                        <div className="text-danger"> {this.state.errorFields.loginEmailError} </div>
                        <br></br>
                        <label>Password:
                        </label>
                        <br></br>
                        <input type="password" name="loginPassword" placeholder="Password" value={this.state.loginPassword} onChange={this.handleChange} />
                        <div className="text-danger">{this.state.errorFields.loginPasswordError}</div>
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
                        <input type="text" name='registerName' placeholder='name' value={this.state.registerName} onChange={this.handleChange} />
                        <div className="text-danger">{this.state.errorFields.registerNameError}</div>
                        <br></br>
                        <label >Email:</label>
                        <br></br>
                        <input type="email" name='registerEmail' placeholder='xyz@xyz.xyz' value={this.state.registerEmail} onChange={this.handleChange} />
                        <div className="text-danger">{this.state.errorFields.registerEmailError}</div>
                        <br></br>
                        <label>Password:
                        </label>
                        <br></br>
                        <input type="password" name="registerPassword" placeholder="Password" value={this.state.registerPassword} onChange={this.handleChange} />
                        <div className="text-danger">{this.state.errorFields.registerPasswordError}</div>
                        <br></br>
                        <label>Confirm Password:
                        </label>
                        <br></br>
                        <input type="password" name="passwordConfirmation" placeholder="Repeat Password" value={this.state.passwordConfirmation} onChange={this.handleChange} />
                        <div className="text-danger">{this.state.errorFields.passwordConfirmtionError}</div>
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
