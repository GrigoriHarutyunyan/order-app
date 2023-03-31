const axiosInstance = require('axios').create({
    baseURL: 'http://order-app.loc/api/',
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
});


export default axiosInstance
