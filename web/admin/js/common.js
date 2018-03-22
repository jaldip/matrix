
//function editUser(nIdUser)
//{
//     document.getElementById('user_id').value = nIdUser;
//     document.getElementById("addedituser").submit();
//}
function uploadFileData(fileData,nImageId)
{
   document.getElementById(nImageId).value = fileData.replace("C:\\fakepath\\", "");
    //$("#addMoreButton").show();
}
function displayMarketData(sUrl,sDivId){
    $.ajax({
        url:'sUrl',
        dataType: "html",
        success: function(response){
        $("#"+sDivId).html(response);
            setTimeout(function(){displayMarketData();}, 5000);
        }
    });
}
function getPreviousDate(sPreviousDate,nColumnNumber){ 
    $('#previousDate').val(sPreviousDate);
    $('#columnNumber').val(nColumnNumber);
}
function switchServer(bSwitch)
{
    $('#switch_server').val(bSwitch);
    $("#form-switch-server").submit();
}