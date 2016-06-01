<?php 
require '../init.inc.php';
    $cache=new Cache();
    if(IS_CACHE){
        switch ($_GET['type']){
            case 'details':$cache->details();
                            break;
            case 'list':$cache->listc();
                        break;
            case 'index':$cache->index();
                         break;
            case 'header':$cache->header();
                        break;
        }
    }
?>