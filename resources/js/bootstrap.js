import axios from 'axios';
window.axios = axios;

import $ from 'jquery';
window.$ = window.jQuery = $;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
