 var arr=new Array();
 var acts=new Array(); 
 var _id=0;
 var _pay=0;

 function dochangepay(id,state)
 {
	var index;
	if(state==3)
	{
		$('#payid'+id).toggleClass('pay3');
		$('#payid'+id).toggleClass('pay0');
		if($('#payid'+id).hasClass('pay0'))	arr[1].push(id);
		else 
		{
			index = arr[1].indexOf(id);
			if (index > -1) arr[1].splice(index, 1);
		}
	}
	else if(state==1)	alert("оплачено");
	else
	{	
		$('#payid'+id).toggleClass('pay3');
		if($('#payid'+id).hasClass('pay3'))	arr[0].push(id);
		else 
		{
			index = arr[0].indexOf(id);
			if (index > -1) arr[0].splice(index, 1);
		}
	}
 }
  function doshowpay(obj)
 {
	var str=obj.href;
	var i,j;
	var id=new Array();
	for(j=0;j<2;j++)
	{
		i=str.indexOf(";");
		id[j]=str.substring(str.indexOf("=")+1,i);
		str=str.substr(i+1);
	}
	var sbstr="";
	var distr="#accountsdialog";
        if(id[1].length>0)
        {
            if(id[1]=='100')
                sbstr="Номенклатура";
            else if(id[1]=='500')
                sbstr="Отгрузки";
            else if(id[1]=='200')
            {
                sbstr="Новый платеж";
                distr="#mydialog";
            }
            else
                sbstr="Платежи";
        }
        else sbstr="Отгрузки";
	$(distr).dialog("option","title",""+sbstr+" по счету №"+id[0]); 
 }
   function dosavepay()
 {

	var i,j;
	var str=arr[0].valueOf();
	str=str+"&"+arr[1].valueOf();
	if(str.length>1) 
	{
		document.forms['date-form'].elements['checks'].value=str;
		document.forms["date-form"].submit();
	}
 }

$(document).ready(function()
 {
	arr[0]=new Array();
	arr[1]=new Array();
 });