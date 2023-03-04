import axios from 'axios';
import React, { useEffect, useState } from 'react'

function Tasks() {
    const [data , setdata] = useState({
        name:"",
        category : "",
        priority : "",
        completed :""
    });
    const [filter, setFilter] = useState({
        user_id : JSON.parse(localStorage.getItem("user")).id,
        status: '',
        categoryName: ''
    })
    const [category , setcategory] = useState([]);
    const [tasks , setTasks] = useState([]);
    const id = JSON.parse(localStorage.getItem("user")).id
    console.log(JSON.parse(localStorage.getItem("user")).id)
    useEffect(()=>{
        axios.get("http://localhost/taskmanger/backend/category/read.php").then(res=>{
            // console.log(res);
            setcategory(res.data)
        });
        axios.post("http://localhost/taskmanger/backend/task/read.php", filter).then(res=>{
            console.log(res);
            setTasks(res.data)
        });
    },[])
    const handleFilterChange = (e)=>{
        setFilter(prev=>({...prev,[e.target.name]:e.target.value}))
    }
    const handleClick = ()=>{
        console.log(filter)
        axios.post("http://localhost/taskmanger/backend/task/read.php", filter).then(res=>{
            console.log(res);
            setTasks(res.data)
        });
    }
    console.log(filter)
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
        
        formData.append('name', data.name)
        formData.append('user_id', JSON.parse(localStorage.getItem("user")).id)
        console.log(formData.get('name'))
        console.log(formData.get('category'))
        console.log(formData.get('priority'))
        console.log(formData.get('completed'))
        console.log(data);
    
        axios.post("http://localhost/taskmanger/backend/task/create.php",formData).then(res=>{
        console.log(res);
        axios.post("http://localhost/taskmanger/backend/task/read.php", filter).then(res=>{
            console.log(res);
            setTasks(res.data)
        });
        setdata({
            name:"",
            category : "",
            priority : "",
            completed :""
        })
      });
      }
  return (
    <div>
            <h1>create new task</h1>
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

        {/* filter */}
        <div className="container">
            <div className="row">
                <div className="mb-3 col">
                    <label htmlFor="pet-select">Choose a States:</label>
                    <select className="form-select"  onChange={handleFilterChange} name="status" id="pet-select">
                        <option value="completed">completed</option>
                        <option value="incomplete">incomplete</option>
                        
                    </select>
                </div>
                <div className="mb-3 col">
                    <label htmlFor="pet-select">filter a Category:</label>
                    <select className="form-select"  onChange={handleFilterChange} name="categoryName" id="pet-select">
                        
                        {category.map((e) => (<option key={e.id} value={e.id}>{e.name}</option>))}
                    </select>
                </div>
            </div>
        </div>
        <div className="show" style={{border: '1px solid'}}>
            
            {filter.categoryName && <div>filter base on category </div>}
            {filter.status && <div>filter base on status </div>}
            <button className='btn btn-dark' onClick={handleClick}>filter</button>
        </div>
        {/* end filter */}

            <h2>Incomplete tasks</h2>
        <table className="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">completed</th>
                <th scope="col">priority</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                {tasks && tasks.map((e, i) =>(
                    <tr className={e.priority == 'high' ? "table-danger" : e.priority == 'medium'  ? "table-warning" : ''} key={e.id}>
                    <th scope="row">{i + 1}</th>
                    <td>{e.name}</td>
                    <td>{e.completed}</td>
                    <td>{e.priority}</td>
                    <td> <button>edit</button> <button>delete</button> </td>
                </tr>
                ))}
            </tbody>
        </table>
    </div>
)
}

export default Tasks