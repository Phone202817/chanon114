<?php
	require_once 'Curl.php';
	class TrueWallet{
		private $login_url = "https://wallet.truemoney.com/user/login";
		private $logout_url = "https://wallet.truemoney.com/user/logout";
		private $profile_url = "https://wallet.truemoney.com/api/profile";
		private $history_url = "https://wallet.truemoney.com/api/transaction_history";
		private $report_url  = "https://wallet.truemoney.com/api/transaction_history_detail?reportID=";
		private $curl;
		function __construct(){
			$this->curl = new Curl();
		}
		
		public function login($email, $password){
			$email = str_replace('@', '%40', $email);
			$data = "email=".$email."&password=".$password;
			$login  = $this->curl->login($this->login_url, $data);
			if(strpos($login, 'Whoops') !== false){
    			return false;
			}else{
				return true;
			}
		}
		
		public function logout(){
			$logout = $this->curl->grab_page($this->logout_url);
			return $logout;
		}
	
		public function get_profile(){
			$profile = $this->curl->grab_page($this->profile_url);
			if (strpos($profile, 'Whoops') !== false) {
    				return false;
			}
			$profile_obj  = json_decode($profile);
			return $profile_obj;
		}
		
		public function get_transactions(){
			$trans = $this->curl->grab_page($this->history_url);
			if (strpos($trans, 'Whoops') !== false) {
    				return false;
			}
			$trans_obj  = json_decode($trans);
			$trans_data = $trans_obj->data->activities;
			return $trans_data;
		}

		public function get_report($report_id){
			$report = $this->curl->grab_page($this->report_url.$report_id);
			if (strpos($report, 'Whoops') !== false) {
    				return false;
			}
			$report_obj = json_decode($report);
			$report_data = $report_obj->data;
			return $report_data;
		}
	}
?>
