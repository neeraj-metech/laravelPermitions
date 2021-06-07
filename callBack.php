<?php 
include_once('connection.php');
$myArr = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14');
$i=1;
$j=1;
foreach ($myArr as $key => $value) {
    if ($i==1) {
        echo '----open<br/>';
    }
    echo $value.'<br/>';
    if ($i%4==0 || $j==count($myArr)) {
        echo '----close<br/>';
        $i=1;
    }else{
        $i++;
    }
    $j++;
}

$data = getEddEnrollIds(1);
echo "('" . implode("','", $data['enrollIds_explod']) . "')";


######################
$ebbEnrollIds = getEddEnrollIds(1);
if ($ebbEnrollIds['enroll_id_count'] > 1) {
	$addCondition = " OR enroll_id IN ('" . implode("','", $data['enrollIds_explod']) . "') ";
}else{
	$addCondition = " limit 1";
}
$Sql_Update_PendingOrder_Accountno = "update tbl_pending_order set ACCOUNT_NO = '435454' where fax_id = '54645' ".$addCondition." ";

######################






function getEddEnrollIds($enroll_id){
	global $conn;
	$response = array();
	$sql = 'SELECT * FROM tab2 WHERE id="'.$enroll_id.'" ';
	$query = mysqli_query($conn,$sql);
	if (mysqli_num_rows($query) > 0) {
		$parentData = mysqli_fetch_object($query);
		echo '<pre>';
		echo $parentData->content;
		print_r($parentData);
		die;
		$response['parent_enrollId'] = $parentData->userid;
		$sql2 = 'SELECT GROUP_CONCAT(id) as enroll_ids FROM tab2 WHERE userid="'.$parentData->userid.'" ';
		$query2 = mysqli_query($conn,$sql2);
		$enrollIds = mysqli_fetch_object($query2);
		$response['enrollIds'] = $enrollIds->enroll_ids;
		$response['enrollIds_explod'] = explode(',', $enrollIds->enroll_ids);
		$response['enroll_id_count'] = count($response['enrollIds_explod']);
		if ($parentData->userid==$enroll_id) {
			$sql = 'SELECT * FROM tab2 WHERE id !="'.$enroll_id.'" AND userid="'.$parentData->userid.'" ';
			$query = mysqli_query($conn,$sql);
			$response['child_enrollId'] = '';
			if (mysqli_num_rows($query) > 0) {
				$childData = mysqli_fetch_object($query);
				$response['child_enrollId'] = $childData->id;
			}
		}else{
			$response['child_enrollId'] = $enroll_id;
		}

	}

	return $response;
}







// add(1,4,'c');

function add($a,$b,$c=''){
	echo $a + $b;
	$d = $a + $b;
	if ($c!='') {
		$a = $b = "";
		add(1,$d);
		exit;
	}
	echo 9;
}

