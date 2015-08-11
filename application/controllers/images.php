<?php
/**
 * Created by PhpStorm.
 * User: bstalnaker
 * Date: 8/4/2015
 * Time: 8:42 PM
 */
if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Images extends LF_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (method_exists($this, $this->task_key))
        {
            $function = $this->task_key;
            $this->$function();
        }
        else
        {
            $this->index();
        }
    }

    public function index()
    {
        $this->load->model('image_model');
        $image_id = $this->uri->segment(2);
        $image = $this->image_model->find($image_id);
        if ($image)
        {
            $this->display($image->path);
        }

    }

    private function display($file_name)
    {
        if (file_exists($file_name))
        {
            $content_type = mime_content_type($file_name);
            header("Content-Type: $content_type");
            echo file_get_contents($file_name);
        }
        else
        {
            echo "No Image Available..";
        }
    }
}