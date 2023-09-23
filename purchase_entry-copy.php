<?php include('log_chk.php')?>
<!DOCTYPE html>
<html>
<head>
<?php 
  date_default_timezone_set('Asia/Calcutta');
  $dt=date('Y-m-d');
  include('common/meta.php');
?>
   <link rel="stylesheet" href="selectcss/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop 
	{ left: -9000px;
	
	}
  </style> 
  <script type="text/javascript">
    function ChangeCase(elem)
    {
        elem.value = elem.value.toUpperCase();
    }
</script>

<script>
	function getdetails()
	{
		var partynm = document.getElementById('txtpartynm').value;
		//alert(partynm);	
		var scriptUrl ='get_purchse_partydetails.php?sID='+partynm;
		//alert(scriptUrl);
		$.ajax({url:scriptUrl,success:function(result)
		{	
		//alert(result);
		var res=result.split('*');
		document.getElementById('txtadrs').value=res[0];
		document.getElementById('txtmob').value=res[1];
		document.getElementById('txtemail').value=res[2];
		document.getElementById('txtgst').value=res[3];
		document.getElementById('txtstate').value=res[4];
		
		//$("#txtdept").html(res[1]).trigger("chosen:updated.chosen");
		}});
	}
</script>

 <script type="text/javascript">
function AddRow(tableID)
	{
				var pnm=document.getElementById('txtpartynm').value;
				//alert(pnm);
				
				if(pnm == '0')
				{
					alert("Please Select Party Name...!");
					$('#txtitem').val(0).trigger("chosen:updated");
				}
				else
				{
					var item_name=document.getElementById('txtitem').value;
					var e = document.getElementById("txtitem");
					var E_itemnm = e.options[e.selectedIndex].text;
					
					
					var scripturl='gethsncode.php?hsnno='+item_name;
					$.ajax({url:scripturl,success:function(res)
					{
					//alert(res);
					var hsn_code=res;
					
					
					//alert(item_name);
					
					var rec=document.getElementById("rec").value;
					
					var table = document.getElementById(tableID);
					var rowCount = table.rows.length;
					//alert(rowCount);
					var row = table.insertRow(rowCount);
					
					var cell1 = row.insertCell(0);
					var element1 = document.createElement("input");
					element1.type = "checkbox";
					element1.id="chkboxx"+rowCount;
					element1.name="chkboxx[]";
					cell1.appendChild(element1);
					
					var cell2 = row.insertCell(1);
					var element2 = document.createElement("lable");
					element2.id="countt"+rowCount;	
					element2.innerHTML=rowCount;			
					cell2.appendChild(element2);
					element2.style.width="100%";
					
					var cell3 = row.insertCell(2);
					var element3 = document.createElement("input");
					element3.type="hidden";
					element3.id="hsn_code"+rowCount;
					element3.name="hsn_code[]";	
					element3.value=hsn_code;
					element3.readOnly="true";			
					cell3.appendChild(element3);
					element3.style.width="100%";
					
					var element31 = document.createElement("label");
					element31.innerHTML=hsn_code;		
					cell3.appendChild(element31);
					
					var cell4 = row.insertCell(3);
					var element4 = document.createElement("input");
					element4.type="hidden";
					element4.id="item_name"+rowCount;
					element4.name="item_name[]";	
					element4.value=item_name;
					element4.readOnly="true";			
					cell4.appendChild(element4);
					element4.style.width="100%";
					
					var element41 = document.createElement("label");
					element41.innerHTML=E_itemnm;		
					cell4.appendChild(element41);
					
					
					var cell5 = row.insertCell(4);
					var element5 = document.createElement("input");
					element5.type="text";
					element5.id="rate"+rowCount;
					element5.name="rate[]";	
					element5.value=0;
					//element4.readOnly="true";			
					cell5.appendChild(element5);
					element5.onchange=function(){
					getcal();gstcalculation();getpayamt();
					}
					element5.style.width="100%";	
					
					var cell6 = row.insertCell(5);						
					var element6 = document.createElement("input");
					element6.type="text";
					element6.id="i_qty"+rowCount;
					element6.name="i_qty[]";	
					element6.value=0;
					//element5.readOnly="true";
					cell6.appendChild(element6);
					element6.onchange=function(){
					getcal();gstcalculation();getpayamt();
					}
					element6.style.width="100%";
					
					
					var cell7 = row.insertCell(6);
					var element7 = document.createElement("input");
					element7.type="text";
					element7.id="i_total"+rowCount;
					element7.name="i_total[]";	
					element7.value=0;
					element7.readOnly="true";		
					cell7.appendChild(element7);
					
					document.getElementById("rec").value=rowCount;
					
					}})
	
				}
	}

