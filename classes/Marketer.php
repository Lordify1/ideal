<?php
    error_reporting(E_ALL);

    require_once("Database.php");

    class Marketer extends DataBase{

        private $dbcon;

        public function __construct(){
            $this->dbcon = $this->connect();
        }


        public function login($email, $pwd){
            // or $query = "SELECT * FROM user WHERE user_email = ? AND user_password = ? LIMIT 1";
            $query = "SELECT * FROM marketers WHERE marketer_email = ? AND marketer_status != 'blocked' LIMIT 1";
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute([$email]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($records){
                $hashed_password = $records["marketer_password"];
                $check = password_verify($pwd, $hashed_password);
                if($check){
                    return $records;
                }else{
                    return false;
                }
            }else{
                return false;
            }


        }

            public function logout(){
                session_unset();
                session_destroy();

            }

        public function get_userbyid($marketer_id){

            $query = "SELECT * FROM marketers  WHERE marketer_id = ?";
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute([$marketer_id]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);

            return $records;

        }

        


    public function create_account($fname, $lname, $email, $pwd, $confirmpwd, $state, $lga, $gender){

        if($pwd == $confirmpwd){
            
            try{
                $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
                $query = "INSERT INTO marketers(marketer_fname,marketer_lname,marketer_email ,marketer_password, state_id, lga_id, marketer_gender) VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->dbcon->prepare($query);
            $result = $stmt->execute([$fname, $lname, $email, $hashed_password, $state, $lga, $gender]);
            $_SESSION["userfeedback"] = "Account created successfully.Complete your profile for your account activation";
    
            //get the last insert id
            $userid = $this->dbcon->lastInsertId();
            return $userid;
    
            }catch(PDOException $e){
                // echo $e->getMessage(); die();
                $_SESSION["error_message"] = "An error occured:" . $e->getMessage();
                return 0;
            }
            catch(Exception $e){
                // echo $e->getMessage(); die();
                $_SESSION["errormessage"] = "An error occured:" . $e->getMessage();
                return 0;
            }
    
    
            }else{
               $_SESSION["errormessage"] = "Passwords must be the same";
            }
    }

        public function get_email($email)
        {
            $sql = "SELECT marketer_email FROM marketers WHERE marketer_email = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$email]);
            $emailed = $stmt->fetch(PDO::FETCH_ASSOC);
            return $emailed;
        }

        public function fetch_states(){

            $sql = "SELECT * FROM state";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $states = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $states;

            if($states){
                return true;
            }else{
                return false;
            }

        }


        public function getlga_bystate($id){
            
            $sql = "SELECT * FROM lga WHERE state_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$id]);
            $lgas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $lgas;

        }

        public function fetch_level(){

            $sql = "SELECT * FROM experience";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $levels = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $levels;
        }

        
        public function fetch_skills(){

            $sql = "SELECT * FROM skills";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $skills;
        }
        

        public function fetch_category(){

            $sql = "SELECT * FROM category";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $categories;
        }
        





         //method that updates marketer start//

        public function marketer_prof_update_one($fname, $lname,  $phone, $dob, $marketer_id){

            $sql = "UPDATE marketers SET marketer_fname = ?, marketer_lname = ?, marketer_phone = ?,  marketer_dob = ? WHERE marketer_id = ?";

            $stmt = $this->dbcon->prepare($sql);
            $updated = $stmt->execute([$fname, $lname,  $phone, $dob, $marketer_id]);
            
            return $updated;
            if($updated){
                return true;
            }else{
                return false;
            }

        }

        public function marketer_prof_update_two($bio, $marketer_id){

            $sql = "UPDATE marketers SET marketer_bio = ? WHERE marketer_id = ?";

            $stmt = $this->dbcon->prepare($sql);
            $updated = $stmt->execute([$bio, $marketer_id]);
            
            return $updated;
            if($updated){
                return true;
            }else{
                return false;
            }

        }

        public function marketer_prof_update_three($experience, $portfoliolink, $marketer_id){

            $sql = "UPDATE marketers SET experience_id = ?, portfolio = ? WHERE marketer_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $updated = $stmt->execute([$experience, $portfoliolink, $marketer_id]);
            return $updated;
            if($updated){
                return true;
            }else{
                return false;
            }

        }

        public function marketer_prof_update_three_second($skills, $marketer_id){
            $sql = "DELETE FROM marketer_skills WHERE marketer_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $isDeleted = $stmt->execute([$marketer_id]);
            if($isDeleted){
                foreach($skills as $skill){
                $sql = "INSERT INTO marketer_skills( marketer_id, skill_id) VALUES (?, ?)";
                $stmt = $this->dbcon->prepare($sql);
                $hold = $stmt->execute([$marketer_id, $skill]);
            }
            return true;
            }else{
                return false;
            };

        }
      

        public function marketer_prof_update_four( $payment_method, $account_details, $state, $lga, $marketer_id){

            $sql = "UPDATE marketers SET pay_method = ?, account_detail = ?, state_id = ?, lga_id = ? WHERE marketer_id = ?";

            $stmt = $this->dbcon->prepare($sql);
            $updated = $stmt->execute([$payment_method, $account_details, $state, $lga, $marketer_id]);
            
            return $updated;
            if($updated){
                return true;
            }else{
                return false;
            }

        }

        public function marketer_prof_update_five($category, $project_type ,$availability, $marketer_id){

            $sql = "UPDATE marketers SET category_id = ?, project_type = ?, marketer_availability= ? WHERE marketer_id = ?";

            $stmt = $this->dbcon->prepare($sql);
            $updated = $stmt->execute([$category, $project_type ,$availability, $marketer_id]);
            
            return $updated;
            if($updated){
                return true;
            }else{
                return false;
            }

        }


        //method that updates marketer profile end//




        public function get_experience_details($marketer_id){

            $sql = "SELECT * FROM marketers JOIN experience ON marketers.experience_id = experience.experience_id WHERE marketer_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer_id]);
            $experience = $stmt->fetch(PDO::FETCH_ASSOC);
            return $experience;
    
            
        }





         
        
        public function business()
        {
            $sql = "SELECT business_name FROM businesses JOIN project ON businesses.business_id = project.business_id";
            $stmt = $this->dbcon->prepare($sql);
            $id = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $id;
        }
        

        //marketer applications methods

        public function my_approved_applications($marketer_id){

            $sql = "SELECT * FROM application JOIN project ON application.project_id = project.project_id WHERE application_status = 'APPROVED' AND marketer_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer_id]);
            $marketers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $marketers;
              
        }

        public function my_pending_applications($marketer_id){

            $sql = "SELECT * FROM application JOIN project ON application.project_id = project.project_id WHERE application_status = 'PENDING' AND  marketer_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer_id]);
            $marketers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $marketers;
              
        }

        public function my_rejected_applications($marketer_id){

            $sql = "SELECT * FROM application JOIN project ON application.project_id = project.project_id WHERE application_status = 'REJECTED' AND marketer_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer_id]);
            $marketers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $marketers;
              
        }






        // marketer payments methods

        public function my_payments($marketer_id){

            $sql = "SELECT * FROM payment JOIN businesses ON payment.business_id  = businesses.business_id WHERE marketer_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer_id]);
            $marketers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
              
        }



        public function pending_payments($marketer)
        {
            $sql ="SELECT * FROM payment JOIN businesses ON payment.business_id = businesses.business_id WHERE marketer_id = ? AND payment_status = 'PENDING' ";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer]);
            $marketer = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $marketer;
        }

        

        public function received_payments($marketer)
        {
            $sql ="SELECT * FROM payment JOIN businesses ON payment.business_id = businesses.business_id WHERE marketer_id = ? AND payment_status = 'COMPLETED' ";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer]);
            $marketer = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $marketer;
        }


        public function cancelled_payments($marketer)
        {
            $sql ="SELECT * FROM payment JOIN businesses ON payment.business_id = businesses.business_id WHERE marketer_id = ? AND payment_status = 'CANCELLED' ";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer]);
            $marketer = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $marketer;
        }



        public function bad_remark($marketer)
        {
            $sql = "SELECT * FROM remarks JOIN businesses ON remarks.business_id = businesses.business_id WHERE marketer_id = ? AND remark_rating < 3";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer]);
            $marketer = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $marketer;
            
        }

        public function good_remark($marketer)
        {
            $sql = "SELECT * FROM remarks JOIN businesses ON remarks.business_id = businesses.business_id WHERE marketer_id = ? AND remark_rating >= 3";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer]);
            $marketer = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $marketer;
            
        }

        public function my_skills($expertise)
        {
            $sql = "SELECT skill_id FROM marketer_skills WHERE marketer_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$expertise]);
            $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $response;
        }


        public function get_state($state_id)
        {

            $sql = "SELECT state_name FROM state WHERE state_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$state_id]);
            $states = $stmt->fetch(PDO::FETCH_ASSOC);
            return $states;
    
            
        }


        public function get_lga($lga_id)
        {

            $sql = "SELECT lga_name FROM lga WHERE lga_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$lga_id]);
            $lgas = $stmt->fetch(PDO::FETCH_ASSOC);
            return $lgas;
    
            
        }


        public function get_experience($experience_id)
        {

            $sql = "SELECT experience_name FROM experience WHERE experience_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$experience_id]);
            $experiences = $stmt->fetch(PDO::FETCH_ASSOC);
            return $experiences;
    
            
        }


        public function get_projects($project_id)
        {

            $sql = "SELECT * FROM project JOIN project_marketers ON project.project_id = project_marketers.project_id WHERE marketer_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$project_id]);
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $projects;
    
            
        }

        public function get_skills($skill_id)
        {

            $sql = "SELECT * FROM skills JOIN marketer_skills ON skills.skill_id = marketer_skills.skill_id WHERE marketer_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$skill_id]);
            $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $skills;
    
            
        }


        public function get_category($marketer_id)
        {

            $sql = "SELECT * FROM marketers JOIN category ON marketers.category_id = category.category_id WHERE marketer_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer_id]);
            $experience = $stmt->fetch(PDO::FETCH_ASSOC);
            return $experience;
    
            
        }



        public function marketer_status($marketer_id)
        {
            $sql = "UPDATE marketers SET marketer_status = 'active' WHERE marketer_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $status = $stmt->execute([$marketer_id]);
            return $status;
        }


        public function active_projects($marketer_id){

            $sql = "SELECT * FROM project_marketers JOIN project ON project_marketers.project_id = project.project_id WHERE marketer_id = ? AND project_status = 'ACTIVE'
            ";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer_id]);
            $marketers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $marketers;
        }

        public function completed_projects($marketer_id){

            $sql = "SELECT * FROM project_marketers JOIN project ON project_marketers.project_id = project.project_id WHERE marketer_id = ? AND project_status = 'COMPLETED'";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$marketer_id]);
            $marketers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $marketers;
        }


        public function business_name($proid){

            $sql = "SELECT * FROM project JOIN businesses ON project.business_id = businesses.business_id WHERE project_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$proid]);
            $project_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $project_id;
        }
        

        public function insert_dp($picname, $id)
        {
            $sql = "UPDATE marketers SET marketer_picture = ? WHERE marketer_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $dp = $stmt->execute([$picname, $id]);
            
        }


        public function get_dp($id)
        {
            $sql = "SELECT marketer_picture FROM marketers WHERE marketer_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$id]);
            $dp = $stmt->fetch(PDO::FETCH_ASSOC);
            return $dp;
        }


        public function login_time($time, $id)
    {
        $sql = "UPDATE marketers SET last_login = ? WHERE marketer_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $login = $stmt->execute([$time, $id]);

    }


    public function category_by_id($id)
    {
        $sql = "SELECT category_name FROM category WHERE category_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $cat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cat;
    }


    public function experience_by_id($id)
    {
        $sql = "SELECT experience_name FROM experience WHERE experience_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $exp = $stmt->fetch(PDO::FETCH_ASSOC);
        return $exp;
    }


    // public function activate_marketer($id)
    // {
    //     $sql = "UPDATE marketers SET marketer_status = 'active' WHERE marketer_id = ?";
    //     $
    // }

 

    // public function activation( $fname, $lname,$email, $phone, $dob,$availability,$experience,$bio,$gender, $state ,$category, $project, $pay, $account, $lga, $portfolio, $marketer_id)
    // {
    //     $sql = "UPDATE marketers SET marketer_fname = ?, marketer_lname = ?, marketer_email = ?, marketer_phone = ?, marketer_dob = ?,  marketer_availability = ?, experience_id = ?, marketer_bio = ?, marketer_gender = ?, state_id = ?, category_id = ?, project_type = ?, pay_method = ?,account_detail = ?, lga_id = ?, portfolio = ? WHERE marketer_id = ?";
    //     $activate = $stmt = $this->dbcon->prepare($sql);
    //     $stmt->execute([$fname, $lname,$email, $phone, $dob,$availability,$experience,$bio,$gender, $state ,$category, $project, $pay, $account, $lga, $portfolio, $marketer_id]);
    //     return $activate;
    // }


    public function activate($id)
    {
        $sql = "UPDATE marketers SET marketer_status = 'active' WHERE marketer_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $activate = $stmt->execute([$id]);
        return $activate;
    }

    public function deactivate($id)
    {
        $sql = "UPDATE marketers SET marketer_status = 'pending' WHERE marketer_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $deactivate = $stmt->execute([$id]);
        return $deactivate;
    }

    public function banks()
    {
        $sql = "SELECT * FROM banks";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $banks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $banks;
    }

    
        
    }

    $market = new Marketer();
    // echo $user->update_profile("Sam", "Lord", "090785430", "3", "2");
    // $user->create_account("Po", "Mine", "dd@gmail.com", "oowe", "oowe");

?>