<?php
	// $dc_id = $_GET['ID'];	
	//$dc_id = 3174;	
	 date_default_timezone_set('Asia/Calcutta');
	 
 	 
	
	function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    } 
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return ucwords($string);
}
	
?> 


<html>
<head>
<style type="text/css" media="all">
/*@media print 
{
   @page
   {
    size: 2.05in 2.91in;
    size: landscape;
  }
}

.ha1{
	font-size:14px;
	}
.boxed {
  border: 1px solid black ;
  width:50%;
}
*/

@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: auto;
    height: 52mm;
	/*size:portrait;*/
	size:landscape;

  }
  /* ... the rest of the rules ... */
}
</style>


<script type="text/javascript">
function get()
{
	var p=document.getElementById('print');
	p.style.visibility="hidden";
	window.print();	
	
	p.style.visibility="visible";
}
</script>

</head>

<?php
$id=$_GET['pId'];
include('lib/function.php');
	
	$qry="SELECT a.paid_amt,a.bal_amt,a.receipt_no,a.date,c.company_nm FROM sale_outstanding AS a
LEFT JOIN sale_entry AS b ON a.sale_id=b.id
LEFT JOIN party_details AS c ON b.party_id=c.id WHERE a.id='$id'";	
$st=$conn->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$paid=$row['paid_amt'];
$company_nm=$row['company_nm'];
$receipt_no=$row['receipt_no'];
$date=$row['date'];
$close_bal=$row['bal_amt'];
$words=convert_number_to_words($paid);
 ?>
 
<body>

<table align="center" cellpadding="3px" cellspacing="0px" border="1px" width="100%" >
<tr align="center">
<td>
<div align="center">
<h2>
<strong style="text-align:center; font-size:30px; color:#F00;" >CASH RECEIPT</strong> 
</h2>
</div>
</td>	
</tr>
<tr>
<td>
<table width="100%">
<tr>
<td align="center">

<div style="text-align:left;font-size:25px">Water Purifier</div>
</td>
</tr>
</table>

<table width="100%">
<tr>
<td >
<div style="text-align:left; padding:10px; font-size:18px; color:#F00">
Cash Receipt : <?php echo $receipt_no?>
</div>
</td>
<td align="right">
<div style="padding:10px; font-size:18px;"> Date : <?php echo date('d/m/Y',strtotime($date)) ?></div>
</td>
</tr>
</table>



</td>
</tr>
<tr align="center" cellpadding="10px">
<td >
<div align="left" style=" line-height:2;padding:10px">
Cash Received From &nbsp;&nbsp;<b> Mr./Mrs. <u><?php echo $company_nm ?> </u> </b>  &nbsp;&nbsp;&nbsp; of &nbsp;<u><?php echo $paid ?> Rs.</u> <br>For Water Purifier 
</div>
<div align="left" style=" line-height:2;padding:10px">
<b>Clo.Bal. :</b> <?php echo $close_bal?>
</div>
<div style="margin-top:80px;float:right;padding-right:30px">
<label style="font-weight:800">Signature</label>
</div>
</td>
</tr>
</table>






<table border="0px" width="100%" style="margin-top:10px">
<tr align="center">
<td>
<input type="button"  name="print" id="print" onClick="get()" value="Print" />
</tr>
</table>


</body>
</html>