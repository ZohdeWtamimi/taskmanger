import axios from 'axios';

const USER_API_URL = "http://localhost/mediaproject/backend/groupcrud";

class GroupService {
   
    getSingleGroup(group){
        return axios.post(`http://localhost/mediaproject/backend/group/index.php`, group);
    }
    createGroup(group){
        return axios.post(`${USER_API_URL}/create.php`, group);
    }
    
    updateGroup(group){
        return axios.post(`${USER_API_URL}/update.php`, group);
    }

}

export default new GroupService()