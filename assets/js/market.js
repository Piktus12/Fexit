/**
 * Created by schvallinger on 19/01/2018.
 */
// ...rest of JavaScript code here
var $ = require('jquery');
require('datatables');
require('datatables/media/css/jquery.dataTables.css');


var market = $('#market').val();

$(document).ready(function() {
    $('#bid').DataTable(
        {
            "ajax":
                {
                    url: "/marketJS/BID/"+market,
                    "dataSrc": ""
                },
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
            "ajax":
                {
                    url: "/marketJS/ASK/"+market,
                    "dataSrc": ""
                },
            "info": false,
            "sort": false,
            "searching": false,
            "pageLength": 15,
            "lengthChange": false
        }
    );
});
