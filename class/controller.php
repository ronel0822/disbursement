<?php 

class Controller extends Db {

	//dashboard
	protected function getWeeklyTransaction(){
		$sql = "SELECT voucher_type, COUNT(*) AS voucher_count 
				FROM finance_disburse 
				WHERE created_at > DATEADD(dd, -(DATEPART(dw, GETDATE())-1), GETDATE()) AND created_at < DATEADD(dd, 7-(DATEPART(dw, GETDATE())), GETDATE())
				GROUP BY voucher_type";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	protected function getDailyTransaction(){
		$sql = "SELECT voucher_type, COUNT(*) AS voucher_count 
				FROM finance_disburse
				WHERE DATEDIFF(day,0,created_at) = DATEDIFF(day,0,GETDATE()) 
				GROUP BY voucher_type";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	protected function getMonthlyTransaction(){
		$sql = "SELECT voucher_type, COUNT(*) AS voucher_count 
				FROM finance_disburse
				WHERE DATEDIFF(month,0,created_at) = DATEDIFF(month,0,GETDATE()) 
				GROUP BY voucher_type";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	protected function getOtherInformation(){
		$data = [];
		$sql = "SELECT 
					COUNT(*) as COUNT
					FROM finance_payables LEFT JOIN finance_disburse 
					ON finance_disburse.payable_id = finance_payables.payables_id 
					WHERE finance_payables.updated_at IS NULL;";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		if($row = $stmt->fetch()){
			$data['request'] = $row['COUNT']; 
		}