function aaRemoveRow1()
{
  //chkbox,count,item_id,code_id,t_qty,sgval,volumeval,uom,t_cost,t_stand;
  
   var i, n, ch, sr, it_id, cid,t_qy, sg,vol, uom_t, ct, stnd;
   
   var count = parseInt(document.getElementById('rec').value);
  //alert(count);
  tbl = document.getElementById('dataTable2');
  
  len = tbl.rows.length-1;
  //alert(len);
 
  n = 2; // assumes ID numbers start at zero
  for (i = 2; i <= len; i++) 
  {
	 //alert(i);
	ch = document.getElementById("chkboxx" +i);
	sr = document.getElementById("countt" + i);
    it_id = document.getElementById("item_id" + i);
	cid = document.getElementById("code_id" +i);
    t_qy = document.getElementById("t_qty" + i);
    sg = document.getElementById("sgval" + i);
	vol = document.getElementById("volumeval" + i);
	uom_t = document.getElementById("uom" + i);
    ct = document.getElementById("t_cost" + i);
    stnd = document.getElementById("t_stand" + i);
	//alert(sr);
	
	
    if (ch && sr && it_id && cid && t_qy && sg && vol && uom_t && ct && stnd) {
      //alert(ch.checked);
	  if (ch.checked)
	   { 
	   
	  /* if(ch.value==-1)
	   {
	   
	   }
	   else
	   {
	    delfun(ch.value);
	   }*/
        tbl.deleteRow(i);
		
        count--;
		//alert('Deleted Record Successfully');
      }
      else {
		ch.id = "chkboxx" + n;
        sr.id = "countt" + n;
		it_id.id = "item_id" + n;
        cid.id = "code_id" + n;
        t_qy.id = "t_qty" + n;
        sg.id = "sgval" + n;
		vol.id = "volumeval" + n;
		uom_t.id = "uom" + n;
        ct.id = "t_cost" + n;//
		stnd.id = "t_stand" + n;
        
		document.getElementById("countt" + n).innerHTML=n;
        ++n;
      }
	  
    }
  }
    document.getElementById('rec').value = count;	
	getstandcal();
	getweightcal();	
	getpercent(); }
	
</script>

<script>
function getcal()
{
	var tot=0;
	var totrowcnt=document.getElementById('rec').value;
	
	for(i=1;i<=totrowcnt;i++)
	{
	var a= document.getElementById('rate'+i).value;
	var b= document.getElementById('i_qty'+i).value;
	var c=parseFloat(a)*parseFloat(b);
	
	var tot=tot+c;
	document.getElementById('i_total'+i).value=c;
	}
	document.getElementById('txttotal').value=tot;
	
}

function getdis()
{
  if(document.getElementById('txtrs').checked == true)
	 {
		 document.getElementById('disval').value='0';
	 }
  else if(document.getElementById('txtper').checked == true)
	 {
		  document.getElementById('disval').value='1';
	 }
	getcaldisant(); 
	gstcalculation();
	getpayamt();
}
</script>

