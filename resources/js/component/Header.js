import React from 'react'
import './App.css'

function Header() {
  const date = new Date()
  const hours = date.getHours()
  let timeOfDay
  const styles = {
    fontSize:30
  }
  if (hours<12) {
    timeOfDay = "Good Morning!!!"
    styles.color = "#04756F"
  } else if (hours >= 12 && hours < 17) {
    timeOfDay = "Good Afternoon!!!"
    styles.color = "#2E0927"
  } else if (hours >= 17 && hours < 19) {
    timeOfDay = "Good Evening!!!"
    styles.color = "#2E0927"
  } else {
    timeOfDay = "Good Night!!!"
    styles.color = "#D90000"
  }
  return (
    <div className='App'>
      <header className="App-header">
        <div>
          <h3 style={styles}>{timeOfDay}</h3>
          <h4>Welcome to productive and happy life.</h4>
        </div>
    </header>
    </div>
);
}

export default Header
