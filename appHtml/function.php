<?php

###################################################################Application Form Functions#################################################################################

define('DBNAME', 'telecom');
define('LOGO', '/home/generic/images/usec_logo.jpg');
define('GENERIC_PATH', '');
define('CHECK_IMAGE', 'budget.png');
define('COMPANY_DETAILS', 'Mail the form to this address: USAC Emergency Broadband Support Center P.O. Box 7081 London, KY 40742');



$FromfilepathTBSig = 'Electronically Signed by <b>Neeraj kumar</b>';
$regMonthElect  = 'May';
$regDateElect = '12';
$regYearElect = '2021';
$agent_f_name = 'Devteam';

$initionals = 'NK';
$fname = 'Neeraj';
$middlename = '';
$suffix_name ="Mr.";
$lastname = 'Kumar';
$phone_number = '9712345678';
$birthdate = '14-05-1995';
$email_address = 'email@test.com';
$ssn_number = '1234';
$address_main ='102 Mail street';
$address_sec = '102 St';
$city = 'Oklama';
$state ='OK';
$zipcode ='97466';

$ben_fname  = 'Neeraj';
$ben_lastname  = 'Kumar';
$ben_middlename ='';
$ben_suffix_name ='Mr.';
$beni_tribal_id ='12';
//$programArr = array('SNAP::OKSNAP::SSI::MEDIC::OKMCAID::FPHA::FPH::SEC8::VPSBP::BIAGA::BIA::TRGA::TANF::TATAN::FDP::FDPIR::TFDP::TRIBAL::HEADS::HST');
$participate_program = 'SNAP::OKSNAP::SSI::MEDIC::VPSBP::BIAGA::TRGA::TANF::TATAN::FDP::FDPIR::TFDP::TRIBAL::HEADS::HST'; 
$is_household  = 'Y';
$household = '8';

$ben_ssn  = '2222';
$beni_dob  ="14-05-1995";
$reg_date = '10-02-1998';
$d_address_main  ='102 Mail street';
$d_address_sec  = '102 st';
$d_city = 'Oklama';
$d_state ='OK';
$d_zipcode ='201009';

$address_type = 'T';
$company_id = '2';

function footer($i, $ourof = NULL, $type = NULL) {
    if ($ourof == NULL) {
        $ourof = '8';
    }
    if ($type == 'Recertification') {
        $url = 'www.usac.org';
    } else {
        $url = 'www.lifelinesupport.org';
    }
    return $foot = '<tr>
            <td valign="top" >
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td valign="top" style="font-size:12pt; color:#39C; text-align:left" width="341"> Page ' . $i . ' of ' . $ourof . ' </td>
                        <td valign="top" width="158">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td width="600"  valign="top"  style="font-size:12pt; color:#ccc; text-align:right">
                            <span style="font-size:12pt; color:#39C; text-align:right">Universal Service Administrative Company | ' . $url . '</span><br />
                            <span style="font-size:12pt; color:#999; text-align:right">Need help? Call the Lifeline Support Center at 1-800-234-9473</span></td>
                    </tr>
                </table>
            </td>
        </tr>';
}

function header1($type = NULL) {
    if ($type == 'HOUSEHOLD') {
        $form_type = "Household Worksheet";
        $code      = "5631";
    } else if ($type == 'Recertification') {
        $form_type = "Annual Recertification Form";
        $code      = "5630";
    } else {
        $form_type = "Application Form";
        $code      = '5629';
    }

    return $heder = '<thead>
			<tr>
				<td>
					<table width="100%" border="0" cellpadding="0" cellspacing="">
						<tr>
							<td valign="top" width="300" align="left">FCC FORM ' . $code . '</td>
							<td valign="top"width="400"><table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								</tr>
								</table>
							</td>
							<td valign="top"width="300" align="right"><span style="text-align:right; font-size:10pt;"><b>OMB APPROVAL EDITION 3060-0819</b></span></td>
						</tr>
						<tr>
							<td valign="top" width="450" align="left"><span style="color:#009ada; font-size:30px; font-weight:600">Lifeline Program</span><br/><strong style="color:#009ada; font-size:30px; font-weight:bold; margin-bottom:5px;">' . $form_type . '</strong></td>
							<td valign="top"width="250">&nbsp;</td>
							<td valign="top"width="300" align="right"><img src="' . LOGO . '" width="357" height="83" /></td>
						</tr>
						<tr>
							<td colspan="3"></td>
						</tr>
					</table>
				</td>
			</tr>
			</thead>';
}

function empty_box($str, $count, $max) {
    for ($i = $count; $i <= $max; $i++) {
        $str .= '<td valign="middle" align="center" style="border:1px solid #ccc; padding:4px; height:35px; line-height:35px; width:27px">&nbsp;</td>';
    }
    return $str;
}

function dynamic_box($str, $max, $type) {
    if ($type == 'ssn') {
        $str = substr($str, -4);
    }
    if ($type == 'd_address_main') {
        $str = strtoupper($str);
    }

    if ($type == 'phone_number') {
        $str = str_replace("-", "", $str);
    }

    if ($type == 'address_sec' || $type == 'd_address_sec') {
        $str = str_replace(" ", "", $str);
    }

    $final_str = "";
    $i         = 0;
    if ($type == 'dob') {
        if ($str != '') {
            $str = date("m-d-Y", strtotime($str));
        } else {
            $str = "";
        }
    }
    $arr       = str_split($str);
    $count_str = count($arr);
    $filled_str = '';

    if ($type == 'phone_number' || $type == 'dob') {
        if ($count_str > 1) {
            foreach ($arr as $strval) {
                if ($i > $max) {
                    break;
                }
                if ($strval == '-') {
                    $filled_str .= '<td valign="middle" style=" padding:4px; height:27px; width:27px; background-color:#fff;">&nbsp;</td>';
                } else {
                    if (($type == 'phone_number' && ($i == '3' || $i == '6')) || ($type == 'dob' && ($i == '2' || $i == '5'))) {
                        $filled_str .= '<td valign="middle" style=" padding:4px; height:27px; width:27px; background-color:#fff;">&nbsp;</td>';
                    }
                    $filled_str .= '<td valign="middle" style="border:1px solid #ccc; padding:4px; height:35px; width:27px; background-color:#fff;">' . $strval . '</td>';
                }
                $i++;
            }
        } else {
            for ($i = 0; $i < 12; $i++) {
                if (($type == 'phone_number' && ($i == '3' || $i == '6')) || ($type == 'dob' && ($i == '2' || $i == '5'))) {
                    $filled_str .= '<td valign="middle" style=" padding:4px; height:27px; width:27px">&nbsp;</td>';
                } else {
                    if ($type == 'dob' && $i > 9) {
                        break;
                    }
                    $filled_str .= '<td valign="middle" style="border:1px solid #ccc; padding:4px; height:35px; width:27px; background-color:#fff;">&nbsp;</td>';
                }
            }
        }
        $final_str = $filled_str;
    } else if ($type == 'email2') {

        if ($count_str > $max) {
            $j = 0;
            for ($i = $max + 1; $i < $count_str; $i++) {
                $filled_str .= '<td valign="middle" align="center" style="border:1px solid #ccc; padding:4px; height:35px; line-height:35px; width:27px">' . $arr[$i] . '</td>';
                $j++;
            }
            $final_str = empty_box($filled_str, $j, 25);
        } else {
            $final_str = empty_box($filled_str, 0, 25);
        }
    } else {
        foreach ($arr as $strval) {
            if ($i > $max) {
                break;
            }

            if (($type == 'address_sec' || $type == 'd_address_sec') && (count($arr) > 5)) {

                $max = count($arr) - 1;
                if ($i > count($arr)) {
                    break;
                }

                if ($i > 5) {
                    $filled_str .= '<td valign="middle" align="center" style="padding:4px; height:35px; line-height:35px; width:27px">' . $strval . '</td>';
                } else {
                    $filled_str .= '<td valign="middle" align="center" style="border:1px solid #ccc; padding:4px; height:35px; line-height:35px; width:27px">' . $strval . '</td>';
                }
            } else {
                if (($type == 'address_sec' || $type == 'd_address_sec')) {
                    $max = 5;
                }
                $filled_str .= '<td valign="middle" align="center" style="border:1px solid #ccc; padding:4px; height:35px; line-height:35px; width:27px">' . $strval . '</td>';
            }
            $i++;
        }


        $final_str = empty_box($filled_str, $count_str, $max);
    }


    return $final_str;
}

function address_type($address_type) {
    if ($address_type == "T") {
        $add_type = '<td valign="middle"><img style="width:20px; height:20px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" /> Yes&nbsp;&nbsp;</td>
                <td valign="middle"><img style="width:20px; height:20px;" src="' . GENERIC_PATH . 'images/c_no.png" /> No</td>';
    } else {
        $add_type = '<td valign="middle"><img style="width:20px; height:20px;" src="' . GENERIC_PATH . 'images/c_no.png" /> Yes</td>
                <td valign="middle"><img style="width:20px; height:20px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" /> No</td>';
    }
    return $add_type;
}

function tribal_land($zip_code, $company_id) {
    // global $con;
    // $getIsTribalStr = "SELECT is_tribal FROM " . DBNAME . ".tbl_service_avail where zip_code='" . trim($zip_code) . "' AND status = 'Y' AND company_id = '" . $company_id . "'";
    // $getIsTribalqry = mysql_query($getIsTribalStr, $con);
    // if ($getIsTribalCT  = mysql_num_rows($getIsTribalqry)) {
    //     $getIsTribalRS = mysql_fetch_object($getIsTribalqry);
    //     $getIsTribal   = $getIsTribalRS->is_tribal;
    // }
    // if ($getIsTribal == 'Y' || $getIsTribal == 'S') {
    //     $is_tribal = '<td valign="middle"><img style="width:20px; height:20px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" /></td>';
    // } else {
    //     $is_tribal = '<td valign="middle"><img style="width:20px; height:20px;" src="' . GENERIC_PATH . 'images/c_no.png" /></td>';
    // }

    return '<td valign="middle"><img style="width:20px; height:20px;" src="' . GENERIC_PATH . 'images/c_no.png" /></td>';
}

function programmes($participate_program, $tribal_show, $isTX = '') {
    $program = explode("::", $participate_program);
    $program = array_map('trim', $program);
    $program = array_map('strtoupper', $program);
    if (in_array('SNAP', $program) || in_array('OKSNAP', $program))
        $SNAP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $SNAP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('SSI', $program))
        $SSI = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $SSI = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('MEDIC', $program) || in_array('OKMCAID', $program))
        $MEDIC = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $MEDIC = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('FPHA', $program) || in_array('FPH', $program) || in_array('SEC8', $program))
        $FPH = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $FPH = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('VPSBP', $program))
        $VPSBP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $VPSBP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('BIAGA', $program) || in_array('BIA', $program) || in_array('TRGA', $program))
        $BIAGA = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $BIAGA = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('TANF', $program) || in_array('TATAN', $program))
        $TANF = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $TANF = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('FDP', $program) || in_array('FDPIR', $program) || in_array('TFDP', $program))
        $FDP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $FDP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('TRIBAL', $program) || in_array('HEADS', $program) || in_array('HST', $program))
        $TRIBAL = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $TRIBAL = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if ($isTX == 'YES') {
        $data = '<tr><td colspan="2" valign="top"><strong>Check all programs that you or someone in your household have:</strong></td></tr>
				<tr><td valign="top" width="50%" height="20">' . $SNAP . 'Supplemental Nutrition Assistance Program (SNAP) (Food Stamps)</td>
				<td valign="top" width="50%">' . $SSI . 'Supplemental Security Income (SSI)</td></tr>
				<tr><td valign="top" width="50%" height="20">' . $MEDIC . 'Medicaid (includes CHIP) </td><td valign="top" width="50%">' . $FPH . 'Federal Public Housing Assistance (FPHA)</td></tr>
				<tr><td valign="top" width="50%" height="20">' . $VPSBP . 'Veterans Pension or Survivors Benefit Programs</td><td valign="top" width="50%">&nbsp;</td></tr>
				<tr><td colspan="2" valign="top"><hr /></td></tr>
				<tr><td colspan="2"><strong>Tribal Specific Programs</strong></td></tr>
				<tr><td valign="top" width="50%" height="20">' . $BIAGA . 'Bureau of Indian Affairs (BIA) General Assistance</td><td valign="top" width="50%">' . $FDP . 'Food Distribution Program on Indian Reservations (FDPIR)</td></tr>
				<tr><td valign="top" width="50%" height="20">' . $TANF . 'Tribal Temporary Assistance for Needy Families (Tribal TANF) </td><td valign="top" width="50%">' . $TRIBAL . ' Tribal Head Start (only households that meet the income Qualifying standard) </td></tr><tr><td></td><td>&nbsp;</td></tr>';
    } else {

        if ($tribal_show == 'YES') {
            $data = '<tr><td valign="middle" style="font-weight:bold"><b>Check all programs that you or someone in your household have:</b></td></tr> <tr><td valign="middle" style="font-weight:normal">' . $SNAP . 'Supplemental Nutrition Assistance Program (SNAP) (Food Stamps)</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $SSI . 'Supplemental Security Income (SSI)</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $MEDIC . 'Medicaid</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $FPH . 'Federal Public Housing Assistance (FPHA)</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $VPSBP . 'Veterans Pension or Survivors Benefit Programs</td></tr>
					<tr><td valign="middle" style="font-weight:normal"></td></tr>
					<tr>
						<td valign="middle" style="font-weight:normal">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr><td colspan="2">&nbsp;</td></tr>
								<tr>
									<tr><td colspan="2">Tribal Specific Programs</td></tr>
									<tr><td width="5%"></td><td width="95%">' . $BIAGA . 'Bureau of Indian Affairs (BIA) General Assistance </td></tr>
									<tr><td></td><td>' . $TANF . 'Tribal Temporary Assistance for Needy Families (Tribal TANF) </td></tr>
									<tr><td></td><td>' . $FDP . 'Food Distribution Program on Indian Reservations (FDPIR) </td></tr>
									<tr><td></td><td>' . $TRIBAL . 'Tribal Head Start (only households that meet the income qualifying standard)</td></tr>
									<tr><td></td><td>&nbsp;</td></tr>
								</tr>
							</table>
						</td>
					</tr>';
        } else if (in_array('TANF', $program) || in_array('FDP', $program) || in_array('FDPIR', $program) || in_array('BIAGA', $program) || in_array('BIA', $program) || in_array('TRIBAL', $program)) {
            $data = '<tr><td valign="middle" style="font-weight:normal">' . $SNAP . 'Supplemental Nutrition Assistance Program (SNAP) (Food Stamps)</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $SSI . 'Supplemental Security Income (SSI)</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $MEDIC . 'Medicaid</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $FPH . 'Federal Public Housing Assistance (FPHA)</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $VPSBP . 'Veterans Pension or Survivors Benefit Programs</td></tr>
					<tr><td valign="middle" style="font-weight:normal"></td></tr>
					<tr>
						<td valign="middle" style="font-weight:normal">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr><td colspan="2">&nbsp;</td></tr>
								<tr>
									<tr><td colspan="2">Tribal Specific Programs</td></tr>
									<tr><td width="5%"></td><td width="95%">' . $BIAGA . 'Bureau of Indian Affairs (BIA) General Assistance </td></tr>
									<tr><td></td><td>' . $TANF . 'Tribal Temporary Assistance for Needy Families (Tribal TANF) </td></tr>
									<tr><td></td><td>' . $FDP . 'Food Distribution Program on Indian Reservations (FDPIR) </td></tr>
									<tr><td></td><td>' . $TRIBAL . 'Tribal Head Start (only households that meet the income qualifying standard)</td></tr>
									<tr><td></td><td>&nbsp;</td></tr>
								</tr>>
							</table>
						</td>
					</tr>';
        } else {
            $data = '<tr><td valign="middle" style="font-weight:normal">' . $SNAP . 'Supplemental Nutrition Assistance Program (SNAP) (Food Stamps)</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $SSI . 'Supplemental Security Income (SSI)</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $MEDIC . 'Medicaid</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $FPH . 'Federal Public Housing Assistance (FPHA)</td></tr>
					<tr><td valign="middle" style="font-weight:normal">' . $VPSBP . 'Veterans Pension or Survivors Benefit Programs</td></tr>
					<tr><td valign="middle" style="font-weight:normal"></td></tr>';
        }
    }
    return $data;
}

