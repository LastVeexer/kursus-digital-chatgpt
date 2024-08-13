// src/services/api.js

import axios from 'axios';

// Membuat instance Axios dengan base URL API Laravel
const api = axios.create({
    baseURL: 'http://localhost:8000/api',
});

export default api;
