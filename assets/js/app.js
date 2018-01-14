// assets/js/app.js
require('../css/app.scss');

// ...rest of JavaScript code here
var $ = require('jquery');
require('bootstrap-sass');

// require the JavaScript
require('bootstrap-star-rating');
// require 2 CSS files needed
require('bootstrap-star-rating/css/star-rating.css');
require('bootstrap-star-rating/themes/krajee-svg/theme.css');


// or you can include specific pieces
// require('bootstrap-sass/javascripts/bootstrap/tooltip');
// require('bootstrap-sass/javascripts/bootstrap/popover');

// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file
var greet = require('./greet');

$(document).ready(function() {
    $('body').prepend('<h1>'+greet('john')+'</h1>');
    $('[data-toggle="popover"]').popover();
});1