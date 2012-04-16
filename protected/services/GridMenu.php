<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GridMenu
 *
 * @author Junior Pires
 */
class GridMenu {

    public static function menu($arrayMenu=array(),$options=array()){
       echo "<table>";
            GridMenu::geraItens($arrayMenu,$options);
       echo "</table>";
    }

     private static function geraItens($arrayMenu=array(),$options=array()){
        
        
        while($arrayMenu!=null) {
            echo '<tr>';
            for($i=0;(($i<$options['columns']) && ($arrayMenu!=null));$i++){
                echo '<td style="text-align: center;">';
                echo CHtml::imageButton($arrayMenu[$i]['icon'],array('submit'=>$arrayMenu[$i]['link']));
                echo "<br><a href=".$arrayMenu[$i]['link'].">".$arrayMenu[$i]['title']."</a>";
                echo '</td>';
                unset ($arrayMenu[$i]);
            }
           
            $arrayMenu=array_values($arrayMenu);
            echo '</tr>';
            
        }


    }
}
?>
