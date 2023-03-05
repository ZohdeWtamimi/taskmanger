import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { useNavigate, useParams } from 'react-router-dom';

function TaskEdit() {
    const param = useParams()
    const navigate = useNavigate()
    const [data , setdata] = useState({
        name:"",
        category : "",
        priority : "",
        completed :""
    });
    console.log(param)
    const [category , setcategory] = useState([]);
    const [tasks , setTasks] = useState([]);
    useEffect(()=>{
        axios.get("http://localhost/taskmanger/backend/category/read.php").then(res=>{
            console.log(res);
            setcategory(res.data)
        });
        // axios.post("http://localhost/taskmanger/backend/task/read.php", ).then(res=>{
        //     console.log(res);
        //     setTasks(res.data)
        // });
    },[])
    const handleChange = (e) => {
        setdata(prev=>({...prev,[e.target.name]:e.target.value}))
      }
    //   console.log(data)
      const handleSubmit =  (e) =>{
        e.preventDefault();
        const formData = new FormData()
        if(data.category===""){
            formData.append('category',1)
        }else{
            formData.append('category', data.category)
        }
        if(data.priority===""){
            formData.append('priority',"low")
        }else{
            formData.append('priority', data.priority)
        }
        if(data.completed===""){
            formData.append('completed','incomplete')
        }else{
            formData.append('completed', data.completed)
        }
        
        formData.append('id', param.id)
        formData.append('name', data.name)
        formData.append('user_id', JSON.parse(localStorage.getItem("user")).id)
        console.log(formData.get('id'))
        console.log(formData.get('name'))
        console.log(formData.get('category'))
        console.log(formData.get('priority'))
        console.log(formData.get('completed'))
        console.log(data);
    
        axios.post("http://localhost/taskmanger/backend/task/update.php",formData).then(res=>{
        console.log(res);
        setdata({
            name:"",
            category : "",
            priority : "",
            completed :""
        })
        navigate('/task')
      });
      }
  return (
    <div>
            <h1>edit task</h1>
        <form onSubmit={handleSubmit} style={ {width:'400px', margin: '0 auto'}}>
        <div className="mb-3">
            <label htmlFor="exampleInputEmail1" className="form-label">Name</label>
            <input onChange={handleChange} value={data.name} name="name" type="text" className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"/>
        </div>
        <div className="mb-3">
            <label htmlFor="pet-select">Choose a Category:</label>
            <select className="form-select"  onChange={handleChange} name="category" id="pet-select">
                
                {category.map((e) => (<option key={e.id} value={e.id}>{e.name}</option>))}
            </select>
        </div>
        <div className="mb-3">
            <label htmlFor="pet-select">Choose a Priority:</label>
            <select className="form-select"  onChange={handleChange} name="priority" id="pet-select">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
        <div className="mb-3">
            <label htmlFor="pet-select">Choose a States:</label>
            <select className="form-select"  onChange={handleChange} name="completed" id="pet-select">
                <option value="completed">completed</option>
                <option value="incomplete">incomplete</option>
                
            </select>
        </div>
            <button  type="submit" className="btn btn-primary">Submit</button>
        </form>
    </div>
  )
}

export default TaskEdit