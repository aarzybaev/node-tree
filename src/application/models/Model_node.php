<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_node extends CI_Model {

        public $nodeName = '';
        public $idParent = 0;
        public $ipAddress = '0.0.0.0';
        public $weight = 100;
        public $tb = 'tree';        

        public function getAllnodes()
        {
                //$this->db->order_by('nodeName', 'ASC');
                $this->db->order_by('weight', 'ASC');
                $query = $this->db->get($this->tb);
                return $query->result_array();
        }
        
        public function getOneNode($id)
        {
                $this->db->where('id', $id);
                $query = $this->db->get($this->tb);
                return $query->row_array();
        }

        public function addNode($pid)
        {
                if(!empty($pid)) {
                    
                    $this->idParent = $pid;  
                    
                };
                    
                    $data = array(
                                    'nodeName' => $_POST['nodeName'], 
                                    'idParent' => $this->idParent,
                                    'ipAddress' => $_POST['ipAddress'],
                                    'weight' => $this->weight
                                ); 
                
                    $this->db->insert($this->tb, $data);
        }

        public function updNode($id)
        {
                
                $data = array(
                                    'nodeName' => $_POST['nodeName'], 
                                    'idParent' => $_POST['idParent'],
                                    'ipAddress' => $_POST['ipAddress'],
                                    'weight' => $_POST['weight']
                                ); 

                $this->db->where('id', $id);
                $this->db->update($this->tb, $data);
        }
        
        
        public function delNodeRecursive($idR) {
            
            $this->db->delete($this->tb, array('id' => $idR));
            
            $query = $this->getAllnodes();
            foreach ($query as $row) {
                
                if($row['idParent'] == $idR) {
                   
                   $this->delNodeRecursive($row['id']); 
                }
            }
            
        }
        
        public function checkNode($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get($this->tb); 
            $row = $query->row();
            return (isset($row))?true:false;
            
        }
        
        public function searchNode()
        {
            $this->db->like('nodeName', $_POST['lookFor']);
            $this->db->or_like('ipAddress', $_POST['lookFor']);
            return $this->db->get($this->tb);
            
        } 

}