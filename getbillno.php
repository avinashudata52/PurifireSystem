<?php
$billno=$_GET['bId'];

include('lib/function.php');

$qry="SELECT a.*,b.rate,b.qty,b.total,b.item_nm,c.itemnm,b.id as stockId FROM purchase_entry AS a 
LEFT JOIN puchase_entry_info AS b ON a.id=b.lastId
LEFT JOIN item_master AS c ON b.item_nm=c.id WHERE b.lastId='$billno'";
$st=$conn->prepare($qry);
$st->execute();
$cnt=1;
$i=1;
echo '<table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr style="background-color:#5377e0">                        	  
                    <th style="padding:10px;color:#fff;text-align:center">No</th>
                    <th style="padding:10px;color:#fff;text-align:center">Item Name</th>
                    <th style="padding:10px;color:#fff;text-align:center">Puechase Rate</th>
                    <th style="padding:10px;color:#fff;text-align:center">Qty</th>
                    <th style="padding:10px;color:#fff;text-align:center">Purchase Total</th>
                    <th style="padding:10px;color:#fff;text-align:center">Sale Rate</th>
                    <th style="padding:10px;color:#fff;text-align:center">Sale Total</th>
                    </tr>
                </thead><tbody>';
	while($row=$st->fetch(PDO::FETCH_ASSOC))
	{
		echo '<tr>';
		echo '<td>'.$cnt.'</td>';
		echo '<td>'.$row['itemnm'].'<input type="hidden" id="txtitemId'.$cnt.'" name="txtitemId[]" value="'.$row['item_nm'].'"></td>';
		echo '<td>'.$row['rate'].'<input type="hidden" id="txtprate'.$cnt.'" name="txtprate[]" value="'.$row['rate'].'"></td>';
		echo '<td>'.$row['qty'].'<input type="hidden" id="txtpqty'.$cnt.'" name="txtpqty[]" value="'.$row['qty'].'"></td>';
		echo '<td>'.$row['total'].'<input type="hidden" id="txtptot'.$cnt.'" name="txtptot[]" value="'.$row['total'].'"></td>';
		echo '<td><input type="text" id="srate'.$cnt.'" class="form-control" name="srate[]" value="0" onChange="getsalerate('.$i.')"></td>';
		echo '<td><input type="text" id="stot'.$cnt.'" class="form-control" name="stot[]" value="0" readonly></td>';
		echo '</tr>';
		$cnt++;
		$i++;
	}
                
echo '</tbody></table>';

?>