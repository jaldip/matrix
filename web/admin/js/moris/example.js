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
            {date: '2018-05-07', success: 00},
            {date: '2018-05-06', success: 500},
            {date: '2018-05-05', success: 850},
            {date: '2018-05-04', success: 71000},
            {date: '2018-05-03', success: 55000},
            {date: '2018-05-02', success: 1540},
            {date: '2018-05-01', success: 440},
            {date: '2018-04-30', success: 7100},
            {date: '2018-04-29', success: 14710},
            {date: '2018-04-28', success: 710},
            {date: '2018-04-27', success: 1410},
            {date: '2018-04-26', success: 14000},
            {date: '2018-04-25', success: 15710},
            {date: '2018-04-24', success: 16710},
            {date: '2018-04-23', success: 17100},
            {date: '2018-04-22', success: 1910},
            {date: '2018-04-21', success: 1310},
            {date: '2018-04-20', success: 11000},
            {date: '2018-04-19', success: 13100},
            {date: '2018-04-18', success: 17010},
            {date: '2018-04-17', success: 18010},
            {date: '2018-04-16', success: 1900},
            {date: '2018-04-15', success: 2300},
            {date: '2018-04-14', success: 21010},
            {date: '2018-04-13', success: 5010},
            {date: '2018-04-12', success: 6300},
            {date: '2018-04-11', success: 8500},
            {date: '2018-04-10', success: 12500},
            {date: '2018-04-09', success: 14610},
            {date: '2018-04-08', success: 16610},
        ],
        xkey: 'date',
        ykeys: ['success'],
        labels: ['ALR'],
        barRatio: 1000,
        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        xLabelAngle: 1000,
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
        xkey: 'date',
        ykeys: ['success'],
        labels: ['Success'],
        hideHover: 'auto',
        lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        data: [
            {date: '2018-05-07', success: 00},
            {date: '2018-05-06', success: 1500},
            {date: '2018-05-05', success: 5000},
            {date: '2018-05-04', success: 55000},
            {date: '2018-05-03', success: 2500},
            {date: '2018-05-02', success: 3000},
            {date: '2018-05-01', success: 4000},
            {date: '2018-04-30', success: 44000},
            {date: '2018-04-29', success: 45000},
            {date: '2018-04-28', success: 46000},
            {date: '2018-04-27', success: 33000},
            {date: '2018-04-26', success: 32000},
            {date: '2018-04-25', success: 1000},
            {date: '2018-04-24', success: 00},
            {date: '2018-04-23', success: 9600},
            {date: '2018-04-22', success: 16500},
            {date: '2018-04-21', success: 17500},
            {date: '2018-04-20', success: 5896},
            {date: '2018-04-19', success: 7500},
            {date: '2018-04-18', success: 7400},
            {date: '2018-04-17', success: 5200},
            {date: '2018-04-16', success: 8693},
            {date: '2018-04-15', success: 9693},
            {date: '2018-04-14', success: 10000},
            {date: '2018-04-13', success: 12000},
            {date: '2018-04-12', success: 15000},
            {date: '2018-04-11', success: 16000},
            {date: '2018-04-10', success: 17000},
            {date: '2018-04-09', success: 18000},
            {date: '2018-04-08', success: 22000},
            {date: '2018-04-07', success: 00},
        ]
    });

});
