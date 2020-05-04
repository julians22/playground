import 'slick-carousel/slick/slick';

// var highchart = require('highcharts');
// require('highcharts/highcharts-more')(highchart);
// require('highcharts/modules/solid-gauge')(highchart);

function carousel() {
    $("#main-carousel").slick({
        appendArrows: "#main-carousel"
    });
}

$(document).ready(function () {
    carousel();
})
