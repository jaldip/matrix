function onCheckboxAllChanged(sValue,sFrmAction){
    if($("#idChkAll").prop('checked') == false){
        $("input[type=checkbox]:checked").each(function(){
            $(this).prop('checked',false);
        });
        sValue = "nothing";
    }
    getReportData(sValue,sFrmAction);
}

function getReportData(sValue,sFrmAction)
{
    var checkedListNames = "(";
    //setting value of hidden variable         
    
    //count checked checkbox
    //var numberOfChecked = $('input:checkbox:checked').val();
    $("input[type=checkbox]:checked").each(function(){
        if($(this).val() != ""){
            checkedListNames += "'"+($(this).val())+"',";
        }
    });
    checkedListNames = checkedListNames.slice(0, -1);
    checkedListNames += ")";
    if(sValue == ""){
         $('#hidden_list_name').val(sValue);
    }
    else{
        $('#hidden_list_name').val(checkedListNames);
    }
    
    //submitting form
    $("#commonForm").attr("action",sFrmAction);
   $('#commonForm').submit();
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
