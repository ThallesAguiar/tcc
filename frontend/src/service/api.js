import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost/mateship/backend/",
  headers: {
    "Access-Control-Allow-Origin": "*",
    "Access-Control-Allow-Methods": "GET, POST, PATCH, PUT, DELETE, OPTIONS",
    "Access-Control-Allow-Headers": "*",
  },
});

api.interceptors.request.use(async (config) => {
  console.log(config);
  const token = await localStorage.getItem("token");
  config.headers.Authorization = token ? `${token}` : "";
  return config;
});

export default api;