function CA_state_programmes($participate_program) {
    global $con;
    $final_str = "";
    $program   = explode("::", $participate_program);
    $program   = array_map('trim', $program);
    $program   = array_map('strtoupper', $program);
    $sql       = "select certi_abbrev from tbl_certification where state = 'CA'";
    $sql_res   = mysql_query($sql, $con);
    if (mysql_num_rows($sql_res) > 0) {
        $data = array();
        while ($row  = mysql_fetch_object($sql_res)) {
            if (in_array($row->certi_abbrev, $program)) {
                $data[$row->certi_abbrev] = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" >';
            } else {
                $data[$row->certi_abbrev] = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" >';
            }
        }
        extract($data);

        $final_str = '<td style="vertical-align: top;padding: 40px 0 0 0;">
						<table style="width:auto; margin:0 auto; padding:15px 0 0 51px;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="width:360px;">
									<table style="width:100%;">
										<tr><td style="width:20px;vertical-align: top;">' . $WIC . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Women, Infants, and Children Program (WIC)</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $CAMCAID . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Medicaid/Medi-Cal</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $SSI . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Supplemental Security Income (SSI)</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $CANSL . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">National School Lunch Program (NSLP)</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $CALIHEAP . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Low Income Home Energy Assistance Program (LIHEAP)</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $CASNAP . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">CalFresh, Food Stamps, or Supplemental Nutrition Assistance Program (SNAP)</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $CASEC8 . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Federal Public Housing Assistance or Section 8</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $VPSBP . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Federal Veterans and Survivors Pension Benefit Program</td>
										</tr>
									</table>
								</td>
								<td style="width:360px;" style="vertical-align:top;">
									<table style="width:100%;">
										<tr><td style="width:20px;vertical-align: top;">' . $CATRTANF . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Tribal TANF</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $CAHST . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Head Start Income Eligible (Tribal Only)</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $TRGA . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Bureau of Indian Affairs General Assistance</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $FDPIR . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Food Distribution Program on Indian Reservations (FDPIR)</td></tr>
										<tr><td style="width:20px;vertical-align: top;">' . $CAMISC . '</td><td style="width:330px;padding-bottom: 5px;padding-left: 5px;">Temporary Assistance for Needy Families (TANF), California Work Opportunity and Responsibility to Kids (CalWORKs), Stanislaus Work Opportunity and Responsibility to Kids (StanWORKs), Welfare-to-Work (WTW), or Greater Avenues for Independence (GAIN)</td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="padding-top:25px; padding-left:0px; padding-bottom:22px; width:100%;">
									<table style="width:100%;">
										<tr>
											<td style="width:630px; ">YOU MUST <b>MAIL A <font style="text-decoration:underline;">COPY</font> OF PROOF</b> OF PARTICIPATION IN A QUALIFYING PUBLIC ASSISTANCE PROGRAM WITH YOUR FORM. Check the <font style="font-style: italic;">Types of Proof</font> in the Eligibility Guidelines.</td>
											<td style="width:110px;"></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>';
    }
    return $final_str;
}

function CA_state_income($total_annual_income, $incomebased_no, $adults_household, $kids_household) {
    if ($incomebased_no == 0) {
        $incomebased_no = "";
    }
    if (strlen($incomebased_no) > 1) {
        $onces = $incomebased_no[1];
        $tens  = $incomebased_no[0];
    } else if (strlen($incomebased_no) == 1) {
        $onces = $incomebased_no;
        $tens  = 0;
    } else {
        $onces = '';
        $tens  = '';
    }

    if ($total_annual_income > 0) {
        $kids                = $kids_household;
        $total_annual_income = number_format($total_annual_income, 2, '.', ',');
        $incode_amount       = "$total_annual_income";
        $lenth               = strlen($incode_amount);
        $income              = '<td style="width:20px;font-weight: bold;font-style: italic;vertical-align: top;font-size:20pt;">$</td>';
        for ($i = 0; $i < $lenth; $i++) {
            if ($incode_amount[$i] == ',') {
                $income .= '<td style="width:10px;font-size:28px;color: #000;vertical-align: bottom;">,</td>';
            } else if ($incode_amount[$i] == '.') {
                $income .= '<td style="width:5px;font-size: 30px;vertical-align: bottom;">' . $incode_amount[$i] . '</td>';
            } else {
                $income .= '<td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;">' . $incode_amount[$i] . '</td>';
            }
        }
    } else {
        $kids   = '';
        $income = '<td style="width:20px;font-weight: bold;font-style: italic;vertical-align: top;font-size:20pt;">$</td>
		<td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td>
		<td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td>
		<td style="width:10px;font-size:28px;color: #000;vertical-align: bottom;">,</td>

		<td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td>
		<td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td>
		<td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td>
		<td style="width:5px;font-size: 30px;vertical-align: bottom;">.</td>
		<td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td>
		<td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td>';
    }
    $str = '<td style="vertical-align: top;padding: 0px 10px 0px 50px; vertical-align:top;">
			<table style="width:100%" cellpadding="0" cellspacing="0">
				<tr>
					<td style="padding-left: 0px;color: #000;padding-top:40px;height: 22px;">How many people (adults and kids) are in your household?</td>
				</tr>
				<tr>
					<td>
						<table  style="width:100%">
							<tr>
							<td style="width:150px; height:30px;">&nbsp;</td>
							<td style="width:140px; height:30px;">Adults (18 and over)</td>
							<td style="border:2px solid #ccc; height:30px; width:50px;text-align: center; font-size:15pt;">' . $adults_household . '</td>
							<td style="width:40px;color: #000;font-weight: bold; height:30px;font-size:25pt;">+</td>
							<td style="width:110px; height:30px;">Kids (under 18)</td>
							<td style="border:2px solid #ccc; height:30px; width:50px;text-align: center; font-size:15pt;">' . $kids . '</td>
							<td style="width:32px;font-size: 25px;color: #000;font-weight: bold;text-align: center; height:30px;">=</td>
							<td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;">' . $tens . '</td>
							<td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;">' . $onces . '</td>
							<td style="width:80px; height:30px;">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table  style="width:100%">
							<tr>
							<td style="padding:0px 0 0 0;color: #000;height:auto;width:399px;vertical-align: top;">
								<p style="width: 100%;margin: 0;padding: 0;">What is your household&rsquo;s total annual gross income? (Round to whole dollars.) </p>
								<p style="width: 100%;margin: 0;padding: 0;">Check the <font style="font-style: italic;">Income Calculator</font> in the Eligibility Guidelines.</p>
							</td>
							' . $income . '
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>';
    return $str;
}

function initionals($fname, $lastname) {
    $ini = strtoupper(substr($fname, 0, 1) . substr($lastname, 0, 1));
    return $ini;
}

/*
  function same_ben($same_ben,$source)
  {
  if(($same_ben == 'Y' || $same_ben == '1' || !isset($same_ben)) && (strtoupper($source) == 'TABLET_FASTTRACK' || strtoupper($source) == 'WEBSITE_FASTTRACK'))
  {
  $ben = '<img style="width:22px; height:22px;" src="'.GENERIC_PATH.'images/c_no.png" />&nbsp;';
  }
  else
  {
  $ben = '<img style="width:22px; height:22px;" src="'.GENERIC_PATH.'images/'.CHECK_IMAGE.'" />&nbsp;';
  }
  return $ben;
  }
 */

function same_ben($fname, $lastname, $ssn_number, $birthdate, $ben_fname, $ben_lastname, $ben_ssn, $beni_dob, $reg_date, $type) {
    $same_ben_flag = "";
    if ($ben_fname == '' && $ben_lastname == '' && $ben_ssn == '' && $beni_dob == '') {
        $same_ben_flag = 'Y';
    } else {
        if ((strtoupper($fname) == strtoupper($ben_fname)) && (strtoupper($lastname) == strtoupper($ben_lastname)) && (strtotime($birthdate) == strtotime($beni_dob)) && ($ssn_number == $ben_ssn)) {
            $same_ben_flag = 'Y';
        } else {
            if ($ben_fname != '' && $ben_lastname != '' && $ben_ssn != '' && $beni_dob != '') {
                $same_ben_flag = 'N';
            } else {
                if (date('Y-m-d', strtotime($reg_date)) <= date('2018-06-25')) {
                    $same_ben_flag = 'N';
                } else {
                    $same_ben_flag = 'Y';
                }
            }
        }
    }
    if ($type == 'flag') {
        $ben = $same_ben_flag;
    } else {
        if ($same_ben_flag == 'Y') {
            $ben = '<img style="width:22px; height:22px; " src="' . GENERIC_PATH . 'images/c_no.png" />';
        } else {
            $ben = '<img style="width:22px; height:22px; " src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />';
        }
    }
    return $ben;
}

function incomebase_amount($state, $incomebased_no, $flag = NULL) {

    global $con;
    $sql     = "select annual_income, persons_household_calculate, income_level, state from tbl_incomebased where state in ('$state', 'HI', 'AK')";
    $sql_res = mysql_query($sql, $con);
    if (mysql_num_rows($sql_res) > 0) {
        $arr_alaska   = array();
        $arr_hawaii   = array();
        $arr_current  = array();
        $key          = array();
        $j            = 1;
        $income_level = "";

        while ($rec_sh = mysql_fetch_object($sql_res)) {
            if ($flag == 'Percent' && $rec_sh->state == $state) {
                if ($incomebased_no == $j) {
                    return $rec_sh->income_level;
                    break;
                } else {
                    return "135";
                    exit;
                }
                $j++;
            }

            if ($rec_sh->state == $state) {
                $arr_current[] = $rec_sh->annual_income;
                $key[]         = $rec_sh->persons_household_calculate;
            } else if ($rec_sh->state == 'AK') {
                $arr_alaska[] = $rec_sh->annual_income;
            } else {
                $arr_hawaii[] = $rec_sh->annual_income;
                $income_level = $rec_sh->income_level;
            }
        }
    }

    $u_key = array_fill(0, count($arr_hawaii), array('arr_current', 'arr_alaska', 'arr_hawaii'));
    $users = array_combine($key, array_map('mymap_arrays', $u_key, $arr_current, $arr_alaska, $arr_hawaii));
    $i     = 1;

    foreach ($users as $val) {
        if ($i % 2 == 0) {
            $bg = 'bgcolor="#CCCCCC"';
        } else {
            $bg = '';
        }

        if ($i == '9') {
            $add = "Add ";
        } else {
            $add = "";
        }

        $data .= '<tr>
                              <td width="34%" valign="top" ' . $bg . ' height="29">' . $add . '$' . number_format($val["arr_current"], 0) . '</td>
                              <td width="18%" valign="top" ' . $bg . ' height="29">' . $add . '$' . number_format($val["arr_alaska"], 0) . '</td>
                              <td width="20%" valign="top" ' . $bg . ' height="29">' . $add . '$' . number_format($val["arr_hawaii"], 2) . '</td>';
        if ($i == $incomebased_no) {
            $data .= '<td width="13%" valign="top" ' . $bg . ' height="29"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />
                                <label for="checkbox"> Yes</label></td>';
            $data .= '<td width="15%" valign="top" ' . $bg . ' height="24"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/c_no.png" />
                                <label for="checkbox"> No</label></td>
                            </tr>';
        } else {
            $data .= '<td width="13%" valign="top" ' . $bg . ' height="29"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/c_no.png" />
                                <label for="checkbox"> Yes</label></td>';
            if ($incomebased_no > 0) {
                $data .= '<td width="15%" valign="top" ' . $bg . ' height="24"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />
                                <label for="checkbox"> No</label></td>
                            </tr>';
            } else {
                $data .= '<td width="15%" valign="top" ' . $bg . ' height="24"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/c_no.png" />
                                <label for="checkbox"> No</label></td>
                            </tr>';
            }
        }


        $i++;
    }

    return $data;
}

function mymap_arrays() {
    $args = func_get_args();
    $key  = array_shift($args);
    return array_combine($key, $args);
}

function incomebase_number($incomebased_no, $isTX = '') {
    $data  ='';
    if ($isTX == 'YES') {
        for ($i = 1; $i < 9; $i++) {
            if ($incomebased_no == $i) {
                $data .= '<td width="10%" align="center" valign="top" style=" border:1px solid #999">' . $i . '<br /><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;</td>';
            } else {
                $data .= '<td width="10%" align="center" valign="top" style=" border:1px solid #999">' . $i . '<br /><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;</td>';
            }
        }
    } else {
        for ($i = 1; $i < 10; $i++) {
            if ($i % 2 == 0) {
                $bg = 'bgcolor="#CCCCCC"';
            } else {
                $bg = '';
            }
            if ($incomebased_no == $i) {
                $data .= '<tr><td valign="top" ' . $bg . ' height="28"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;' . $i . '</td></tr>';
            } else if ($i == '9') {
                if ($incomebased_no > 8) {
                    $data .= '<tr>
								  <td valign="top" height="24"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;
									<span style="font-size:9pt"> If more than 8, add this
									  amount for each extra person:</span></td>
								</tr>';
                } else {
                    $data .= '<tr>
								  <td valign="top" height="24"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;
									<span style="font-size:9pt"> If more than 8, add this
									  amount for each extra person:</span></td>
								</tr>';
                }
            } else {
                $data .= '<tr><td valign="top" ' . $bg . ' height="28"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;' . $i . '</td></tr>';
            }
        }
    }

    return $data;
}

function way_reach($best_way_reach) {
    $str = explode(',', $best_way_reach);
    //print_r($str);
    //exit;
    $str = array_map('trim', $str);
    $str = array_map('strtoupper', $str);

    if (in_array('EMAIL', $str)) {
        $str_new .= '<td valign="top" width="25%"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;Email';
    } else {
        $str_new .= '<td valign="top" width="25%"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;Email';
    }
    if (in_array('PHONE', $str)) {
        $str_new .= '<td valign="top" width="21%"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;Phone';
    } else {
        $str_new .= '<td valign="top" width="21%"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;Phone';
    }

    if (in_array('TEXT MESSAGE', $str)) {
        $str_new .= '<td valign="top" width="29%"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;Text Message';
    } else {
        $str_new .= '<td valign="top" width="29%"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;Text Message';
    }

    if (in_array('MAIL', $str)) {
        $str_new .= '<td valign="top" width="25%"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;Mail';
    } else {
        $str_new .= '<td valign="top" width="25%"><img style="width:18px; height:18px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;Mail';
    }

    return $str_new;
}

