/* #version=0.0.0-0#3 default 2023-05-10T00:39:17 977FD84368B950B9 */
/* #version=0.0.0-0#2 default 2023-05-10T00:20:29 11AF6E5EC5859DDF */
import axios from 'axios'

let Api = axios.create({
    baseURL: 'http://localhost:8000',
});

export default Api;