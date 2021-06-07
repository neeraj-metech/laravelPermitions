<?php 
include_once('connection.php');

if (isset($_POST['download_btn'])) {
	csv_download($conn);
}
#################### Trigger ####################
// DROP TRIGGER IF EXISTS `updateAmoun`;CREATE TRIGGER `updateAmoun` AFTER UPDATE ON `tab1` FOR EACH ROW BEGIN IF !(NEW.amount <=> OLD.amount) THEN INSERT INTO `tab2` SET `userid` = OLD.id, `amount` = (NEW.amount - OLD.amount); END IF; END 

#################### Trigger ####################

#################### Store procedures ####################
	// DROP PROCEDURE `getTab1`; CREATE DEFINER=`root`@`localhost` PROCEDURE `getTab1`(IN `type1` VARCHAR(20), IN `prefix1` VARCHAR(20), IN `suffix1` VARCHAR(20), IN `length1` INT, OUT `nextId1` VARCHAR(20)) NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER SELECT amount INTO nextId1 from `tab1` where `type` = type1

	$input1 = 'test';
	$input2 = '';
	$input3 = '';
	$input4 = '';
	/*
	in mysqli_stmt_bind_param() ssss = type of inputs

	i 	corresponding variable has type integer
	d 	corresponding variable has type double
	s 	corresponding variable has type string
	b 	corresponding variable is a blob and will be sent in packets

	*/

	$call = mysqli_prepare($conn, 'CALL getTab1(?, ?, ?, ?, @myoutput)');
	mysqli_stmt_bind_param($call, 'ssss', $input1, $input2, $input3, $input4);
	mysqli_stmt_execute($call);
	$select = mysqli_query($conn, 'SELECT @myoutput');
	$result = mysqli_fetch_assoc($select);
	$procOutput_sum     = $result['@myoutput'];
#################### Store procedures ####################


#################### Store Functions ####################
	// DELIMITER $$
	// DROP FUNCTION if EXISTS `myfunction` $$
	// CREATE FUNCTION myfunction(user_id varchar(20)) RETURNS varchar(20)
	// DETERMINISTIC
	// BEGIN
	// DECLARE xyz varchar(20);
	// SELECT amount INTO xyz FROM tab1 where id=user_id;
	// RETURN (xyz);
	// END$$
	// DELIMITER ;

	$sql = 'SELECT *,myfunction(userid) as tab1_amount FROM tab2';
	$query = mysqli_query($conn,$sql);
	while ($rows = mysqli_fetch_assoc($query)) {
		$data[] = $rows;
	}
#################### Store Functions ####################


#################### TRANSACTION ####################
		// mysqli_query($conn,"BEGIN");
		// $sql = 'INSERT INTO tab1 set amount=150,type="new",code="new001" ';
		// $ins = mysqli_query($conn,$sql);

		// $sql2 = 'INSERT INTO tab1 set amount=200,type="new",code="new002" ';
		// $ins2 = mysqli_query($conn,$sql2);

		// if ($ins && $ins2 ) {
		// 	mysqli_query($conn,"COMMIT");
			
		// }else{
		// 	mysqli_query($conn,"ROLLBACK");
		// 	echo 'rollback entry';
		// }
	
#################### TRANSACTION ####################


#################### download CSV ####################
	// mysqli_options($con, MYSQLI_OPT_LOCAL_INFILE, true);
		// $sql = "SELECT 'Id', 'Amount', 'type', 'Code' UNION ALL SELECT id,amount,type,IFNULL(code,'N/A') FROM tab1 INTO OUTFILE 'C:/xampp/htdocs/employee_backup.csv' FIELDS ENCLOSED BY '' TERMINATED BY ',' ESCAPED BY '' LINES TERMINATED BY '\r\n' ";
		// mysqli_query($conn,$sql);
#################### download CSV ####################

// FOR UPLOADING CSV USING SQL QUERY
#####################################################

// mysqli_options($conn, MYSQLI_OPT_LOCAL_INFILE, true);
// $sql = "LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/employee_backup.csv' INTO TABLE tab1 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES (`amount`,`amount`,`type`, `code`) ";
// mysqli_query($conn, $sql);

#####################################################


function csv_download($conn){
    $data = 'id,old,new,amount,userid,updated_date_time,tab1_amount'."\n";
	$sql = 'SELECT *,myfunction(userid) as tab1_amount FROM tab2';
	$query = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_array($query)) {
		// $data[] = $rows;
      	$data .= $row['id'].",".$row['old'].",".$row['new'].",".$row['amount'].",".$row['userid'].",".$row['updated_date_time'].",".$row['tab1_amount']."\n";
	}


    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="data.csv"');
    echo $data;
    die;
}

 ?>

<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test</title>
</head>
<body>
	<form action="" method="POST">
		<input type="submit" name="download_btn" id="download_btn" value="Download Csv">
	</form>
	<table border="1">
		<thead>
			<tr>
				<th>id</th>
				<th>old</th>
				<th>new</th>
				<th>amount</th>
				<th>userid</th>
				<th>updated_date_time</th>
				<th>tab1_amount</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($data as $key => $value) { ?>
					<tr>
						<td><?php echo $value['id'];?></td>
						<td><?php echo $value['old'];?></td>
						<td><?php echo $value['new'];?></td>
						<td><?php echo $value['amount'];?></td>
						<td><?php echo $value['userid'];?></td>
						<td><?php echo $value['updated_date_time'];?></td>
						<td><?php echo $value['tab1_amount'];?></td>
					</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
</html>