function ne_other_details($enroll_id) {
    global $con;
    $sql     = "SELECT * FROM " . DBNAME . ".tbl_ne_other_detail WHERE enrollment_id ='" . $enroll_id . "'";
    $sql_res = mysql_query($sql, $con);
    if (mysql_num_rows($sql_res) > 0) {
        $rec_sh = mysql_fetch_object($sql_res);
        return $rec_sh;
    }
}

function ne_other_info($enroll_id, $info) {
    global $con;
    $response = array();
    if ($info == 'DETAILS') {
        $sql = "SELECT * FROM " . DBNAME . ".tbl_ne_other_detail WHERE enrollment_id ='" . $enroll_id . "'";
    } else {
        $sql = "SELECT * FROM " . DBNAME . ".tbl_ne_other_members WHERE enrollment_id ='" . $enroll_id . "'";
    }
    $sql_res = mysql_query($sql, $con);
    if (mysql_num_rows($sql_res) > 0) {
        if ($info == 'DETAILS') {
            $rec_sh = mysql_fetch_object($sql_res);
            return $rec_sh;
        } else {
            while ($rec_sh = mysql_fetch_object($sql_res)) {
                $households[] = $rec_sh;
            }
            return $households;
        }
    } else {
        $response[] = "No record found";
    }
}

function fill_spaces($len = 5) {
    $s = '';
    for ($l = 0; $l < $len; $l++) {
        $s .= '&nbsp;';
    }
    return $s;
}

#############################################################Application Form Functions#################################################################################
#############################################################Proof Functions#################################################################################

function encript_value($q) {
    $cryptKey = 'qJB0rGtIn7dsnbt3efyCp';
    $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
    return( $qEncoded );
}

function decript_value($q) {
    $cryptKey = 'qJB0rGtIn7dsnbt3efyCp';
    $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
    return( $qDecoded );
}

if (!function_exists('getKeyvalues')) {

    function getKeyvalues($encriptV, $sumKey) {
        foreach ($encriptV as $key => $val) {
            if ($sumKey == $key) {
                return $val;
            }
        }
    }

}

/*
  function removeSpecialChars($string) {
  return preg_replace('/[^A-Za-z0-9_/\]/', '', $string);
  }
 */

function removeSpecialChars($fields) {
    $arr = array("@", "$", "*", "&", "^", ":", ";", "!", "|", "`", "~", "'", "\"", "%", ",", "\\", "(", ")", "=", "+", "<", ">", "~", "{", "}", " ");
    $vl  = str_replace($arr, "", $fields);
    return trim($vl);
}

function generateOrUpdateFileName($oldFileUrl, $FaxID, $uploadId, $type) {
    global $con;
    $oldFileNameArr = explode("/", $oldFileUrl);
    if (count($oldFileNameArr) == 1) {
        $oldFileName = $oldFileNameArr[0];
    } else {
        $oldFileName = end($oldFileNameArr);
    }

    $fileName = removeSpecialChars($oldFileName);
    if ($fileName != $oldFileName) {
        unset($oldFileNameArr[count($oldFileNameArr) - 1]);
        $fileUrl = implode('/', $oldFileNameArr) . "/" . $fileName;
        if ($type == 'application') {
            $sql = "UPDATE " . DBNAME . ".tbl_fax SET fax_file_name = '" . $fileUrl . "' WHERE id='" . $FaxID . "' LIMIT 1";
        } else if ($type == 'household' || $type == 'proof' || $type == 'exhibit_pdf') {
            $sql = "UPDATE " . DBNAME . ".tbl_upload_file SET file_name = '" . $fileUrl . "' WHERE FaxID = '" . $FaxID . "' and id = '" . $uploadId . "'  LIMIT 1";
        }
        $execute_qry = mysql_query($sql, $con);
    }

    if (strtoupper($type) == 'PROOF') {
        if ($fileName == $oldFileName) {
            unset($oldFileNameArr[count($oldFileNameArr) - 1]);
        }

        $month_year = end($oldFileNameArr);
        return $month_year . "^#*" . $fileName;
    } else {
        return $fileName;
    }
}

function API_Resquest_Response_log($logid = "", $request = "", $response = "", $request_type = "", $enroll_id = "", $vendor_id = "", $status = "") {
    global $con;

    if ($logid > 0) {
        $sql = "update tbl_api_request_response set response='" . addslashes($response) . "' , date_time_response = NOW(), request_status = '$status' where id='$logid'";
        mysql_query($sql, $con);
    } else {
        $sql   = "insert into tbl_api_request_response set response='" . $response . "' , vendor_id='" . $vendor_id . "', request_type='" . $request_type . "', request='" . $request . "', date_time_request = NOW(),  enroll_id = '" . $enroll_id . "'";
        mysql_query($sql, $con);
        $logid = mysql_insert_id($con);
    }

    return $logid;
}

function getDecrypt($text, $lockID) {
    global $con, $arrayLoc, $arraySlt, $log_sign_abc;
    if ($text) {
        $locKey    = $saltKey   = $locKeyDb  = $saltKeyDb = $locKeyLn  = $saltKeyLn = '';

        $sqlConfig           = "select * from tbl_use_en WHERE id = '$lockID'";
        $queryConfig         = mysql_query($sqlConfig, $con);
        $log_sign_abc['abc'] = $sqlConfig;
        if (mysql_num_rows($queryConfig) > 0) {
            $resConfig = mysql_fetch_object($queryConfig);
            //print_r($resConfig);
            $locKeyDb  = $resConfig->loc;
            $saltKeyDb = $resConfig->slt;
        }

        $locKeyLn  = $arrayLoc[$lockID];
        $saltKeyLn = $arraySlt[$lockID];

        $log_sign_abc['locKeyLn']  = $locKeyLn;
        $log_sign_abc['saltKeyLn'] = $saltKeyLn;

        $locKey  = $locKeyDb . $locKeyLn;
        $saltKey = $saltKeyDb . $saltKeyLn;

        $log_sign_abc['locKey']     = $locKey;
        $log_sign_abc['saltKey']    = $saltKey;
        $log_sign_abc['decryption'] = trim(@mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $saltKey, base64_decode(urldecode($text)), MCRYPT_MODE_ECB, $locKey));

        return trim(@mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $saltKey, base64_decode(urldecode($text)), MCRYPT_MODE_ECB, $locKey));
    } else {
        return;
    }
}

function getDecrypt_agent($val) {
    global $log_sign_abc;
    $val_decript                 = @base64_decode($val);
    $log_sign_abc['val_decript'] = $val_decript;
    $valRev                      = @strrev($val_decript);
    $log_sign_abc['valRev']      = $valRev;
    $arrOriginal                 = @explode('TSI', $valRev);
    $log_sign_abc['arrOriginal'] = $arrOriginal;
    $log_sign_abc['count']       = count($arrOriginal);

    if ($arrOriginal[0] == '') {
        return "TSI" . $arrOriginal[1];
    } elseif (count($arrOriginal) > 2 && $arrOriginal[0] != '' && trim($arrOriginal[1]) != '') {
        return $arrOriginal[0] . "TSI" . $arrOriginal[1];
    } else {
        return $arrOriginal[0];
    }
}

function create_sign_new($fax_id) {
    global $con;
    $sqluploadFileFax = mysql_query("select enroll_id from " . DBNAME . ".tbl_fax where id ='$fax_id'", $con);
    $recFileUpFax     = mysql_fetch_object($sqluploadFileFax);
    $enroll_id        = $recFileUpFax->enroll_id;
    $sqlCustomer      = "SELECT signature FROM " . DBNAME . ".tbl_customer_sign where enroll_id='" . $enroll_id . "' and is_status='Y' order by id desc limit 1";
    $query_Customer   = mysql_query($sqlCustomer, $con);
    if (mysql_num_rows($query_Customer) > 0) {
        $result_Customer = mysql_fetch_object($query_Customer);
        $data            = getDecrypt_agent($result_Customer->signature);
        $sign_arr        = explode('data:image/png;base64,', $data);
        $data            = $sign_arr[1];
        $im              = imagecreatefromstring(base64_decode($data));
        if ($im !== false) {
            $fileName          = SIGN_PATH . "sign_" . $enroll_id . '_' . time() . ".png";
            imagealphablending($im, false);
            imagesavealpha($im, true);
            $resp              = imagepng($im, $fileName);
            $FromfilepathTBSig = $fileName;
        }
    }
    return $FromfilepathTBSig;
}

function androidCreateSignRC($enroll_id) {
    global $con;

    //For Infinity and nal

    $sqlSign   = "select * from tbl_customer_sign where enroll_id='$enroll_id' and is_status='Y' order by id desc";
    $querySign = mysql_query($sqlSign, $global_backend);
    $recSign   = mysql_fetch_object($querySign);
    $data      = $recSign->signature;
    $data      = base64_decode($data);
    $im        = imagecreatefromstring($data);

    if ($im !== false) {
        $fileName          = ENROLLPDFPHYSICALPATHROOTSIG . "sign_android_" . $enroll_id . ".png";
        imagealphablending($im, false); // setting alpha blending on
        imagesavealpha($im, true); // save alphablending setting (important)
        $resp              = imagepng($im, $fileName);
        $FromfilepathTBSig = $fileName;

        if (file_exists($FromfilepathTBSig)) {
            return $FromfilepathTBSig;
        } else
            return '';
    }
    else {
        return false;
    }
}

function create_sign_terracomWebsite($fax_id) {
    global $con;
    $sqluploadFileFax = mysql_query("select enroll_id from " . DBNAME . ".tbl_fax where id ='$fax_id'", $con);
    $recFileUpFax     = mysql_fetch_object($sqluploadFileFax);
    $enroll_id        = $recFileUpFax->enroll_id;
    $sqlCustomer      = "SELECT signature FROM `tbl_customer_enrollsign` where enroll_id='" . $enroll_id . "' and is_status='Y' order by id desc limit 1";
    $query_Customer   = mysql_query($sqlCustomer, $con);
    if (mysql_num_rows($query_Customer) > 0) {
        $result_Customer             = mysql_fetch_object($query_Customer);
        $Customersignature_file_name = getDecrypt($result_Customer->signature, LOCK_ID_3);
        $data                        = $Customersignature_file_name;
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data                        = base64_decode($data);
        $im                          = imagecreatefromstring($data);
        if ($im !== false) {
            $fileName          = SIGN_PATH . "sign_" . $enroll_id . '_' . time() . ".png";
            imagealphablending($im, false);
            imagesavealpha($im, true);
            $resp              = imagepng($im, $fileName);
            $FromfilepathTBSig = $fileName;
        }
    }
    return $FromfilepathTBSig;
}

function androidCreateSign_($enroll_id) {
    //For global, cellspan
    global $con;
    $sqlSign   = "select * from " . DBNAME . ".tbl_android_upload_file_longBlob where enroll_id='$enroll_id' and file_type='signature'";
    $querySign = mysql_query($sqlSign, $con);
    if (mysql_num_rows($querySign) == 0) {
        $sqlSign   = "select * from tbl_android_upload_file where enroll_id='$enroll_id' and file_type='signature'";
        $querySign = mysql_query($sqlSign, $con);
    }
    $recSign = mysql_fetch_object($querySign);
    $data    = $recSign->android_file_name;
    $data    = base64_decode($data);
    $im      = imagecreatefromstring($data);
    if ($im !== false) {
        $fileName          = SIGN_PATH . "sign_android_usconnect_" . $enroll_id . ".png";
        imagealphablending($im, false); // setting alpha blending on
        imagesavealpha($im, true); // save alphablending setting (important)
        $resp              = imagepng($im, $fileName);
        $FromfilepathTBSig = $fileName;
        if (file_exists($FromfilepathTBSig)) {
            return $FromfilepathTBSig;
        } else
            return '';
    }
    else {
        return false;
    }
}

function GetSignatureFilePath($company, $fax_id, $enroll_id, $state, $type = "", $recert_status = "", $customer_id = "", $source = "") {
    global $log, $con, $log_sign_abc;

    $log['signature']['request'] = "Company: $company, Fax_id: $fax_id, State: $state , Enroll_id : $enroll_id, Type: $type, Recert_status: $recert_status, Customer_id: $customer_id";

    if (($company == 1 && $state != 'WI' && $state != 'NE' && $recert_status != 'website-terracom') || $company == 40 || $company == 45) {
        return "Signaute file not applicable";
    }

    if ($company == '1' || $company == '43' || $company == '16' || $company == '13' || $company == '59' || $company == '54' || $company == '32' || $company == '7' || $company == '25') {
        if (($company == '43') && $type != 'recert' || $company == '16' || $company == '13' || $company == '59' || $company == '54' || $company == '32' || $company == '7' || $company == '25') {
            if ($company == '7') {
                // $enroll_id = str_replace('S', '', $enroll_id);
                $numericOnly = preg_replace("/[^0-9]+/", "", $enroll_id);
                $enroll_id1  = "OR enroll_id='" . $numericOnly . "'";
            }
            $sqlCustomer    = "SELECT signature FROM " . DBNAME . ".tbl_customer_sign where enroll_id='" . $enroll_id . "' $enroll_id1   and is_status='Y' order by id desc limit 1";
            $query_Customer = mysql_query($sqlCustomer, $con);
            if (mysql_num_rows($query_Customer) > 0) {
                $result_Customer                          = mysql_fetch_object($query_Customer);
                $log['sign_content_data_encrypt_content'] = $result_Customer->signature;
                if ($company == '16' || $company == '13' || $company == '59' || $company == '32' || $company == '7' || $company == '25') {
                    $data = getDecrypt($result_Customer->signature, LOCK_ID_1);
                } else {

                    $data = getDecrypt_agent($result_Customer->signature);
                }
                $log['sign_content_data_decrypt_content'] = $data;
                $sign_arr                                 = explode('data:image/png;base64,', $data);
                //$log['sign_arr'] = $sign_arr;
                $data                                     = $sign_arr[1];
                $im                                       = imagecreatefromstring(base64_decode($data));
            }
        } else if (($state == 'NE' || $state == 'WI') && $type != 'recert' && strtoupper($source) == 'WEBSITE') {
            $sqlCustomer    = "SELECT signature FROM `tbl_customer_enrollsign` where enroll_id='" . $enroll_id . "' and is_status='Y' order by id desc limit 1";
            $query_Customer = mysql_query($sqlCustomer, $con);
            if (mysql_num_rows($query_Customer) > 0) {
                $result_Customer             = mysql_fetch_object($query_Customer);
                $Customersignature_file_name = getDecrypt($result_Customer->signature, LOCK_ID_3);
                $data                        = $Customersignature_file_name;
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data                        = base64_decode($data);
                $im                          = imagecreatefromstring($data);
            }
        } else if ($state == 'NE' && $type != 'recert' && strtoupper($source) != 'WEBSITE') {
            $sqlCustomer    = "SELECT signature FROM " . DBNAME . ".tbl_customer_sign where enroll_id='" . $enroll_id . "' $enroll_id1   and is_status='Y' order by id desc limit 1";
            $query_Customer = mysql_query($sqlCustomer, $con);
            if (mysql_num_rows($query_Customer) > 0) {
                $result_Customer                          = mysql_fetch_object($query_Customer);
                $data                                     = getDecrypt_agent($result_Customer->signature);
                $log['sign_content_data_decrypt_content'] = $data;
                $sign_arr                                 = explode('data:image/png;base64,', $data);
                //$log['sign_arr'] = $sign_arr;
                $data                                     = $sign_arr[1];
                $im                                       = imagecreatefromstring(base64_decode($data));
            }
        } else if ($type == 'recert') {
            $sqlCustomer    = "SELECT signature, Appsign FROM tbl_customer_sign where customer_id='" . $customer_id . "' and is_status='Y' and sign_device='recertApp' and date(created_datetime)>='2016-05-02' order by id desc limit 1";
            $query_Customer = mysql_query($sqlCustomer, $con);
            if (mysql_num_rows($query_Customer) > 0) {
                $result_Customer             = mysql_fetch_object($query_Customer);
                //$Customersignature_file_name = $result_Customer->Appsign;
                $Customersignature_file_name = $result_Customer->signature;
                $data                        = $Customersignature_file_name;
                $data                        = base64_decode($data);
                $im                          = imagecreatefromstring($data);
            } else {
                $sqlCustomer    = "SELECT signature FROM tbl_customer_sign where customer_id='" . $customer_id . "' and is_status='Y' and sign_device!='recertApp' and date(created_datetime)>='2016-05-02' order by id desc limit 1";
                $query_Customer = mysql_query($sqlCustomer, $con);
                if (mysql_num_rows($query_Customer) > 0) {
                    $result_Customer             = mysql_fetch_object($query_Customer);
                    $cryptKey                    = 'qJB0rGtIn7dsnbt3efyCp';
                    $Customersignature_file_name = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($result_Customer->signature), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
                    $data                        = $Customersignature_file_name;
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data                        = base64_decode($data);
                    $im                          = imagecreatefromstring($data);
                }
            }
        }
    }
    //else if($company == '7' || $company == '16')
    /*
      else if($company == '7')
      {
      $sqlCustomer	= "select * from ".DBNAME.".tbl_android_upload_file_longBlob where enroll_id='$enroll_id' and file_type='signature'";
      $querySign	= mysql_query($sqlCustomer,$con);
      if(mysql_num_rows($querySign)==0)
      {
      $sqlSign1	= "select * from tbl_android_upload_file where enroll_id='$enroll_id' and file_type='signature'";
      $querySign	= mysql_query($sqlSign1,$con);
      }
      $recSign	= mysql_fetch_object($querySign);
      $data = $recSign->android_file_name;
      $data = base64_decode($data);
      $im = imagecreatefromstring($data);
      }
     */ else if ($company == '32') {
        $sqlCustomer = "select * from tbl_customer_sign where enroll_id='$enroll_id' and is_status='Y' order by id desc";
        $querySign   = mysql_query($sqlCustomer, $con);
        $recSign     = mysql_fetch_object($querySign);
        $data        = $recSign->signature;
        $data        = base64_decode($data);
        $im          = imagecreatefromstring($data);
    }
    $log['signature']['sqlCustomer'] = $sqlCustomer;
    //$log['signature']['decrypt_log'] = $log_sign_abc;
    //$log['signature']['sign_content_data'] = $data;
    if ($im !== false && $im != NULL && $im != '') {

        if ($type == 'recert') {
            $sigfilename = SIGN_PATH . "sign_" . $customer_id . '_' . time() . ".jpg";
        } else {
            $fileName = SIGN_PATH . "sign_" . $enroll_id . '_' . time() . ".png";
        }
        imagealphablending($im, false); // setting alpha blending on
        imagesavealpha($im, true); // save alphablending setting (important)
        $resp              = imagepng($im, $fileName);
        $FromfilepathTBSig = $fileName;
        if (file_exists($FromfilepathTBSig)) {
            return $FromfilepathTBSig;
        } else {
            return "Unable to create sign";
        }
    } else {
        return "Invalid Sign String";
    }
}