<script>
function getcaldisant()
{
	var totrowcnt=document.getElementById('rec').value;
	var tot=document.getElementById('txttotal').value;
	
	if(totrowcnt == '0')
	{
		alert('Please Select Item Name...!');
		document.getElementById('txtdiscnt').value='0';
	}
	else if(tot == '0')
	{
		alert('Please Enter Rate and Quantity...!');
		document.getElementById('txtdiscnt').value='0';
	}
	else
	{
	var discountamt_val=document.getElementById('txtdiscnt').value;
	//alert(discountamt_val);
	var dis_val = document.getElementById('disval').value;
	//alert(dis_val);
	if(dis_val == '0')
	{
		document.getElementById('txtdiscountamt').value=discountamt_val;
		
		
	}
	else if(dis_val == '1')
	{
	   var a = 	document.getElementById('txttotal').value;
	   var cal =parseFloat(discountamt_val)*parseFloat(a)/100;
	   document.getElementById('txtdiscountamt').value=cal;
	}
	 
	 var tot = document.getElementById('txttotal').value;
	 var discnt_val = document.getElementById('txtdiscountamt').value;
	 
	 var grandtot=parseFloat(tot)-parseFloat(discnt_val);
	 document.getElementById('txtgrandtot').value=grandtot.toFixed(2);
	}
}
</script>

<script>
function gstcalculation()
{
	var a=document.getElementById("txtpurchasety").value;
	
	var state_val=document.getElementById("txtstate").value;
	//alert(state_val);
	var aa = document.getElementById("txttotal").value;
	var bb = document.getElementById("txtdiscountamt").value;
	
	var cc= parseFloat(aa)-parseFloat(bb);
	
	if(a=='1' || a==1)
	{
		if(document.getElementById("txtgst18").checked == true)
		{
			document.getElementById("txtgsttype").value=1;
			var gst18val = (cc)*18/100;
			
			if(state_val == '1' || state_val == 1)
			{
				var divide_gst = parseFloat(gst18val)/2;
				document.getElementById("txtsgst").value=divide_gst.toFixed(2);
			    document.getElementById("txtcgst").value=divide_gst.toFixed(2);
			}
			else if(state_val == '2' || state_val == 2)
			{
				var divide_igst = parseFloat(gst18val);
				document.getElementById("txtigst").value=divide_igst.toFixed(2);
			}
			
			var gtotal=parseFloat(gst18val)+parseFloat(cc);
			
			document.getElementById("txtgrandtot").value=gtotal.toFixed(2);
			
			
			
		}
		else if(document.getElementById("txtgst12").checked == true)
		{
			document.getElementById("txtgsttype").value=2;
			var gst12val = (cc)*12/100;
			
			if(state_val == '1' || state_val == 1)
			{
				var divide_gst = parseFloat(gst12val)/2;
				document.getElementById("txtsgst").value=divide_gst.toFixed(2);
			    document.getElementById("txtcgst").value=divide_gst.toFixed(2);
			}
			else if(state_val == '2' || state_val == 2)
			{
				var divide_igst = parseFloat(gst12val);
				document.getElementById("txtigst").value=divide_igst.toFixed(2);
			}
			
			var gtotal=parseFloat(gst12val)+parseFloat(cc);
			
			document.getElementById("txtgrandtot").value=gtotal.toFixed(2);
			
			
		}
		else if(document.getElementById("txtgst5").checked == true)
		{
			document.getElementById("txtgsttype").value=3;
			var gst5val = (cc)*5/100;
			
			if(state_val == '1' || state_val == 1)
			{
				var divide_gst = parseFloat(gst5val)/2;
				document.getElementById("txtsgst").value=divide_gst.toFixed(2);
			    document.getElementById("txtcgst").value=divide_gst.toFixed(2);
			}
			else if(state_val == '2' || state_val == 2)
			{
				var divide_igst = parseFloat(gst5val);
				document.getElementById("txtigst").value=divide_igst.toFixed(2);
			}
			
			var gtotal=parseFloat(gst5val)+parseFloat(cc);
			
			document.getElementById("txtgrandtot").value=gtotal.toFixed(2);
			
			
		}
	}
	else if(a=='2' || a==2)
	{
		
		if(document.getElementById("txtwithoutgst").checked == true)
		{
			document.getElementById("txtgsttype").value=4;
			document.getElementById("txtgrandtot").value=cc;
			document.getElementById("txtsgst").value=0;
			document.getElementById("txtcgst").value=0;
			document.getElementById("txtigst").value=0;
		}
	}
	else
	{
			document.getElementById("txtgrandtot").value=cc;
			document.getElementById("txtsgst").value=0;
			document.getElementById("txtcgst").value=0;
			document.getElementById("txtigst").value=0;
			document.getElementById("txtgsttype").value=0;
	}
}
</script>

