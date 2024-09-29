/**
 * Created by Zura on 12/25/2021.
 */
import axios from "axios";
import store from "./store";
import router from "./router/index.js";

const axiosClient = axios.create({
  baseURL: `${import.meta.env.VITE_API_BASE_URL}/api`
})

axiosClient.interceptors.request.use(config => {
  config.headers.Authorization = `Bearer ${store.state.user.token}`
  return config;
})

axiosClient.interceptors.response.use(
  response => {
    return response;  // If the response is successful, just return it.
  }, 
  error => {
    // Check if the error has a response (server responded with a status code)
    if (error.response) {
      if (error.response.status === 401) {
        store.commit('setToken', null);
        router.push({ name: 'login' });
      }
    } else if (error.request) {
      // No response was received from the server (server might be down, client offline)
      console.error("Client could not connect to the server. Please check your internet connection or server status.");
    
    } else {
      console.error("An unknown error occurred:", error.message);
    }
    throw error;
  }
);


export default axiosClient;