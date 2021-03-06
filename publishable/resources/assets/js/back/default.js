/* jquery */
window.$ = window.jQuery = require('jquery');

/* bootstrap */
require('popper.js');
require('bootstrap');

// for supporting Object.keys not compatible in IE
require('@babel/polyfill');

/* sprintf (POedit) */
require('sprintf-js');

// Service Worker
// require('../sw/core/register-sw');

/* GSAP FOR ANIMATION */
// import {TweenMax, Power2, TimelineLite, TimelineMax, CSSRulePlugin, Circ} from 'gsap/all';

// window.TweenMax = TweenMax;
// window.Power2 = Power2;
// window.TimelineLite = TimelineLite;
// window.TimelineMax = TimelineMax;
// window.CSSRulePlugin = CSSRulePlugin;
// window.Circ = Circ;

// import LazyLoad from 'vanilla-lazyload';

//sweetAlert
import Swal from 'sweetalert2';

import tempusdominus from 'tempusdominus-bootstrap-4';

jQuery.prototype.datetimepicker = $.prototype.datetimepicker = tempusdominus;

// Support promise
// import 'promise-polyfill/src/polyfill';

/* DATATABLES */
var DataTable = require('datatables.net');
$ = jQuery = DataTable.$;

require('datatables.net-src/js/integration/dataTables.bootstrap4');

require('datatables.net-buttons')(window, $);

require('select2');
window.Dropzone = require('dropzone');
Dropzone.autoDiscover = false;

import * as moment from 'moment';

// console.log('moment', moment);
window.moment = moment;
require('tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.js')


// window.lazyLoadInstance = new LazyLoad({
//     elements_selector: "img"
//     // ... more custom settings?
// });

/* SCROLL REVEAL */
// window.ScrollReveal = require('scrollreveal').default;

//CLEAVE
// require('cleave.js/dist/cleave');

//LEAFLET
// require('leaflet');

/* OWL CAROUSEL FOR SLIDER */
// require('owl.carousel');


/* LAVALAMP FOR SWITCH */
// require('lavalamp');

/* magnify */
// require('magnify');

require('../utils/datatables/buttons.server-side');

import Helpers from '../utils/_helpers';
window.Helpers = Helpers;

require('../utils/_global');

require('./partials/_sidebar');
