import axios from "axios";

const getRequest = async (url) => {
    const data = await axios.get(url);
    return data;
}

const postRequest = async (url) => {
    return await axios.post(url);
}

export default {
    getRequest,
    postRequest
}