function get_agent_signature_generic($company, $fax_id, $enroll_id, $state, $type = "", $recert_status = "", $customer_id = "") {
    global $log, $con;

    $log['signature']['request_2'] = "Company: $company, Fax_id: $fax_id, State: $state , Enroll_id : $enroll_id, Type: $type, Recert_status: $recert_status, Customer_id: $customer_id";

    //if (($company == 1 && $state != 'WI' && $state != 'NE' && $recert_status != 'website-terracom') || $company == 40 || $company == 45)
    if (($company == 1 && $state != 'WI' && $state != 'NE' && $recert_status != 'website-terracom') || $company == 45) {
        return "Signaute file not applicable";
    }

    //$numericOnly = preg_replace("/[^0-9]+/", "", $enroll_id);
    //$enroll_id1 =  "OR e_id ='".$numericOnly."'";

    $sql_signature_id = "SELECT agent_signature_id FROM tbl_webenrollment_plus WHERE enroll_id = '" . $enroll_id . "'";
    $query_signature  = mysql_query($sql_signature_id, $con);
    $obj_sign         = mysql_fetch_object($query_signature);
    $sign_id          = $obj_sign->agent_signature_id;

    $log['signature']['sql_signature_id_2'] = $sql_signature_id;

    $sqlCustomer                     = "SELECT signature FROM " . DBNAME . ".tbl_agent_signature where id='" . $sign_id . "'";
    $log['signature']['sqlCustomer_2'] = $sqlCustomer;
    $query_Customer                  = mysql_query($sqlCustomer, $con);
    if (mysql_num_rows($query_Customer) > 0) {
        $result_Customer = mysql_fetch_object($query_Customer);
        if ($company == '16' || $company == '13' || $company == '59' || $company == '32' || $company == '7' || $company == '25') {
            $data = getDecrypt($result_Customer->signature, LOCK_ID_1);
        } else {
            $data = getDecrypt_agent($result_Customer->signature);
        }
        $sign_arr = explode('data:image/png;base64,', $data);
        $data     = $sign_arr[1];
        $im       = imagecreatefromstring(base64_decode($data));
    } else {
        return "Signature not found in table ";
    }

    if ($im !== false && $im != NULL && $im != '') {

        if ($type == 'recert') {
            $sigfilename = SIGN_PATH . "agent_sign_" . $customer_id . '_' . time() . ".jpg";
        } else {
            $fileName = SIGN_PATH . "agent_sign_" . $enroll_id . '_' . time() . ".png";
        }
        imagealphablending($im, false); // setting alpha blending on
        imagesavealpha($im, true); // save alphablending setting (important)
        $resp              = imagepng($im, $fileName);
        $FromfilepathTBSig = $fileName;
        if (file_exists($FromfilepathTBSig)) {
            return $FromfilepathTBSig;
        } else {
            return "Unable to create sign";
        }
    } else {
        return "Invalid Sign String";
    }
}

function Getproofpath($oldProofUrl, $monthYear, $cintex_migration = "") {
    /*
      echo $oldProofUrl;
      echo "<br/>############<br/>";
      echo ROOT_AGENT_PROOF_PATH;
      echo "<br/>############<br/>";
      echo ROOT_BACKEND_PROOF_PATH;
      echo "<br/>############<br/>";
      echo ROOT_WEBSITE_PROOF_PATH;
      echo "<br/>############<br/>";
      echo ROOT_IVR_PROOF_PATH;
      echo "<br/>############<br/>";
     */

    if ((strpos($oldProofUrl, 'AvSr04Address_Proof05') !== false) || (strpos($oldProofUrl, 'Ar321AddfHwQGWY98K70C') !== false) || (strpos($oldProofUrl, 'CSP21AddfHwQGWY98K70C15') !== false) || (strpos($oldProofUrl, 'NAAr251AddfHwQGYY58K70H') !== false) || (strpos($oldProofUrl, 'SFAr321AddfHwQGWY98K70C') !== false)) {
        $fileFolderName = ROOT_AGENT_PROOF_PATH . $monthYear . "/";
    } else if (strpos($oldProofUrl, 'upload_file') !== false) {
        if ($cintex_migration == 'Y') {
            $fileFolderName = ROOT_BACKEND_PROOF_PATH_CINTEX . $monthYear . "/";
        } else {
            $fileFolderName = ROOT_BACKEND_PROOF_PATH . $monthYear . "/";
        }
    } else if (strpos($oldProofUrl, 'upload_proof') !== false) {
        $fileFolderName = ROOT_WEBSITE_PROOF_PATH . $monthYear . "/";
    } else if (strpos($oldProofUrl, 'ivrrecertification_2013') !== false) {
        //$fileFolderName = ROOT_IVR_PROOF_PATH.$monthYear."/";
        $fileFolderName = ROOT_IVR_PROOF_PATH;
    } else if (strpos($oldProofUrl, 'household8i54pdf') !== false) {
        $fileFolderName = RECERTIFICATIONPHYPATH . "household8i54pdf/";
    } else if (strpos($oldProofUrl, 'recert545pdf') !== false) {
        $fileFolderName = RECERTIFICATIONPHYPATH . "recert545pdf/";
    } else if (strpos($oldProofUrl, 'rec4ert6pro8ofLL') !== false) {
        $fileFolderName = RECERTIFICATIONPHYPATH . "rec4ert6pro8ofLL/";
    } else if (strpos($monthYear, 'ivrrecertification') !== false) {
        $fileFolderName = ROOT_IVR_PROOF_PATH;
    } else if ($cintex_migration == 'Y' && strpos($oldProofUrl, 'CIAr321AddfHwQGWY98K70C') !== false) {
        $fileFolderName = ROOT_AGENT_PROOF_PATH_CINTEX . $monthYear . "/";
    } else {
        $fileFolderName = "";
    }
    return $fileFolderName;
}

function Get_Mime_Type($data) {
    $mime_arr = array("text/plain" => "txt", "image/png" => "png", "image/jpeg" => "jpg", "image/gif" => "gif", "image/bmp" => "bmp", "application/zip" => "zip", "application/pdf" => "pdf", "application/msword" => "doc", "application/rtf" => "rtf", "application/vnd.ms-excel" => "xls", "application/octet-stream" => "jpeg", "video/3gpp" => "3gp", "application/gsm" => "gsm", "audio/gsm" => "gsm", "audio/x-gsm" => "gsm", "application/x-gsm" => "gsm", "audio/mpeg" => "mp3", "audio/wav" => "wav", "audio/wave" => "wav", "audio/x-wave" => "wav", "audio/vnd.wave" => "wav", "audio/x-ms-wma" => "wma", "audio/AMR" => "amr");

    $imgdata   = base64_decode($data);
    $f         = finfo_open();
    $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
    return $mime_arr[$mime_type];
}

function encVal($val) {
    if ($val != '') {
        $val_merge   = @strtoupper(addslashes(trim($val)) . "tsi");
        $val_rev     = @strrev($val_merge);
        $originalVal = @base64_encode($val_rev);
        return $originalVal;
    } else
        return $val;
}

function decriptVal($val) {
    if ($val != '') {
        $val_decript = @base64_decode($val);
        $valRev      = @strrev($val_decript);
        $arrOriginal = @explode('TSI', $valRev);
        return $arrOriginal[0];
    } else
        return $val;
}

function getPasswordFromCust($FaxID) {
    global $con;
    $sql_tbl_cust  = "select ssn_number, dob from " . DBNAME . ".tbl_customer where fax_id = '$FaxID'";
    $querytbl_cust = mysql_query($sql_tbl_cust, $con);
    if (mysql_num_rows($querytbl_cust) > 0) {
        $res_obj_cust = mysql_fetch_object($querytbl_cust);
        $ssn          = $res_obj_cust->ssn_number;
        $ssn_number   = substr($ssn, -4);
        $ssnNNumber   = $ssn_number;
        $dob1         = str_replace('-', '', $res_obj_cust->dob);
        $pass         = $ssn_number . $dob1;
    }
    return $pass;
}

#############################################################Proof Functions#################################################################################

function sendEmailNotifocation($toEmail, $subject, $body, $attachmentPath = '', $fromEmail = '', $fromName = '', $toName = '') {
    include_once('/home/generic/includes/class.phpmailer.php');
    if ($fromEmail == '')
        $fromEmail = 'support@vcaremail.com';
    if ($fromName == '')
        $fromName  = 'Vcare Fileserver';
    $mail      = new PHPMailer();

    $mail->From        = $fromEmail;
    $mail->FromName    = $fromName;
    $mail->Host        = "vidiwallservice.com";
    $mail->Mailer      = "smtp";
    $mail->SMTPAuth    = "true";
    $mail->Port        = 587;
    $mail->Username    = "smtpauth@vidiwallservice.com";
    $mail->Password    = MAIL_SERVER_PASSWORD;
    $mail->ContentType = "text/html";
    $mail->Subject     = $subject;
    $mail->Body        = "<p>" . nl2br($body) . "</p>";
    if ($toEmail != '') {
        $toemail = explode(',', $toEmail);
        $toname  = explode(',', $toName);
        $i       = 0;
        foreach ($toemail as $email) {
            $name = @$toname[$i];
            if ($i == 0) {
                $mail->AddAddress($email, $name);
            } else {
                $mail->AddCC($email, $name);
            }
            $i++;
        }
        if (is_array($attachmentPath)) {
            foreach ($attachmentPath as $attach) {
                $mail->AddAttachment($attach);
            }
        } else {
            $attach = $attachmentPath;
            if ($attach != '')
                $mail->AddAttachment($attach);
        }
        $mail->Send();
        $mail->ClearAddresses();
        $mail->ClearAttachments();
    }
}

if (!function_exists('catchError')) {

    function catchError($errno, $errstr, $errline = '') {
        global $log;
        $strerror       .= "Eroor Type : " . $errno . "<br>";
        $strerror       .= "Eroor Message : " . $errstr . "<br>";
        $strerror       .= "Line Number : " . $errline;
        $subject        = "error reporting On File Server Development.";
        echo $body2          = "Error:\n" . $strerror . "\n" . json_encode($log);
        $toEmail        = 'chandan.singh@vcaremail.com';
        sendEmailNotifocation($toEmail, $subject, $body2, $attachmentPath = '', '', '', 'Chandan Singh');
        exit();
    }

}
if (!function_exists('ShutDown')) {

    function ShutDown() {
        $lasterror = error_get_last();
        if (in_array($lasterror['type'], Array(E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_RECOVERABLE_ERROR, E_CORE_WARNING, E_COMPILE_WARNING, E_PARSE))) {
            catchError($lasterror['type'], $lasterror['message'], $lasterror['file'], $lasterror['line']);
        }
    }

}

function throwExp($var) {
    global $con;
    if ($var === FALSE) {
        throw new Exception(mysql_error($ln));
    }
}

function csvToArray($path, $column_index) {
    if (file_exists($path)) {
        $list      = fopen($path, 'r');
        $i         = 0;
        $proof_arr = array();
        while (($line      = fgetcsv($list)) !== FALSE) {
            if ($i == 0) {
                $i++;
                continue;
            } else {
                $proof_arr[] = $line[$column_index];
            }
            $i++;
        }
        fclose($list);
        return $proof_arr;
    } else {
        return "No list found";
    }
}

