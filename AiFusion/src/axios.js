import axios from "axios"
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
axios.defaults.baseURL="http://192.168.1.204:8000"
// axios.defaults.baseURL="http://127.0.0.1:8000"
