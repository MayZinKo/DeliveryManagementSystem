<?php

class File_upload{
	protected $CI;
	public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance(); 	
    }
     function item_category_upload($uploader)
    {
    
    	$img_ext = $this->CI->config->item('item_category_image_extension');    
    	$img_allow_type = $this->CI->config->item('img_allow_type');   
    	
    	$config['upload_path'] = "./".$img_ext;
		$config['allowed_types'] = $img_allow_type;
		$config['max_size'] = '16000';
		$config['max_width']  = '1000';
		$config['max_height']  = '1000';
		$config['encrypt_name'] = TRUE;
		$config['remove_spaces'] = TRUE;

		$this->CI->load->library('upload',$config);	
		 if ( ! $this->CI->upload->do_upload($uploader))
        {
            $img = array('error' => $this->CI->upload->display_errors());
            $img["has_error"]= true;
        }
        else
        {
            $data = $this->CI->upload->data();
			$img['file_name']=$data['file_name'];
			$img['has_error']=false;
        }
        return $img['file_name'];
    }
     function item_category_arr_upload()
    {
        $this->CI->load->library('upload');
              $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
             
                 for($i=0; $i<$cpt; $i++)
                {
                    $_FILES['userfile']['name']= $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']= $files['userfile']['size'][$i];
                    $this->CI->upload->initialize($this->set_upload_options());
                    $this->CI->upload->do_upload();
                    $data = $this->CI->upload->data();

                    $images[] = $data['file_name'];
                }
                
            // $fileName = implode('    /     ',$images);
            // echo $fileName;
                return $images;

    }
    private function set_upload_options()
      { 
        $img_ext = $this->CI->config->item('item_category_image_extension');    
        $img_allow_type = $this->CI->config->item('img_allow_type');   

            $config = array();
            $config['upload_path'] = "./".$img_ext;
            $config['allowed_types'] = $img_allow_type;
            $config['max_size'] = '16000';
            $config['encrypt_name'] = TRUE;
            $config['remove_spaces'] = TRUE;
            return $config;
      }

}