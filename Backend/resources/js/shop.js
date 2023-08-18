import jquery from 'jquery';
import logo from '~@resources/images/logo.png';
import favicon from '~@resources/images/logo1.png';
import loader from '~@resources/images/loader.gif';
import '~js-url/url.min.js';

jquery('.logo').attr('src', logo);
jquery('#loader').attr('src', loader);
jquery('#favicon').attr('href', favicon);