<script>
function getpayamt()
	{
		var grandtot = document.getElementById('txtgrandtot').value;
		//alert(grandtot);
		var payamt = document.getElementById('txtpayamt').value;
		//alert(payamt);
		if(payamt > grandtot)
		{
			alert('Please Enter valid amount...!');
			document.getElementById('txtpayamt').value="0";
			document.getElementById('txtbalamt').value="0";
		}
		else
		{
			var bal=parseFloat(grandtot)-parseFloat(payamt);
			//alert(bal);
			if(isNaN(bal))
			{
				bal=0;
			}
			document.getElementById('txtbalamt').value=bal;
		}
		
		
	}
</script>

<script>
function getsaletype()
		{
			
			var a=document.getElementById("txtpurchasety").value;
			//alert(a);
			
			
			if(a == '1')
			{
				document.getElementById("first").style.visibility='visible';
				document.getElementById("first").style.overflow='visible';
				document.getElementById("first").style.height='auto';
				
				document.getElementById("second").style.visibility='hidden';
				document.getElementById("second").style.overflow='hidden';
				document.getElementById("second").style.height='0px';
				
			}
			else if(a == '2')
			{
				document.getElementById("first").style.visibility='hidden';
				document.getElementById("first").style.overflow='hidden';
				document.getElementById("first").style.height='0px';
				
				document.getElementById("second").style.visibility='visible';
				document.getElementById("second").style.overflow='visible';
				document.getElementById("second").style.height='auto';
			}
			else
			{
				document.getElementById("first").style.visibility='hidden';
				document.getElementById("first").style.overflow='hidden';
				document.getElementById("first").style.height='0px';
				
				document.getElementById("second").style.visibility='hidden';
				document.getElementById("second").style.overflow='hidden';
				document.getElementById("second").style.height='0px';
			}
			
		}
</script>

<script>
	function getpaytype()
	{
		if(document.getElementById('txtyes').checked==true)
		{
			document.getElementById("yes").style.visibility='visible';
			document.getElementById("yes").style.overflow='visible';
			document.getElementById("yes").style.height='auto';
			document.getElementById("txtpaybillamt").value=1;
			
			
		}
		else
		{
			document.getElementById("yes").style.visibility='hidden';
			document.getElementById("yes").style.overflow='hidden';
			document.getElementById("yes").style.height='0px';
			
			document.getElementById("online").style.visibility='hidden';
			document.getElementById("online").style.overflow='hidden';
			document.getElementById("online").style.height='0px';
			
			document.getElementById("cheque").style.visibility='hidden';
			document.getElementById("cheque").style.overflow='hidden';
			document.getElementById("cheque").style.height='0px';
			
			document.getElementById("cash").style.visibility='hidden';
			document.getElementById("cash").style.overflow='hidden';
			document.getElementById("cash").style.height='0px';
			
			document.getElementById("txtpaybillamt").value=0;
			document.getElementById("txtpaymode").value=0;
		}
	}
</script>

