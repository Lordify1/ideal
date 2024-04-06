<?php  
    error_reporting(E_ALL);

    require_once("Db.php");

    class Project extends Db{

        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function active_project(){

            $sql = "SELECT * FROM project JOIN businesses ON project.business_id = businesses.business_id WHERE project_status = 'ACTIVE'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $active = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $active;

        }

        public function pending_project()
        {

            $sql = "SELECT * FROM project JOIN businesses ON project.business_id = businesses.business_id WHERE project_status = 'PENDING'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $blocked = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $blocked;

        }


        public function completed_project()
        {

            $sql = "SELECT * FROM project JOIN businesses ON project.business_id = businesses.business_id WHERE project_status = 'COMPLETED'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $completed = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $completed;

        }


        public function cancelled_project()
        {

            $sql = "SELECT * FROM project JOIN businesses ON project.business_id = businesses.business_id WHERE project_status = 'CANCELLED'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $rejected = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $rejected;

        }



        //action area

        public function activate_project($id)
        {
            $sql = "UPDATE project SET project_status = 'ACTIVE' WHERE project_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $activate = $stmt->execute([$id]);
            return $activate;
        }


        public function cancel_project($id)
        {
            $sql = "UPDATE project SET project_status = 'CANCELLED' WHERE project_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $cancel = $stmt->execute([$id]);
            return $cancel;
        }


        public function pend_project($id)
        {
            $sql = "UPDATE project SET project_status = 'PENDING' WHERE project_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $pend = $stmt->execute([$id]);
            return $pend;
        }


        public function all_projects()
        {

            $sql = "SELECT * FROM project";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $all;


        }


        public function state($id)
        {
            $sql = "SELECT state_name FROM state WHERE state_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $state = $stmt->fetch(PDO::FETCH_ASSOC);
            return $state;
        }

        public function lga($id)
        {
            $sql = "SELECT lga_name FROM lga WHERE lga_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $lga = $stmt->fetch(PDO::FETCH_ASSOC);
            return $lga;
        }

        public function industry($id)
        {
            $sql = "SELECT industry_name FROM industry WHERE industry_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $industry = $stmt->fetch(PDO::FETCH_ASSOC);
            return $industry;
        }

        public function experience($id)
        {
            $sql = "SELECT experience_name FROM experience WHERE experience_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $experience = $stmt->fetch(PDO::FETCH_ASSOC);
            return $experience;
        }

        public function business($id)
        {
            $sql = "SELECT business_name FROM businesses WHERE business_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $business = $stmt->fetch(PDO::FETCH_ASSOC);
            return $business;
        }


        public function search_project($title)
        {
            $sql = "SELECT * FROM project WHERE project_title LIKE '%' ? '%' ";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$title]);
            $title = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $title;

            if($title)
            {
                return true;
            }else
            {
                return false;
            }
        }

        public function project_pay($title)
        {
            $sql = "SELECT * FROM project_payment WHERE pp_percentage = '30%' AND project_title = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$title]);
            $payment = $stmt->fetch(PDO::FETCH_ASSOC);
            return $payment;
        }


    }

$project = new Project();

?>