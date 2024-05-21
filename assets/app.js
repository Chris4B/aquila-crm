import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';


// import 'bootstrap';

const $ = require('jquery');
require ('bootstrap');
$(function() {
    $('[data-toggle="popover"]').popover();
});



//js files

import './js/hyper-config';
import './js/hyper-layout';
import './js/hyper-main';
import './js/hyper-syntax';



//js for ui

import './js/ui/component.chat';
import './js/ui/component.dragula';
import './js/ui/component.fileupload';
import './js/ui/component.range-slider';
import './js/ui/component.rating';
import './js/ui/component.scrollbar';
import './js/ui/component.todo';

// js for pages
// import './js/pages/demo.apex-area';
// import './js/pages/demo.apex-bar';
// import './js/pages/demo.apex-boxplot';
// import './js/pages/demo.apex-bubble';
// import './js/pages/demo.apex-candlestick';
// import './js/pages/demo.apex-column';
// import './js/pages/demo.apex-heatmap';
// import './js/pages/demo.apex-line';
// import './js/pages/demo.apex-mixed';
// import './js/pages/demo.apex-pie';
// import './js/pages/demo.apex-polar-area';
// import './js/pages/demo.apex-radar';
// import './js/pages/demo.apex-radialbar';
// import './js/pages/demo.apex-scatter';
// import './js/pages/demo.apex-sparklines';
// import './js/pages/demo.apex-timeline';
// import './js/pages/demo.apex-treemap';
// import './js/pages/demo.britechart';
// import './js/pages/demo.calendar';
// import './js/pages/demo.chartjs-area';
// import './js/pages/demo.chartjs-bar';
// import './js/pages/demo.chartjs-line';
// import './js/pages/demo.chartjs-other';
// import './js/pages/demo.crm-dashboard';
// import './js/pages/demo.crm-management';
// import './js/pages/demo.crm-project';
// import './js/pages/demo.customers';
// import './js/pages/demo.dashboard';
// import './js/pages/demo.dashboard-analytics';
// import './js/pages/demo.dashboard-projects';
// import './js/pages/demo.dashboard-wallet';
// import './js/pages/demo.dashboard-wallet';
// import './js/pages/demo.datatable-init';
import './js/pages/demo.form-wizard';
import './js/pages/custom-js';
// import './js/pages/demo.google-maps';
// import './js/pages/demo.inbox';
// import './js/pages/demo.jstree';
// import './js/pages/demo.materialdesignicons';
// import './js/pages/demo.products';
// import './js/pages/demo.profile';
// import './js/pages/demo.project-detail';
// import './js/pages/demo.project-gantt';
// import './js/pages/demo.quilljs';
// import './js/pages/demo.remixicons';
// import './js/pages/demo.sellers';
// import './js/pages/demo.simplemde';
// import './js/pages/demo.sparkline';
// import './js/pages/demo.tasks';
// import './js/pages/demo.timepicker';
// import './js/pages/demo.toastr';
// import './js/pages/demo.typehead';
// import './js/pages/demo.vector-maps';
// import './js/pages/demo.widgets';

