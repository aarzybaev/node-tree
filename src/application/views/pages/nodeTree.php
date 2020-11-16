<?php

/**
 * @author askhad
 * @copyright 2017
 */
    
    function grepID($q, $id, $pid, &$res) {
                    
        foreach($q as $row) {
        
            if($pid == $row['id']) {
            
                $res[] = $id;
            
                grepID($q, $row['id'], $row['idParent'], $res);
            }
        
        }
    
        return $res;
        
    }
    
    
    $mass = '';
    
    $css = '';
    
    $res = array();
    
    $mass = grepID($query, $endNode['id'], $endNode['idParent'], $res);
    
    $mlen = count($mass); 
    
    $len = $mlen - 1;
    
    $patCore = '/ats|alcatel/i';
    $countCore = 0;
    $patTran = '/air|ligo|cnt|mtt|lumina|freemile/i';
    $countTran = 0;
    $patBase = '/mtbs|cnbs/i';
    $countBase = 0;
    $patRt = '/mtr/i';
    $countRt = 0;
    $patSc = '/mt |sta/i';
    $countSc = 0;
    $total = 0;
    
    echo '<ul class="tree">';
    echo '<li>';
    echo '<a data-toggle="tooltip" title="0.0.0.0"'.$style['parent'].' href="'.base_url().'b/main/nodeOp/0">root</a>';  
    
    echo !$len?'<ul>':'</li>';
    
    for(; 0 <= $len; $len--) {
        
        foreach($query as $node) {
            
                
            if($mass[$len] == $node['id']) {
                
                $css = $style['defStyle'];
                $total++;
                
                if(preg_match_all($patCore, $node['nodeName'], $match)) {$css = $style['coreStyle']; $countCore++;}
                if(preg_match_all($patTran, $node['nodeName'], $match)) {$css = $style['tranStyle']; $countTran++;}
                if(preg_match_all($patBase, $node['nodeName'], $match)) {$css = $style['baseStyle']; $countBase++;}
                if(preg_match_all($patRt, $node['nodeName'], $match)) {$css = $style['rtStyle']; $countRt++;}
                if(preg_match_all($patSc, $node['nodeName'], $match)) {$css = $style['scStyle']; $countSc++;}
                
                echo '<li>';
                echo '<a data-toggle="tooltip" title="'.$node['ipAddress'].'"'.$css.' href="'.base_url().'b/main/nodeOp/'.$node['id'].'">'.$node['nodeName'].'</a>';
                if($len) echo '<ul>';
        
            }
        }
        
    }
    
    for(; 0 < $mlen; $mlen--) {
        
        echo '</ul></li>';
    }

    echo '</ul>';
    
   
?>
<br />

<ul class="list-group col-4 treeList">
<li class="list-group-item active">Brief information:</li>
<li class="list-group-item">Core nodes - &nbsp;<span class="badge badge-default badge-pill"><?=$countCore;?></span></li>
<li class="list-group-item">Transport nodes - &nbsp;<span class="badge badge-default badge-pill"><?=$countTran;?></span></li>
<li class="list-group-item">MTR nodes - &nbsp;<span class="badge badge-default badge-pill"><?=$countRt;?></span></li>
<li class="list-group-item">BS nodes - &nbsp;<span class="badge badge-default badge-pill"><?=$countBase;?></span></li>
<li class="list-group-item">DL nodes - &nbsp;<span class="badge badge-default badge-pill"><?=$total - ($countCore+$countTran+$countRt+$countBase);?></span></li>
<li class="list-group-item list-group-item-info">Amount of nodes - &nbsp;<span class="badge badge-default badge-pill"><?=$total;?></span></li>
</ul>
<br />
