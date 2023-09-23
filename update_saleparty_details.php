<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>
<?php 
if(isset($_POST['btnsub']))
{
include('lib/function.php');
$eId=$_POST['eId'];	
$company_nm=$_POST['txtconpanynm'];
$txtmob=$_POST['txtmob'];
$txtaddress=$_POST['txtaddress'];
$txtemail=$_POST['txtemail'];
$txtgst=$_POST['txtgst'];
$txtstate=$_POST['txtstate'];
$txtcitypin=$_POST['txtcitypin'];

$qry="UPDATE party_details SET company_nm='$company_nm',mobile='$txtmob',adrs='$txtaddress',email='$txtemail',gst_no='$txtgst',state='$txtstate',city_pin='$txtcitypin' WHERE id='$eId'";
$st=$conn->prepare($qry);
$st->execute();

echo "<script> alert('Record Updated Successfully...!')</script>";
echo "<script>refreshAndClose(); </script>";
echo "<script>self.opener.location.reloadAndClose(); </script>";
echo "<script>window.location.href='party_entry.php'</script>";
}
else
{
echo "<script> alert('Record Not Updated...!')</script>";
echo "<script>refreshAndClose(); </script>";
echo "<script>self.opener.location.reloadAndClose(); </script>";
echo "<script>window.location.href='party_entry.php'</script>";
}
?>