function GetProofPassword($cust_id, $fax_id) {
    global $con;

    if ($fax_id > 0) {
        $sqlPendingTable   = "select dob, ssn_number from " . DBNAME . ".tbl_pending_order where fax_id='$fax_id'";
        $queryPendingTable = mysql_query($sqlPendingTable, $con);
        if (mysql_num_rows($queryPendingTable) > 0) {
            $objPendingTable = mysql_fetch_object($queryPendingTable);
            $dob             = $objPendingTable->dob;
            $ssn_number      = $objPendingTable->ssn_number;
        } else {
            $sqlFax     = "select dob, ssn_number from " . DBNAME . ".tbl_fax where id='$fax_id'";
            $queryFax   = mysql_query($sqlFax, $con);
            $recFax     = mysql_fetch_object($queryFax);
            $dob        = $recFax->dob;
            $ssn_number = $recFax->ssn_number;
        }
    } else if ($cust_id > 0) {
        $sqlCust    = "select dob, ssn_number from " . DBNAME . ".tbl_customer where id='$cust_id'";
        $queryCust  = mysql_query($sqlCust, $con);
        $recCust    = mysql_fetch_object($queryCust);
        $dob        = $recCust->dob;
        $ssn_number = $recCust->ssn_number;
    }

    if (strlen($ssn_number) == 9) {
        $ssnLast4 = substr($ssn_number, 5, 4);
    } else if (strlen($ssn_number) == 4 || strlen($ssn_number) == 3) {
        if (strlen($ssn_number) == 3) {
            $ssnLast4 = '0' . $ssn_number;
        } else {
            $ssnLast4 = $ssn_number;
        }
    }

    $dob = preg_replace("/[^a-zA-Z0-9]/", "", $dob);

    if ($ssnLast4 != '' && $dob != '' && $dob != '0000-00-00') {
        $password = $ssnLast4 . $dob;
        if (strlen($password) == 12) {
            return $password;
        } else {
            return '158219820501';
        }
    } else {
        return '158219820501';
    }
}

function encryptBackendProof($cust_id, $fax_id, $newFilename, $sourceFileName) {
    global $con;
    if ($sourceFileName == '') {
        $sourceFileName = $newFilename;
    }
    $password               = GetProofPassword($cust_id, $fax_id); //getCustomerPass($cust_id, $fax_id);
    $ssnNNumber             = substr($password, 0, 4);
    $pdfnameT               = $sourceFileName; // File name interchanged
    $pdfname                = $newFilename;
    include(PROJECT_HOME . "encryptFiles.php");
    $zip                    = ProofConvertZip($password, $pdfname);
    $response['ENCRIPTKEY'] = $encriptKey;
    $response['IVKEY']      = $IVKey;
    $response['PASSWORD']   = $password;
    $response['FILENAME']   = $pdfname;
    $response['SUCCESS']    = $zip;
    return json_encode($response);
}

function ProofConvertZip($passowrd, $fileName) {
    extract(pathinfo($fileName));
    $zipFilePath = $dirname . '/' . $filename . '.zip';
    system("zip -P $passowrd -j -r $zipFilePath $fileName >/dev/null");
    if (file_exists($zipFilePath)) {
        return 1;
    } else {
        return 0;
    }
}

function proof_enc_log($enroll_id, $request, $temp_upload_id, $response, $type, $upload_file_id = "") {
    global $con;
    ## Adding Comment
    if ($upload_file_id != "") {
        $sql = "UPDATE " . DBNAME . ".tbl_api_request_response set vendor_id='" . $upload_file_id . "', request_type = 'encrypt_proof_upload' WHERE  enroll_id = '" . $enroll_id . "' and request_type='" . $type . "' and vendor_id='" . $temp_upload_id . "' and request='" . $request . "' LIMIT 1 ";
    } else {
        $sql = "insert into " . DBNAME . ".tbl_api_request_response set response='" . $response . "' , vendor_id='" . $temp_upload_id . "', request_type='" . $type . "', request='" . $request . "', date_time_request = NOW(),  enroll_id = '" . $enroll_id . "'";
    }
    mysql_query($sql, $con);
}

function manual_decrypt($source, $destination) {
    include(PROJECT_HOME . "decryptfunc.php");
    if (!file_exists($source)) {
        echo "Source file not exist on given location.";
        exit;
    }

    for ($i = 0; $i < 37; $i++) {
        $encriptKey = $arrayKey1[$i];
        $IVKey      = $arrayIV[$i];
        $obj->Decrypt($source, $destination, $encriptKey, $IVKey);
        if (file_exists($destination)) {
            if (filesize($destination) > 100) {
                return "_" . $i;
            } else {
                unlink($destination);
            }
        }
    }
    return false;
}

function IsFileExist($sorceFilename, $destinationFilename) {
    $fileName_arr       = pathinfo($sorceFilename);
    $fileName           = $fileName_arr['basename'];
    $fileExt            = $fileName_arr['extension'];
    $only_file_name_arr = explode('.' . $fileExt, $sorceFilename);
    $only_file_name     = $only_file_name_arr[0];
    $file_ext_arr       = array('pdf', 'png', 'jpg', 'jpeg', 'gif', 'txt', 'gsm', 'bmp', 'PDF', 'PNG', 'JPG', 'JPEG', 'TXT', 'GSM', 'GIF', 'BMP', 'mp3', 'wav', 'wma', '3gp', 'amr', 'MP3', 'WAV', 'WMA', '3GP', 'AMR');
    $response           = array();
    foreach ($file_ext_arr as $ext) {
        $sorceFilename = $only_file_name . '.' . $ext;
        if (file_exists($sorceFilename)) {
            $destinationFilename = str_replace('.' . $fileExt, '.' . $ext, $destinationFilename);
            $response[0]         = $sorceFilename;
            $response[1]         = $destinationFilename;
            $response[2]         = $ext;
            return $response;
        }
    }
    return false;
}

function get_pdf_content($file_path) {
    $content = "";
    if (file_exists($file_path)) {
        $parser  = new \Smalot\PdfParser\Parser();
        $pdf     = $parser->parseFile($file_path);
        $content = $pdf->getText();
    }
    return $content;
}

function check_CA_state_hh_required($content) {
    if (strpos($content, "California LifeLine Household Worksheet") === false) {
        return 0;
    } else {
        return 1;
    }
}

function generate_all_proof_files($faxid) {
    global $con;
    $response_arr  = array();
    $i             = 0;
    $sql_proof_qry = "select * from " . DBNAME . ".tbl_upload_file where FaxID = '" . $faxid . "' and category_id != '9' LIMIT 5";
    $result        = mysql_query($sql_proof_qry, $con);
    while ($row           = mysql_fetch_object($result)) {
        $res              = generate_proof_file($faxid, $row->id, 1);
        $response_arr[$i] = $res;
        $i++;
    }
    return $response_arr;
}

function generate_proof_file($FaxID, $upload_id, $log_required) {
    global $con;
    $log                            = array();
    $response                       = array();
    include_once(PROJECT_HOME . "cryptography.php");
    $cintex_migration               = 'N';
    $sql_proof_qry                  = "select file_name, android_autoid, uploaded_by, upload_date, category_id, new_file_name,company_id from " . DBNAME . ".tbl_upload_file where id = '" . $upload_id . "'";
    $log['proof_sql']               = $sql_proof_qry;
    $sql_proof                      = mysql_fetch_object(mysql_query($sql_proof_qry, $con));
    $oldProofUrl                    = $sql_proof->file_name;
    $new_file_name                  = $sql_proof->new_file_name;
    $android_autoid                 = $sql_proof->android_autoid;
    $company                        = $sql_proof->company_id;
    $log['oldProofUrl']             = $oldProofUrl;
    $cat_id                         = $sql_proof->category_id;
    $fileName1                      = generateOrUpdateFileName($oldProofUrl, $FaxID, $upload_id, 'proof');
    $log['FileName_with_monthyear'] = $fileName1;
    $fileName_arr                   = explode("^#*", $fileName1);
    if (trim($sql_proof->uploaded_by) == 'cintex_migration') {
        $cintex_migration        = 'Y';
        $log['cintex_migration'] = 'Yes';
    }
    if ($android_autoid > 0 && $oldProofUrl != '' && ($new_file_name == '' || empty($new_file_name))) {
        $sql_tab       = "select  android_file_name from " . DBNAME . ".tbl_android_upload_file_longBlob where id='$android_autoid'";
        $query_tab     = mysql_query($sql_tab, $con);
        $num_query_tab = mysql_num_rows($query_tab);
        $rec_tab       = mysql_fetch_object($query_tab);
        $error         = 3;
    } else {
        $num_query_tab = 0;
    }
    if ($android_autoid > 0 && $fileName_arr[0] == '' && ($new_file_name == '' || empty($new_file_name)) && ( $num_query_tab > 0)) {
        $log['proof_location'] = 'Table';
        $sql_tab               = "select  android_file_name from " . DBNAME . ".tbl_android_upload_file_longBlob where id='$android_autoid'";
        $query_tab             = mysql_query($sql_tab, $con);
        if (mysql_num_rows($query_tab) > 0) {
            $rec_tab                 = mysql_fetch_object($query_tab);
            include_once('tablet_proof.php');
            file_put_contents(PROJECT_DECRYPT_PATH . $fileName_arr[1], base64_decode($rec_tab->android_file_name));
            //$response['chunk'] = $rec_tab->android_file_name;
            $response['file_path']   = PROJECT_DECRYPT_PATH . $fileName_arr[1];
            $response['category_id'] = $cat_id;
            $response['extention']   = Get_Mime_Type($rec_tab->android_file_name);
            $response['msg_code']    = 'FS0';
            $response['msg']         = 'SUCCESS';
            if ($log['tablet_fileserver']['Success'] == "1") {
                $response['new_file_name'] = 'SUCCESS';
            } else if ($log['tablet_fileserver']['Success'] == "0") {
                $response['new_file_name'] = 'Failed';
            }
        } else {
            $sql_update_flag            = "UPDATE  " . DBNAME . ".tbl_upload_file SET is_proof_found = 0 where id='" . $upload_id . "' LIMIT 1";
            $result_update_flag         = mysql_query($sql_update_flag, $con);
            $log['is_proof_found_flag'] = 'UPDATED to 0';
            $response['msg_code']       = 'FS50';
            $response['msg']            = 'Proof Data not found.';
            $response['category_id']    = $cat_id;
            $response['upload_id']      = $upload_id;
        }
    } else {
        $log['proof_location'] = 'Fileserver';

        if ($new_file_name != '') {
            $oldProofUrl = $new_file_name;
        } else if ($error == 3) {
            $log['chunk'] = "File chunk not found in table";
            $m_y          = date('Ym', strtotime($sql_proof->upload_date)) . '/';
            $folder       = end(array_filter(explode('/', ROOT_AGENT_PROOF_PATH))) . '/';
            $oldProofUrl  = BACKEND_URL . $folder . $m_y . $oldProofUrl;
            $log['Case']  = "Found tablet proof on fileserver which is not found in longblob table.";
            $error        = 0;
            $error1       = 3;
        }

        if ($new_file_name != '' || $error1 == 3) {
            //$oldProofUrl = $new_file_name;
            $fileName1                         = generateOrUpdateFileName($oldProofUrl, $FaxID, $upload_id, 'proof');
            $log['NewFileName_with_monthyear'] = $fileName1;
            $fileName_arr                      = explode("^#*", $fileName1);
        }

        $fileName     = $fileName_arr[1];
        $monthYear    = $fileName_arr[0];
        $sql_tbl_fax  = "select * from " . DBNAME . ".tbl_fax where id='$FaxID'";
        $querytbl_fax = mysql_query($sql_tbl_fax, $con);
        if (mysql_num_rows($querytbl_fax) > 0) {
            $log['Fax_Entry']    = "Entry found in tbl_fax";
            $rec_sh              = mysql_fetch_object($querytbl_fax);
            $enroll_id           = $rec_sh->enroll_id;
            $fname               = strtoupper($rec_sh->f_name);
            $birthdate           = trim($rec_sh->dob);
            $ssn                 = $rec_sh->ssn_number;
            $ssn_number          = substr($ssn, -4);
            $ssnNNumber          = $ssn_number;
            $dob1                = str_replace('-', '', $birthdate);
            $pass                = $ssn_number . $dob1;
            $credentials['pass'] = $pass;
            $fileFolderName      = Getproofpath($oldProofUrl, $monthYear, $cintex_migration);
            if ($fileFolderName == "") {
                $response['category_id']  = $cat_id;
                $response['upload_id']    = $upload_id;
                $response['msg_code']     = 'FS18';
                $response['msg']          = 'Invalid file path !!';
                $log['Invalid_file_path'] = 'Invalid file path in DB ' . $fileFolderName . ' !!'; //log
            } else {
                $exactFilename       = $fileName;
                $FromfilepathTB      = $fileFolderName . $exactFilename;
                $unlinkdfpENC        = PROJECT_ENC_PATH . $fileName;
                $unlinkdfpDEC        = PROJECT_DECRYPT_PATH . $fileName;
                $ext                 = pathinfo($FromfilepathTB, PATHINFO_EXTENSION);
                $zipExtWithFilename  = str_replace('.' . $ext, '.zip', $FromfilepathTB);
                $log['Zipfile_path'] = $zipExtWithFilename;
            }
        } else {
            $response['category_id'] = $cat_id;
            $response['upload_id']   = $upload_id;
            $response['msg_code']    = 'FS17';
            $response['msg']         = 'Invalid faxID !! ';
        }
    }

    if ($response['msg'] == '') {
        $PROJECT_ENC_PATH = PROJECT_ENC_PATH;
        $sqlDecTbl        = "select per.p_id from tbl_employee emp LEFT JOIN tbl_permission_group per on emp.group_type = per.gr_id where emp.status='Active' and emp.login_id='" . $user_id . "' and per.p_id = '452'";
        $queryDecTbl      = mysql_query($sqlDecTbl, $con);
        $numRowDectbl     = mysql_num_rows($queryDecTbl);
        $numRowDectbl     = 1;
        if ($numRowDectbl > 0) {
            $credentials['unzip_pass'] = $pass;

            if (strlen($pass) != 12) {
                $pass       = getPasswordFromCust($FaxID);
                $ssnNNumber = substr(trim($pass), 0, 4); // Use ssn from tbl_customer because we are using ssn & DOB from same table for password. if this password is correct so ssn will use from same table.
            }

            if (file_exists($zipExtWithFilename)) {
                $unzip               = system("unzip -P $pass $zipExtWithFilename -d $PROJECT_ENC_PATH >> /dev/null");
                $log['unzip1']       = "unzip -P $pass $zipExtWithFilename -d $PROJECT_ENC_PATH >> /dev/null";
                $log['unlinkdfpENC'] = $unlinkdfpENC;
                if (!file_exists($unlinkdfpENC)) {
                    $pass                          = getPasswordFromCust($FaxID);
                    $ssnNNumber                    = substr(trim($pass), 0, 4); // Use ssn from tbl_customer because we are using ssn & DOB from same table for password. if this password is correct so ssn will use from same table.
                    $credentials['new_unzip_pass'] = $pass;
                    $unzip                         = system("unzip -P $pass $zipExtWithFilename -d $PROJECT_ENC_PATH >> /dev/null");
                    $log['unzip2']                 = "unzip -P $pass $zipExtWithFilename -d $PROJECT_ENC_PATH >> /dev/null";
                    if (!file_exists($unlinkdfpENC)) {
                        $pass          = "158219820501";
                        $unzip         = system("unzip -P $pass $zipExtWithFilename -d $PROJECT_ENC_PATH >> /dev/null");
                        $log['unzip3'] = "unzip -P $pass $zipExtWithFilename -d $PROJECT_ENC_PATH >> /dev/null";
                        $ssnNNumber    = "1582"; // Use ssn from tbl_customer because we are using ssn & DOB from same table for password. if this password is correct so ssn will use from same table.
                    }
                }

                $exist_arr               = IsFileExist($unlinkdfpENC, $unlinkdfpDEC);
                $log['exist_arr']        = $exist_arr;
                $log['new_unlinkdfpENC'] = $unlinkdfpENC;
                $log['new_unlinkdfpDEC'] = $unlinkdfpDEC;
                $unlinkdfpENC            = $exist_arr[0];
                $unlinkdfpDEC            = $exist_arr[1];
                $fileExt                 = $exist_arr[2];

                if (!file_exists($unlinkdfpENC)) {
                    $response['category_id'] = $cat_id;
                    $response['upload_id']   = $upload_id;
                    $response['msg_code']    = 'FS13';
                    $response['msg']         = 'Unable to upzip file!!';
                    $log['File_unzip']       = 'Unable to upzip file ' . $zipExtWithFilename . ' !!'; //log
                } else if (strpos($oldProofUrl, 'recording_611') !== false) {
                    $destinationFilename     = $unlinkdfpENC;
                    $log['File_decrypt']     = "File has not been decrypted due to alreday decrypted"; //log
                    $response['file_path']   = $destinationFilename;
                    $response['category_id'] = $cat_id;
                    $response['extention']   = pathinfo($destinationFilename, PATHINFO_EXTENSION);
                    $response['msg_code']    = 'FS0';
                    $response['msg']         = 'SUCCESS';
                    /*
                      unlink($destinationFilename);
                      $log['Delete File']['Unziped Decrypted File'] = $destinationFilename;
                     */
                } else {
                    $log['File_unzip']   = "File " . $zipExtWithFilename . " has been unzip to " . $PROJECT_ENC_PATH; //log
                    $sorceFilename       = $unlinkdfpENC;
                    $destinationFilename = $unlinkdfpDEC;
                    if ($company == 7 && $sql_proof->uploaded_by == 'cintex_migration') {
                        if (file_exists(PROJECT_HOME . "decryptfunc_cintex.php")) {
                            include(PROJECT_HOME . "decryptfunc_cintex.php");
                        } else {
                            $log['cintex_Decryt_KEY_file'] = "DecryptKEY file not found on fileserver.";
                        }
                    } else if (file_exists(PROJECT_HOME . "decryptfunc.php")) {
                        include(PROJECT_HOME . "decryptfunc.php");
                    } else {
                        $log['Decryt_KEY_file'] = "DecryptKEY file not found on fileserver.";
                    }

                    $credentials['decriptKey']    = $encriptKey;
                    $credentials['decript_IVKey'] = $IVKey;
                    $log['destinationFilename']   = $destinationFilename;
                    if (!file_exists($destinationFilename) || filesize($destinationFilename) == 0) {
                        $response['msg_code']  = 'FS14';
                        $response['msg']       = 'Unable to decrypt file!!';
                        $log['File_decyption'] = 'Unable to decrypt file ' . $sorceFilename . ' !!'; //log
                    } else {
                        $log['File_decrypt']     = "File has been decrypted to " . $destinationFilename; //log
                        //$chunck = base64_encode(file_get_contents($destinationFilename));
                        $response['file_path']   = $destinationFilename;
                        $response['category_id'] = $cat_id;
                        $response['extention']   = pathinfo($destinationFilename, PATHINFO_EXTENSION);
                        $response['msg_code']    = 'FS0';
                        $response['msg']         = 'SUCCESS';

                        /*
                          unlink($unlinkdfpENC);
                          $log['Delete File']['Unziped Encryptd File'] = $unlinkdfpENC;
                          unlink($destinationFilename);
                          $log['Delete File']['Unziped Decrypted File'] = $destinationFilename;
                         */
                    }
                }
            } else {
                $response['category_id'] = $cat_id;
                $response['upload_id']   = $upload_id;
                $response['msg_code']    = 'FS16';
                $response['msg']         = 'File not available on server!!';
                $log['File_available']   = 'File not available on server' . $zipExtWithFilename . ' !!'; //log

                $sql_update_flag            = "UPDATE  " . DBNAME . ".tbl_upload_file SET is_proof_found = 0 where id='" . $upload_id . "' LIMIT 1";
                $result_update_flag         = mysql_query($sql_update_flag, $con);
                $log['is_proof_found_flag'] = 'is_proof_found Updated to 0';
            }
        } else {
            if (file_exists($zipExtWithFilename)) {
                $response['file_path']   = $zipExtWithFilename;
                $response['category_id'] = $cat_id;
                $response['extention']   = "zip";
                $response['msg_code']    = 'FS0';
                $response['msg']         = 'SUCCESS';
            } else {
                $response['msg_code'] = 'FS10';
                $response['msg']      = 'Zip file not exist !! ';
            }
        }
    }

    /*
      echo "<pre>";
      print_r($response);
      print_r($log);
      exit;
     */

    $log['credentials'] = base64_encode(json_encode($credentials));
    if ($log_required == 1) {
        $response['log'] = $log;
    }
    if ($response['msg_code'] == 'FS0') {
        $status = 'SUCCESS';
    } else {
        $status = 'FAILED';
    }
    return $response;
}

