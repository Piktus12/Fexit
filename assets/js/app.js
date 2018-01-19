// assets/js/app.js
require('../css/app.scss');

// ...rest of JavaScript code here
var $ = require('jquery');
require('datatables');
require('datatables/media/css/jquery.dataTables.css');
//require('bootstrap-sass');

// require the JavaScript
//require('bootstrap-star-rating');
// require 2 CSS files needed
//require('bootstrap-star-rating/css/star-rating.css');
//require('bootstrap-star-rating/themes/krajee-svg/theme.css');

require('canvasjs/src/charts/candlestick');


// or you can include specific pieces
// require('bootstrap-sass/javascripts/bootstrap/tooltip');
// require('bootstrap-sass/javascripts/bootstrap/popover');

// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file


$(document).ready(function() {
    $('#bid').DataTable(
        {
            "info": false,
            "sort": false,
            "searching": false,
            "pageLength": 15,
            "lengthChange": false
        }
    );
});

$(document).ready(function() {
    $('#ask').DataTable(
        {
            "info": false,
            "sort": false,
            "searching": false,
            "pageLength": 15,
            "lengthChange": false
        }
    );
});

