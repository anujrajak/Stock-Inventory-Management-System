<?php 

require 'config.php';

$condition = "";

$conn = connection();
// echo $_POST['name']; die;
// if(isset($_POST['name']) && $_POST['name']!=""){
// 	$condition.=" and p.pro_name like '".$_POST['name']."%'";
// }
if(isset($_POST['cat']) && $_POST['cat']!=""){
	$condition.=" and p.pro_grpid = '".$_POST['cat']."'";
}
if(isset($_POST['firm']) && $_POST['firm']!=""){
	$condition.=" and p.pro_firmid = '".$_POST['firm']."'";
}
$sql = "SELECT * FROM product p inner join category c on c.cat_id=p.pro_grpid inner join type t on t.ty_id=p.pro_typeid inner join firm f on f.firm_id=p.pro_firmid
     WHERE 0=0 $condition ORDER BY cat_name ASC";
$data = $conn->query($sql);
$conn=null;
?>

<table class="table table-condensed table-hover table-bordered table-striped">
	<thead>
		<tr>
			<th><center>S. no.</center></th>
			<!-- <th><center>Name</center></th> -->
			<!-- <th><center>Description</center></th> -->
			<th><center>Firm</center></th>
			<th><center>Category</center></th>
			<th><center>Type</center></th>
			<th><center>Price</center></th>
			<th><center>CGST</center></th>
            <th><center>IGST</center></th>
            <th><center>SGST</center></th>
			<th><center>Quantity</center></th>
			<th><center>Status</center></th>
		</tr>
	</thead>
	<tbody style="color:black;">
		<?php $s=0;
		foreach ($data as $row){ $s++; ?>
		<tr>
			<td><center><?php echo $s; ?></center></td>
			<!-- <td><?php echo ucwords($row['pro_name']); ?></td> -->
			<!-- <td><?php echo ucwords($row['pro_des']); ?></td> -->
			<td><?php echo ucwords($row['firm_name']); ?></td>
			<td><?php echo ucwords($row['cat_name']); ?></td>
			<td><?php echo ucwords($row['ty_name']); ?></td>
			<td><?php echo ucwords($row['pro_price']); ?></td>
			<td><?php echo ucwords($row['cgst'])."%"; ?></td>
            <td><?php echo ucwords($row['igst'])."%"; ?></td>
            <td><?php echo ucwords($row['sgst'])."%"; ?></td>
			<td><?php echo ucwords($row['pro_qty']); ?></td>
			<td><?php
			if ($row['pro_qty'] > 0) {
				echo "Available";
			}else{
				echo "<span style='color:red;'>Out of stock</span>";
			}
			?></td>
		</tr>
		<?php   } ?>
	</tbody>
</table>