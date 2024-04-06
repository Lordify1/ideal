<?php  
    error_reporting(E_ALL);

    require_once("Db.php");

    class Category extends Db{

        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function get_category(){

            $sql = "SELECT * FROM category";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $category = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $category;

        }

        public function add_category($category_id, $category_name){
           
            $sql = "INSERT INTO category (category_id, category_name) VALUES (?,?)";
            $stmt = $this->dbconn->prepare($sql);
            $categories = $stmt->execute([$category_id, $category_name]);
            return $categories;
            
        }

        public function delete_category($category_id){
           
            $sql = "DELETE FROM category WHERE category_id = ? ";
            $stmt = $this->dbconn->prepare($sql);
            $categories = $stmt->execute([$category_id]);
            return $categories;
            
        }


        

    }

$category = new Category();
?>