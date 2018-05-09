
function getReportData(sValue,sFrmAction)
{
    //setting value of hidden variable         
    $('#hidden_list_name').val(sValue);
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