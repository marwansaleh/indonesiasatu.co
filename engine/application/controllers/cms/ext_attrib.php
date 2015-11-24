<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Category
 *
 * @author marwansaleh
 */
class Ext_attrib extends MY_AdminController {
    function __construct() {
        parent::__construct();
        $this->data['active_menu'] = 'system';
        $this->data['page_title'] = '<i class="fa fa-cogs"></i> Extended Article Attributes';
        $this->data['page_description'] = 'List and update article extended attributes';
        
        //load models
        $this->load->model(array('article/attributes_m','article/category_m'));
    }
    
    function index(){
        $page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE):1;
        
        $this->data['page'] = $page;
        $offset = ($page-1) * $this->REC_PER_PAGE;
        $this->data['offset'] = $offset;
        
        $where = NULL;
        
        //count totalRecords
        $this->data['totalRecords'] = $this->attributes_m->get_count($where);
        //count totalPages
        $this->data['totalPages'] = ceil ($this->data['totalRecords']/$this->REC_PER_PAGE);
        $this->data['items'] = array();
        if ($this->data['totalRecords']>0){
            $items = $this->attributes_m->get_offset('*',$where,$offset,  $this->REC_PER_PAGE);
            if ($items){
                foreach($items as $item){
                    $item->category = $this->category_m->get_value('name',array('id'=>$item->category_id));
                    $this->data['items'][] = $item;
                }
                $url_format = site_url('cms/ext_attrib/index?page=%i');
                $this->data['pagination'] = smart_paging($this->data['totalPages'], $page, $this->_pagination_adjacent, $url_format, $this->_pagination_pages, array('records'=>count($items),'total'=>$this->data['totalRecords']));
            }
        }
        $this->data['pagination_description'] = smart_paging_description($this->data['totalRecords'], count($this->data['items']));
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], 'Extended Attributes', site_url('cms/ext_attrib'), TRUE);
        
        $this->data['subview'] = 'cms/ext_attrib/index';
        $this->load->view('_layout_admin', $this->data);
    }
    
    function edit(){
        $id = $this->input->get('id', TRUE);
        $page = $this->input->get('page', TRUE);
        
        $item = $id ? $this->category_m->get($id):$this->category_m->get_new();
        
        if ((!$id && !$this->users->has_access('CATEGORY_CREATE'))||($id && !$this->users->has_access('CATEGORY_EDIT'))){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Sorry. You dont have access for this feature');
            redirect('cms/category/index?page='.$page);
        }
        
        $this->data['item'] = $item;
        
        //data support
        $this->data['parents'] = $this->category_m->get_by(array('id !='=>$id));
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], 'Categories', site_url('cms/category'));
        breadcumb_add($this->data['breadcumb'], 'Update Item', NULL, TRUE);
        
        $this->data['submit_url'] = site_url('cms/category/save?id='.$id.'&page='.$page);
        $this->data['back_url'] = site_url('cms/category/index?page='.$page);
        $this->data['subview'] = 'cms/category/edit';
        $this->load->view('_layout_admin', $this->data);
    }
    
    function save(){
        $id = $this->input->get('id', TRUE);
        $page = $this->input->get('page', TRUE);
        
        if ((!$id && !$this->users->has_access('CATEGORY_CREATE'))||($id && !$this->users->has_access('CATEGORY_EDIT'))){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Sorry. You dont have access for this feature');
            redirect('cms/category/index?page='.$page);
        }
        
        $rules = $this->category_m->rules;
        $this->form_validation->set_rules($rules);
        //exit(print_r($rules));
        if ($this->form_validation->run() != FALSE) {
            $postdata = $this->category_m->array_from_post(array('name','slug','parent','sort','is_menu','is_home'));
            
            if ($this->category_m->save($postdata, $id)){
                $this->session->set_flashdata('message_type','success');
                $this->session->set_flashdata('message', 'Data category item saved successfully');
                
                redirect('cms/category/index?page='.$page);
            }else{
                $this->session->set_flashdata('message_type','error');
                $this->session->set_flashdata('message', $this->category_m->get_last_message());
            }
        }
        
        if (validation_errors()){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', validation_errors());
        }
        
        redirect('cms/category/edit?id='.$id.'&page='.$page);
    }
    
    function delete(){
        $id = $this->input->get('id', TRUE);
        $page = $this->input->get('page', TRUE);
        
        if (!$this->users->has_access('CATEGORY_DELETE')){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Sorry. You dont have access for this feature');
            redirect('cms/category/index?page='.$page);
        }
        
        //check if found data item
        $item = $this->category_m->get($id);
        if (!$item){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Could not find data category item. Delete item failed!');
        }else{
            if ($this->category_m->delete($id)){
                $this->session->set_flashdata('message_type','success');
                $this->session->set_flashdata('message', 'Data category item deleted successfully');
            }else{
                $this->session->set_flashdata('message_type','error');
                $this->session->set_flashdata('message', $this->category_m->get_last_message());
            }
        }
        
        redirect('cms/category/index?page='.$page);
    }
}

/*
 * file location: engine/application/controllers/cms/category.php
 */