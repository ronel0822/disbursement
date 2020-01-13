<?php 

class View extends Controller {

	//dashboard
	public function viewWeeklyTransaction(){
		return $this->getWeeklyTransaction();
	}

	public function viewDailyTransaction(){
		return $this->getDailyTransaction();
	}

	public function viewMonthlyTransaction(){
		return $this->getMonthlyTransaction();
	}

	public function viewOtherInformation(){
		return $this->getOtherInformation();
	}

	public function viewBarGraph($montlyYear){
		return $this->getBarGraph($montlyYear);
	}

	//payable
	public function viewPayable() {
		return $this->getPayable();
	}

	public function viewPayable_view($id) {
		return $this->getPayable_view($id);
	}


	public function viewAcceptRequest($id,$voucherType){
		return $this->getAcceptRequest($id,$voucherType);
	}

	//test
	public function testInsert($firstname,$lastname,$username,$password){
		return $this->insert($firstname,$lastname,$username,$password);
	}


	//Ongoing request.
	public function viewOngoingRequest(){
		return $this->getOngoingRequest();
	}


	public function viewOngoingView($id){
		return $this->getOngoingView($id);
	}

	public function viewVoucherFile($id,$file,$payableId){
		return $this->getVoucherFile($id,$file,$payableId);
	}


	//Disbursed records
	public function viewDisbursed(){
		return $this->getDisbursed();
	}

	public function viewRequestDisbursed($id){
		return $this->getRequestDisbursed($id);
	}

	//notification
	public function getNotifications(){
		return $this->setNotifications();
	}

	//Not yet view Notification
	public function viewNotification(){
		return $this->getNotification();
	}

	//Notification Viewed
	public function updateNotification(){
		return $this->updateNotifications();
	}

	//Notification Dropdown
	public function viewAllNotification(){
		return $this->getAllNotification();
	}

	//additional functions
	public function getLastDayOfMonth($string){
		$a_date = $string;
		return date("Y-m-t", strtotime($a_date));
	}
}

?>