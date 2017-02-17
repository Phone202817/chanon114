<?php
//Show all error, remove it once you finished you code.
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
if($wallet->login($setting['username'],$setting['password'])){
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
	if($transaction&&$report = $wallet->get_report($transaction[0]->reportID)){
		echo "<pre>";
		print_r($report);
		echo "</pre>";
	}
	//Examples
	//Get mobile number
	$mobile_number = $profile->mobileNumber; // 081-234-5678
	echo 'Mobile Number: '.$mobile_number.'<br>';
	//(Later)Fetch your lastest report number here.
	$last_report = 0;
	//Get new transactions.
	foreach($trans as $tran){
		//Get transaction type.
		$tran_type = $tran->text3En;
		//Get transaction report id.
		$tran_report = $tran->reportID;
		if($tran_type == 'creditor' && $tran_report > $last_report){
			$tran_from = $tran->text5Th; // 081-234-5678
			$last_report = $tran->reportID // 123456789
			echo '['.$tran_reportID.'] Creditor from '.$tran_from.'<br>';
			//Get full report.
			$full_report = $wallet->get_report($tran_reportID);
			//Get message from transaction.
			$message = $full_report->data->personalMessage->data;
			//(Later)Do stuff.
		}
	}
	//Get lastest 'creditor' transaction report id.
	foreach($trans as $tran){
		$tran_type = $tran->text3En;
		if($tran_type == 'creditor'){
			/*
			Get lastest transaction report number of 'creditor'
			Note: Different transaction type may use different report id group.
			*/
			$last_report = $tran->reportID;
			break;
		}
	}
	//(Later)Save '$last_report' it into your database here.
	echo 'Lastest report: '.$last_report.'<br>';
	//Logout
	$wallet->logout();
}else{
	echo 'Login Failed!';
}
?>