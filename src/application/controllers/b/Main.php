<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    
    public function __construct()
        {
                parent::__construct();
                $this->load->library('form_validation');
                $this->load->model('model_node');
                
        }
	    
    public function index()
	{
		$data['title'] = 'LAB::Backend';
        $data['author'] = 'Askhad';
        $data['content'] = 'LAB::Backend';
        $data['menu'] = array('item1' => array ('active', '<span class="sr-only">(current)'),
                                'item2' => array ('', ''),
                                'item3' => array ('', ''),
                                'item4' => array ('', '')
                                );
        $page = 'main';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
	}
    
    public function nodeAdd($id = '')
	{
		$data['title'] = 'LAB::Node add';
        $data['author'] = 'Askhad';
        $data['content'] = 'LAB::Backend';
        $data['menu'] = array('item1' => array ('', ''),
                                'item2' => array ('active', '<span class="sr-only">(current)'),
                                'item3' => array ('', ''),
                                'item4' => array ('', '')
                                );
        $data['id'] = $id;
        $page = 'nodeAdd';
        
        $this->form_validation->set_rules('nodeName', 'Nodes name', 'required');
        $this->form_validation->set_rules('ipAddress', 'IP address', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/menu', $data);
                        $this->load->view('pages/'.$page, $data);
                        $this->load->view('templates/footer');
                }
                else
                {
                        $this->model_node->addNode($id);
                        
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/menu', $data);
                        $this->load->view('success/nodeAdd', $data);
                        $this->load->view('templates/footer');
                                                
                }
        
        
	}
    
        
    public function nodeList($id = 0)
	{
		$data['title'] = 'LAB::Node list';
        $data['author'] = 'Askhad';
        $data['content'] = 'LAB::Backend';
        $data['menu'] = array('item1' => array ('', ''),
                                'item2' => array ('', ''),
                                'item3' => array ('active', '<span class="sr-only">(current)'),
                                'item4' => array ('', '')
                                );
        $data['query'] = $this->model_node->getAllnodes();
        $data['topNodeId'] = $id;
        $data['style'] = array( 'parent' => 'class="btn btn-danger btn-sm" ',
                                'defStyle' => 'class="btn btn-outline-primary btn-sm" ',
                                'coreStyle' => 'class="btn btn-outline-info btn-sm" ',
                                'tranStyle' => 'class="btn btn-info btn-sm"',
                                'baseStyle' => 'class="btn btn-warning btn-sm" ',
                                'rtStyle' => 'class="btn btn-success btn-sm" ',
                                'scStyle' => 'class="btn btn-secondary btn-sm" '
                                );
        $page = 'nodeList';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
	}
    
    public function nodeOp($id)
	{
		$data['title'] = 'LAB::Node Operation';
        $data['author'] = 'Askhad';
        $data['content'] = 'LAB::Backend';
        $data['menu'] = array('item1' => array ('', ''),
                                'item2' => array ('', ''),
                                'item3' => array ('', ''),
                                'item4' => array ('', '')
                                );
        $data['id'] = $id;
        $page = 'nodeOp';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
	}
    
    public function nodeUpd($id)
	{
		$data['title'] = 'LAB::Node Update';
        $data['author'] = 'Askhad';
        $data['content'] = 'LAB::Backend';
        $data['menu'] = array('item1' => array ('', ''),
                                'item2' => array ('', ''),
                                'item3' => array ('', ''),
                                'item4' => array ('', '')
                                );
        $data['id'] = $id;
        
        if($this->model_node->checkNode($id)) {
            
            
            $data['node'] = $this->model_node->getOneNode($id);
            $page = 'nodeUpd';
        
            $this->form_validation->set_rules('nodeName', 'Nodes name', 'required');
            $this->form_validation->set_rules('ipAddress', 'IP address', 'required');
            $this->form_validation->set_rules('idParent', 'ID parent', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/menu', $data);
                        $this->load->view('pages/'.$page, $data);
                        $this->load->view('templates/footer');
                }
                else
                {
                        $this->model_node->updNode($data['node']['id']);
                        
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/menu', $data);
                        $this->load->view('success/nodeUpd', $data);
                        $this->load->view('templates/footer');
                                                
                }
        } else {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/menu', $data);
                $this->load->view('errors/checkNode', $data);
                $this->load->view('templates/footer');   
        }
        
        
        
	}
    
    public function nodeDel_($id)
	{
		$data['title'] = 'LAB::Node Delete';
        $data['author'] = 'Askhad';
        $data['content'] = 'LAB::Backend';
        $data['menu'] = array('item1' => array ('', ''),
                                'item2' => array ('', ''),
                                'item3' => array ('', ''),
                                'item4' => array ('', '')
                                );
        $data['id'] = $id;
        $page = 'nodeDel';
        
        if($this->model_node->checkNode($id)) {
        
        $this->model_node->delNodeRecursive($id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('success/'.$page, $data);
        $this->load->view('templates/footer');
        
        } else {
            
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('errors/checkNode', $data);
        $this->load->view('templates/footer');
        
        }
	}
    
    public function nodeDel($id)
	{
	   echo 'Нет прав на удаление! <br/>';
       echo '<a href="'.base_url().'">На главную</a>';
	   }
    
    public function nodeSearch($id = '')
	{
		$data['title'] = 'LAB::Node search';
        $data['author'] = 'Askhad';
        $data['content'] = 'LAB::Backend';
        $data['menu'] = array('item1' => array ('', ''),
                                'item2' => array ('', ''),
                                'item3' => array ('', ''),
                                'item4' => array ('active', '<span class="sr-only">(current)'),
                                );
        $data['id'] = $id;
        $page = 'nodeSearch';
        
        $this->form_validation->set_rules('lookFor', 'Search field', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/menu', $data);
                        $this->load->view('pages/'.$page, $data);
                        $this->load->view('templates/footer');
                }
                else
                {
                        $data['find'] = $this->model_node->searchNode();
                        $data['query'] = $this->model_node->getAllnodes();
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/menu', $data);
                        $this->load->view('success/nodeSearch', $data);
                        $this->load->view('templates/footer');
                                                
                }
        
        
	}
    
    public function getTree($id = 0)
	{
		$data['title'] = 'LAB::Node list';
        $data['author'] = 'Askhad';
        $data['content'] = 'LAB::Backend';
        $data['menu'] = array('item1' => array ('', ''),
                                'item2' => array ('', ''),
                                'item3' => array ('', ''),
                                'item4' => array ('', '')
                                );
        $data['query'] = $this->model_node->getAllnodes();
        $data['endNode'] = $this->model_node->getOneNode($id);;
        $data['style'] = array( 'parent' => 'class="btn btn-danger btn-sm" ',
                                'defStyle' => 'class="btn btn-outline-primary btn-sm" ',
                                'coreStyle' => 'class="btn btn-outline-info btn-sm" ',
                                'tranStyle' => 'class="btn btn-info btn-sm" ',
                                'baseStyle' => 'class="btn btn-warning btn-sm" ',
                                'rtStyle' => 'class="btn btn-success btn-sm" ',
                                'scStyle' => 'class="btn btn-secondary btn-sm" '
                                );
        $page = 'nodeTree';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
	}

}
