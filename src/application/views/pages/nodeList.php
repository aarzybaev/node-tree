<?php

/**
 * @author askhad
 * @copyright 2017
 */
 
    echo '<ul class="tree">';
        
    foreach($query as $nodeParent) { 
        
            if(!$topNodeId) {
        
                if($nodeParent['idParent'] == $topNodeId) { // Получаем родителей
            
                    $css = setCSS($nodeParent['nodeName'], $style);
          
                    echo '<li>';
                    echo '<a data-toggle="tooltip" title="'.$nodeParent['ipAddress'].'" '.$css.' href="'.base_url().'b/main/nodeOp/'.$nodeParent['id'].'">'.$nodeParent['nodeName'].'</a>';
                    treeBuilder($query, $nodeParent['id'], $style);
                                
                }
                
            } else {
                
                if($nodeParent['id'] == $topNodeId) { // Получаем родителей
            
                    $css = setCSS($nodeParent['nodeName'], $style);
          
                    echo '<li>';
                    echo '<a data-toggle="tooltip" title= "'.$nodeParent['ipAddress'].'" '.$css.' href="'.base_url().'b/main/nodeOp/'.$nodeParent['id'].'">'.$nodeParent['nodeName'].'</a>';
                    treeBuilder($query, $nodeParent['id'], $style);
                                
                }
                
            }
    
    }
    

    echo '</ul>';
    
    function treeBuilder($q, $id, $nodeStyle) {

        $nodeCount = 0;
                
        foreach($q as $child) {
            
            if($child['idParent'] == $id) $nodeCount++;
            
        }
        
        if(!$nodeCount) {
            
            echo '</li>';
            
        } else {
            
            echo '<ul>';
                foreach($q as $row) {
                    
                    if($row['idParent'] == $id) {
                        
                        $css = setCSS($row['nodeName'], $nodeStyle);
                        
                        echo '<li>';
                        echo '<a data-toggle="tooltip" title= "'.$row['ipAddress'].'" '.$css.'href="'.base_url().'b/main/nodeOp/'.$row['id'].'">'.$row['nodeName'].'</a>';
                        treeBuilder($q, $row['id'], $nodeStyle );
                    }
                    
                }
            echo '</ul>';
        }
        
    }
    
    function setCSS($name, $styleCSS) {
        
            $patRoot = '/root/i';
            $patCore = '/ats|alcatel|dgs/i';
            $patTran = '/air|ligo|cnt|mtt|lumina|freemile/i';
            $patBase = '/mtbs|cnbs/i';
            $patRt = '/mtr/i';
            $patSc = '/mt |sta/i';
                        
            $css = $styleCSS['defStyle'];
                        
            if(preg_match_all($patRoot, $name, $match)) {$css = $styleCSS['parent'];}
            if(preg_match_all($patCore, $name, $match)) {$css = $styleCSS['coreStyle'];}
            if(preg_match_all($patTran, $name, $match)) {$css = $styleCSS['tranStyle'];}
            if(preg_match_all($patBase, $name, $match)) {$css = $styleCSS['baseStyle'];}
            if(preg_match_all($patRt, $name, $match)) {$css = $styleCSS['rtStyle'];}
            if(preg_match_all($patSc, $name, $match)) {$css = $styleCSS['scStyle'];}
            
            return $css;
    }
    
?>
<br />