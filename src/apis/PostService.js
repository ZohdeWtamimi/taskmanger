import axios from 'axios';

const API_URL = "http://localhost/mediaproject/backend/post";


class PostService {

    getPost(){
        return axios.get(`${API_URL}/read.php`);
    }

    createPost(post){
        return axios.post(`${API_URL}/create.php`, post);
    }
  

    getPostById(id){
        return axios.get(`${API_URL}/single_user.php`, 
            { params: { id: id } });
    }
    findPost(post){
        return axios.post(`${API_URL}/finduser.php`, post);

    }

    updatePost(post){
        return axios.post(`${API_URL}/update.php`, post);
   
    }
  

    deletePost(id){
        return axios.delete(`${API_URL}/delete.php`, 
                                    { params: { id: id } });
    }
}

export default new PostService()