<?php
//Show all error, remove it once you finished your code.
ini_set('display_errors', 1);
//Include TrueWallet class.
include_once('manager/TrueWallet.php');
$wallet = new TrueWallet();
//Login with your username and password.
$username = "";
$password = "";
//Logout incase your previous session still exist, no need if you only use 1 user.
$wallet->logout();
//Login into TrueWallet
$login = $wallet->login($username,$password);
if($login){
	//Get current profile.
	if($profile = $wallet->get_profile()){
		echo "<pre>";
		print_r($profile);
		echo "</pre>";
	}
	//Show 50 lastest transaction.
	if($transaction = $wallet->get_transactions()){
		echo "<pre>";
		print_r($transaction);
		echo "</pre>";
	}
	//Get full report of transaction.
	if($transaction[0]&&$report = $wallet->get_report($transaction[0]->reportID)){
		echo "<pre>";
		print_r($report);
		echo "</pre>";
	}
	//Examples
	//Get mobile number
	$mobile_number = $profile->mobileNumber; // 081-234-5678
	echo 'Mobile Number: '.$mobile_number.'<br>';
	$report_type_want = 'creditor';
	$last_report = 0;
	//(Later)Fetch your lastest report number here.
	//Get new transactions.
	foreach($transaction as $tran){
		//Get transaction type.
		$tran_type = $tran->text3En;
		//Get transaction report id.
		$tran_report = $tran->reportID;
		if($tran_type == $report_type_want && $tran_report > $last_report){
			$tran_reportID = $tran->reportID; // 12345678
			//Get full report.
			$full_report = $wallet->get_report($tran_reportID);
			//Get information from transaction.
			$tran_amount = $full_report->amount; // 1234
			$tran_from = $full_report->ref1; // 0812345678
			$tran_message = $full_report->personalMessage->value; // message
			$tran_date = $full_report->section4->column1->cell1->value; // 31/01/17 23:59
			$tran_id = $full_report->section4->column2->cell1->value; // 1234567890
			//(Later)Do stuff.
		}
	}
	//Get lastest 'creditor' transaction report id.
	foreach($transaction as $tran){
		$tran_type = $tran->text3En;
		if($tran_type == $report_type_want){
			/*
			Get lastest transaction report number of 'creditor'
			Note: Different transaction type may use different report id group.
			      ReportID is a unique id for your own account,
				  but transaction id is the same for both sender and reciver account.
			*/
			$last_report = $tran->reportID;
			break;
		}
	}
	//(Later)Save '$last_report' it into your database here.
	echo 'Lastest report: '.$last_report.'<br>';
	//Logout
	$wallet->logout();
}elseif($login==0){
	echo 'Please verify your account!';
}else{
	echo 'Login failed!';
}
?>