function generate_qr_code($enroll_id) {
    global $con;
    $response = array();
    $sql      = "select document_id from " . DBNAME . ".tbl_ca_enroll_detail where enroll_id = '$enroll_id'";
    $result   = mysql_query($sql, $con);
    if (mysql_num_rows($result) > 0) {
        $row         = mysql_fetch_object($result);
        $document_id = $row->document_id;
        if ($document_id != '') {
            $qa_path     = PROJECT_DECRYPT_PATH;
            $filename    = $qa_path . $enroll_id . '_' . rand(11111111, 99999999) . '_qr.png';
            $image_size  = 'L'; // array('L','M','Q','H')
            $matrix_size = 1; // min(max((int)$matrix_size, 1), 10)
            QRcode::png($document_id.'_DEL', $filename, $image_size, $matrix_size, 2);
            if (!file_exists($filename)) {
                $response['code']        = 'FS02';
                $response['msg']         = 'Unable to create qa code for - ' . $document_id . '.';
                $response['qr_path']     = '';
                $response['document_id'] = $document_id;
            } else {
                $response['code']        = 'FS00';
                $response['msg']         = 'SUCCESS';
                $response['qr_path']     = $filename;
                $response['document_id'] = $document_id;
            }
        } else {
            $response['code']        = 'FS01';
            $response['msg']         = 'Document id not found';
            $response['qr_path']     = '';
            $response['document_id'] = '';
        }
    }
    return json_encode($response);
}

function generate_barcode($enroll_id,$extraStr='') {
    global $con;
    $response = array();
    $sql      = "select document_id from " . DBNAME . ".tbl_ca_enroll_detail where enroll_id = '$enroll_id'";
    $result   = mysql_query($sql, $con);
    if (mysql_num_rows($result) > 0) {
        $row         = mysql_fetch_object($result);
        $document_id = $row->document_id;
        if ($document_id != '') {
            $qa_path     = PROJECT_DECRYPT_PATH;
            $filename    = $qa_path . $enroll_id . '_' . rand(11111111, 99999999) . '_qr.png';
            $image_size  = 'L'; // array('L','M','Q','H')
            $matrix_size = 1; // min(max((int)$matrix_size, 1), 10)
//            echo $filename;
//            QRcode::png($document_id.'_DEL', $filename, $image_size, $matrix_size, 2);
            $code = $document_id.''.$extraStr;
            Datamatrix::factory()
                ->setCode($code)
                ->setSize(33)
                ->setFile($filename)
                ->getDatamatrixPngData();
//            die;
            if (!file_exists($filename)) {
                $response['code']        = 'FS02';
                $response['msg']         = 'Unable to create qa code for - ' . $document_id . '.';
                $response['qr_path']     = '';
                $response['document_id'] = $document_id;
            } else {
                $response['code']        = 'FS00';
                $response['msg']         = 'SUCCESS';
                $response['qr_path']     = $filename;
                $response['document_id'] = $document_id;
            }
        } else {
            $response['code']        = 'FS01';
            $response['msg']         = 'Document id not found';
            $response['qr_path']     = '';
            $response['document_id'] = '';
        }
    }
    return json_encode($response);
}


function ca_state_date($heading, $date) {
    $str = '<table style="width:100%; padding: 0;">
				<tr>
					<td style="vertical-align:middle; font-weight:bold; width:110px;">' . $heading . '</td>
					<td style="padding: 0;">
						<table style="width:100%;padding: 0;">
							<tr>
								<td style="border: 2px solid #ccc;width: 25px;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0; font-size:17pt;">' . $date[0] . '</td>
								<td style="border: 2px solid #ccc;width: 25px;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0; font-size:17pt;">' . $date[1] . '</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align: center;color: #000;">Month</td>
							</tr>
						</table>
					</td>
					<td style="vertical-align: top;color: #ccc;font-size:25pt;">/</td>
					<td style="padding: 0;">
						<table style="width:100%;padding: 0;">
							<tr>
								<td style="border: 2px solid #ccc;width: 25px;height: 35px;text-align: center;line-height: 35px;font-size:17pt;font-weight: 600;margin: 0;padding: 0;">' . $date[2] . '</td>
								<td style="border: 2px solid #ccc;width: 25px;height: 35px;text-align: center;line-height: 35px;font-size:17pt;font-weight: 600;margin: 0;padding: 0; font-size:17pt;">' . $date[3] . '</td>
							</tr>
							<tr>
								<td colspan="2"  style="text-align: center;color: #000;">Day</td>
							</tr>
						</table>
					</td>
					<td style="vertical-align: top;color: #ccc; font-size:25pt;">/</td>
					<td style="padding: 0;" style="">
						<table style="width:100%; padding: 0;"  cellpadding="0" cellspacing="0">
							<tr>
								<td style="border: 2px solid #ccc;width: 25px;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0;font-size:17pt;">' . $date[4] . '</td>
								<td style="border: 2px solid #ccc;width: 25px;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0;font-size:17pt;">' . $date[5] . '</td>
								<td style="border: 2px solid #ccc;width: 25px;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0;font-size:17pt;">' . $date[6] . '</td>
								<td style="border: 2px solid #ccc;width: 25px;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0;font-size:17pt;">' . $date[7] . '</td>
							</tr>
							<tr>
								<td colspan="4"  style="text-align: center;color: #000; ">Year</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>';
    return $str;
}

function ca_state_name($fname, $middlename, $lastname) {
    $max_box     = 28;
    $str         = '';
    $current_box = 1;
    for ($i = 0; $i < strlen($fname); $i++) {
        if ($current_box <= $max_box) {
            $str .= '<td style="border: 2px solid #ccc;float:right;width: 25px;font-size:17pt;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0;">' . $fname[$i] . '</td>';
            $current_box++;
        }
    }

    $str .= '<td style="border: 2px solid #ccc;float:right;width: 25px;font-size:17pt;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0;">&nbsp;</td>';
    $current_box++;

    if ($middlename != '') {
        for ($i = 0; $i < strlen($middlename); $i++) {
            if ($current_box <= $max_box) {
                $str .= '<td style="border: 2px solid #ccc;float:right;width: 25px;font-size:17pt;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0;">' . $middlename[$i] . '</td>';
                $current_box++;
            }
        }

        $str .= '<td style="border: 2px solid #ccc;float:right;width: 25px;font-size:17pt;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0;">&nbsp;</td>';
        $current_box++;
    }



    for ($i = 0; $i < strlen($lastname); $i++) {
        if ($current_box <= $max_box) {
            $str .= '<td style="border: 2px solid #ccc;float:right;width: 25px;font-size:17pt;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0;">' . $lastname[$i] . '</td>';
            $current_box++;
        }
    }

    if ($current_box <= $max_box) {
        for ($i = $current_box; $i <= $max_box; $i++) {
            $str .= '<td style="border: 2px solid #ccc;float:right;width: 25px;font-size:17pt;height: 35px;text-align: center;line-height: 35px;margin: 0;padding: 0;">&nbsp;</td>';
        }
    }

    return $str;
}

function ca_print_fint_size($print_font_size) {
    $standard = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 0px;">';
    $large    = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 0px;">';
    $braille  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 0px;">';
    if ($print_font_size == 'S') {
        $standard = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 0px;">';
    }
    if ($print_font_size == 'L') {
        $large = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 0px;">';
    }
    if ($print_font_size == 'B') {
        $braille = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 0px;">';
    }
    $str = '<table style="width:100%;">
				<tr>
					<td style="width: 130px;">
						<table style="width:100%;">
							<tr>
								<td>' . $standard . '</td>
								<td>Standard Print</td>
							</tr>
						</table>
					</td>
					<td style="width: 121px;">
						<table style="width:100%;">
							<tr>
								<td>' . $large . '</td>
								<td>Large Print</td>
							</tr>
						</table>
					</td>
					<td>
						<table style="width:100%;">
							<tr>
								<td>' . $braille . '</td>
								<td>Braille</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>';
    return $str;
}

