    <?php
        class Route{

            public static $validRoutes = array();

            public static function set($route, $fundction){
                self::$validRoutes[] = $route;
                
                if($_GET['url'] == $route){
                    $fundction->__invoke();
                }
                // else{
                //     account::home();
                // }
            }
        }
    ?>