<script>
	function getpaymode()
	{
	    if(document.getElementById('txtcash').checked==true)
		 {
			document.getElementById("txtpaymode").value=1;
			document.getElementById("cash").style.visibility='visible';
			document.getElementById("cash").style.overflow='visible';
			document.getElementById("cash").style.height='auto';
			
			document.getElementById("cheque").style.visibility='hidden';
			document.getElementById("cheque").style.overflow='hidden';
			document.getElementById("cheque").style.height='0px';
			
			document.getElementById("online").style.visibility='hidden';
			document.getElementById("online").style.overflow='hidden';
			document.getElementById("online").style.height='0px';
			
			
		 }
		 else if(document.getElementById('txtcheque').checked==true)
		 {
			document.getElementById("txtpaymode").value=2;
			document.getElementById("cheque").style.visibility='visible';
			document.getElementById("cheque").style.overflow='visible';
			document.getElementById("cheque").style.height='auto';
			
			document.getElementById("cash").style.visibility='visible';
			document.getElementById("cash").style.overflow='visible';
			document.getElementById("cash").style.height='auto';
			
			document.getElementById("online").style.visibility='hidden';
			document.getElementById("online").style.overflow='hidden';
			document.getElementById("online").style.height='0px';
		 }
		 else if(document.getElementById('txtonlinepay').checked==true)
		 {
			document.getElementById("txtpaymode").value=3;
			document.getElementById("online").style.visibility='visible';
			document.getElementById("online").style.overflow='visible';
			document.getElementById("online").style.height='auto';
			
			document.getElementById("cheque").style.visibility='hidden';
			document.getElementById("cheque").style.overflow='hidden';
			document.getElementById("cheque").style.height='0px';
			
			document.getElementById("cash").style.visibility='visible';
			document.getElementById("cash").style.overflow='visible';
			document.getElementById("cash").style.height='auto';
		 }
		 else
		 {
			document.getElementById("txtpaymode").value=0;
			document.getElementById("online").style.visibility='hidden';
			document.getElementById("online").style.overflow='hidden';
			document.getElementById("online").style.height='0px';
			
			document.getElementById("cheque").style.visibility='hidden';
			document.getElementById("cheque").style.overflow='hidden';
			document.getElementById("cheque").style.height='0px';
			
			document.getElementById("cash").style.visibility='hidden';
			document.getElementById("cash").style.overflow='hidden';
			document.getElementById("cash").style.height='0px';
		 }
	}
	
