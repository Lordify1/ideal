<?php
    error_reporting(E_ALL);

    require_once("Database.php");

    class Business extends DataBase{

        private $dbcon;

        public function __construct(){
            $this->dbcon = $this->connect();
        }

        public function login($email, $pwd){
            // or $query = "SELECT * FROM user WHERE user_email = ? AND user_password = ? LIMIT 1";
            $query = "SELECT * FROM businesses WHERE business_email = ? and business_status != 'blocked' LIMIT 1";
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute([$email]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($records){
                $hashed_password = $records["business_password"];
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


        public function business_email($email)
    {
        $sql = "SELECT business_email FROM businesses WHERE business_email = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$email]);
        $email = $stmt->fetch(PDO::FETCH_ASSOC);
        return $email;
    }


  



        public function get_userbyid($business_id){

            $query = "SELECT * FROM businesses WHERE business_id = ?";
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute([$business_id]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);

            return $records;

        }


    



        // fetching applications and do application actions for businesses


        // public function set_application_status(){
        //     $sql = "UPDATE application_status FROM applications WHERE "
        // }

        public function get_applications_pending($business_id){

            $query = "SELECT * FROM application JOIN marketers ON application.marketer_id = marketers.marketer_id WHERE business_id = ? AND application_status = 'PENDING'";
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute([$business_id]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $records;

        }

        public function get_applications_rejected($business_id){

            $query = "SELECT * FROM application JOIN marketers ON application.marketer_id = marketers.marketer_id WHERE business_id = ? AND application_status = 'REJECTED'";
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute([$business_id]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $records;

        }

        public function get_applications_approved($business_id){

            $query = "SELECT * FROM application JOIN marketers ON application.marketer_id = marketers.marketer_id WHERE business_id = ? AND application_status = 'APPROVED'";
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute([$business_id]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $records;

        }

        public function reply_application($status, $appid)
        {
            $sql = "UPDATE application SET application_status = ? WHERE application_id = ? ";
            $stmt = $this->dbcon->prepare($sql);
            $response = $stmt->execute([$status, $appid]);

        }


        public function update_marketers($proid, $marketer_id)
        {
            $sql = "INSERT INTO project_marketers (project_id, marketer_id) VALUES (?,?)";
            $stmt = $this->dbcon->prepare($sql);
            $response = $stmt->execute([$proid, $marketer_id]);
           
        }


        public function delete_marketers($proid, $marketer_id)
        {
            $sql = "DELETE FROM project_marketers WHERE project_id = ? AND marketer_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$proid, $marketer_id]);
           
        }


        //fetching applications and do application actions for businesses




        public function business_register($compname, $compemail, $comppassword, $confirmpwd, $state, $lga){

         if($comppassword == $confirmpwd){
            
            try{
                $hashed_password = password_hash($comppassword, PASSWORD_DEFAULT);
                $query = "INSERT INTO businesses(business_name, business_email ,business_password, state_id, lga_id) VALUES (?,?,?,?,?)";
            $stmt = $this->dbcon->prepare($query);
            $result = $stmt->execute([$compname, $compemail, $hashed_password, $state, $lga]);
            $_SESSION["success_message"] = "Account created successfully. Complete your profile for your account activation";
    
            //get the last insert id
            $business_id = $this->dbcon->lastInsertId();
            return $business_id;
    
            }catch(PDOException $e){
                // echo $e->getMessage(); die();
                // $_SESSION["errormessage"] = "An error occured:" . $e->getMessage();
                // return 0;
            }
            catch(Exception $e){
                // echo $e->getMessage(); die();
                // $_SESSION["errormessage"] = "An error occured:" . $e->getMessage();
                // return 0;
            }
    
    
            }else{
               $_SESSION["errormessage"] = "Passwords must be the same";
            }
    }


        //method that updates user profile start//

        public function bprofile_update_one($name,$email, $phone, $web ,$about ,$address,$state, $lga ,$business_id)
        {

            $sql = "UPDATE businesses SET business_name = ?, business_email = ?, business_phone_no = ?, 	business_website = ?, about_business = ?, business_address = ?, state_id = ?, lga_id = ? WHERE business_id = ?";

            $stmt = $this->dbcon->prepare($sql);
            $updated = $stmt->execute([$name,$email, $phone, $web ,$about ,$address,$state,$lga, $business_id]);
            
            return $updated;
            if($updated){
                return true;
            }else{
                return false;
            }

        }
        


        public function bprofile_update_two($paymethod, $detail, $business_id)
        {

            $sql = "UPDATE businesses SET pay_method = ?, account_detail = ? WHERE business_id = ?";

            $stmt = $this->dbcon->prepare($sql);
            $updated = $stmt->execute([$paymethod, $detail ,$business_id]);
            
            return $updated;
            if($updated){
                return true;
            }else{
                return false;
            }

        }


        public function bprofile_update_three($industry, $contact_person, $business_id)
        {

            $sql = "UPDATE businesses SET industry_id = ?, contact_person_name = ? WHERE business_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $updated = $stmt->execute([$industry, $contact_person, $business_id]);
            
            return $updated;
            if($updated){
                return true;
            }else{
                return false;
            }

        }


        public function bprofile_update_three_second($business_id, $desired_skills){
            $sql = "DELETE FROM business_skills WHERE business_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $isDeleted = $stmt->execute([$business_id]);
            if($isDeleted){
                foreach($desired_skills as $desired_skill){
                $sql = "INSERT INTO business_skills(business_id, skill_id) VALUES (?, ?)";
                $stmt = $this->dbcon->prepare($sql);
                $hold = $stmt->execute([$business_id, $desired_skill]);
            }
            return true;
            }else{
                return false;
            };

        }
        //method that updates user profile end//
        

        // a method thst will insert a user register for in the table
        public function register_topic_User($topic, $user_id){
            //to prevent redundancy in db
            $sql = "DELETE FROM user_breakout WHERE breakout_userid = ?";
            $stmt = $this->dbconn->prepare($sql);
            $isDeleted = $stmt->execute([$user_id]);
            if($isDeleted){
                foreach($topic as $top){
                $sql = "INSERT INTO user_breakout(breakout_topicid, breakout_userid) VALUES (?, ?)";
                $stmt = $this->dbconn->prepare($sql);
                $hold = $stmt->execute([$top, $user_id]);
            }
            return true;
            }else{
                return false;
            }
//because topic is an array we have to loop over and insert one after the other
            
            

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


        //pending lga stuff 
        public function fetch_lga()
        {
            
            $sql = "SELECT * FROM lga";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $lgas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $lgas;

        }


        public function getlga_bystate($id){
            
            $sql = "SELECT * FROM lga WHERE state_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$id]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;

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
        
        public function fetch_industry(){

            $sql = "SELECT * FROM industry";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $industries = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $industries;




    }




    /* method to check if the project title is not in the table already */

    public function if_project($title)
    {
        $sql = "SELECT project_title FROM project WHERE project_title = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$title]);
        $hold = $stmt->fetch(PDO::FETCH_ASSOC);
        return $hold;
    }

     /* method to check if the project title is not in the table already */


     public function active_projects($business_id)
     {
        $sql = "SELECT * FROM project WHERE project_status = 'ACTIVE' AND business_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$business_id]);
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $projects;
     }

     public function pending_projects($business_id)
     {
        $sql = "SELECT * FROM project WHERE project_status = 'PENDING' AND business_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$business_id]);
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $projects;
     }

     public function completed_projects($business_id)
     {
        $sql = "SELECT * FROM project WHERE project_status = 'COMPLETED' AND business_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$business_id]);
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $projects;
     }

     public function declined_projects($business_id)
     {
        $sql = "SELECT * FROM project WHERE project_status = 'CANCELLED' AND business_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$business_id]);
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $projects;
     }




     public function create_project($protitle, $prodesc, $state, $proaudience, $proindustry, $prodeadline, $progoals, $experience, $prooffer, $procomm, $procomments, $proefforts, $lga, $skills, $no_of_marketers, $business_id){
       
        $sql = "INSERT INTO project (project_title,project_description, state_id, target_audience, industry_id, deadline, project_goals_objectives, experience_id, offer_amount_range, communication, additional_comments,previous_efforts,lga_id,req_no_of_marketers, business_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->dbcon->prepare($sql);
        $response = $stmt->execute([$protitle, $prodesc, $state, $proaudience, $proindustry, $prodeadline, $progoals, $experience, $prooffer, $procomm, $procomments, $proefforts,$lga, $no_of_marketers, $business_id]);
    
        $proid = $this->dbcon->lastInsertId();
        
        if($proid)
        {
            foreach($skills as $skill){
            $sql = "INSERT INTO project_skills( project_id, skill_id) VALUES (?, ?)";
            $stmt = $this->dbcon->prepare($sql);
            $hold = $stmt->execute([$proid, $skill]);
            }

            if($hold)
            {
                return true;
            }else
            {
                return false;
            }
        }

        
    
    }


      public function insert_file_name($img_file_name, $title)
       {
            $sql= "UPDATE project SET project_image = ? WHERE project_title = ?";
            $stmt = $this->dbcon->prepare($sql);
            $response = $stmt->execute([$img_file_name, $title]);
            return $response;
       }

    public function fetch_file_name($id)
    {

        try{

            $sql = "SELECT project_image FROM project WHERE project_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$id]);
            $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $images;

        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }


    public function fetch_img_for_project_view($id)
    {

        try{

            $sql = "SELECT project_image FROM project WHERE project_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$id]);
            $images = $stmt->fetch(PDO::FETCH_ASSOC);

            return $images;

        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }


    public function business_state($state)
    {
        $sql = "SELECT state_name FROM state JOIN businesses ON state.state_id = businesses.state_id WHERE businesses.state_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$state]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);
        return $response;
    }


    public function desired_skills($experience)
    {
        $sql = "SELECT skill_id FROM business_skills WHERE business_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$experience]);
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }

    public function get_industry($business_id)
    {

            $sql = "SELECT * FROM businesses JOIN industry ON businesses.industry_id = industry.industry_id WHERE business_id = ?";
            $stmt  = $this->dbcon->prepare($sql);
            $stmt->execute([$business_id]);
            $experience = $stmt->fetch(PDO::FETCH_ASSOC);
            return $experience;
    
            
    }


    public function project_status($status, $project_id)
    {
        $sql = "UPDATE project SET project_status = ? WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $change = $stmt->execute([$status, $project_id]);
        return $change;
    
    }


    //methods used in the business view

    public function my_state($id)
    {
        $sql = "SELECT state_name FROM state WHERE state_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $change = $stmt->fetch(PDO::FETCH_ASSOC);
        return $change;
        if($change)
        {
           return true;
        }else
        {
            return false;
        }
    }

    public function my_lga($id)
    {
        $sql = "SELECT lga_name FROM lga WHERE lga_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $change = $stmt->fetch(PDO::FETCH_ASSOC);
        return $change;
        if($change)
        {
           return true;
        }else
        {
            return false;
        }
    }

    public function my_industry($id)
    {
        $sql = "SELECT industry_name FROM industry WHERE industry_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $change = $stmt->fetch(PDO::FETCH_ASSOC);
        return $change;
        if($change)
        {
           return true;
        }else
        {
            return false;
        }
    }

    public function my_projects($id)
    {
        $sql = "SELECT * FROM project WHERE business_id = ? AND project_status = 'ACTIVE' OR project_status = 'COMPLETED'";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $change = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $change;
        if($change)
        {
           return true;
        }else
        {
            return false;
        }
    }


    public function my_skills_preference($id)
    {
        $sql = "SELECT * FROM business_skills JOIN skills ON business_skills.skill_id = skills.skill_id WHERE business_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $change = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $change;
        if($change)
        {
           return true;
        }else
        {
            return false;
        }
    }

    //methods used in the business view



    public function insert_logo($picname, $id)
    {
        $sql = "UPDATE businesses SET business_logo = ? WHERE business_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $dp = $stmt->execute([$picname, $id]);
        
    }


    public function get_logo($id)
    {
        $sql = "SELECT business_logo FROM businesses WHERE business_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $dp = $stmt->fetch(PDO::FETCH_ASSOC);
        return $dp;
    }


    public function login_time($time, $id)
    {
        $sql = "UPDATE businesses SET last_login = ? WHERE business_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $login = $stmt->execute([$time, $id]);

    }

    public function business_name($name)
    {
        $sql = "SELECT business_name FROM businesses WHERE business_name = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$name]);
        $name = $stmt->fetch(PDO::FETCH_ASSOC);
        return $name;
    }


    public function pending_payments($email)
    {
        $sql = "SELECT * FROM project_payment WHERE pp_status = 'PENDING' AND business_email = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$email]);
        $pending = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $pending;
    }
   

    public function completed_payments($email)
    {
        $sql = "SELECT * FROM project_payment WHERE pp_status = 'COMPLETED' AND business_email = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$email]);
        $completed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $completed;
    }


    public function cancelled_payments($email)
    {
        $sql = "SELECT * FROM project_payment WHERE pp_status = 'CANCELLED' AND business_email = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$email]);
        $cancelled = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cancelled;
    }


    public function refund($email)
    {
        $sql = "SELECT * FROM business_refund WHERE business_email = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$email]);
        $cancelled = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cancelled;
    }


    public function payment_project($id)
    {
        $sql = "SELECT project_title FROM project WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $cancelled = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cancelled;
    }


    public function project_skills($id)
    {
        $sql ="SELECT * FROM project_skills WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $skills;
    }



    public function update_project($prodesc, $state, $proaudience, $proindustry, $prodeadline, $progoals, $experience, $prooffer, $procomm, $procomments, $proefforts, $lga, $skills, $no_of_marketers, $business_id, $project_id){
       
        $sql = "UPDATE project SET  project_description = ?, state_id  = ?, target_audience =?, industry_id = ?, deadline = ?, project_goals_objectives = ?, experience_id = ?, offer_amount_range = ?, communication = ?, additional_comments = ?,previous_efforts = ?,lga_id = ?,  req_no_of_marketers = ?, business_id = ? WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $response = $stmt->execute([$prodesc, $state, $proaudience, $proindustry, $prodeadline, $progoals, $experience, $prooffer, $procomm, $procomments, $proefforts,$lga, $no_of_marketers, $business_id, $project_id]);
    
        // $proid = $this->dbcon->lastInsertId();
        
        if($response)
        {
            foreach($skills as $skill){
            $sql = "INSERT INTO project_skills( project_id, skill_id) VALUES (?, ?)";
            $stmt = $this->dbcon->prepare($sql);
            $hold = $stmt->execute([$proid, $skill]);
            }

            if($hold)
            {
                return true;
            }else
            {
                return false;
            }
        }

        
    
    }


    public function update_file_name($img_file_name, $title)
       {
            $sql= "UPDATE project SET project_image = ? WHERE project_title = ?";
            $stmt = $this->dbcon->prepare($sql);
            $response = $stmt->execute([$img_file_name, $title]);
            return $response;
       }


       public function get_experience($id)
       {
        $sql = "SELECT experience_name FROM experience WHERE experience_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $experience = $stmt->fetch(PDO::FETCH_ASSOC);
        return $experience;
       }


       public function marketer_skills($id)
       {
        $sql = "SELECT * FROM marketer_skills JOIN skills ON marketer_skills.skill_id = skills.skill_id WHERE marketer_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $skills;
       }
    

       public function activate($id)
       {
           $sql = "UPDATE businesses SET business_status = 'active' WHERE business_id = ?";
           $stmt = $this->dbcon->prepare($sql);
           $activate = $stmt->execute([$id]);
           
           if($activate == 1)
           {
            return true;
           }else{
            return false;
           }
       }

       public function deactivate($id)
       {
           $sql = "UPDATE businesses SET business_status = 'pending' WHERE business_id = ?";
           $stmt = $this->dbcon->prepare($sql);
           $deactivate = $stmt->execute([$id]);
           
           if($deactivate == 1)
           {
            return true;
           }else{
            return false;
           }
       }


       public function disable_application($id)
       {
        
            $sql = "UPDATE project SET receiving_application = 'NO' WHERE project_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $disable = $stmt->execute([$id]);
            return $disable;
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
    
    
    $business = new Business();
    // echo $user->update_profile("Sam", "Lord", "090785430", "3", "2");
    // $user->create_account("Po", "Mine", "dd@gmail.com", "oowe", "oowe");

?>