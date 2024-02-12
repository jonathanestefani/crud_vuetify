import axios from "axios";
import qs from "qs";

const standard = axios.create({
  headers: {
    post: {
      "Access-Control-Allow-Origin": "*",
    },
  },
  baseURL: "http://localhost:8000/",
  timeout: 100000,
  transformResponse: [
    function (data) {
      return data;
    },
  ],
  paramsSerializer: (params) => qs.stringify(params),
});

standard.interceptors.response.use((response) => {
  if (response.data instanceof ArrayBuffer) {
    return response;
  }

  if (!(response.data.startsWith("[{") || response.data.startsWith("{"))) {
    return response;
  }

  return response;
});

export default standard;
