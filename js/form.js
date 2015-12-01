  var acts=new Array(); 
  var nametoset='';
  var idtoset='';
  var objtoset;
var dialogname='';

	function doch()
{
	var str=$("#FileForm_image").val();
	var n = str.lastIndexOf("\\");
	if (n<0) n = str.lastIndexOf("/");
	if (!(n<0)) str= str.substr(n+1);
	$("#Exp_link").val(str);
}
	function dochi()
{
	var str=$("#FileForm_image").val();
	var n = str.lastIndexOf("\\");
	if (n<0) n = str.lastIndexOf("/");
	if (!(n<0)) str= str.substr(n+1);
	$("#Inc_link").val(str);
}

  function showdialog(act,obj)
 { 
  	if(acts[act]==undefined) return;
	dialogname=acts[act]['dialog_name'];
        objtoset=$(obj).parent().parent();
	$("#"+dialogname).dialog("option","title",acts[act]['dialog_title']+": стр."+$(objtoset).children('td').eq(0).html()); 
	$("#"+dialogname).dialog("open");

   }  
   function setinv(obj)
   {
     tr=$(obj).parent().parent();
    str=$(tr).children('td').eq(7).text()+" - ";
    str+=$(tr).children('td').eq(6).text()+" - ";
   str+=$(tr).children('td').eq(3).text()+" - ";
   str+=$(tr).children('td').eq(4).text();
  
   stri=$(tr).children('td').eq(1).text()+" - ";
    stri+=$(tr).children('td').eq(2).text()+" - ";
   stri+=$(tr).children('td').eq(5).text();
   
    $(objtoset).children('td').eq(9).html(str);
    $(objtoset).children('td').eq(10).html($(tr).children('td').eq(0).text());
   $(objtoset).children('td').eq(11).html(stri);
    $(objtoset).children('td').eq(8).html($(tr).children('td').eq(7).text());
    $("#"+dialogname).dialog("close");  
      
   }
   function setexp(obj)
 { 
     var id;
    tr=$(obj).parent().parent();
    str=$(tr).children('td').eq(1).text()+" - ";
    str+=$(tr).children('td').eq(2).text()+" - ";
   str+=$(tr).children('td').eq(3).text()+" - ";
   str+=$(tr).children('td').eq(4).text()+" - ";
   str+=$(tr).children('td').eq(5).text();
   
    if(nametoset=='ords') id=6;
   else if(nametoset=='ordsub')
   {
        id=8;
        $(objtoset).children('td').eq(11).html('');
        $(objtoset).children('td').eq(10).html('');
   }
    $(objtoset).children('td').eq(id+1).html(str);
    $(objtoset).children('td').eq(id).html($(tr).children('td').eq(0).text());
    $("#"+dialogname).dialog("close");  
 } 
     function clearexpvalue(obj)
 {	
       objtoset=$(obj).parent().parent();
    if(nametoset=='ords')
    {
          $(objtoset).children('td').eq(6).html('');
          $(objtoset).children('td').eq(7).html('');
    }
    else 
    {
         $(objtoset).children('td').eq(8).html('');
          $(objtoset).children('td').eq(9).html('');
          $(objtoset).children('td').eq(10).html('');
          $(objtoset).children('td').eq(11).html('');
    }

} 
     function clearinvvalue(obj)
 {	
        objtoset=$(obj).parent().parent();

          $(objtoset).children('td').eq(10).html('');
          $(objtoset).children('td').eq(11).html('');


}
 function doshow(act,obj)
 { 
        objtoset=$(obj).parent().parent();
  	if(acts[act]==undefined) return;
	nametoset=act;
 	dialogname=acts[act]['dialog_name'];
 	$("#"+dialogname).dialog("option","title",acts[act]['dialog_title']+": стр."+$(objtoset).children('td').eq(0).html()); 
	$("#"+dialogname).dialog("open");

   }   
     function clearvalue(obj)
 {	
       objtoset=$(obj).parent().parent();
      $(objtoset).children('td').eq(4).html('');
      $(objtoset).children('td').eq(3).html('');
       ty=parseInt($(objtoset).children('td').eq(6).html());
        if(ty>9)
         $(objtoset).children('td').eq(6).html(12);
       else
         $(objtoset).children('td').eq(6).html(0);
}  

     function showvalue(obj)
 {	
       objtoset=$(obj).parent().parent();
      alert($(objtoset).children('td').length);
  } 