</script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('common/sidemenu.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><b>Purchase Entry</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form class="form-horizontal" action="purchase_entry_ins.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div>
                  <label style="color:RED"><u>Party Information</u></label>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Party Name :</label>
                    <div class="col-sm-4">
                      <select class="chosen-select form-control" id="txtpartynm" name="txtpartynm" onChange="getdetails();">
                      <option value="0">--- Select ---</option>
                      <?php
                      include('lib/function.php');
					  $qry="SELECT id,company_nm FROM purchase_party_details WHERE sts='0'";
					  $st=$conn->prepare($qry);
					  $st->execute();
					  while($row=$st->fetch(PDO::FETCH_ASSOC))
					  {
						  echo '<option value="'.$row['id'].'">'.$row['company_nm'].'</option>';
					  }
					  $conn=null;
					  ?>
                      </select>
                    </div>
                    <label class="col-sm-2 col-form-label">Address :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtadrs" name="txtadrs" placeholder="Address">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile No :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control " id="txtmob" name="txtmob" placeholder="Mobile No">
                    </div>
                    <label class="col-sm-2 col-form-label">Email :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtemail" name="txtemail" placeholder="Email">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">GST No :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtgst" name="txtgst" placeholder="GST">
                      <input type="hidden" class="form-control" id="txtstate" name="txtstate"> 
                    </div>
                  </div>
                  
                  <div>
                  <label style="color:RED"><u>Purchase Information</u></label>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Bill No :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtbillno" name="txtbillno" placeholder="Bill No" required>
                    </div>
                    <label class="col-sm-2 col-form-label">Date :</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="txtdate" name="txtdate" value="<?php echo $dt;?>">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Item Name :</label>
                    
                    <div class="col-sm-4">
                      <select class="chosen-select form-control" id="txtitem" name="txtitem" onChange="AddRow('dataTable2');">
                      <option value="0">--- Select ---</option>
                      <?php
                      include('lib/function.php');
					  $qry="SELECT id,itemnm FROM item_master WHERE sts='0'";
					  //echo $qry."<br>";
					  $stm=$conn->prepare($qry);
					  $stm->execute();
					  while($rw=$stm->fetch(PDO::FETCH_ASSOC))
					  {
						  echo '<option value="'.$rw['id'].'">'.$rw['itemnm'].'</option>';
					  }
					  $conn=null;
					  ?>
                      </select>
                     </div>
                    <!-- <div class="col-md-2">
                      <button class="fa fa-trash btn-danger" type="button" value="Delete Row" onClick="aaRemoveRow1('dataTable2')" style="padding:5px"></button> 
                     </div>-->
                    
                  </div>
                  
                  <div class="table-responsive" style="margin-top:15px">
                    <input type="hidden" id="rec" name="rec" value="0">
                    <table id="dataTable2" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                    <tr style="background-color:#5377e0">                        	  
                    <th style="padding:10px;color:#fff;text-align:center">Select</th>
                    <th style="padding:10px;color:#fff;text-align:center">No.</th>
                    <th style="padding:10px;color:#fff;text-align:center">HSN</th>
                    <th style="padding:10px;color:#fff;text-align:center">Item Name</th>
                    <th style="padding:10px;color:#fff;text-align:center">Rate</th>
                    <th style="padding:10px;color:#fff;text-align:center">Qty</th>
                    <th style="padding:10px;color:#fff;text-align:center">Total</th>
                    </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                    
                    </table> 
                    </div>
                    
                    <div class="row">
                    	<div class="col-md-6"></div>
                        <div class="col-md-6">
                        <table>
                        <tr>
                        <td><label>Purchase Type : </label>&nbsp;&nbsp;</td>
                        <td>
                        <select class="chosen-select form-control" id="txtpurchasety" name="txtpurchasety" onChange="getsaletype();gstcalculation();">
                        <option value="0">--Select Sale Type--</option>
                        <option value="1">With GST</option>
                        <option value="2">Without GST</option>
                        </select>
                        </td>
                        </tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                        <td><label>GST Type :</label></td>
                        <td>
                        	<div id="first" style="visibility:hidden;overflow:hidden;height:0px;">
                            <input type="radio" id="txtgst18" name="txtgst18" onClick="gstcalculation();">&nbsp;18%
                            <input type="radio" id="txtgst12" name="txtgst18" onClick="gstcalculation();">&nbsp;12%
                            <input type="radio" id="txtgst5" name="txtgst18" onClick="gstcalculation();">&nbsp;5%
                            </div>
                            <div id="second" style="visibility:hidden;overflow:hidden;height:0px;">
                            <input type="radio" id="txtwithoutgst" name="txtwithoutgst" checked required>&nbsp;Without GST
                            </div>
                            
                            <input type="hidden" id="txtgsttype" name="txtgsttype" value="0">
                        </td>
                        </tr>
                        
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                        <td><label>Total :</label></td>
                        <td><input type="text" id="txttotal" name="txttotal" class="form-control form-control-sm" readonly value="0"></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                        <td>
                        <label>Discount :</label>
                        <input type="radio" id="txtrs" name="txtrs" value="0" checked onClick="getdis()">&nbsp;RS
                        <input type="radio" id="txtper" name="txtrs" value="1" onClick="getdis()">&nbsp;% 
                        <input type="text" id="txtdiscnt" name="txtdiscnt" class="form-control form-control-sm" style="width:100px" value="0" onChange=                 			"getcaldisant();gstcalculation();">
                        <input type="hidden" id="disval" name="disval" value="0">
                        </td>
                        <td><input type="text"  id="txtdiscountamt" name="txtdiscountamt" class="form-control form-control-sm" value="0" readonly></td>
                        </tr>
                        
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                        <td><label>SGST :</label></td>
                        <td><input type="text" id="txtsgst" name="txtsgst" class="form-control form-control-sm" value="0" readonly></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                        <td><label>CGST :</label></td>
                        <td><input type="text" id="txtcgst" name="txtcgst" class="form-control form-control-sm" value="0" readonly></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                        <td><label>IGST :</label></td>
                        <td><input type="text" id="txtigst" name="txtigst" class="form-control form-control-sm" value="0" readonly></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                        <td><label>Grand Total :</label></td>
                        <td><input type="text" id="txtgrandtot" name="txtgrandtot" class="form-control form-control-sm" value="0" readonly></td>
                        </tr>
                        
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                        <td><label>Do u Want Pay Bill Amount :&nbsp;&nbsp;</label></td>
                        <td>
                        <input type="radio" id="txtyes" name="txtyes" onClick="getpaytype();" required>&nbsp;Yes
                        <input type="radio" id="txtno" name="txtyes" onClick="getpaytype()">&nbsp;No
                        
                        <input type="hidden" id="txtpaybillamt" name="txtpaybillamt" value="0" required>
                        </td>
                        </tr>
                        
                        
                        </table>
                       
                            <div class="row" id="yes" style="visibility:hidden;overflow:hidden;height:0px;">
                                <div class="col-md-5"><label>Payment mode :</label></div>
                                <div class="col-md-2"><input type="radio" id="txtcash" name="txtcash" onClick="getpaymode()">&nbsp;Cash   </div>
                                <div class="col-md-2"><input type="radio" id="txtcheque" name="txtcash" onClick="getpaymode()">&nbsp;Cheque </div>
                                <div class="col-md-2"><input type="radio" id="txtonlinepay" name="txtcash" onClick="getpaymode()">&nbsp;Online </div>
                                
                                <input type="hidden" id="txtpaymode" name="txtpaymode" value="0">
                            </div>
                            
                            <div class="row" id="cheque" style="visibility:hidden;overflow:hidden;height:0px">
                               <div class="col-md-5"><label>Bank Name :</label></div>
                               <div class="col-md-6"><input type="text" id="txtbanknm" name="txtbanknm" class="form-control form-control-sm"> </div>
                               <div class="col-md-1"></div>
                               
                               <div class="col-md-5" style="margin-top:5px"><label>Cheque Number :</label></div>
                               <div class="col-md-6" style="margin-top:5px"><input type="text" id="txtchequenm" name="txtchequenm" class="form-control form-control-sm"> </div>
                               <div class="col-md-1"></div>
                                
                               <div class="col-md-5" style="margin-top:5px"><label>Cheque Date :</label></div>
                               <div class="col-md-6" style="margin-top:5px"><input type="date" id="txtchequedt" name="txtchequedt" class="form-control form-control-sm"> </div>
                               <div class="col-md-1"></div>
                             </div>
                             
                             <div class="row" id="online" style="visibility:hidden;overflow:hidden;height:0px">
                                <div class="col-md-5" style="margin-top:5px"><label>Online Payment Type :</label></div>
                                <div class="col-md-6" style="margin-top:5px">
                                <select class="chosen-select form-control" id="txtonlinepay" name="txtonlinepay">
                                <option value="0">--Select--</option>
                                <option value="Cardpay">Cardpay</option>
                                <option value="Googlepay">GooglePay</option>
                                <option value="Phonepay">Phonepay</option>
                                <option value="Paytm">Paytm</option>
                                </select>
                                </div>
                                <div class="col-md-1"></div>
                               
                                <div class="col-md-5" style="margin-top:5px"><label>Transaction Id :</label></div>
                                <div class="col-md-6" style="margin-top:5px"><input type="text" id="txttransid" name="txttransid" class="form-control form-control-sm"> </div>
                                <div class="col-md-1"></div>
                            </div>
                            
                            <div class="row" id="cash" style="visibility:hidden;overflow:hidden;height:0px">
                                <div class="col-md-5"><label>Paying Amount :</label></div>
                                <div class="col-md-6"><input type="text" id="txtpayamt" name="txtpayamt" class="form-control form-control-sm" onChange="getpayamt()"> </div>
                                <div class="col-md-1"></div>
                               
                                <div class="col-md-5" style="margin-top:5px"><label>Balance  Amount :</label></div>
                                <div class="col-md-6" style="margin-top:5px"><input type="text" id="txtbalamt" name="txtbalamt" class="form-control form-control-sm" readonly> </div>
                                <div class="col-md-1"></div>
                            </div>
                            
                            
                        </div>
                       
                    </div>

                </div>
                
                
                
                
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="btnsub" name="btnsub">Submit</button>
                </div>
                <!-- /.card-footer -->
              </form>
             
              
            </div>
        <!-- /.card -->

		

      </div>
      <!-- /.container-fluid -->
      
      
      
	</section>
    <!--List Table-->
   
   
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('common/footer.php')?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
<script src="selectjs/chosen.jquery.js" type="text/javascript"></script>
<script src="selectjs/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
var config = {
'.chosen-select'           : {},
'.chosen-select-deselect'  : {allow_single_deselect:true},
'.chosen-select-no-single' : {disable_search_threshold:10},
'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
'.chosen-select-width'     : {width:"95%"}
}
for (var selector in config) {
$(selector).chosen(config[selector]);
}
</script>
</body>
</html>
