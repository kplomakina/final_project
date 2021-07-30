<?php
    class Menu {
        
        private $db;
        
        public function __construct() {
            $this->db = DB::getInstance();
        }
        public function getMenu(){
            $query = (new Select('`menu_items`'))
                ->sort(array('name' => '`menu_items_id`', 'direction' => 'ASC'))
                ->build();
            $menuItems = mysqli_query($this->db, $query);
            return mysqli_fetch_all($menuItems, MYSQLI_ASSOC);
        }
        
        public function getText($name){
            $query = (new Select('`static_pages`'))
                ->what(array('`static_page_text`'))
                ->where(array('WHERE' => array('`static_page_name`', '=', "'$name'")))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_assoc($result);
        }
        
        public function updateText($name, $aboutNewText) {
            $query = "UPDATE `static_pages`
				     SET `static_page_text` = '$aboutNewText'
				     WHERE `static_page_name` = '$name';
            ";
            mysqli_query($this->db, $query);
            return true;
        }
    }

