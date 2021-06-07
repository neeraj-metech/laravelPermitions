<?php 
include_once('connection.php');

$sql = "SELECT product_id,product_name,product_code,sku FROM sht_products where is_bundle_product =0";
$query = mysqli_query($conn,$sql);
$num = mysqli_num_rows($query);
$allData = [];
while ($row = mysqli_fetch_assoc($query)) {
	$row['parent_sku'] = '';
	$allData[] = $row;
	$sql2 = "SELECT product_id,product_name,product_code,sku FROM sht_products where bundle_product_data like '%".$row['sku']."%' ";
	$query2 = mysqli_query($conn,$sql2);
	while ($row2 = mysqli_fetch_assoc($query2)) {
		$row2['parent_sku'] = $row['sku'];
		$allData[] = $row2;
	}
}
?>

<table borer='1'>
	<thead>
		<tr>
			<th>Product id</th>
			<th>Product Name</th>
			<th>Product Code</th>
			<th>SKU</th>
			<th>Parent SKU</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($allData as $key => $value) {?>
			<tr>
				<td><?php echo $value['product_id'];?></td>
				<td><?php echo $value['product_name'];?></td>
				<td><?php echo $value['product_code'];?></td>
				<td><?php echo $value['sku'];?></td>
				<td><?php echo $value['parent_sku'];?></td>
			</tr>		
		<?php } ?>
	</tbody>
</table>