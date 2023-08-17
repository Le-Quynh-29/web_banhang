import _ from 'lodash';
import axios from 'axios';
import jquery from 'jquery';
import moment from 'moment/moment';

try {
    window._ = _;
    window.$ = window.jQuery = jquery;
    window.moment = moment;
} catch (e) {}

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