function ca_household($enroll_id, $source, $FaxID, $fname, $lastname) {
    global $con;
    $enroll_autoid = preg_replace("/[^0-9]/", "", $enroll_id);
    if (strtoupper($source) == 'AGENTPROGRAM' || strtoupper($source) == 'WEBAGENTPROGRAM') {
        $sql_household    = "select * from " . DBNAME . ".tbl_household_agent where  enrollment_id='$enroll_autoid'";
        $result_household = mysql_query($sql_household, $con);

        if (mysql_num_rows($result_household) == 0) {
            $sql_household    = "select * from " . DBNAME . ".tbl_household where  enrollment_id='$enroll_autoid' or enrollment_id='$enroll_id'";
            $result_household = mysql_query($sql_household, $con);
        }
    } else if (strtoupper($source) == 'TABLET' || strtoupper($source) == 'TABLET_FASTTRACK') {
        $sql_household    = "select * from " . DBNAME . ".tbl_household where enrollment_id='$enroll_id'";
        $result_household = mysql_query($sql_household, $con);
    } else {
        $sql_household    = "select * from " . DBNAME . ".tbl_household where fax_id='$FaxID'";
        $result_household = mysql_query($sql_household, $con);
    }
    //$str = $sql_household;
    $obj_houseHold = mysql_fetch_object($result_household);

    $initionals  = initionals($fname, $lastname);
    $initials_I  = '<tr><td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td><td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td></tr>';
    $initials_II = '<tr><td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td><td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;"></td></tr>';

    if (strtoupper($obj_houseHold->lifeline) == 'YES' || strtoupper($obj_houseHold->lifeline) == 'Y') {
        $lifeline_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">Yes';
        $lifeline_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    } else if (strtoupper($obj_houseHold->lifeline) == 'NO' || strtoupper($obj_houseHold->lifeline) == 'N') {
        $lifeline_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $lifeline_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">No';
    } else {
        $lifeline_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $lifeline_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    }

    if (strtoupper($obj_houseHold->parent) == 'YES' || strtoupper($obj_houseHold->parent) == 'Y') {
        $parent_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">Yes';
        $parent_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    } else if (strtoupper($obj_houseHold->parent) == 'NO' || strtoupper($obj_houseHold->parent) == 'N') {
        $parent_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $parent_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">No';
    } else {
        $parent_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $parent_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    }
    if (strtoupper($obj_houseHold->adult) == 'YES' || strtoupper($obj_houseHold->adult) == 'Y') {
        $adult_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">Yes';
        $adult_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    } else if (strtoupper($obj_houseHold->adult) == 'NO' || strtoupper($obj_houseHold->adult) == 'N') {
        $adult_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $adult_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">No';
    } else {
        $adult_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $adult_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    }

    if (strtoupper($obj_houseHold->relative) == 'YES' || strtoupper($obj_houseHold->relative) == 'Y') {
        $relative_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">Yes';
        $relative_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    } else if (strtoupper($obj_houseHold->relative) == 'NO' || strtoupper($obj_houseHold->relative) == 'N') {
        $relative_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $relative_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">No';
    } else {
        $relative_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $relative_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    }

    if (strtoupper($obj_houseHold->roommate) == 'YES' || strtoupper($obj_houseHold->roommate) == 'Y') {
        $roommate_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">Yes';
        $roommate_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    } else if (strtoupper($obj_houseHold->roommate) == 'NO' || strtoupper($obj_houseHold->roommate) == 'N') {
        $roommate_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $roommate_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">No';
    } else {
        $roommate_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $roommate_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    }

    if (strtoupper($obj_houseHold->other) == 'YES' || strtoupper($obj_houseHold->other) == 'Y') {
        $other_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">Yes';
        $other_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    } else if (strtoupper($obj_houseHold->other) == 'NO' || strtoupper($obj_houseHold->other) == 'N') {
        $other_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $other_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">No';
    } else {
        $other_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $other_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    }

    if (strtoupper($obj_houseHold->share) == 'YES' || strtoupper($obj_houseHold->share) == 'Y') {
        $share_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">Yes';
        $share_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    } else if (strtoupper($obj_houseHold->share) == 'NO' || strtoupper($obj_houseHold->share) == 'N') {
        $share_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $share_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/yes.png" style="padding-right: 3px;font-size:11pt;">No';
    } else {
        $share_yes = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">Yes';
        $share_no  = '<img src="' . GENERIC_PATH . 'images/ca_images/no.jpg" style="padding-right: 3px;font-size:11pt;">No';
    }

    if (strtoupper($obj_houseHold->certifi1) == 'YES' || strtoupper($obj_houseHold->certifi1) == 'Y') {

        $initials_I = '<tr><td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;">' . $initionals[0] . '</td><td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;">' . $initionals[1] . '</td></tr>';
    }

    if (strtoupper($obj_houseHold->certifi2) == 'YES' || strtoupper($obj_houseHold->certifi2) == 'Y') {
        $initials_II = '<tr><td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;">' . $initionals[0] . '</td><td style="border:2px solid #ccc; height:30px; width:26px;text-align: center; font-size:15pt;">' . $initionals[1] . '</td></tr>';
    }

    $str .= '<table style="width:726px; margin:0 auto;  padding:2px 0 0 0;">
				<tr>
					<td style=" padding:0;  font-size:11pt;">1. Does your spouse or domestic partner (that is, someone you are married to or in a relationship with) &nbsp;&nbsp;&nbsp;&nbsp;already receive discounted phone service? (select no if you do not have a spouse or partner)
					</td>
					<td style="width: 141px;  padding:0;">
						<table style="width:100%; margin:0 auto; font-weight:bold; ">
							<tr>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $lifeline_yes . '</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $lifeline_no . '</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table style="width:726px; margin:0 auto; background:#e6e7e8;padding:2px 0;">
				<tr>
					<td style="width:20px;padding-left: 20px;padding-right:0px;vertical-align: top;">
						<img src="' . GENERIC_PATH . 'images/ca_images/bg-arrow.png" style="float:left;" />
					</td>
					<td style=" width:700px;font-size:11pt;">
						 If you selected <b>YES</b>, you may not sign up for California LifeLine because someone in your household already receives the discount.  Only ONE discount is allowed per household.
					</td>
				</tr>
				<tr>
					<td style="width:20px;padding-left: 20px;padding-right:0px;vertical-align: top;">
						<img src="' . GENERIC_PATH . 'images/ca_images/bg-arrow.png" style="float:left;" />
					</td>
					<td style="width:20px; width:700px;font-size:11pt;">
						If you selected <b>NO</b>, please answer question #2.
					</td>
				</tr>
			</table>
			<table style="width:726px; margin:0 auto; ">
				<tr>
					<td colspan="2" style="font-size:11pt;">2. Other than a spouse or partner, do other adults (people over the age of 18 or emancipated minors) live with you at your &nbsp;&nbsp;&nbsp;&nbsp;address?
					</td>
				</tr>
				<tr>
					<td style="width:435px;padding-left: 0px;">
						<table style="width:100%; padding:0;">
							<tr>
								<td style="font-weight: bold;width: 20px;padding-bottom: 5px;font-size:11pt;">
									A.
								</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $parent_yes . '</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $parent_no . '</td>
								<td style="width:276px;vertical-align: top;line-height: 18px;padding-bottom:2px;font-size:11pt;">
									A parent
								</td>
							</tr>
							<tr>
								<td style="font-weight: bold;width: 20px;">
									B.
								</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $adult_yes . '</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $adult_no . '</td>
								<td style="width:276px;vertical-align: top;line-height: 18px;padding-bottom:2px;font-size:11pt;">
									An adult son or daughter
								</td>
							</tr>
							<tr>
								<td style="font-weight: bold;width: 20px;vertical-align: top;padding-bottom: 2px;">C.</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $relative_yes . '</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $relative_no . '</td>
								<td style="width:366px;vertical-align: top;line-height: 18px;padding-bottom: 2px;font-size:11pt;">
									Another adult relative (such as a sibling, aunt, cousin, grandparent, grandchild, etc.)
								</td>
							</tr>
						</table>
					</td>
					<td style="width:283px;vertical-align: top;">
						<table style="width:100%; padding:0;">
							<tr>
								<td style="font-weight: bold;width: 20px;padding-bottom: 5px;font-size:11pt;">
									D.
								</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $roommate_yes . '</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $roommate_no . '</td>
								<td style="width:180px;vertical-align: top;line-height: 18px;padding-bottom:2px;font-size:11pt;">
									An adult roommate
								</td>
							</tr>
							<tr>
								<td style="font-weight: bold;width: 20px;padding-bottom: 2px;">
									E.
								</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $other_yes . '</td>
								<td style="width:54px;font-weight: bold;vertical-align: top;line-height: 18px;padding-bottom:2px;">' . $other_no . '</td>
								<td style="width:180px;fvertical-align: top;line-height: 18px;padding-bottom: 2px;">
									<table cellpadding="0" cellpadding="0" style="vertical-align:top; width:100%;">
										<tr>
											<td style="width:50px;font-size:11pt;">Other</td>
											<td style="border:0;padding-bottom: 5px; width:150px; border-bottom:1px solid #000;"></td>
										</tr>
									</table>

								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table style="width:726px; margin:0 auto; background:#e6e7e8;padding:2px 0;">
				<tr>
					<td style="width:20px;padding-left: 20px;padding-right:0px;vertical-align: top;padding-bottom: 0px;">
						<img src="' . GENERIC_PATH . 'images/ca_images/bg-arrow.png" style="float:left;padding-bottom: 0px;" />
					</td>
					<td style=" width:700px;font-size:11pt;">
						If you selected <b>NO</b> for each statement above, you do not need to answer the remaining questions. Please initial line <b>G</b>, below, and sign and date the worksheet.
					</td>
				</tr>
				<tr>
					<td style="width:20px;padding-left: 20px;padding-right:0px;vertical-align: top;">
						<img src="' . GENERIC_PATH . 'images/ca_images/bg-arrow.png" style="float:left;" />
					</td>
					<td style="width:20px; width:700px;font-size:11pt;">
						 If you selected <b>YES</b> to any part of question #2, please answer question #3.
					</td>
				</tr>
			</table>
			<table style="width:726px; margin:0 auto; padding: 0px 0;">
				<tr>
					<td style="width:20px;padding-left: 0px;padding-right:0px;vertical-align: top;padding-bottom: 2px;font-size:11pt;">
						3. Do you share living expenses (bills, food, etc.) and share income (either your income, the otherperson&rsquo;s income or both &nbsp;&nbsp;&nbsp;&nbsp;incomes together) with at least one of the adults listed above in question #2?&nbsp;&nbsp;' . $share_yes . '&nbsp;&nbsp;' . $share_no . '</td>
					</td>
				</tr>
			</table>
			<table style="width:726px; margin:0 auto 5px; background:#e6e7e8;padding: 2px 0;">
				<tr>
					<td style="width:20px;padding-left: 20px;padding-right:0px;vertical-align: top;padding-bottom: 0px;">
						<img src="' . GENERIC_PATH . 'images/ca_images/bg-arrow.png" style="float:left;padding-bottom: 0px;" />
					</td>
					<td style=" width:700px;font-size:11pt;">
						 If you selected <b>NO</b>, then your address <b>includes more than one household.</b> Please initial lines <b>F</b> and <b>G</b> below, and sign and date the worksheet.
					</td>
				</tr>
				<tr>
					<td style="width:20px;padding-left: 20px;padding-right:0px;vertical-align:">
						<img src="' . GENERIC_PATH . 'images/ca_images/bg-arrow.png" style="float:left;" />
					</td>
					<td style="width:20px; width:700px;font-size:11pt;">
						 If you selected <b>YES</b>, then your address includes only <b>one household</b>. You may not sign up for California LifeLine because someone in your household already receives the discount.
					</td>
				</tr>
			</table>
			<table style="width:726px; margin:0 auto; border:2px solid #000;padding:0 2px;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="background: #e6e7e8;text-align: center;">
						<p style="font-weight: bold;margin: 4px 0 0 0px;font-size:13pt;">CERTIFICATION </p>
						 <p style="font-weight: bold;margin:0px 0 0 0px;font-size:11pt;">Please initial the certifications below and sign and date this worksheet.<br> Submit this worksheet along with your California LifeLine form and copies of your proof of eligibility.
						</p>
					</td>
				</tr>
				<tr>
					<td style=" padding:0;">
						<table style="width:auto;padding: 0 0 0 40px;">
							<tr>
								<td style="font-weight: bold;vertical-align: bottom;padding-top: 0px;font-size:11pt;padding-bottom:5px;">F.</td>
								<td>
									<table style="width:85px;padding: 0;">
										<tr>
											<td colspan="2"  style="text-align: center;color: #000;font-weight: bold;font-size:10pt;">Initial Here</td>
										</tr>
										' . $initials_I . '
									</table>
								</td>
								<td style="padding-top: 0px;padding-left: 10px;font-size:11pt; vertical-align:bottom; padding-bottom:5px;">I certify that there are multiple households at my service address.</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style=" padding:0;">
						<table style="width:auto;padding: 0 0 0 40px;">
							<tr>
								<td style="font-weight: bold;vertical-align:middle;padding-top: 0px;font-size:11pt;padding-bottom:5px;">G.</td>
								<td  style="vertical-align: top; width:85px;">
									<table style="width:85px;padding: 0;">
										<tr>
											<td colspan="2" style="height:1px;"></td>
										</tr>
										' . $initials_II . '
									</table>
								</td>
								<td style="padding-top: 0px;padding-left: 10px;font-size:11pt;">I understand that violation of the one-per-household requirement is against the Federal Communication Commission&rsquo;s rules and may result in me losing my California LifeLine discounts, and potentially, prosecution by the United States government.
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>';
    return $str;
}

function dirToArray($dir) {

    $result = array();

    $cdir = scandir($dir);
    foreach ($cdir as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            } else {
                $result[] = $value;
            }
        }
    }

    return $result;
}

function check_digital_signature($enroll_id) {
    global $con;
    $numericOnly            = preg_replace("/[^0-9]+/", "", $enroll_id);
    $numeric_enroll_id      = "OR enroll_id='" . $numericOnly . "'";
    $sqlCustomersign        = "SELECT signature FROM " . DBNAME . ".tbl_customer_sign where enroll_id='" . $enroll_id . "' $numeric_enroll_id order by id desc limit 1";
    $result_sqlCustomersign = mysql_query($sqlCustomersign, $con);
    return mysql_num_rows($result_sqlCustomersign);
}

function get_agent_name_generic($emp_id) {
    global $con;
    $name   = '';
    $sql    = "SELECT fname,lname FROM tbl_employee WHERE e_id = " . $emp_id;
    $result = mysql_query($sql, $con);
    if (mysql_num_rows($result) > 0) {
        $row  = mysql_fetch_object($result);
        $name = strtoupper($row->fname . " " . $row->lname);
    }
    return $name;
}

function get_agent_data_form_tbl_agent_signature($emp_id) {
    global $con;
    $row    = '';
    $sql    = "SELECT * FROM tbl_agent_signature WHERE e_id = " . $emp_id . " order by id DESC limit 1 ";
    $result = mysql_query($sql, $con);
    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_object($result);
    }
    return $row;
}

function get_agent_signature_by_enrollid($enroll_id) {
    global $con;
    $row              = '';
    $sql_signature_id = "SELECT agent_signature_id FROM tbl_webenrollment_plus WHERE enroll_id = '" . $enroll_id . "'";
    $query_signature  = mysql_query($sql_signature_id, $con);
    $obj_sign         = mysql_fetch_object($query_signature);
    $sign_id          = $obj_sign->agent_signature_id;

    $sqlCustomer    = "SELECT * FROM tbl_agent_signature where id='" . $sign_id . "'";
    $query_Customer = mysql_query($sqlCustomer, $con);
    $row = mysql_fetch_object($query_Customer);
    return $row;
}

function EbbHeader($type = NULL) {
    if ($type == 'HOUSEHOLD') {
        $form_type = "Household Worksheet";
        $code      = "5631";
    } else if ($type == 'Recertification') {
        $form_type = "Annual Recertification Form";
        $code      = "5630";
    } else {
        $form_type = "Application Form";
        $code      = '5638';
    }

$heder = '<thead>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="">
        <tr>
          <td valign="top" width="300" align="left" style="color:#f47521; font-weight:bold">FCC FORM ' . $code . '</td>
          <td valign="top"width="400"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              </tr>
            </table></td>
          <td valign="top"width="300" align="right"></td>
        </tr>
        <tr>
          <td valign="top" colspan="2" width="700" align="left"><span style="color:#578bc8; font-size:30px; font-weight:600">Emergency Broadband Benefit Program</span><br/>
            <strong style="color:#578bc8; font-size:30px; font-weight:bold; margin-bottom:5px;">' . $form_type . '</strong></td>
          <td valign="top"width="300" align="right"><img src="' . LOGO . '" width="430" height="95" /></td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
      </table></td>
  </tr>
</thead>';
return $heder;
}
function EBBFooter($i, $ourof = NULL, $type = NULL) {
    if ($ourof == NULL) {
        $ourof = '8';
    }
    if ($type == 'Recertification') {
        $url = 'www.usac.org';
    } else {
        $url = 'www.getemergencybroadband.org';
    }
    return $foot = '<tr>
      <td valign="top" >
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top" style="font-size:12pt; color:#578bc8; text-align:left" width="341"> Page ' . $i . ' of ' . $ourof . ' </td>
            <td valign="top" width="158">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td width="600"  valign="top"  style="font-size:12pt; color:#ccc; text-align:right"><span style="font-size:12pt; color:#578bc8; text-align:right">Universal Service Administrative Company | ' . $url . '</span><br />
              <span style="font-size:12pt; color:#999; text-align:right">Need help? Call the Emergency Broadband Support Center at 1-833-511-0311</span></td>
          </tr>
        </table>
        </td>
    </tr>';
}
function EBBprogrammes($participate_program, $tribal_show, $isTX = '') {
    $program = explode("::", $participate_program);
    $program = array_map('trim', $program);
    $program = array_map('strtoupper', $program);

    if (in_array('SNAP', $program) || in_array('OKSNAP', $program))
        $SNAP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $SNAP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('SSI', $program))
        $SSI = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $SSI = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('MEDIC', $program) || in_array('OKMCAID', $program))
        $MEDIC = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $MEDIC = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('FPHA', $program) || in_array('FPH', $program) || in_array('SEC8', $program))
        $FPH = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $FPH = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('VPSBP', $program))
        $VPSBP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $VPSBP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('BIAGA', $program) || in_array('BIA', $program) || in_array('TRGA', $program))
        $BIAGA = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $BIAGA = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('TANF', $program) || in_array('TATAN', $program))
        $TANF = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $TANF = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('FDP', $program) || in_array('FDPIR', $program) || in_array('TFDP', $program))
        $FDP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $FDP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';

    if (in_array('TRIBAL', $program) || in_array('HEADS', $program) || in_array('HST', $program))
        $TRIBAL = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
    else
        $TRIBAL = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';    

    $data = '<tr>
   <td valign="middle" style="font-weight:normal">' . $SNAP . '&nbsp;Supplemental Nutrition Assistance Program (SNAP, also called Food Stamps)</td>
