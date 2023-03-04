import axios from 'axios';
import React, { useState } from 'react'
import { Button, Form } from 'react-bootstrap'
import UserService from '../apis/UserService';




function Welcome() {
    const [data , setdata] = useState({
        name:"",
        email : "",
        password : "",
    });
    const handleChange = (e) => {
        setdata(prev=>({...prev,[e.target.name]:e.target.value}))
      }
      console.log(data)
      const handleSubmit =  (e) =>{
        e.preventDefault();
    
        axios.post("http://localhost/taskmanger/backend/user/create.php",data).then(res=>{
        console.log(res);
        localStorage.setItem("user",JSON.stringify(res.data))
      });
      }
  return (
    <form onSubmit={handleSubmit}>
    <div className="mb-3">
      <label htmlFor="exampleInputEmail1" className="form-label">Name</label>
      <input onChange={handleChange} value={data.name} name="name" type="text" className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"/>
    </div>
    <div className="mb-3">
      <label htmlFor="exampleInputEmail1" className="form-label">Email address</label>
      <input onChange={handleChange} value={data.email} name="email" type="email" className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"/>
    </div>
    <div className="mb-3">
      <label htmlFor="exampleInputPassword1" className="form-label">Password</label>
      <input onChange={handleChange} value={data.password} name= "password" type="password" className="form-control" id="exampleInputPassword1"/>
    </div>
    <button  type="submit" className="btn btn-primary">Submit</button>
  </form>
  )
}

export default Welcome