function rejectionFunction($enroll_id, $rejection_id, $rejected_by = '') {
	global $ln;
	$response = array();
	$enrollIds = array();
	$enrollIds[] = $enroll_id;
	$webenroll_info_sql    = 'Select * from tbl_webenroll_info where enroll_id="' . $enroll_id . '" limit 1';
	$webenroll_info_query  = mysql_query($webenroll_info_sql, $ln);
    $webenroll_info_result = mysql_fetch_object($webenroll_info_query);
	if ($webenroll_info_result->initial_chosen_enroll_type=='COMBO' && $webenroll_info_result->enrollment_type=='LIFELINE') {
		    $sql = 'SELECT * FROM tbl_webenrollment_detail WHERE enroll_id = "'.$enroll_id.'" LIMIT 1';
		    $query = mysql_query($sql,$ln);
		    if (mysql_num_rows($query) > 0) {
		      $parentData = mysql_fetch_object($query);
		      $sql2 = 'SELECT GROUP_CONCAT(enroll_id) as enroll_ids FROM tbl_webenrollment_detail WHERE ACCOUNT_NO = "'.$parentData->ACCOUNT_NO.'" ';
		      $query2 = mysql_query($sql2,$ln);
		      $Ids = mysql_fetch_object($query2);
		      $enrollIds = explode(',', $Ids->enroll_ids);
			}
		}
	$finalArr = array_unique($enrollIds);
	foreach ($finalArr as $key => $value) {
		$response = call_rejectionFunction($value, $rejection_id, $rejected_by);
	}
	return $response;
}
function call_rejectionFunction($enroll_id, $rejection_id, $rejected_by = '') {
    ################created by chandan singh on 31-01-2019##############################
    global $ln;
    ####################includes################################
    include_once GENERIC_FOLDER . "Notification/SMSEmailNotification/notification_function.php";
    include_once(GENERIC_FOLDER_CSR . "customerNotes/functions.php");
    ####################includes################################
    $log = $response = array();
    $isMultipleRejection = '0';
    $log['is_multi_rejection'] = 'N';
    $log['rejection_id_type'] = strtoupper(gettype($rejection_id));
    if ($rejected_by == '') {
        $rejected_by = $_SESSION[PROJECT_SESSION_USER];
    }
    if (gettype($rejection_id) == 'array') {
        $isMultipleRejection = 1;
        $rejection_arr = $rejection_id;
        $rejection_id = $rejection_id[0];
        $log['is_multi_rejection'] = 'Y';
    }

    $is_disconnection_form = "";
    $request = func_get_args();
    $sql = "select enroll_id,source,order_completed,id, f_name,l_name,company_id,email,primary_phone from tbl_pending_order where enroll_id = '$enroll_id'";
    $result = mysql_fetch_object(mysql_query($sql, $ln));
    $source = $result->source;
    if ($result->order_completed == "Y") {
        $response['msg_code'] = "REJECT01";
        $response['msg'] = "This order is already approved";
        $log['response'] = $response;
        $log_id = API_Resquest_Response_log('', json_encode($log), 'ORDER_REJECTION', 'Review', json_encode($request), $enroll_id);
        $response['log_id'] = $log_id;
        return $response;
    }

    if ($rejection_id == '37') {
        $is_disconnection_form = ", is_disconnection_form='N'";
        $log['is_disconnection_form'] = 'UPDATED';
    }

    if ($rejection_id > 0) {
        ############# Multiple Rejection Start #############
        if ($isMultipleRejection == 1) {
            $rejection_times = 1;
            $sql_rejection_time = "Select max(rejection_times) as rejectionTime from tbl_customer_rejections WHERE enroll_id= '" . $enroll_id . "' limit 1";
            $query_rejection_time = mysql_query($sql_rejection_time, $ln);
            $num_rows_rejection_time = mysql_num_rows($query_rejection_time);
            if ($num_rows_rejection_time > 0) {
                $data_rejection_time = mysql_fetch_assoc($query_rejection_time);
                $rejection_times = $data_rejection_time['rejectionTime'] + 1;

                $log['rejectionTime_last_count'] = $data_rejection_time['rejectionTime'];
                $log['rejectionTime_latest_count'] = $rejection_times;
            }
            $log['rejectionTime_query'] = $sql_rejection_time;

            foreach ($rejection_arr as $key => $value) {
                $sql_insert_multi_rejection = "insert into tbl_customer_rejections set enroll_id = '" . $enroll_id . "', customer_rejections = '" . $value . "', rejection_times='" . $rejection_times . "' ";
                mysql_query($sql_insert_multi_rejection, $ln);
            }
        }
        ############# Multiple Rejection End #############

        $sql_update_pending = "update tbl_pending_order set rejectionID = '$rejection_id' ,rejected_by='" . $rejected_by . "', rejection_datetime = NOW()  $is_disconnection_form  where enroll_id = '$enroll_id' limit 1";
        $sql_webenrollment = "update tbl_webenrollment_detail set cust_status ='Rejected',rejection_id='$rejection_id' ,rejected_by='" . $rejected_by . "',  rejection_datetime = NOW() where enroll_id = '$enroll_id' limit 1";

        $response['msg'] = "Order successfully rejected.";
        $data_note['customer_notes'] = 'Order successfully rejected due to ' . getRejectionDesc($rejection_id);
        $response['rejection_removed'] = "N";
    } else {
        $sql_update_pending = "update tbl_pending_order set rejectionID='$rejection_id' where enroll_id = '$enroll_id' limit 1";
        $sql_webenrollment = "update tbl_webenrollment_detail set cust_status ='New',rejection_id='$rejection_id' where enroll_id='$enroll_id' limit 1";

        $response['msg'] = "Rejection successfully removed.";
        $data_note['customer_notes'] = 'Rejection successfully removed';
        $response['rejection_removed'] = "Y";
    }

    $log['tbl_pending_order'] = $sql_update_pending;
    $log['tbl_webenrollment_detail'] = $sql_webenrollment;
    if (mysql_query($sql_update_pending, $ln)) {
        $value = 'rejection_datetime=NOW() , rejected_by="' . $rejected_by . '"';
        activation_activity_log($enroll_id, $value);
        $log['tbl_pending_order'] = "tbl_pending_order Updated successfully.($sql_update_pending)";
    }
    if (mysql_query($sql_webenrollment, $ln)) {
        $value = 'disconnection_datetime=NOW(), disconnection_by="' . $rejected_by . '"';
        activation_activity_log($enroll_id, $value);
        $log['tbl_webenrollment_detail'] = "tbl_webenrollment_detail Updated successfully.($sql_webenrollment)";
    }
    /*
      // Code Commented because "tbl_pending_order_rejection_log" did not find in DB same code was in old rejection function.
      $query_log = "insert into tbl_pending_order_rejection_log set enroll_id = '".$enroll_id."', pending_order_id = '".$result->id."', rejectionID = '".$rejection_id."', rejected_by = '".$_SESSION[PROJECT_SESSION_USER]."', rejected_datetime = now()";   // insertRejectionLog function
      $log['tbl_pending_order_rejection_log'] = $query_log;
      if(mysql_query($query_log, $ln))
      {
      $log['tbl_pending_order_rejection_log'] = "tbl_pending_order_rejection_log Updated successfully.($query_log)";
      }
     */

    if ($source == 'tablet') {
        if ($rejection_id > 0) {
            #################Include Tablet functions###################
            include_once GENERIC_FOLDER . "common/JSON.class.php";
            include_once GENERIC_FOLDER . "common/JSON.php";
            require_once GLOBALPATH . "config/tablet_constant.php";
            $module = "review";
            $action = "tablet_functions";
            include(GENERIC_FOLDER_ACTIVATION . 'index.php');
            ############################################################
            $objWebEn = $web_ln;
            notificationSentToTablet($source, $enroll_id, 'Rejected', $rejection_id);
        }
    }

    ####### Start Add GenericInsert Notification function######
    if ($rejection_id > 0) {
        $company_id = $result->company_id;
        $enrll_id = $enroll_id;
        $first_name = $result->f_name;
        $last_name = $result->l_name;
        $primary_phone = '';
        $customer_email = $result->email;
        $templateVariables = array('%FIRST_NAME%' => $first_name, '%LAST_NAME%' => $last_name, '%ENROLLMENT_ID%' => $enrll_id, '%ENROLLMENT_STATUS%' => 'Rejected', '%TRACKING_NO%' => '', '%REJECT_RESON%' => $rejection_id);

        if (strtoupper($source) == 'WEBSITE') {
            $idProof_caterogies = array("3", "23", "24", "26", "27", "28", "29", "35", "47", "55", "57", "58", "59", "63", "65", "69", "71", "76", "77", "81", "82", "83", "84", "85", "86", "87", "95", "96", "97", "98", "109", "110", "111", "112", "113", "114", "119", "53", "54", "38", "39", "91", "92", "88", "67", "9", "19", "60", "6");
            if (in_array($rejection_id, $idProof_caterogies)) {
                $return = GenericInsertNotification($company_id, $customer_id, 'WEBSITE_ENROLLMENT_REJECT_DUE_TO_PROOF', $customer_email, $primary_phone, '', $templateVariables);
                $log['GenericInsertNotification'] = "GenericInsertNotification Parameters - " . ("$company_id, $customer_id, 'WEBSITE_ENROLLMENT_REJECT_DUE_TO_PROOF', $customer_email, $primary_phone, '', " . json_encode($templateVariables));
            } else {
                $return = GenericInsertNotification($company_id, $customer_id, 'WEBSITE_ENROLLMENT_STATUS_REJECT', $customer_email, $primary_phone, '', $templateVariables);
                $log['GenericInsertNotification'] = "GenericInsertNotification Parameters - " . ("$company_id, $customer_id, 'WEBSITE_ENROLLMENT_STATUS_REJECT', $customer_email, $primary_phone, '', " . json_encode($templateVariables));
            }
        } else {
            $return = GenericInsertNotification($company_id, $customer_id, 'ENROLLMENT_STATUS_REJECT', $customer_email, $primary_phone, '', $templateVariables);
            $log['GenericInsertNotification'] = "GenericInsertNotification Parameters - " . ("$company_id, $customer_id, 'ENROLLMENT_STATUS_REJECT', $customer_email, $primary_phone, '', " . json_encode($templateVariables));
        }

        $log['GenericInsertNotification_return'] = $return;
    }
    ##############################End#########################
    ############################Add_customer_activity#########
    $data_note['enrollment_id'] = $enroll_id;
    $data_note['postedby'] = $rejected_by;

    $data_note['activity_type'] = 'Order Rejection';
    $data_note['source'] = $source;
    $data_note['is_customer_activity'] = 1;
    $addNotes_Genric_return = addNotes_Genric($data_note);
    $log['addNotes_Genric_data_notes'] = $data_note;
    $log['addNotes_Genric_return'] = $addNotes_Genric_return;
    ############################Add_customer_activity#########

    $response['msg_code'] = "REJECT00";
    $log['response'] = $response;
    $log_id = API_Resquest_Response_log('', json_encode($log), 'ORDER_REJECTION', 'Review', json_encode($request), $enroll_id);
    $response['log_id'] = $log_id;
    return json_encode($response);
}
 ?>