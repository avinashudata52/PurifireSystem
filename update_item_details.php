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
$txtitem=$_POST['txtitem'];
$txthsncode=$_POST['txthsncode'];
$txtrate=$_POST['txtrate'];

$qry="UPDATE item_master SET itemnm='$txtitem',hsn='$txthsncode',rate='$txtrate' WHERE id='$eId'";
$st=$conn->prepare($qry);
$st->execute();

$qry1="UPDATE stock_maintain SET sale_rate='$txtrate' WHERE itemId='$eId'";
$st1=$conn->prepare($qry1);
$st1->execute();

echo "<script> alert('Record Updated Successfully...!')</script>";
echo "<script>refreshAndClose(); </script>";
echo "<script>self.opener.location.reloadAndClose(); </script>";
echo "<script>window.location.href='items.php'</script>";
}
else
{
echo "<script> alert('Record Not Updated...!')</script>";
echo "<script>refreshAndClose(); </script>";
echo "<script>self.opener.location.reloadAndClose(); </script>";
echo "<script>window.location.href='items.php'</script>";
}
?>