function getvalues()
 {
     var fd=$("#from_date").val();
     var td=$("#to_date").val();
    var ff=$("#sel_department").val();
    return fd+" "+td+" "+ff;
     
 }
     function setvalue(id,obj)
 {	
	var name=obj.innerHTML;
        $(objtoset).children('td').eq(4).html(name);
        $(objtoset).children('td').eq(3).html(id);
        var ty=parseInt($(objtoset).children('td').eq(6).html());
        if(ty>9)
         $(objtoset).children('td').eq(6).html(11);
       else
         $(objtoset).children('td').eq(6).html(1);
 	$("#"+dialogname).dialog("close");
} 
  function dosavepay()
 {
     dosave('prod','product');
     dosave('cli','product');
     dosave('dep','product');
    docsave('ord','doc');
    docsave('inv','doc');
    document.forms["date-form"].submit();
 }
  function docsave(pref,elem)
 {
	var str='';
        var val,ord,inv;
        var tabs = $('#'+pref+'-xml-grid table');
        var table=tabs[0];
        var rowLength = table.rows.length;
        if(rowLength>1)
        {

        for(var i=1; i<rowLength; i+=1)
        {
            if(pref=='ord')
            {
                     if(table.rows[i].cells.length>6)
                  {
                      ord = parseInt(table.rows[i].cells[6].innerHTML);
                      if(ord>0)
                      {
                         val = parseInt(table.rows[i].cells[0].innerHTML)+"="+(isNaN(ord) ? "0" : ord);
                          str+=val+'.';
                      }
                  }
              
            }
            else
            {
                    if(table.rows[i].cells.length>10)
                  {
                      ord = parseInt(table.rows[i].cells[8].innerHTML);
                      inv = parseInt(table.rows[i].cells[10].innerHTML);
                      if((ord>0)||(inv>0))
                      {
                         val = parseInt(table.rows[i].cells[0].innerHTML)+"="+(isNaN(ord) ? "0" : ord)+"="+(isNaN(inv) ? "0" : inv);
                         str+=val+'.';
                      }
                  }
            }
         }
        if(str.length>1) 
	{
		document.forms['date-form'].elements[elem].value+=str;
	}
   }
     
 }
     function dosave(pref ,elem)
 {

	var str='';
        var val,val1,ty,id;
        var tabs = $('#'+pref+'-xml-grid table');
        var table=tabs[0];
        var rowLength = table.rows.length;
         id=6;
        if(rowLength>1)
        {

        for(var i=1; i<rowLength; i+=1)
        {
            if(table.rows[i].cells.length>6)
            {
                
                ty = parseInt(table.rows[i].cells[id].innerHTML);
                if(ty>0)
                {
                    if(ty==11)
                   {
                     val = parseInt(table.rows[i].cells[3].innerHTML);
                     val1 = parseInt(table.rows[i].cells[5].innerHTML);
                     if(val!=val1)
                     {
                      val = table.rows[i].cells[0].innerHTML+"="+val;
                      str+=val+'.';
                     }
                    }
                    else if(ty!=10)
                    {
                     if(ty==12)
                       val = table.rows[i].cells[0].innerHTML+"=0";
                     else
                         val = table.rows[i].cells[0].innerHTML+"="+table.rows[i].cells[3].innerHTML;
                        str+=val+'.';
                  }
                 }
             }
      }
       if(str.length>1) 
	{
		document.forms['date-form'].elements[elem].value+=str;
	}
    }
 }

$(document).ready(function()
 {
	acts['client']={	model_name:'Country',
						dialog_name:'clientdialog',
						dialog_title:'Клиенты',
					};
	acts['product']={	model_name:'Concert',
						dialog_name:'productdialog',
						dialog_title:'Товары',
					};
	acts['department']={	model_name:'Department',
						dialog_name:'departmentdialog',
						dialog_title:'Фирмы',
					};
	acts['ords']={	model_name:'Exp',
						dialog_name:'accountsdialog',
						dialog_title:'Счета',
					};
	acts['ordsub']={	model_name:'Exp',
						dialog_name:'accountsdialog',
						dialog_title:'Счета',
					};
	acts['invs']={	model_name:'Inv',
						dialog_name:'accountsdialog',
						dialog_title:'Накладные',
					};

/**/								

 });