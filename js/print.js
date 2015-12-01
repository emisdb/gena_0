function didprint(state)
 {
        if(state==0)
	{
           jQuery('#printtorg').printThis();
	}
	else
	{	
            jQuery('#printsf').printThis();
	}
 }
function doprint(state)
 {
     w=window.open(null, 'Print_Page', 'scrollbars=yes'); 
     w.document.write('<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">');
      if(state==0)
	{
          w.document.write('<head><title>ТОРГ-12</title>');
          w.document.write('<style type="text/css" media="print">  @page { size:landscape; margin:0cm 0cm;} .page-break {page-break-after: always;}</style>');
	}
	else if(state==1)
	{	
           w.document.write('<head><title>Счет-Фактура</title>');
           w.document.write('<style type="text/css" media="print"> @page { size:landscape; margin:0cm 0cm;} </style>');
	}
	else if(state==2)
	{	
            w.document.write('<head><title>Счет</title>');
           w.document.write('<style type="text/css" media="print"> @page { size:portrait; margin:0cm 0cm;} #show_print{visibility:visible; display:block;}</style>');
	}
	else if(state==3)
	{	
           w.document.write('<head><title>Счет</title>');
           w.document.write('<style type="text/css" media="print"> @page { size:portrait; margin:0cm 0cm;} #show_print{visibility:hidden; display:none;}</style>');
           w.document.write('<style type="text/css" media="screen"> #show_print{visibility:hidden; display:none;}</style>');
	}
        w.document.write('<link rel="stylesheet" type="text/css" href="'+baseDir+'/css/main.css" />');  
        w.document.write('<link rel="stylesheet" type="text/css" href="'+baseDir+'/css/print_doc.css" />');  
        w.document.write('</head><body>');
        if(state==0)
	{
           w.document.write(jQuery('#printtorg').html());
	}
	else if(state==1)
	{	
             w.document.write(jQuery('#printsf').html());
	}
	else
	{	
             w.document.write(jQuery('#printarea').html());
	}
         w.document.write('</body></html>');
         w.document.close();
//    w.print();
 }
 