<?php
    error_reporting(E_ALL);

    require_once("Database.php");

    class General extends DataBase{

        private $dbcon;

        public function __construct(){
            $this->dbcon = $this->connect();
        }

        
  

        public function fetch_projects(){
            $sql = "SELECT * FROM project JOIN businesses ON project.business_id = businesses.business_id WHERE project_status = 'COMPLETED' OR project_status = 'ACTIVE'";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $projects;

    }


        public function project_skills($project_id)
        {
            $sql = "SELECT * FROM project_skills JOIN skills ON project_skills.skill_id = skills.skill_id WHERE project_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$project_id]);
            $proskills = $stmt->fetch(PDO::FETCH_ASSOC);
            return $proskills;
        }



    public function fetch_marketers()
    {
        $sql = "SELECT * FROM marketers WHERE marketer_status = 'active'";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $marketers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $marketers;

        if($marketers){
            $_SESSION["all_marketer"] = $marketers;
        }else{
            return false;
        }
    }


    public function activate_marketer($id)
    {
        $sql = "UPDATE marketers SET marketer_status = 'active' WHERE marketer_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $marketer = $stmt->execute([$id]);
        return $marketer;
    }


    public function marketers_index(){
        $sql = "SELECT * FROM marketers LIMIT 4";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $marketers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $marketers;

        if($marketers){
            return true;
        }else{
            return false;
        }
    }
    


 public function fetch_businesses(){
    $sql = "SELECT * FROM businesses WHERE business_status = 'active'";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $businesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $businesses;

    if($businesses){
        return true;
    }else{
        return false;
    }
}

    public function businesses_index(){
        $sql = "SELECT * FROM businesses LIMIT 4";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $businesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $businesses;
    
        if($businesses){
            return true;
        }else{
            return false;
        }
    }

    
    public function view_marketer($marketer_email){

        $sql = "SELECT * FROM marketers WHERE marketer_email = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$marketer_email]);
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function view_business($business_email){

        $sql = "SELECT * FROM businesses WHERE business_email = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$business_email]);
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function get_projectbyid($project_id){

        $query = "SELECT * FROM project WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($query);
        $stmt->execute([$project_id]);
        $records = $stmt->fetch(PDO::FETCH_ASSOC);

        return $records;

    }


    
    /* all about project view */


    


    public function view_project($project_id){

        $sql = "SELECT * FROM project WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$project_id]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);

        return $response;
    }


    public function view_project_business($project_id){

        $sql = "SELECT business_name FROM project JOIN businesses ON project.business_id = businesses.business_id WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$project_id]);
        $bname = $stmt->fetch(PDO::FETCH_ASSOC);

        return $bname;
    }

    public function view_project_marketers($project_id){

        $sql = "SELECT marketer_email FROM marketers JOIN project_marketers ON marketers.marketer_id = project_marketers.marketer_id WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$project_id]);
        $marketers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $marketers;
    }

    public function view_project_state($project_id){

        $sql = "SELECT state_name FROM project JOIN state ON project.state_id = state.state_id WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$project_id]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);

        return $response;
    }

    public function view_project_industry($project_id){

        $sql = "SELECT industry_name FROM project JOIN industry ON project.industry_id = industry.industry_id WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$project_id]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);

        return $response;
    }



    public function view_project_experience($project_id){

        $sql = "SELECT experience_name FROM project JOIN experience ON project.experience_id = experience.experience_id WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$project_id]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);

        return $response;
    }


    public function view_project_skill($project_id){

        $sql = "SELECT skill_name FROM project_skills JOIN skills ON project_skills.skill_id = skills.skill_id WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$project_id]);
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $response;
    }




    /* all about project view */

    public function count_project()
    {
       $sql = "SELECT project_title, COUNT(project_id) FROM project ";
       $stmt = $this->dbcon->prepare($sql);
       $stmt->execute();
       $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $count;
    }



    public function show_experience($project_id)
    {

        $sql = "SELECT * FROM project WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$project_id]);
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }


    public function project_index(){
        $sql = "SELECT * FROM project JOIN businesses ON project.business_id = businesses.business_id WHERE project_status = 'ACTIVE' OR project_status = 'COMPLETED' LIMIT 4";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }


    public function project_skills_index($project_id)
    {
        $sql = "SELECT * FROM project_skills JOIN skills ON project_skills.skill_id = skills.skill_id WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$project_id]);
        $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $skills;
    }

    public function project_industry_index($project_id)
    {
        $sql = "SELECT * FROM project JOIN industry ON project.industry_id = industry.industry_id WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$project_id]);
        $industry = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $industry;
    }


    public function insert_newsletter($name, $email)
    {
        $sql = "INSERT INTO newsletter (user_name, user_email) VALUES (?,?)";
        $stmt = $this->dbcon->prepare($sql);
        $response = $stmt->execute([$name, $email]);
        return $response;
    }


    public function marketer_skills($id)
    {
        $sql = "SELECT * FROM marketer_skills JOIN skills ON marketer_skills.skill_id = skills.skill_id WHERE marketer_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $skills;
    }


  


    public function insert_application($relevant_experience, $approach, $strategy, $specific_skills, $portfolio, $timeline, $communication, $testimonials, $additional_information,	$marketer_id, $project_id, $business_id, $prounique){

        $sql= "SELECT application_unique FROM application WHERE application_unique = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$prounique]);
        $check = $stmt->fetch(PDO::FETCH_ASSOC);

        if($check == null)
        {
            $sql = "INSERT INTO application( relevant_experience, approach, strategy, specific_skills, portfolio, timeline, communication, testimonials,additional_information, marketer_id, project_id, business_id, application_unique) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
             $stmt = $this->dbcon->prepare($sql);
            $response = $stmt->execute([$relevant_experience, $approach, $strategy, $specific_skills, $portfolio, $timeline, $communication, $testimonials, $additional_information,	$marketer_id, $project_id, $business_id, $prounique]);
        }else
        {
            $_SESSION["error_message"] = "You already sent an application for this Project. Please await a response";
            header("location:../all_projects.php");
            die();
        }
        return $response;
    }

    public function business_industry($indid)
        {
            $sql = "SELECT industry_name FROM industry WHERE industry_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$indid]);
            $ind = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $ind;
        }


    public function message_ideal($business_id, $marketer_id, $message, $email, $message_type)
    {
        $sql = "INSERT INTO customer_service (business_id, marketer_id, message, email, message_type_name) VALUES (?,?,?,?,?)";
        $stmt = $this->dbcon->prepare($sql);
        $cs = $stmt->execute([$business_id, $marketer_id, $message, $email, $message_type]);
    }


    public function getlga_bystate($id){
            
        $sql = "SELECT * FROM lga WHERE state_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $lgas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lgas;

    }

    public function message_type()
    {
        $sql = "SELECT * FROM message_types";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }


    public function industries()
    {
        $sql = "SELECT * FROM industry";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $industry = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $industry;
    }

    public function state()
    {
        $sql = "SELECT * FROM state";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $states = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $states;
    }


    public function lga()
    {
        $sql = "SELECT * FROM lga";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $lgas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lgas;
    }


    public function experience()
    {
        $sql = "SELECT * FROM experience";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $experience = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $experience;
    }


    public function category()
    {
        $sql = "SELECT * FROM category";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $category = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $category;
    }

    //implementing the search function


    public function search_business($name)
    {
        $sql = "SELECT * FROM businesses WHERE business_status = 'active' AND business_name LIKE '%' ? '%'";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$name]);
        $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $search;
    }

    public function search_marketer($name)
    {
        $sql = "SELECT * FROM marketers WHERE marketer_status = 'active' AND concat(marketer_lname,marketer_fname) LIKE '%' ? '%'";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$name]);
        $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $search;
    }


    public function search_project($title)
    {
        $sql = "SELECT * FROM project WHERE project_status = 'active' OR project_status ='completed' AND 
        project_title LIKE '%' ? '%'";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$title]);
        $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $search;
    } 
    
    
    public function apply_button($unique)
    {
        $sql = "SELECT application_unique FROM application WHERE application_unique = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$unique]);
        $unique = $stmt->fetch(PDO::FETCH_ASSOC);
        return $unique;
    }


    public function get_application($id)
    {
        $sql = "SELECT * FROM application WHERE application_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$id]);
        $app = $stmt->fetch(PDO::FETCH_ASSOC);
        return $app;
    }


    public function update_application($relevant_experience, $approach, $strategy, $specific_skills, $portfolio, $timeline, $communication, $testimonials, $additional_information, $application_amount, $application_id){

            $sql = "UPDATE application SET relevant_experience = ?, approach = ?, strategy = ?, specific_skills = ?, portfolio = ?, timeline = ?, communication = ?, testimonials = ?,additional_information = ?, application_amount = ?WHERE application_id = ?";
             $stmt = $this->dbcon->prepare($sql);
            $update = $stmt->execute([$relevant_experience, $approach, $strategy, $specific_skills, $portfolio, $timeline, $communication, $testimonials, $additional_information, $application_amount, $application_id]);

            return $update;

            
    }




    public function delete_application($id)
    {
        $sql = "DELETE FROM application WHERE application_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $delete = $stmt->execute([$id]);

        return $delete;
    }



    public function delete_project($id)
    {
        $sql = "DELETE FROM project WHERE project_id = ?";
        $stmt = $this->dbcon->prepare($sql);
        $delete = $stmt->execute([$id]);
    }


    
    public function project_by_title($title)
    {
        $sql = "SELECT * FROM project WHERE project_title = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$title]);
        $project = $stmt->fetch(PDO::FETCH_ASSOC);
        return $project;
    }
   
}

    $general = new General();

?>