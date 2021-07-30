<?php
    class Helper {
        
        static public function escape($str) {
            return htmlentities($str);
        }
        
        static public function generateToken($size = 32) {
            $symbols = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '@', '$', '_', '+', '='];
            $symbolsLength = count($symbols);
            $token = '';
            for ($i = 0; $i < $size; $i++) {
                $token .= $symbols[rand(0, $symbolsLength - 1)];
            }
            return $token;
	    }
        
        static public function has_children($rows, $id) {
            foreach ($rows as $row) {
            if ($row['menu_items_parent_id'] == $id)
            return true;
            }
        return false;
        }

        static public function build_menu($rows, $parent = NULL) {
            $parentLiClass = '';
            $parentLinkClass = '';
            $toggleAttr='';
            if($parent){ //if parent is not 0
                $result = '<ul class="sub-menu-block dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
            }else{
                $result = '<ul class="navbar-nav main-menu ml-auto" id="tabs">';
            }
            foreach ($rows as $row) {
                if ($row['menu_items_parent_id'] == $parent){
                    $hasChildren = Helper::has_children($rows, $row['menu_items_id']);
                    if($hasChildren) {
                        $parentLiClass = 'class="dropdown"';
                        $parentLinkClass = 'class="main-menu__link dropdown-toggle"';
                        $toggleAttr=' id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                    }else{
                        if($row['menu_items_parent_id'] != NULL) {
                            $parentLiClass = '';
                            $parentLinkClass = 'class="dropdown-item sub-menu__link"';
                            $toggleAttr='';
                        } else {
                            $parentLiClass = '';
                            $parentLinkClass = 'class="main-menu__link"';
                            $toggleAttr='';
                        }
                    }
                    $result.= '<li '.$parentLiClass.'><a '.$parentLinkClass.' href="' . FULL_SITE_ROOT . $row["menu_items_url"].'"'.$toggleAttr.'>
                            '.$row["menu_items_name"].'
                            </a>';
                    if ($hasChildren) {
                        $result.= '<div class="collapse navbar-collapse" id="navbarNavDropdown">';
                        $result.= Helper::build_menu($rows, $row['menu_items_id']);
                        $result.='</div>';
                    }
                    $result.= '</li>';
                }
            }
        $result.= '</ul>';
        return $result;
        }
    }