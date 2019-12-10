import React from 'react';
import ReactDOM from 'react-dom';
import "./App.css"
import { BrowserRouter, Link } from 'react-router-dom';
import Footer from './Footer'
import Header from './Header'
import Main from './Main';

function Example() {
    return (
        <BrowserRouter>
        <div>
            <Header />
            <Main />
            <Footer />
        </div>
        </BrowserRouter>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
