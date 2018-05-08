$(function () {

    /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
    var day_data = [
        {"period": "2018-05-07", "licensed": 80, "sorned": 60},
        {"period": "2018-05-06", "licensed": 251, "sorned": 290},
        {"period": "2018-05-05", "licensed": 769, "sorned": 800},
        {"period": "2018-05-04", "licensed": 246, "sorned": 461},
        {"period": "2018-05-03", "licensed": 657, "sorned": 967},
        {"period": "2018-05-02", "licensed": 148, "sorned": 627},
        {"period": "2018-05-01", "licensed": 471, "sorned": 740},
        {"period": "2018-04-30", "licensed": 871, "sorned": 900},
        {"period": "2018-04-29", "licensed": 401, "sorned": 656},
        {"period": "2018-04-28", "licensed": 115, "sorned": 122}
    ];
//    Morris.Bar({
//        element: 'graph_bar_group',
//        data: day_data,
//        xkey: 'period',
//        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
//        ykeys: ['licensed', 'sorned'],
//        labels: ['Licensed', 'SORN'],
//        hideHover: 'auto',
//        xLabelAngle: 60
//    });

    Morris.Bar({
        element: 'graph_bar',
        data: [
            {device: '2018-05-07', ALR: 10},
            {device: '2018-05-06', ALR: 50},
            {device: '2018-05-05', ALR: 85},
            {device: '2018-05-04', ALR: 71},
            {device: '2018-05-03', ALR: 55},
            {device: '2018-05-02', ALR: 154},
            {device: '2018-05-01', ALR: 44},
            {device: '2018-04-30', ALR: 71},
            {device: '2018-04-29', ALR: 1471},
            {device: 'Other', ALR: 1371}
        ],
        xkey: 'device',
        ykeys: ['geekbench'],
        labels: ['Geekbench'],
        barRatio: 1000,
        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        xLabelAngle: 35,
        hideHover: 'auto'
    });

//    Morris.Bar({
//        element: 'graphx',
//        data: [
//            {x: '2015 Q1', y: 2, z: 3, a: 4},
//            {x: '2015 Q2', y: 3, z: 5, a: 6},
//            {x: '2015 Q3', y: 4, z: 3, a: 2},
//            {x: '2015 Q4', y: 2, z: 4, a: 5}
//        ],
//        xkey: 'x',
//        ykeys: ['y', 'z', 'a'],
//        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
//        hideHover: 'auto',
//        labels: ['Y', 'Z', 'A']
//    }).on('click', function (i, row) {
//        console.log(i, row);
//    });
//
//    Morris.Area({
//        element: 'graph_area',
//        data: [
//            {period: '2014 Q1', iphone: 2666, ipad: null, itouch: 2647},
//            {period: '2014 Q2', iphone: 2778, ipad: 2294, itouch: 2441},
//            {period: '2014 Q3', iphone: 4912, ipad: 1969, itouch: 2501},
//            {period: '2014 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
//            {period: '2015 Q1', iphone: 6810, ipad: 1914, itouch: 2293},
//            {period: '2015 Q2', iphone: 5670, ipad: 4293, itouch: 1881},
//            {period: '2015 Q3', iphone: 4820, ipad: 3795, itouch: 1588},
//            {period: '2015 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
//            {period: '2016 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
//            {period: '2016 Q2', iphone: 8432, ipad: 5713, itouch: 1791}
//        ],
//        xkey: 'period',
//        ykeys: ['iphone', 'ipad', 'itouch'],
//        lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
//        labels: ['iPhone', 'iPad', 'iPod Touch'],
//        pointSize: 2,
//        hideHover: 'auto'
//    });
//
//
//    Morris.Donut({
//        element: 'graph_donut',
//        data: [
//            {label: 'Jam', value: 25},
//            {label: 'Frosted', value: 40},
//            {label: 'Custard', value: 25},
//            {label: 'Sugar', value: 10}
//        ],
//        colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
//        formatter: function (y) {
//            return y + "%"
//        }
//    });

    new Morris.Line({
        element: 'graph_line',
        xkey: 'year',
        ykeys: ['value'],
        labels: ['Value'],
        hideHover: 'auto',
        lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        data: [
            {year: '2012', value: 20},
            {year: '2013', value: 10},
            {year: '2014', value: 5},
            {year: '2015', value: 5},
            {year: '2016', value: 20}
        ]
    });

});