		$sql = "SELECT 
					COUNT(*) as COUNT
					FROM finance_payables LEFT JOIN finance_disburse 
					ON finance_disburse.payable_id = finance_payables.payables_id 
					WHERE finance_payables.updated_at IS NOT NULL 
					AND finance_payables.disbursed_at IS NULL";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		if($row = $stmt->fetch()){
			$data['ongoing'] = $row['COUNT']; 
		}

		$sql = "SELECT 
					COUNT(*) as COUNT
					FROM finance_payables LEFT JOIN finance_disburse 
					ON finance_disburse.payable_id = finance_payables.payables_id 
					WHERE finance_payables.updated_at IS NOT NULL 
					AND finance_payables.disbursed_at IS NOT NULL";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		if($row = $stmt->fetch()){
			$data['disbursed'] = $row['COUNT']; 
		}

		return $data;
		
	}

	protected function getBarGraph($monthlyYear){
		$data = [];
		for ($i=1; $i <= 12 ; $i++) { 
			$sql = "SELECT id, COUNT(*) AS count FROM finance_disburse ".$monthlyYear[$i];
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			$fetchAll = $stmt->fetchAll();
			array_push($data, count($fetchAll));
		}
		return $data;
	}


	//payable
	protected function getPayable() {
		$stmt = $this->connect()->prepare("SELECT * FROM finance_payables WHERE  finance_payables.updated_at IS NULL ORDER BY payables_id DESC");
		$stmt->execute();
		return $stmt;
	}

	protected function getPayable_view($id) {
		$stmt = $this->connect()->prepare("SELECT * FROM finance_payables WHERE finance_payables.payables_id=? AND updated_at IS NULL");
		$stmt->bindParam(1,$id);
		$stmt->execute();
		return $stmt;
	}


	//Ongoing Request
	protected function getOngoingRequest(){
		$stmt = $this->connect()->prepare("SELECT * FROM finance_disburse INNER JOIN finance_payables ON finance_disburse.payable_id = finance_payables.payables_id WHERE finance_disburse.voucher_file IS NULL ORDER BY payables_id DESC");
		$stmt->execute();
		return $stmt;
	}

	protected function getOngoingView($id){
		$stmt = $this->connect()->prepare("SELECT * FROM finance_disburse INNER JOIN finance_payables ON finance_disburse.payable_id = finance_payables.payables_id WHERE finance_disburse.id = ?");
		$stmt->bindParam(1,$id);
		$stmt->execute();
		return $stmt;
	}


	//Disbursed records
	protected function getDisbursed(){
		$stmt = $this->connect()->prepare("SELECT * FROM finance_disburse INNER JOIN finance_payables ON finance_disburse.payable_id = finance_payables.payables_id WHERE finance_disburse.disbursed_at IS NOT NULL ORDER BY finance_disburse.id DESC");
		$stmt->execute();
		return $stmt;
	}

	protected function getRequestDisbursed($id){
		$stmt = $this->connect()->prepare("SELECT * FROM finance_disburse INNER JOIN finance_payables ON finance_disburse.payable_id = finance_payables.payables_id WHERE finance_disburse.disbursed_at IS NOT NULL AND finance_disburse.id=?");
		$stmt->bindParam(1,$id);
		$stmt->execute();
		return $stmt;
	}


	//upload
	protected function getVoucherFile($id,$file,$payableId){
		$stmt = $this->connect()->prepare("UPDATE finance_disburse SET voucher_file = ?, disbursed_at = GETDATE() WHERE id = ?");
		$stmt2 = $this->connect()->prepare("UPDATE finance_payables SET disbursed_at = GETDATE(), status = 'paid' WHERE payables_id = ?");

		$fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('pdf');
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 500000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
					$fileDestination = "../Storage/Disbursement/".$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					$stmt->bindParam(1,$fileNameNew);
					$stmt->bindParam(2,$id);
					$stmt->execute();
					$stmt2->bindParam(1,$payableId);
					$stmt2->execute();
                    return true;
                }else{
					$_SESSION['errorMessage'] = "Filesize is too big, Upload failed.";
					return false;
                }
            }else{
				$_SESSION['errorMessage'] = "Error uploading file!";
				return false;
            }
        }else{
			$_SESSION['errorMessage'] = "You cannot upload files of this type.";
			return false;
        }
	}


	//authentication
	protected function getAuthentication($username,$password){
		$query = "SELECT * FROM accounts WHERE username=? AND password=?";
		$pst = $this->connect()->prepare($query);
		$pst->bindParam(1,$username);
		$pst->bindParam(2,$payables_idsword);
		$pst->execute();
		if($pst->rowCount() != 0){
			if($row = $pst->fetch()) {
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['lastname'] = $row['lastname'];
			}
			return true;
		}else{
			return false;
		}
	}

	protected function getAcceptRequest($id,$voucherType){
		$payableQuery = "UPDATE finance_payables SET updated_at = GETDATE() WHERE payables_id = ?";
		$pst = $this->connect()->prepare($payableQuery);
		$pst->bindParam(1,$id);
		$pst->execute();

		$username = $_SESSION['username'];
		$userQuery = "SELECT * FROM accounts WHERE username=?";
		$userPst = $this->connect()->prepare($userQuery);
		$userPst->bindParam(1,$username);
		$userPst->execute();
		if($row = $userPst->fetch()){
			$lastname = $row['lastname'];
			$disburseQuery = "INSERT INTO finance_disburse (payable_id,prepared_by,voucher_type,created_at) VALUES (?,?,?,GETDATE())";
			$disbursePst = $this->connect()->prepare($disburseQuery);
			$disbursePst->bindParam(1,$id);
			$disbursePst->bindParam(2,$lastname);
			$disbursePst->bindParam(3,$voucherType);
			if($disbursePst->execute()){
				return true;
			}else{
				return false;
			}
			
		}

	}

	//Notification
	protected function setNotifications(){
		$stmt = $this->connect()->prepare("SELECT * FROM finance_payables WHERE  finance_payables.updated_at IS NULL");
		$stmt->execute();
		while($row = $stmt->fetch()){
			$count = 0;
			$stmt2 = $this->connect()->prepare("SELECT * FROM finance_disbursement_notification");
			$stmt2->execute();
			while($row2 = $stmt2->fetch()){
				if($row['payables_id'] == $row2['payable_id']){
					$count++;
				}
			}
			if($count == 0){
				$stmt3 = $this->connect()->prepare("INSERT INTO finance_disbursement_notification VALUES (?,NULL)");
				$stmt3->bindParam(1,$row['payables_id']);
				$stmt3->execute();
			}
		}
	}

	//Not yet view notification
	protected function getNotification(){
		$stmt = $this->connect()->prepare("SELECT * FROM finance_disbursement_notification WHERE viewed_at IS NULL");
		$stmt->execute();
		return $stmt;
	}

	//Notification viewed
	protected function updateNotifications(){
		$stmt = $this->connect()->prepare("UPDATE finance_disbursement_notification SET viewed_at=GETDATE() WHERE viewed_at IS NULL");
		$stmt->execute();
		return $stmt;
	}

	//Notification Dropdown
	protected function getAllNotification(){
		$stmt = $this->connect()->prepare("SELECT * FROM finance_disbursement_notification LEFT JOIN finance_payables ON finance_payables.payables_id = finance_disbursement_notification.payable_id ORDER BY id DESC");
		$stmt->execute();
		return $stmt;
	}

}