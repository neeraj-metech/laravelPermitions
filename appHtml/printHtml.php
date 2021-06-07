<?php

include_once("mpdf/mpdf.php");
include_once(GENERIC_PATH . "functions.php");

$initionals = initionals($fname, $lastname);

//$FromfilepathTBAgentSig = $signpath;

/*
  //if($same_ben == 'Y' || $same_ben == '1' ||  !isset($same_ben))
  if(($same_ben == 'Y' || $same_ben == '1' || !isset($same_ben)) && (strtoupper($source) == 'TABLET_FASTTRACK' || strtoupper($source) == 'WEBSITE_FASTTRACK'))
  {
  $ben_ssn = "";
  $ben_fname = "";
  $ben_middlename = "";
  $ben_lastname = "";
  $beni_dob = "";
  $ben_suffix_name= "";
  }
 */

$same_ben = same_ben($fname, $lastname, $ssn_number, $birthdate, $ben_fname, $ben_lastname, $ben_ssn, $beni_dob, $reg_date, 'flag');
if ($same_ben == 'Y') {
    $ben_ssn         = "";
    $ben_fname       = "";
    $ben_middlename  = "";
    $ben_lastname    = "";
    $beni_dob        = "";
    $ben_suffix_name = "";
}


if (check_digital_signature($enroll_id) > 0 && file_exists($FromfilepathTBSig)) {
    $FromfilepathTBSig = '<img width="350px" height="20px;" src="' . $FromfilepathTBSig . '" />';
} else {
    $FromfilepathTBSig = 'Electronically Signed by <b>' . $fname . '&nbsp;' . $lastname . '</b>';
}

/*
  else if(($company == 1 && $state != 'WI') || $company == 40 || $company == 45 || $company == 49 || ($company == 13 && strtoupper($source_send) == 'WEBSITE'))
  {
  $FromfilepathTBSig = 'Electronically Signed by <b>'.$fname.'&nbsp;'.$lastname.'</b>';
  }
  else
  {
  $FromfilepathTBSig = '<img width="350px" height="20px;" src="'.$FromfilepathTBSig.'" />';
  //$FromfilepathTBSig = '<img width="350px" height="20px;" src="/var/www/html/global-agent/storedpics/global_agent_sign_133_TS294878.png" />';
  }
 */
$additional_pages = "";

if (strtoupper($source_send) == 'WEBSITE' && $company == 13) {
    include_once('safetynet_additional_pages.php');
    $logo             = PROJECT_HOME . "images/safetynet_wireless_logo.png";
    $created_time     = date('m/d/Y h:i A', strtotime($posted_datetime));
    $additional_pages = get_safetynet_additional_pages($fname, $middlename, $lastname, $birthdate, $ssn_number, $phone_number, $address_main, $address_sec, $city, $state, $zipcode, $d_address_main, $d_address_sec, $d_city, $d_state, $d_zipcode, $address_type, $created_time, $logo);
}

