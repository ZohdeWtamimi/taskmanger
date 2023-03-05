import logo from './logo.svg';
import './App.css';
import { Route, Routes } from 'react-router-dom';
import Welcome from './pages/Welcome';
import { useEffect } from 'react';
import axios from 'axios';
import Tasks from './pages/Tasks';
import TaskEdit from './pages/TaskEdit';

function App() {
  return (
    <div className="App">
    <Routes>
    <Route path="/" element={<Welcome/>}/>
    <Route path="/task" element={<Tasks/>}/>
    <Route path="/task/:id" element={<TaskEdit/>}/>
  </Routes>  
    </div>
  );
}

export default App;
