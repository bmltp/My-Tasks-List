import React from 'react'
import './App.css'


function FormattedDate(props) {
  return <h2>{props.date.toLocaleTimeString()}</h2>;
}

class Footer extends React.Component {
  constructor(props) {
    super(props);
    this.state = {date: new Date()};
  }

  componentDidMount() {
    this.timerID = setInterval(
      () => this.tick(),
      1000
    );
  }

  componentWillUnmount() {
    clearInterval(this.timerID);
  }

  tick() {
    this.setState({
      date: new Date()
    });
  }

  render() {
    return (
      <div className="App">
        <footer className="App-footer">
          <h3> Have a good day.</h3>
          <FormattedDate date={this.state.date} />
        </footer>
      </div>
    );
  }
}

export default Footer
