import axios from 'axios';

const getHomeContent = async () => {
    try {
        const response = await axios.get('http://localhost:8000/api/home');
        return response.data;
    } catch (error) {
        console.error("Error fetching data:", error);
        return null;
    }
};

export default getHomeContent;
