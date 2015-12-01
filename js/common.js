
  function doshowsm()
 {
	$("#accountsdialog").dialog("open");
 }

  function doedit(dialogname, what)
 {
        if(what)
            $("#"+dialogname).dialog("open");
        else
            $("#"+dialogname).dialog("close");
 }
 function doselect(id)
 {
    $("#PointDeliveries").dialog("close");
    document.forms['companies-form'].elements['Points_point_point_id'].value=id;
    document.forms['companies-form'].submit();
  }