</tr>
<tr>
   <td valign="middle" style="font-weight:normal">' . $SSI . '&nbsp;Supplemental Security Income (SSI)</td>
</tr>
<tr>
   <td valign="middle" style="font-weight:normal">' . $MEDIC . '&nbsp;Medicaid</td>
</tr>
<tr>
   <td valign="middle" style="font-weight:normal">' . $FPH . '&nbsp;Federal Public Housing Assistance (FPHA)</td>
</tr>
<tr>
   <td valign="middle" style="font-weight:normal">' . $VPSBP . '&nbsp;Veterans Pension or Survivors Benefit Programs</td>
</tr>
<tr>
   <td valign="middle" style="font-weight:normal">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td width="10" valign="top"><img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;</td>
            <td width=""> Free and Reduced Price School Lunch or Breakfast Program in the 2019-20 or 2020-21 school
               year. If you choose this program, please enter your school name, school district and state.
            </td>
         </tr>
      </table>
   </td>
</tr>
<tr>
   <td valign="top" style="font-weight:normal; padding-left:20px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td valign="top" width="250">School Name</td>
            <td valign="top" width="25">&nbsp;</td>
            <td valign="top" width="250">School District</td>
            <td valign="top" width="25">&nbsp;</td>
            <td valign="top" width="100">State</td>
         </tr>
         <tr>
            <td valign="top" width="250">
               <table>
                  <tr>
                     <td valign="top" width="250" style="border:1px solid #ccc; padding:5px">SchoolName</td>
                  </tr>
               </table>
            </td>
            <td valign="top" width="25">&nbsp;</td>
            <td valign="top" width="250">
               <table>
                  <tr>
                     <td valign="top" width="250" style="border:1px solid #ccc; padding:5px">SchoolDistrict</td>
                  </tr>
               </table>
            </td>
            <td valign="top" width="25">&nbsp;</td>
            <td valign="top" width="100" >
               <table>
                  <tr>
                     <td valign="top" width="50" style="border:1px solid #ccc; padding:5px">O</td>
                     <td valign="top" width="50" style="border:1px solid #ccc; padding:5px">K</td>
                  </tr>
               </table>
         </tr>
      </table>
   </td>
</tr>
<tr>
    <td valign="middle" style="font-weight:normal"></td>
</tr>';
if ($tribal_show=='YES') {
    $data .='<tr>
   <td valign="middle" style="font-weight:normal">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td colspan="2">&nbsp;</td>
         </tr>
         <tr>
         <tr>
            <td colspan="2">Tribal Specific Programs</td>
         </tr>
         <tr>
            <td width="5%"></td>
            <td width="95%">' . $BIAGA . '&nbsp;Bureau of Indian Affairs (BIA) General Assistance </td>
         </tr>
         <tr>
            <td></td>
            <td>' . $TANF . '&nbsp;Tribal Temporary Assistance for Needy Families (Tribal TANF) </td>
         </tr>
         <tr>
            <td></td>
            <td>' . $FDP . '&nbsp;Food Distribution Program on Indian Reservations (FDPIR) </td>
         </tr>
         <tr>
            <td></td>
            <td>' . $TRIBAL . '&nbsp;Tribal Head Start (only households that meet the income qualifying standard)</td>
         </tr>
         <tr>
            <td></td>
            <td>&nbsp;</td>
         </tr>
      </table>
   </td>
</tr>';
}

return $data;

}
function ebb_address_type($address_type) {
    $addresstType = array('T'=>'Yes','P'=>'No');
    $add_type = '';
    foreach ($addresstType as $key => $value) {
        $imgName = 'c_no.png';
        if ($address_type==$key) {
            $imgName = 'check.png';
        }
        $add_type .= '<td valign="middle"><img style="width:20px; height:20px;" src="images/' . $imgName . '" /> '.$value.'&nbsp;&nbsp;</td>';
    }
    return $add_type;
}

function ebb_way_reach($best_way_reach) {
    $bestWay = array('EMAIL','PHONE','TEXT','MAIL');
    
    $str = explode(',', $best_way_reach);
    $str = array_map('trim', $str);
    $str = array_map('strtoupper', $str);
    $str_new = '';
    foreach ($bestWay as $key => $value) {
        $checkImg = 'c_no.png';
        if (in_array($value, $str)) {
            $checkImg = 'check.png';
        }
        $str_new .= '<td valign="top" width="25%"><img style="width:18px; height:18px;" src="images/'.$checkImg.'" />&nbsp;'.ucfirst(strtolower($value)).' ';
    }
    

    return $str_new;
}

function EBBprogrammes2($participate_program, $tribal_show, $isTX = '') {
    $program = explode("::", $participate_program);
    $program = array_map('trim', $program);
    $program = array_map('strtoupper', $program);

    //$programArr = array('SNAP','OKSNAP','SSI','MEDIC','OKMCAID','FPHA','FPH','SEC8','VPSBP','BIAGA','BIA','TRGA','TANF','TATAN','FDP','FDPIR','TFDP','TRIBAL','HEADS','HST');

    $SNAPArr = array('SNAP','OKSNAP');
    $SSIArr = array('SSI');
    $MEDICArr = array('MEDIC','OKMCAID');
    $FPHArr = array('FPHA','FPH','SEC8');
    $VPSBPArr = array('VPSBP');
    $BIAGAArr = array('BIAGA','BIA','TRGA');
    $TANFArr =array('TANF','TATAN');
    $FDPArr = array('FDP','FDPIR','TFDP');
    $TRIBALArr = array('TRIBAL','HEADS','HST');

    $SNAP=$SSI=$MEDIC=$FPH=$VPSBP=$BIAGA=$TANF=$FDP=$TRIBAL = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';
    foreach ($program as $key => $value) {
        if (in_array($value, $SNAPArr)) {
            $SNAP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $SSIArr)){
            $SSI = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $MEDICArr)){
            $MEDIC = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $FPHArr)){
            $FPH = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $VPSBPArr)){
            $VPSBP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $BIAGAArr)){
            $BIAGA = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $TANFArr)){
            $TANF = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $FDPArr)){
            $FDP = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $TRIBALArr)){
            $TRIBAL = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }
    }


    $data = '<tr>
   <td valign="middle" style="font-weight:normal">' . $SNAP . '&nbsp;Supplemental Nutrition Assistance Program (SNAP, also called Food Stamps)</td>
</tr>
<tr>
   <td valign="middle" style="font-weight:normal">' . $SSI . '&nbsp;Supplemental Security Income (SSI)</td>
</tr>
<tr>
   <td valign="middle" style="font-weight:normal">' . $MEDIC . '&nbsp;Medicaid</td>
</tr>
<tr>
   <td valign="middle" style="font-weight:normal">' . $FPH . '&nbsp;Federal Public Housing Assistance (FPHA)</td>
</tr>
<tr>
   <td valign="middle" style="font-weight:normal">' . $VPSBP . '&nbsp;Veterans Pension or Survivors Benefit Programs</td>
</tr>
<tr>
  <td valign="top" style="font-weight:normal; padding-left:20px">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
           <td valign="top" width="250"><strong>School Name</strong></td>
           <td valign="top" width="25">&nbsp;</td>
           <td valign="top" width="250"><strong>School District</strong></td>
           <td valign="top" width="25">&nbsp;</td>
           <td valign="top" width="100"><strong>State</strong></td>
        </tr>
        <tr>
           <td valign="top" width="250">
              <table>
                 <tr>
                    <td valign="top" width="250" style="border:1px solid #ccc; padding:5px">&nbsp;</td>
                 </tr>
              </table>
           </td>
           <td valign="top" width="25">&nbsp;</td>
           <td valign="top" width="250">
              <table>
                 <tr>
                    <td valign="top" width="250" style="border:1px solid #ccc; padding:5px">&nbsp;</td>
                 </tr>
              </table>
           </td>
           <td valign="top" width="25">&nbsp;</td>
           <td valign="top" width="100" >
              <table>
                 <tr>
                    <td valign="top" width="50" style="border:1px solid #ccc; padding:5px">&nbsp;</td>
                    <td valign="top" width="50" style="border:1px solid #ccc; padding:5px">&nbsp;</td>
                 </tr>
              </table>
        </tr>
     </table>
  </td>
</tr>
<tr>
  <td valign="middle" style="font-weight:normal"></td>
</tr>';
if ($tribal_show=='YES') {
    $data .='<tr>
   <td valign="middle" style="font-weight:normal">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td colspan="2">&nbsp;</td>
         </tr>
         <tr>
         <tr>
            <td colspan="2">Tribal Specific Programs</td>
         </tr>
         <tr>
            <td width="5%"></td>
            <td width="95%">' . $BIAGA . '&nbsp;Bureau of Indian Affairs (BIA) General Assistance </td>
         </tr>
         <tr>
            <td></td>
            <td>' . $TANF . '&nbsp;Tribal Temporary Assistance for Needy Families (Tribal TANF) </td>
         </tr>
         <tr>
            <td></td>
            <td>' . $FDP . '&nbsp;Food Distribution Program on Indian Reservations (FDPIR) </td>
         </tr>
         <tr>
            <td></td>
            <td>' . $TRIBAL . '&nbsp;Tribal Head Start (only households that meet the income qualifying standard)</td>
         </tr>
         <tr>
            <td></td>
            <td>&nbsp;</td>
         </tr>
      </table>
   </td>
</tr>';
}

return $data;

}
function EBBproofids($proofIds='') {
    $proof_ids = explode("::", $proofIds);
    $proof_ids = array_map('trim', $proof_ids);
    $proof_ids = array_map('strtoupper', $proof_ids);

    //$programArr = array('SNAP','OKSNAP','SSI','MEDIC','OKMCAID','FPHA','FPH','SEC8','VPSBP','BIAGA','BIA','TRGA','TANF','TATAN','FDP','FDPIR','TFDP','TRIBAL','HEADS','HST');

    $DL_Arr = array('DL');
    $MILITAY_Arr = array('MILITAY_ID');
    $PASSPORT_Arr = array('PASSPORT');
    $TAX_Arr = array('TAX_ID');
    $GOV_Arr = array('GOV_ID');


    $DL_ID=$MILITAY_ID=$PASSPORT=$TAX_ID=$GOV_ID = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/c_no.png" />&nbsp;';
    foreach ($proof_ids as $key => $value) {
        if (in_array($value, $DL_Arr)) {
            $DL_ID = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $MILITAY_Arr)){
            $MILITAY_ID = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $PASSPORT_Arr)){
            $PASSPORT = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $TAX_Arr)){
            $TAX_ID = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }else if(in_array($value, $GOV_Arr)){
            $GOV_ID = '<img style="width:22px; height:22px;" src="' . GENERIC_PATH . 'images/' . CHECK_IMAGE . '" />&nbsp;';
        }
    }


    $data = '<tr>
            <td valign="top" style="padding:4px; height:35px; width:27px">&nbsp;</td>
            <td valign="top" colspan="15"style=" padding:4px; height:35px; width:300px">Driver\'s License</td>
            <td valign="top" align="center" style=" padding:4px; height:35px; line-height:35px; width:27px">'.$DL_ID.'</td>
            <td valign="top" colspan="15"style=" padding:4px; height:35px; width:200px">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top" style="padding:4px; height:35px; width:27px">&nbsp;</td>
            <td valign="top" colspan="15"style=" padding:4px; height:35px; width:300px">Military ID</td>
            <td valign="top" align="center" style=" padding:4px; height:35px; line-height:35px; width:27px">'.$MILITAY_ID.'</td>
            <td valign="top" colspan="15"style=" padding:4px; height:35px; width:200px">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top" style="padding:4px; height:35px; width:27px">&nbsp;</td>
            <td valign="top" colspan="15"style=" padding:4px; height:35px; width:300px">Passport</td>
            <td valign="top" align="center" style=" padding:4px; height:35px; line-height:35px; width:27px">'.$PASSPORT.'</td>
            <td valign="top" colspan="15"style=" padding:4px; height:35px; width:200px">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top" style="padding:4px; height:35px; width:27px">&nbsp;</td>
            <td valign="top" colspan="15"style=" padding:4px; height:35px; width:300px">Tax payer Identification Number</td>
            <td valign="top" align="center" style=" padding:4px; height:35px; line-height:35px; width:27px">'.$TAX_ID.'</td>
            <td valign="top" colspan="15"style=" padding:4px; height:35px; width:200px">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top" style="padding:4px; height:35px; width:27px">&nbsp;</td>
            <td valign="top" colspan="15"style=" padding:4px; height:35px; width:300px">Other Government ID</td>
            <td valign="top" align="center" style=" padding:4px; height:35px; line-height:35px; width:27px">'.$GOV_ID.'</td>
            <td valign="top" colspan="15"style=" padding:4px; height:35px; width:200px">&nbsp;</td>
          </tr>';

return $data;

}

function dynamic_box2($str, $max, $type) {

    $final_str = "";
    $i         = 0;
    if ($type == 'dob') {
        if ($str != '') {
            $str = date("m-d-Y", strtotime($str));
        } else {
            $str = "";
        }
    }
    $arr       = str_split($str);
    $count_str = count($arr);
    $filled_str = '';

    if ($type == 'phone_number' || $type == 'dob') {
        if ($count_str > 1) {
            foreach ($arr as $strval) {
                if ($i > $max) {
                    break;
                }
                if ($strval == '-') {
                    $filled_str .= '<td valign="middle" style=" padding:4px; height:27px; width:27px; background-color:#eee;">&nbsp;</td>';
                } else {
                    if (($type == 'phone_number' && ($i == '3' || $i == '6')) || ($type == 'dob' && ($i == '2' || $i == '5'))) {
                        $filled_str .= '<td valign="middle" style=" padding:4px; height:27px; width:27px; background-color:#fff;">&nbsp;</td>';
                    }
                    $filled_str .= '<td valign="middle" style="border:1px solid #ccc; padding:4px; height:35px; width:27px; background-color:#fff;">' . $strval . '</td>';
                }
                $i++;
            }
        } else {
            for ($i = 0; $i < 12; $i++) {
                if (($type == 'phone_number' && ($i == '3' || $i == '6')) || ($type == 'dob' && ($i == '2' || $i == '5'))) {
                    $filled_str .= '<td valign="middle" style=" padding:4px; height:27px; background-color:#eee; width:27px">&nbsp;</td>';
                } else {
                    if ($type == 'dob' && $i > 9) {
                        break;
                    }
                    $filled_str .= '<td valign="middle" style="border:1px solid #ccc; padding:4px; height:35px; width:27px; background-color:#fff;">&nbsp;</td>';
                }
            }
        }
        $final_str = $filled_str;
    } else {

        $final_str = empty_box($filled_str, $count_str, $max);
    }


    return $final_str;
}
?>