if ($enrollment_type=='EBB1') {
  include_once(GENERIC_PATH . "USAC_EBB_Enrollment_Form.php");
}else{
$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	</head>

	<body style="margin:0 auto; font-family: Arial; font-size:14pt; line-height:20pt; ">
	<div style=" width:100%; height:auto; float:left">
	  <table width="1024" border="0" cellpadding="0" cellspacing="0" >
		' . header1() . '
    <tr>
      <td valign="top" width="100%">
        <hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    <tr>
      <td valign="top"><table width="980" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="273" valign="top"><h1 style="font-size:30pt; font-weight:800"> 1.<br />
                About <br />
                Lifeline</h1>
              Lifeline is a federal
              benefit that lowers the
              monthly cost of phone
              or internet service. </td>
            <td width="707" valign="top" style="padding:5px "><table width="100%" border="0" cellpadding="0" cellspacing="0"  >
                <tr>
                  <td valign="top" style="height:30px; line-height:28px; padding:8px 0px"><h2 style="font-size:30px; font-weight:normal; font-family:sans-serif; color:#09C; padding:8px 0px">Rules</h2></td>
                </tr>
                <tr>
                  <td>If you qualify, your household can get Lifeline for phone or internet service, but not both.</td>
                </tr>
                <tr>
                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top" width="50px" align="right" style="padding:5px; color:#39C; "><li>&nbsp;</li></td>
                        <td valign="top"  align="left" style="padding:5px"><b> If you get Lifeline for phone service
                          ,</b> you can get the benefit for one mobile phone or one home
                          phone, but not both. </td>
                      </tr>
                      <tr>
                        <td valign="top" width="50px" align="right" style="padding:5px; color:#39C; "><li>&nbsp;</li></td>
                        <td valign="top"  align="left" style="padding:5px"><b> If you get Lifeline for internet service
                          ,</b> you can get the benefit for your mobile phone or your home
                          connection, but not both. </td>
                      </tr>
                      <tr>
                        <td valign="top" width="50px" align="right" style="padding:5px; color:#39C; "><li>&nbsp;</li></td>
                        <td valign="top"  align="left" style="padding:5px"> <b>If you get Lifeline for bundled phone and internet service,</b>
                          you can get the benefit for your mobile
                          phone bundled service or your home bundled service, but not both.</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td valign="top">Your household cannot get Lifeline from more than one phone or internet company.</td>
                </tr>
                <tr>
                  <td valign="top">You are only allowed to get one Lifeline benefit per household,
                    <b>not per person</b>
                    . If more than one person in
                    your household gets Lifeline, you are breaking the FCC&#39;s rules and will lose your benefit.</td>
                </tr>
                <tr>
                  <td valign="top" style="height:20px; line-height:28px; padding:8px 0px"><span style="font-size:25px; font-weight:normal; font-family:sans-serif; color:#09C; padding:8px 0px">What is a household?</span></td>
                </tr>
                <tr>
                  <td valign="top">A household is a group of people who live together and share income and expenses (even if they are not related to each other). </td>
                </tr>
                <tr>
                  <td valign="top" style="height:20px; line-height:28px; padding:8px 0px"><span style="font-size:25px; font-weight:normal; font-family:sans-serif; color:#09C; padding:8px 0px">Do not give your benefit to another person</span></td>
                </tr>
                <tr>
                  <td valign="top">Lifeline is non-transferable. You cannot give your Lifeline benefit to another person, even if they qualify. </td>
                </tr>
                <tr>
                  <td valign="top" style="height:20px; line-height:28px; padding:8px 0px"><span style="font-size:25px; font-weight:normal; font-family:sans-serif; color:#09C; padding:8px 0px">Be honest on this form</span></td>
                </tr>
                <tr>
                  <td valign="top">You must give accurate and true information on this form and on all Lifeline-related forms or questionnaires. If you give false or fraudulent information, you will lose your Lifeline benefit (i.e., de-enrollment or being barred from the program) and the United States government can take legal actions against you. This may include (but is not limited to) fines or imprisonment.</td>
                </tr>
                <tr>
                  <td valign="top" style="height:30px; line-height:28px; padding:8px 0px"><span style="font-size:25px; font-weight:normal; font-family:sans-serif; color:#09C; padding:8px 0px">You may need to show other documents</span></td>
                </tr>
                <tr>
                  <td valign="top">You will need to show your phone or internet company an official document from one of the government
                    qualifying programs or  prove your annual income. Please provide copies of your official documents with this
                    application. Include the documents in option 1 or option 2 below:</td>
                </tr>
                <tr>
                  <td valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top" width="50px" align="right" style="padding:5px; color:#39C; ">1.</td>
                        <td valign="top"  align="left" style="padding:5px">If you qualify through a government program: copies of your state ID card and an official document from the program you are qualifying through (your SNAP card, Medicaid card, Supplemental Security Income (SSI) benefit letter, Federal Public Housing Assistance (FPHA) award letter, or other accepted documents).</td>
                      </tr>
                      <tr>
                        <td valign="top" width="50px" align="right" style="padding:5px; color:#39C; ">2.</td>
                        <td valign="top"  align="left" style="padding:5px">If you qualify through your income: copies of your state ID card and your last state, federal, or Tribal tax return, pay stubs for 3 consecutive months, or other accepted documents. Visit lifelinesupport.org to see the full list of accepted documents.</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td valign="top">Visit lifelinesupport.org to see the full list of accepted documents</td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td valign="top" style="border: 5px solid #ffb956;"><table width="100%" border="0">
                <tr>
                  <td valign="top" width="50%" style="padding:5px"><span style="font-size:30px; font-weight:normal; font-family:sans-serif; color:#333">Apply</span><br />
                    <P>To apply for a Lifeline benefit, fill out every  section of this form, initial every agreement statement, and sign the last page. </P></td>
                  <td valign="top" width="50%" style="padding:5px">To apply, bring or mail this form to your phone or
                    internet company. <br/>
					<b>' . COMPANY_DETAILS . '</b>
					</td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
	 <tr>
      <td valign="top" width="100%" height="110">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" width="100%"><hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
   ' . footer(1) . '
  </table>
</div>';

//Second Page Start


$html .= '<div style=" width:100%; height:auto; float:left">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    ' . header1() . '
    <tr>
      <td valign="top" width="100%">
        <hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    <tr>
      <td valign="top"><table width="980" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="273" valign="top"><span style="font-size:30pt; font-weight:800"> 2.<br />
              Your <br />
              Information </span><br />
              <br />
              <br />
              All fields are required
              unless indicated. Use only
              CAPITALIZED LETTERS
              and black ink to fill out
              this form </td>
            <td width="707" valign="top" style="padding:10px; border:4px solid #ccc "><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td valign="top"><strong>What is your full legal name?</strong><br />
                          <span style="font-size:12pt; font-weight:normal">The name you use on official documents, like your Social Security Card or State ID. Not a nickname.</span></td>
                      </tr>
                      <tr>
                        <td valign="top" width="600"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              ' . dynamic_box($fname, 25, 'fname') . '
                            </tr>
                          </table>
                          <span style="font-size:12pt; font-weight:normal">First</span></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="500"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($middlename, 19, 'middlename') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">Middle (optional) </span></td>
                              <td valign="top" width="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td valign="top" style="border:; padding:3px; height:27px; width:27px">&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td valign="top" width="100"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($suffix_name, 4, 'suffix_name') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">Suffix (optional) </span></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              ' . dynamic_box($lastname, 25, 'lastname') . '
                            </tr>
                          </table>
                          <span style="font-size:12pt; font-weight:normal">Last</span></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="65%"><strong >What is your phone number</strong> <span style="font-size:12pt; font-weight:normal">(if you have one)?</span></td>
                              <td valign="top" style="text-align:right:" width="35%"><strong >What is your date of birth?</strong></td>
                            </tr>
                            <tr>
                              <td valign="top" width="65%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($phone_number, 25, 'phone_number') . '
                                  </tr>
                                </table></td>
                              <td valign="top" style="text-align:right:" width="35%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($birthdate, 25, 'dob') . '
                                  </tr>
                                  <tr>
                                    <td colspan="2" valign="top" style=""><span style="font-size:12pt; font-weight:normal">Month</span></td>
                                    <td valign="top" style=" padding:4px; height:27px; width:27px">&nbsp;</td>
                                    <td colspan="2" valign="top" style=" padding:4px; height:27px; width:27px"><span style="font-size:12pt; font-weight:normal">Day</span></td>
                                    <td valign="top" style=" padding:4px; height:27px; width:27px">&nbsp;</td>
                                    <td colspan="4" valign="top" style=" padding:4px; height:27px; width:27px"><span style="font-size:12pt; font-weight:normal">Year</span></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><strong>What is your email address</strong> <span style="font-size:12pt; font-weight:normal">(if you have one)
                          ?
                          .</span></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             ' . dynamic_box($email_address, 25, 'email') . '
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top" style="margin-top:10PX"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              ' . dynamic_box($email_address, 25, 'email2') . '
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="600"><strong>What are the last 4 numbers of your Social Security Number </strong>(SSN)?</td>
                              <td valign="top" width="100"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
								    c
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td colspan="2" valign="top"><span style="font-size:12pt; font-weight:normal">If you do not have a SSN, what is your Tribal Identification Number? </span>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><strong>What is the best way to reach you?</strong></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             ' . way_reach($best_way_reach) . '
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td valign="top" style="border: ">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td valign="top" width="100%" height="280">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" width="100%"><hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    ' . footer(2) . '
  </table>
</div>';

// Third Page Start

$html .= '<div style=" width:100%; height:auto; float:left">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    ' . header1() . '
    <tr>
      <td valign="top" width="100%">
        <hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    <tr>
      <td valign="top"><table width="980" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="273" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top"><span style="font-size:30pt; font-weight:800"> 2.<p>Your </p>
                    <p>Information</p>
                    <p>(continued) </p></span></td>
                </tr>
                <tr>
                  <td valign="top" height="100">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top">  <span style="font-size:10pt; font-weight:normal; line-height:12pt; "><p>*  Tribal lands include any federally recognized Indian tribe&#39;s reservation, pueblo, or colony, including former reservations in Oklahoma; Alaska Native regions established pursuant to the Alaska Native Claims Settlement Act (85 Stat. 688); Indian allotments; Hawaiian Home Lands-areas held in trust for Native Hawaiians by the state of Hawaii, pursuant to the Hawaiian Homes Commission Act, 1920 July 9, 1921, 42 Stat. 108, et. seq., as amended; and any land designated as such by the Commission for purposes of this subpart pursuant to the designation process in the FCC&#39;s Lifeline rules.</p></span></td>
                </tr>
              </table>
              <div style="margin-top:200px"></div></td>
            <td width="707" valign="top" style="padding:10px; border:4px solid #ccc "><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td valign="top"><strong>What is your home address?</strong> <span style="font-size:12pt; font-weight:normal">(The address where you will get service. Do not use a P.O. Box)</span></td>
                      </tr>
                      <tr>
                        <td valign="top" width="600"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>

							' . dynamic_box($address_main, 25, 'address_main') . '

                            </tr>
                          </table>
                          <span style="font-size:12pt; font-weight:normal">Street Number and Name</span></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="100"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($address_sec, 7, 'address_sec') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">Apt., Unit, etc. </span></td>
                              <td valign="top" width="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td valign="top" style="border:; padding:3px; height:27px; width:27px">&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td valign="top" width="500"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                     ' . dynamic_box($city, 18, 'city') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">City </span></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="60"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($state, 1, 'state') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">State</span></td>
                              <br />
                              <td valign="top" width="30">&nbsp;</td>
                              <td valign="top" width="200"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($zipcode, 4, 'zipcode') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">Zip Code</span></td>
                              <td valign="top">&nbsp;</td>
                              <td valign="top">&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="45%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td valign="middle"><strong style="font-size:16px;">Is this a temporary address ?</strong></td>
                                    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          ' . address_type($address_type) . '
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table></td>
                              <td valign="top" width="55%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td style="text-align:right;" valign="middle"><strong style="font-size:16px; text-align:right;">&nbsp;&nbsp;&nbsp;&nbsp;Check if you live on Tribal Lands*</strong></td>
                                    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          ' . tribal_land($zipcode, $company_id) . '
                                          <td valign="top">&nbsp;</td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><strong>What is your mailing address?</strong> <span style="font-size:12pt; font-weight:normal">(Only fill this out if it is not the same as your home address.)</span></td>
                      </tr>
                      <tr>
                        <td valign="top" width="600"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              ' . dynamic_box($d_address_main, 25, 'd_address_main') . '
                            </tr>
                          </table>
                          <span style="font-size:12pt; font-weight:normal">Street Number and Name</span></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="100"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($d_address_sec, 7, 'd_address_sec') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">Apt., Unit, etc. </span></td>
                              <td valign="top" width="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td valign="top" style="border:; padding:3px; height:27px; width:27px">&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td valign="top" width="500"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                   ' . dynamic_box($d_city, 18, 'd_city') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">City </span></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="60"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($d_state, 1, 'd_state') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">State</span></td>
                              <br />
                              <td valign="top" width="30">&nbsp;</td>
                              <td valign="top" width="200"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($d_zipcode, 4, 'd_zipcode') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">Zip Code</span></td>
                              <td valign="top">&nbsp;</td>
                              <td valign="top">&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td valign="top" style="border: ">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td valign="top" width="100%" height="390">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" width="100%" ><hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    ' . footer(3) . '
  </table>
</div>';

//Fourth Page Start


$html .= '<div style=" width:100%; height:auto; float:left">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    ' . header1() . '
    <tr>
      <td valign="top" width="100%">
        <hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    <tr>
      <td valign="top"><table width="980" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="273" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="194" valign="top"><span style="font-size:30pt; font-weight:800"> 2.<br />
					Your  Information (continued)
                </tr>
                <tr>
                  <td valign="top"><span style=" color:#F60 ">Only fill this section
                    out if you are applying
                    through a child or
                    dependent.</span></td>
                </tr>
              </table>
              <div style="margin-top:200px"></div></td>
            <td width="707" valign="top" style="padding:10px; border:4px solid #ccc; background-color:#eeeeee"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="">
                <tr>
                  <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td valign="top"><span style="background-color:#fff">' . same_ben($fname, $lastname, $ssn_number, $birthdate, $ben_fname, $ben_lastname, $ben_ssn, $beni_dob, $reg_date, '') . '
                          </span><label for="checkbox"></label>
                          <strong>Check if you are qualifying through a child or dependent in your household.
                          If so, answer the following questions:</strong></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><strong>What is their full legal name?</strong></td>
                      </tr>
                      <tr>
                        <td valign="top" width="600"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr style="background-color:#fff;">
                               ' . dynamic_box($ben_fname, 25, 'ben_fname') . '
                            </tr>
                          </table>
                          <span style="font-size:12pt; font-weight:normal">First</span></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="500"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr style="background-color:#fff;">
                                    ' . dynamic_box($ben_middlename, 19, 'ben_middlename') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">Middle (optional) </span></td>
                              <td valign="top" width="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td valign="top" style="border:; padding:3px; height:27px; width:27px">&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td valign="top" width="100"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr style="background-color:#fff;">
                                    ' . dynamic_box($ben_suffix_name, 4, 'ben_suffix_name') . '
                                  </tr>
                                </table>
                                <span style="font-size:12pt; font-weight:normal">Suffix (optional) </span></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr style="background-color:#fff;">
                               ' . dynamic_box($ben_lastname, 25, 'ben_lastname') . '
                            </tr>
                          </table>
                          <span style="font-size:12pt; font-weight:normal">Last</span></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="50%"><strong>What is their date of birth?</strong></td>
                              <td valign="top" width="50%"></td>
                            </tr>
                            <tr>
                              <td valign="top" width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr >
                                    ' . dynamic_box($beni_dob, 25, 'dob') . '
                                  </tr>
                                  <tr>
                                    <td colspan="2" valign="top" style=""><span style="font-size:12pt; font-weight:normal">Month</span></td>
                                    <td valign="top" style=" padding:4px; height:27px; width:27px">&nbsp;</td>
                                    <td colspan="2" valign="top" style=" padding:4px; height:27px; width:27px"><span style="font-size:12pt; font-weight:normal">Day</span></td>
                                    <td valign="top" style=" padding:4px; height:27px; width:27px">&nbsp;</td>
                                    <td colspan="4" valign="top" style=" padding:4px; height:27px; width:27px"><span style="font-size:12pt; font-weight:normal">Year</span></td>
                                  </tr>
                                </table></td>
                              <td valign="top" width="50%">&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="600"><strong>What are the last 4 numbers of their Social Security Number (SSN)?</strong></td>
                              <td valign="top" width="100"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr style="background-color:#fff;">
                                     ' . dynamic_box($ben_ssn, 3, 'ssn') . '
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td colspan="2" valign="top"><span style="font-size:12pt; font-weight:normal">If they do not have a SSN, what is your Tribal Identification Number? </span>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr style="background-color:#fff;">
                                   ' . dynamic_box($beni_tribal_id, 25, 'beni_tribal_id') . '
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td valign="top" style="border: ">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td valign="top" width="100%" height="400">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" width="100%" ><hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    ' . footer(4) . '
  </table>
</div>';

//Fifth Page Start

$html .= '<div style=" width:100%; height:auto; float:left">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    ' . header1() . '
    <tr>
      <td valign="top" width="100%">
        <hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    <tr>
      <td valign="top"><table width="980" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="273" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="132" valign="top"><span style="font-size:30pt; font-weight:800">3.<br />
                    Qualify for<br />
                    Lifeline </span></td>
                </tr>
                <tr>
                  <td valign="top"><span style=" color:#F60 ">Fill out this section to
                    show that you, your
                    dependent, or someone
                    in your household
                    qualifies for Lifeline. <br />
                    </br>
                    <br />
                    </br>
                    <br />
                    </br>
                    You can qualify through
                    some government
                    assistance programs or
                    through your income (you
                    do not need to qualify
                    through both). </span></td>
                </tr>
              </table>
              <div style="margin-top:200px"></div></td>
            <td width="707" valign="top" ><span style="color:#09F; font-weight:600; font-size:18PT">Qualify through a government program:</span><br />
              <br />
              <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                <tr>
					<td valign="top" style="padding:10px; border:4px solid #ccc;  ">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" >
						' . programmes($participate_program, 'YES') . '
						</table>
					</td>
                </tr>
                <tr>
                  <td valign="top" style="color:#39F" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="300" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="100%"   style=" border-bottom:solid 4PX #39F">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                          </table></td>
                        <td width="6%" align="center" valign="bottom"><strong style="font-size:18pt;color:#09F;">Or</strong></td>
                        <td width="300" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="100%"   style=" border-bottom:solid 4PX #39F">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td headers="50">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td valign="top" ><span style="color:#09F; font-weight:600; font-size:18pt">Qualify through your income: </span><br />
                    (Only fill this out if you do not qualify through a government program.) </td>
                </tr>
               <tr>
                  <td valign="top" style="padding:10px; border:4px solid #ccc;  "><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="216" valign="top" style="border-right:1px solid #ccc"><strong>Including you, how
                          many people live in your
                          household?
                          (check one)</strong>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="181"><p>&nbsp;<br />
                                </p>
                                <p>&nbsp;</p></td>
                            </tr>
                          </table>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">

                           ' . incomebase_number($household) . '
                            <tr>
                              <td valign="top"><span style="font-size:12pt">&nbsp;</span></td>
                            </tr>
                          </table></td>
                        <td width="460" valign="top" ><p style="padding-left:5px"><strong>Is your income the same or less than the amount listed for your
                            state and household size?</strong> <br />
                            <span style="font-size:12pt">(only check yes or no next to your household size)</span></p>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-left:5px">
                            <tr>
                              <td width="139" height="52" valign="top"><span style="font-size:10pt"><strong>All 48 States & DC</strong></span><br />
                                <span style="font-size:8pt">(not Alaska and Hawaii)</span></td>
                              <td width="99" valign="top"><span style="font-size:10pt"><strong>Alaska</strong></span></td>
                              <td width="225" valign="top"><span style="font-size:10pt"><strong>Hawaii</strong></span></td>
                            </tr>
                          </table>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            ' . incomebase_amount($state, $household) . '
                          </table></td>
                      </tr>
                    </table>
                    <span style="font-size:11pt; color:#000; font-weight:bold"> <br />' . incomebase_amount($state, $household, 'Percent') . '% of the '.date("Y").' Federal Poverty Guidelines </span><br />
                    <span style="font-size:11pt; color:#999; font-weight:normal">*The Federal Poverty Guidelines are typically updated at the end of January.</span></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td valign="top" style="border: ">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td valign="top" width="100%" height="40">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" width="100%" ><hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
   ' . footer(5) . '
  </table>
</div>';

//Six Page Start

$html .= '<div style="height:auto; width:100%; float:left">
  <table width="1024" border="0" style=" margin:0 auto; padding:30px; ">
   ' . header1() . '
    <tr>
      <td valign="top" width="100%">
        <hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    <tr>
      <td valign="top"><table width="980" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="273" valign="top"><table width="100%" height="925" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top"><span style="font-size:30pt; font-weight:800">4.<br />
                    Agreement</span></td>
                </tr>
                <tr>
                  <td valign="top" height="100">I agree, under
                    penalty of perjury,
                    to the following
                    statements:</td>
                </tr>
                <tr>
                  <td valign="top"><span style=" color:#F60 ">You must initial next to
                    each statement.</span></td>
                </tr>
                <tr>
                  <td valign="top" height="90"><span style="font-size:10pt; font-weight:normal; line-height:12pt; "> </span></td>
                </tr>
                <tr>
                  <td height="480" valign="bottom"><span style="font-size:10pt; font-weight:normal; line-height:12pt; ">I consent to let USAC contact me at my Lifeline
                    phone number for important reminders and
                    updates to my Lifeline service.  Message and data
                    rates may apply.  Text STOP to end messages.</span></td>
                </tr>
              </table>
              <div style="margin-top:200px"></div></td>
            <td width="707" valign="top" style="padding:10px; "><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top" style="height:10px ; padding:5px">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								 <td valign="top" align="center" style="height:10px;width:60px ; border:1px solid #ccc;">' . $initionals . '</td>
							</tr>
							<tr>
								<td valign="top">Initial</td>
							</tr>
						</table>
					</td>
                  <td width="680" valign="top" style="padding:5px"> I (or my dependent or other person in my household) currently get benefits from the government
                    program(s) listed on this form or my annual household income is 135% or less than the Federal
                    Poverty Guidelines (the amount listed in the Federal Poverty Guidelines table on this form). </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:10pt; font-weight:normal; line-height:8pt;" >&nbsp;</td>
                </tr>
                <tr>
					<td valign="top" style="height:10px ; padding:5px">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								 <td valign="top" align="center" style="height:10px;width:60px ; border:1px solid #ccc; padding:10px;">' . $initionals . '</td>
							</tr>
							<tr>
								<td valign="top">Initial</td>
							</tr>
						</table>
					</td>
                  <td width="680" valign="top" style="padding:5px"> I agree that if I move I will give my service provider my new address within 30 days. </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" style="height:10px ; padding:5px">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								 <td valign="top" align="center" style="height:10px;width:60px ; border:1px solid #ccc; padding:10px;">' . $initionals . '</td>
							</tr>
							<tr>
								<td valign="top">Initial</td>
							</tr>
						</table>
					</td>
                  <td width="680" valign="top" style="padding:5px"> I understand that I have to tell my service provider within 30 days if I do not qualify for Lifeline
                    anymore, including:
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="10%" align="right" valign="top" style="padding:5px"><strong>1.</strong></td>
                        <td width="90%" valign="top" style="padding:10px"> I, or the person in my household that qualifies, do not qualify through a government
                          program or income anymore</td>
                      </tr>
                      <tr>
                        <td align="right" valign="top" style="padding:5px;"><strong>2.</strong></td>
                        <td valign="top" style="padding:05px"> Either I or someone in my household gets more than one Lifeline benefit (including, more
                          than one Lifeline broadband internet service, more than one Lifeline telephone service, or
                          both Lifeline telephone and Lifeline broadband internet services).</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" style="height:10px ; padding:5px">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								 <td valign="top" align="center" style="height:10px;width:60px ; border:1px solid #ccc; padding:10px;">' . $initionals . '</td>
							</tr>
							<tr>
								<td valign="top">Initial</td>
							</tr>
						</table>
					</td>
                  <td width="680" valign="top" style="padding:5px"> I know that my household can only get one Lifeline benefit and, to the best of my knowledge, my
                    household is not getting more than one Lifeline benefit. </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" style="height:10px ; padding:5px">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								 <td valign="top" align="center" style="height:10px;width:60px ; border:1px solid #ccc; padding:10px;">' . $initionals . '</td>
							</tr>
							<tr>
								<td valign="top">Initial</td>
							</tr>
						</table>
					</td>
                  <td width="680" valign="top" style="padding:5px"> I agree that my service provider can give the Lifeline Program administrator all of the information I
                    am giving on this form. I understand that this information is meant to help run the Lifeline Program
                    and that if I do not let them give it to the Administrator, I will not be able to get Lifeline benefits.
                    </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" style="height:10px ; padding:5px">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								 <td valign="top" align="center" style="height:10px;width:60px ; border:1px solid #ccc; padding:10px;">' . $initionals . '</td>
							</tr>
							<tr>
								<td valign="top">Initial</td>
							</tr>
						</table>
					</td>
                  <td width="680" valign="top" style="padding:5px"> All the answers and agreements that I provided on this form are true and correct to the best of
                    my knowledge.
                    </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" style="height:10px ; padding:5px">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								 <td valign="top" align="center" style="height:10px;width:60px ; border:1px solid #ccc; padding:10px;">' . $initionals . '</td>
							</tr>
							<tr>
								<td valign="top">Initial</td>
							</tr>
						</table>
					</td>
                  <td width="680" valign="top" style="padding:5px"> I know that willingly giving false or fraudulent information to get Lifeline Program benefits is
                    punishable by law and can result in fines, jail time, de-enrollment, or being barred from the
                    program. </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" style="height:10px ; padding:5px">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								 <td valign="top" align="center" style="height:10px;width:60px ; border:1px solid #ccc; padding:10px;">' . $initionals . '</td>
							</tr>
							<tr>
								<td valign="top">Initial</td>
							</tr>
						</table>
					</td>
                  <td width="680" valign="top" style="padding:5px"> My service provider may have to check whether I still qualify at any time. If I need to recertify
                    (renew) my Lifeline benefit, I understand that I have to respond by the deadline or I will be
                    removed from the Lifeline Program and my Lifeline benefit will stop.</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" style="height:10px ; padding:5px">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								 <td valign="top" align="center" style="height:3px;width:60px ; border:1px solid #ccc; padding:4px 10px; border-radius: 4em;">' . $initionals . '</td>
							</tr>
							<tr>
								<td valign="top">Initial</td>
							</tr>
						</table>
					</td>
                  <td width="680" valign="top" style="padding:5px"> I was truthful about whether or not I am a resident of Tribal lands, as defined in section 2 of this
                    form. </td>
                </tr>

                <tr>
                  <td colspan="2" valign="top" style="border:0px solid #F90; padding:10px"><table width="100%" border="0" cellspacing="0" cellpadding="0">

					  <tr>
                        <td width="73%" valign="top">&nbsp;</td>
                        <td width="27%" valign="top">&nbsp;</td>
                      </tr>
					  <tr>
                        <td width="73%" valign="top"><b>Signature</b></td>
                        <td width="27%" valign="top"><b>Today&#39;s Date</b></td>
                      </tr>

                      <tr>
                        <td valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" style="border:2px solid #ccc; padding:15px;" width="500">' . $FromfilepathTBSig . '</td>
                            </tr>
                          </table></td>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" style="border:2px solid #ccc; padding:15px;" width="300">' . $regMonthElect . '&nbsp;' . $regDateElect . ', ' . $regYearElect . '</td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td valign="top" style="border: ">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td valign="top" width="100%" height="80">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" width="100%" ><hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    ' . footer(6) . '
  </table>
</div>';

//Seventh Page Start
$html .= '<div style=" width:100%; height:auto; float:left">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
   ' . header1() . '
    <tr>
      <td valign="top" width="100%">
        <hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    <tr>
      <td valign="top"><table width="980" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="273" valign="top"><span style="font-size:30pt; font-weight:800"> 5.<br />
              Agent <br />
              Information</span> <span style="color:#F60"> Answer only if a sales
              person submits this form.</span></td>
            <td width="707" valign="top" style="padding:10px; border:4px solid #ccc "><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td valign="top"><strong>What is the agent&#39;s full legal name?</strong><br />
                          <span style="font-size:9pt; font-weight:normal">The name you use on official documents, like your Social Security Card or State ID. Not a nickname.</span></td>
                      </tr>
                      <tr>
                        <td valign="top" width="600"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              ' . dynamic_box($agent_f_name, 25, 'fname') . '
                            </tr>
                          </table>
                          <span style="font-size:9pt; font-weight:normal">First</span><br /></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="500"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                  </tr>
                                </table>
                                <span style="font-size:9pt; font-weight:normal">Middle (optional) </span></td>
                              <td valign="top" width="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td valign="top" style="border:; padding:3px; height:27px; width:27px">&nbsp;</td>
                                  </tr>
                                </table></td>
                              <td valign="top" width="100"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                    <td valign="top" style="border:1px solid #ccc; padding:4px; height:35px; width:27px">&nbsp;</td>
                                  </tr>
                                </table>
                                <span style="font-size:9pt; font-weight:normal">Suffix (optional) </span></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
							' . dynamic_box($agent_l_name, 19, 'middlename') . '
						  </tr>
                          </table>
                          <span style="font-size:9pt; font-weight:normal">Last</span></td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top" width="50%" style=""><strong>What is the agent&#39;s ID number?</strong></td>
                              <td valign="top" width="50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>What is the agent&#39;s date of birth?</strong></td>
                            </tr>
                            <tr>
                              <td valign="top" width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($nlad_rad_id, 25, 'phone_number') . '
                                  </tr>
                                </table></td>
                              <td valign="top" width="50%" style="padding-left:30px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    ' . dynamic_box($agent_dob, 25, 'dob') . '
                                  </tr>
                                  <tr>
                                    <td colspan="2" valign="top" style=""><span style="font-size:9pt; font-weight:normal">Month</span></td>
                                    <td valign="top" style=" padding:4px; height:27px; width:27px">&nbsp;</td>
                                    <td colspan="2" valign="top" style=" padding:4px; height:27px; width:27px"><span style="font-size:9pt; font-weight:normal">Day</span></td>
                                    <td valign="top" style=" padding:4px; height:27px; width:27px">&nbsp;</td>
                                    <td colspan="4" valign="top" style=" padding:4px; height:27px; width:27px"><span style="font-size:9pt; font-weight:normal">Year</span></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td valign="top" style="border: ">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td valign="top" width="100%" height="530">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" width="100%"><hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    ' . footer(7) . '
  </table>
</div>';

//Eighth Page Start

$html .= '<div style=" width:100%; height:auto; float:left">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    ' . header1() . '
    <tr>
      <td valign="top" width="100%">
        <hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    <tr>
      <td valign="top"><table width="980" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="273" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top"><h1 style="font-size:30pt; font-weight:800">&nbsp;</h1></td>
                </tr>
                <tr>
                  <td valign="top" height="450">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top"><span style="font-size:8pt; font-weight:normal; line-height:8pt; ">&nbsp;</span></td>
                </tr>
              </table>
              <div style="margin-top:200px"></div></td>
            <td width="707" valign="top" style="padding:10px; "><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="2" valign="top" style="color:#009ada; font-size:22pt; font-weight:normal" >Notice</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" ><strong>PAPERWORK REDUCTION ACT NOTICE: </strong> Section 54.410 of the Federal Communications Commission&#39;s rules requires all
                    Lifeline subscribers to demonstrate their eligibility to receive Lifeline services. This collection of information stems from the
                    Commission&#39;s authority under Section 254 of the Communications Act of 1934, as amended, 47 U.S.C. &#167;254. Using this authority,
                    the FCC has designated USAC as the permanent Lifeline Administrator. The FCC has published rules detailing how consumers can
                    qualify for Lifeline services and what Lifeline services they may receive (47 CFR &#167;54.400 et seq.). The data provided in response to
                    this information collection will be used by USAC to verify the applicant&#39;s eligibility for Lifeline services. </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" >We have estimated that each response to this collection of information will take, on average, between 0.25 and 0.75 hours. Our
                    estimate includes the time to read the questions, look through existing records, gather the required data, and actually complete
                    and review the form or response. If you have any comments on this estimate, or how we can improve the collection and reduce
                    the burden it causes you, please write to the Federal Communications Commission, OMD-PERM, Paperwork Reduction Project
                    (3060-0819), Washington, D.C. 20554. We also will accept your comments via the Internet if you send them to PRA@fcc.gov.  Please
                    DO NOT SEND COMPLETED DATA COLLECTION FORMS TO THIS ADDRESS</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>

				<tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" >Remember - You are not required to respond to a collection of information sponsored by the Federal government, and the government may not conduct or sponsor this collection, unless it displays a currently valid Office of Management and Budget (OMB) control number. This collection has been assigned an OMB control number of 3060-0819.</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>

                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" >The Commission is authorized under the Communications Act of 1934, as amended, to collect the information we request on
                    this form. If we believe there may be a violation or potential violation of a statute or a Commission regulation, rule, or order,
                    your response may be referred to the Federal, state, or local agency responsible for investigating, prosecuting, enforcing, or
                    implementing the statute, rule, regulation, or order. </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" >If you do not provide the information we request on this form, you will not be eligible to receive Lifeline services under the Lifeline
                    Program rules, 47 C.F.R. &#167;&#167; 54.400-54.423.</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" >The foregoing Notice is required by the Paperwork Reduction Act of 1995, P.L. No. 104-13, 44 U.S.C.   &#167; 3501, et seq.</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" ><strong>PRIVACY ACT STATEMENT:</strong> The Privacy Act is a law that requires the Federal Communications Commission (FCC) and the
                    Universal Service Administrative Company (USAC) to explain why we are asking individuals for personal information and what we
                    are going to do with this information after we collect it.</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" ><strong>Authority:</strong> Section 254 of the Communications Act (47 U.S.C. &#167;254), as amended, 47 U.S.C. &#167; 254, authorizes the FCC to operate
                    the Lifeline program. Using this authority, the FCC has designated USAC as the permanent Lifeline Administrator. The FCC has
                    published rules detailing how consumers can qualify for Lifeline services and what Lifeline services they may receive (47 CFR
                     &#167;54.400 et seq.). </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" ><strong>Purpose: </strong> We are collecting this personal information so we can verify that you qualify for the Lifeline program and so we can
                    efficiently provide Lifeline services to you. We access, maintain and use your personal information in the manner described in the
                    Lifeline System of Records Notice (SORN), FCC/WCB-1, which we have published in 82 Fed. Reg. 38686 (Aug. 15, 2017). </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" ><strong>Routine Uses: </strong> We may share the personal information you enter into this form with other parties for specific purposes, such
                    as: with contractors that help us operate the Lifeline program; with other federal and state government agencies that help
                    us determine your Lifeline eligibility; with the telecommunications companies that provide you Lifeline service; and with law
                    enforcement and other officials investigating potential violations of Lifeline rules. </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" >A complete listing of the ways we may use your information is published in the Lifeline SORN described in the "Purpose"
                    paragraph of this statement. </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" style="font-size:11pt; font-weight:normal; line-height:14pt;" ><strong>Disclosure:</strong> You are not required to provide the information we are requesting, but if you do not, you will not be eligible to receive
                    Lifeline services under the Lifeline Program rules, 47 C.F.R.  &#167;&#167; 54.400-54.423</td>
                </tr>

              </table></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td valign="top" width="100%" height="150">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" width="100%" ><hr  style="width:100%; color:#ccc; background:#ccc; height:2px;"/></td>
    </tr>
    ' . footer(8) . '
        </table></td>
    </tr></table></div>';

if ($state == 'WA') {
    $html .= '<div style=" width:100%;  float:left; font-size:9pt; line-height:15pt;">
			<table width="1024" border="0" style="font-size:9pt; line-height:15pt; margin:0 auto; padding:30px; ">

  <tr>
    <td width="100%" align="center" valign="top" >

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td align="center" valign="middle" height="80"><img src="' . WALOGO . '"  /></td>
  </tr>
  <tr>
    <td align="center" valign="middle" height="30">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle" height="30">STATE OF WASHINGTON</td>
  </tr>
  <tr>
    <td align="center" valign="middle" height="30"><strong style="color:#000; font-size:12pt; font-weight:bold; margin-bottom:5px; text-align:center">DEPARTMENT OF SOCIAL AND HEALTH SERVICES</strong></td>
  </tr
  ><tr>
    <td align="center" valign="middle" height="30">ECONOMIC SERVICES ADMINISTRATION</td>
  </tr
  ><tr>
    <td align="center" valign="middle" height="30">COMMUNITY SERVICES DIVISION</td>
  </tr
>
<tr>
    <td align="center" valign="middle" height="10">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle" height="30"><strong style="color:#000; font-size:12pt; font-weight:bold; margin-bottom:5px; text-align:center">Authorization of Disclosure</strong>
   </td>
  </tr>


</table>

      <hr  style="width:100%; color:#FFF; background:#FFF; height:2px;"/>


      </td>
  </tr>

  <tr>
    <td valign="top">&nbsp;</td>
  </tr>

  <tr>
    <td valign="top" style="padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
          <td valign="top">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="60%">I have applied for fedreral Lifeline assistance and understand that </td>
    <td valign="top" width="40%" style="border-bottom:1px solid #999" ><div style="width:400PX"><b>' . fill_spaces(15) . COMPANY_NAME . '</b></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" valign="top"><span style="font-size:9px">LIFELINE INDIVIDUAL PROVIDER&#39;S NAME</span></td>
  </tr>
</table>

          </td>
        <tr>
          <td valign="top">must make sure I am eligible to receive the benifit. I understand that above provider has a Data Share Agreement with the
Washington State Department of Social and Health Services (DSHS) to search the Benefit Verification System
(BVS) to determine my eligibility to receive federal Lifeline Assistance. By signing the below statement I give my
permission to DSHS to share limited private and confidential information with the provider.<br /></td>
        </tr>
        <tr>
          <td valign="top">I authorize the Washington State Department of Social and Health Services/Economic Services Administration to
disclose if I do or do

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="70">not receive Supplement Nutritioon Assistance program (SNAP)and/or Medicalid benefits to </td>
    <td valign="top" width="30%" style="border-bottom:1px solid #999;" ><div style=" width:100%"><b>' . fill_spaces(15) . COMPANY_NAME . '</b></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" valign="top"><span style="font-size:9px">LIFELINE INDIVIDUAL PROVIDER&#39;S NAME</span></td>
  </tr>
</table>only for the purpose of determining my eligibility or annual recertification for the federal Lifeline assistance program.<br /></td>
        </tr>
      </table></td>
  </tr>
   <tr>
    <td valign="top">My Authorization is effective from the date of my signature below until i terminate my Lifeline service with</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="60%" style="border-bottom:1px solid #999"><div style=" width:550PX"><b>' . fill_spaces(15) . COMPANY_NAME . '</b></div> </td>
    <td valign="top" width="40%" >&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top" ><span style="font-size:12px">LIFELINE INDIVIDUAL PROVIDER&#39;S NAME</span></td>
    <td align="center" valign="top"></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp; </td>
  </tr>

   <tr>
    <td valign="top">&nbsp;</td>


  <tr>
    <td valign="top">&nbsp;</td>
  </tr>


  <tr>
    <td valign="top" style=" font-weight:bold"> I have read and understand the above Authorization of Disclosure.
       </td>
  </tr>





  <tr>
    <td valign="top" width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle" style="width:250px;  border-bottom:1px solid #ccc" ><div style="width:250px;">' . $FromfilepathTBSig . '&nbsp;&nbsp;&nbsp;</div></td><td>&nbsp;</td>
	 <td valign="middle" style="width:250px;  border-bottom:1px solid #ccc" ><div style="width:250px;">' . $regMonthElect . '&nbsp;' . $regDateElect . ', ' . $regYearElect . '</div></td><td>&nbsp;</td>
    <td valign="middle" style="width:250px;  border-bottom:1px solid #ccc" ><div style="width:250px;">' . $fname . '&nbsp;' . $middlename . '&nbsp;' . $lastname . '&nbsp;&nbsp;&nbsp;</div></td>

  </tr>
  <tr>
    <td valign="top" align="left">SIGNATURE</td><td>&nbsp;</td>
     <td valign="top" align="left">DATE</td><td>&nbsp;</td>
     <td valign="top" align="left">PRINTED NAME</td>
  </tr>
</table>
</td>
  </tr>

  <tr>
    <td valign="top" width="100%">&nbsp;</td>
  </tr>

  <tr>
    <td valign="top" width="100%">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" width="100%" style="color:#; font-size:10PT">AUTHORIZATION OF DISCLOSURE<BR />
DSHS 27-168(06/2018)</td>
  </tr>

  <tr>
    <td valign="top" width="100%"></td>
  </tr>

</table>
		</div>';
}

if ($state == 'WI' && $company == 1) {
    $html .= '<div style=" width:100%;  float:left; font-size:9pt; line-height:15pt;">
				<table width="1024" border="0" style="font-size:9pt; line-height:15pt; margin:0 auto; padding:30px; ">
					<tr>
						<td width="100%" align="center" valign="top" >
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="text-align:certer;"  height="80"><span style="text-align:certer; margin-left:60px; font-size:20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Wisconsin Addendum</strong></td>
								</tr>

								<tr>
									<td  height="80"><span style="text-align:justify; font-size:13px;">I give permission to the Department of Revenue and the Department of Health Services to verify to TerraCom Wireless whether I participate in a low-income assistance program that would make me eligible for the lifeline telephone assistance program, or that my household income or status as a Homestead Tax Credit recipient would make me eligible. TerraCom Wireless shall maintain the information in this form and any information received about me from the Departments as confidential account information.</span></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
					   <td colspan="2" valign="top" style="border:0px solid #F90; padding:10px"><table width="100%" border="0" cellspacing="0" cellpadding="0">

						   <tr>
							 <td width="73%" valign="top">&nbsp;</td>
							 <td width="27%" valign="top">&nbsp;</td>
						   </tr>
						   <tr>
							 <td width="73%" valign="top"><b>Signature</b></td>
							 <td width="27%" valign="top"><b>Today&#39;s Date</b></td>
						   </tr>

						   <tr>
							 <td valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
								 <tr>
								   <td valign="top" style="border:2px solid #ccc; padding:15px;" width="500">' . $FromfilepathTBSig . '</td>
								 </tr>
							   </table></td>
							 <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								 <tr>
								   <td valign="top" style="border:2px solid #ccc; padding:15px;" width="300">' . $regMonthElect . '&nbsp;' . $regDateElect . ', ' . $regYearElect . '</td>
								 </tr>
							   </table></td>
						   </tr>
						 </table></td>
					 </tr>
				</table>
			</div>';
}

$html .= $additional_pages;


$html .= '</body>
</html>';
}
//echo $html;
//die;

$folderName = $pdffileFolderName;
$pdfname    = $folderName . $exactFilenameEnpdf;
$pdfnameT   = $folderName . str_replace('.pdf', '_T.pdf', $exactFilenameEnpdf);
$mpdf       = new mPDF('', '', 0, 'helvetica', 7, 7, 2, 2, 2, 2, '');
$mpdf->WriteHTML($html);
$mpdf->Output($pdfnameT);
?>