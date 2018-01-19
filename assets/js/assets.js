/**
 * Created by schvallinger on 19/01/2018.
 */
// ...rest of JavaScript code here
var $ = require('jquery');
require('datatables');
require('datatables/media/css/jquery.dataTables.css');
//require('bootstrap-sass');


$(document).ready(function() {
    $('#coins').DataTable(
        {
            "ajax":
                {
                    url: "/assetJS",
                    "dataSrc": ""
                },
            "info": false,
            "pageLength": 16,
            "sort": false

        }
    );
});

