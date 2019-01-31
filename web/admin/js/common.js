function onCheckboxAllChanged(sValue){
    if($("#idChkAll").prop('checked') == false){
        $("input[type=checkbox]:checked").each(function(){
            $(this).prop('checked',false);
        });
        sValue = "nothing";
    }
    getReportData(sValue);
}

function getReportData(sValue)
{
    // var checkedListNames = "(";
    //setting value of hidden variable         
    
    //count checked checkbox
    //var numberOfChecked = $('input:checkbox:checked').val();

    $.each($("input[type=checkbox]:checked"), function(){
        var sTitle = $(this).val();
        // sTitle = sTitle.split(" ").join('_');
        // sCategory = sCategory.concat(sTitle,"-");
        // alert(sTitle);
        $.ajax({
            url: "<?php echo getConfig('siteUrl').'/report/bargraphdata' ?>",
            method: "POST",
            data: {hidden_list_name : sTitle},
            beforeSend: function() {
                $('#loadingbar').show();
            },
            success: function(data){
                alert(data);
                // $('#loadingbar').hide();
                // var graphData = data.split('-');
                // var sSeries = JSON.parse(graphData[0]);
                // var sCategories = ("[" + graphData[1] + "]");
                // sCategories = sCategories.replace(/,(?=[^,]*$)/, '');
                // sCategories = sCategories.replace(/'/g, '"');
                // sCategories = JSON.parse(sCategories);
                // var sEspNames = ("[" +graphData[2]+ "]");
                // sEspNames = sEspNames.replace(/,(?=[^,]*$)/, '');
                // sEspNames = sEspNames.replace(/'/g, '"');
                // sEspNames = JSON.parse(sEspNames);
                // var sColor = ("[" +graphData[3]+ "]");
                // sColor = sColor.replace(/,(?=[^,]*$)/, '');
                // sColor = sColor.replace(/'/g, '"');
                // sColor = JSON.parse(sColor);
                // Highcharts.chart('container', {
                // chart: {
                //     type: 'column'
                // },
                // title: {
                //     text: ''
                // },
                // xAxis: {
                //     categories: sCategories
                // },
                // yAxis: {
                //     allowDecimals: false,
                //     min: 0,
                //     lineColor: '#FF0000',
                //     lineWidth: 1,
                //     title: {
                //         text: ''
                //     }
                // },
                // tooltip: {
                //     formatter: function () {
                //         return '<b>' + this.x + '</b><br/>' +
                //             this.series.name + ': ' + this.y + '<br/>' +
                //             'Total: ' + this.point.stackTotal;
                //     }
                // },
                // plotOptions: {
                //     column: {
                //         stacking: 'normal'
                //     }
                // },
                // series: sSeries
                // });
            },
        }); 
    });    
    // $("input[type=checkbox]:checked").each(function(){
    //     if($(this).val() != ""){
    //         checkedListNames += "'"+($(this).val())+"',";
    //     }
    // });
    // checkedListNames = checkedListNames.slice(0, -1);
    // checkedListNames += ")";
    // if(sValue == ""){
    //     $('#hidden_list_name').val(sValue);
    // }
    // else{
    //     $('#hidden_list_name').val(checkedListNames);
    // }
    
    //submitting form
    // $("#commonForm").attr("action");
   // $('#commonForm').submit();
}

//    function getReportData(sValue,sFrmAction)
//    {
//        $.ajax({
//            type: "POST",
//            url :sFrmAction,
//            data: {'list_name' : sValue},
//            success: function(data) 
//            {
//                alert(data);
//            }
//        });
//    }
