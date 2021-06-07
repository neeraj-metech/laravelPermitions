


<?php 
include('../connection.php');

//APAMELA	BHIBBS	12-12-1990	8888 1404 N PARK AVE	OK	74801


$stateJson = file_get_contents('https://cdn-api.co-vin.in/api/v2/admin/location/states');
$stateArr = json_decode($stateJson,true);
if (isset($_POST['zip_submit']) || isset($_POST['district_submit'])) {
	$pincode = isset($_POST['zip_code']) ? $_POST['zip_code'] : '';
	$todays     = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	if ($_POST['date']=='') {
		$date = date("d-m-Y", $todays);
	}else{
		$date = date('d-m-Y',strtotime($_POST['date']));
	}

	$district_id = isset($_POST['district']) ? $_POST['district'] : '';
	$Age = isset($_POST['age']) ? $_POST['age'] : '';



	if ($pincode!='') {
		$dataJson = file_get_contents('https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByPin?pincode='.$pincode.'&date='.$date);
	}else if($district_id!=''){
		$dataJson = file_get_contents('https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByDistrict?district_id='.$district_id.'&date='.$date);
	}
	if (isset($dataJson)) {
		$dataArr = json_decode($dataJson,true);
		$data = $dataArr['centers'];

		echo "<table border='0'><thead>
			<tr>
				<th>Center Id</th>
				<th>Center Name</th>
				<th>Center Address</th>
				<th>Paid/Free</th>
				<th>Age</th>
				<th>Date</th>
				<th>Vaccine</th>
				<th>Dose1</th>
				<th>Dose2</th>
			</tr>
		</thead><tbody>";
		if (count($data) > 0) {
			$i=1;
			foreach ($data as $key => $value) {
				foreach ($value['sessions'] as $key2 => $value2) {
					if ($value2['min_age_limit'] == $Age && ($value2['available_capacity_dose1'] > 0 || $value2['available_capacity_dose2'] > 0)) {
						echo "<tr>
								<td>".$value['center_id']."</td>
								<td>".$value['name']."</td>
								<td>".$value['address'].", (".$value['block_name']."), ".$value['district_name']."</td>
								<td>".$value['fee_type']."</td>
								<td>".$value2['min_age_limit']."</td>
								<td>".$value2['date']."</td>
								<td>".$value2['vaccine']."</td>
								<td>".$value2['available_capacity_dose1']."</td>
								<td>".$value2['available_capacity_dose2']."</td>
							</tr>";
							$i++;
					}
				}
			}
		}else{
			echo "<tr><td colspan='9'>No Data Available!</td></tr>";
		}
		if ($i==1) {
			echo "<tr><td colspan='9'>No Data Available!</td></tr>";
		}
		echo "</body></table>";
	}else{
		echo 'Invalid Request!';
	}
	echo "<br/><br/><br/><br/>";
	// echo '<pre>';
	// print_r($data);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>check vaccination center and slots availability </title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
table, th, td {
  border: 1px solid black;
  text-align: center;
}
</style>
<body>
	<form name="serach_by_zip" id="serach_by_zip" method="POST">
		<input type="text" name="zip_code" id="zip_code" placeholder="Enter zip code" value="201009" required>&nbsp;&nbsp;&nbsp;&nbsp; <input type="date" name="date" id="date"> <input type="radio" name="age" value="18" checked>18<input type="radio" name="age" value="45">45 &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="zip_submit" value="Search By Zip">
	</form>
	<form name="serach_by_zip" id="serach_by_zip" method="POST">
		<select name="state" id="state" required="">
			<option value="">Select State</option>
			<?php foreach ($stateArr['states'] as $key => $value) {
				$selectState='';
				if ($value['state_id']=='34') {
						$selectState = 'Selected="Selected"';
					}	
				echo "<option value=".$value['state_id']." ".$selectState.">".$value['state_name']."</option>";
			} ?>
		</select>
		<select name="district" id="district" required="">
			<option value="">Select District</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp; <input type="date" name="date" id="date"> <input type="radio" name="age" value="18" checked>18<input type="radio" name="age" value="45">45 &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="district_submit" value="Search By District">
	</form>

	<script>
		jQuery(document).ready(function(){
			var state_code = $('#state').val();
			loadDistrict(state_code,651);
		});
	  jQuery('#state').on('change',function(e){
		e.preventDefault();
		var stateCode = $(this).val();
		loadDistrict(stateCode);		
	  });

	  function loadDistrict(stateCode,selected=''){
	  	var districtOption = '<option value="">Select District</option>';
			jQuery.ajax({
				url:'https://cdn-api.co-vin.in/api/v2/admin/location/districts/'+stateCode,
				type:'get',
				// data:jQuery('#frmSubmit').serialize(),
				success:function(result){
					$.each(result.districts, function(index,value){
						var optSelect = '';
						if(selected!='' && value.district_id==selected){
							optSelect = 'selected="selected"';
						}
						districtOption += '<option value="'+value.district_id+'" '+optSelect+'>'+value.district_name+'</option>';
					});
					$('#district').html(districtOption);

				}
			});	
	  }
	  </script>
</body>
</html>

