<?php
/**
 * Created by PhpStorm.
 * User: bstalnaker
 * Date: 7/29/2015
 * Time: 11:30 PM
 */
if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class image_model extends LF_Model
{
    public function __construct()
    {
    }

    public function create_image($file)
    {
        $data = array();
        $this->fit_image_file_to_width($file->file_path, 400);
        move_uploaded_file($file->file_path, IMGPATH . $file->file_name);
        $data['path'] = IMGPATH . $file->file_name;
        //path,image_id
        $this->db->insert('image', $data);

        $ret = ($this->db->affected_rows() == 1) ? $this->db->insert_id() : FALSE;
        return $ret;
    }

    private function fit_image_file_to_width($file, $w)
    {
        list($width, $height) = getimagesize($file);
        $newwidth = $w;
        $newheight = $w * $height / $width;

        $mime = mime_content_type($file);
        switch ($mime)
        {
            case 'image/jpeg':
            case 'image/jpg':
                $src = imagecreatefromjpeg($file);
                break;
            case 'image/png';
                $src = imagecreatefrompng($file);
                break;
            case 'image/bmp';
                $src = imagecreatefromwbmp($file);
                break;
            case 'image/gif';
                $src = imagecreatefromgif($file);
                break;
        }

        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        switch ($mime)
        {
            case 'image/jpeg':
                imagejpeg($dst, $file);
                break;
            case 'image/png';
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
                imagepng($dst, $file);
                break;
            case 'image/bmp';
                imagewbmp($dst, $file);
                break;
            case 'image/gif';
                imagegif($dst, $file);
                break;
        }

        imagedestroy($dst);
    }

    public function find($image_id)
    {
        $return = false;
        if ($image_id > 0)
        {
            $this->db->where('id', intval($image_id));
            $results = $this->db->get('image');
            $results = $results->result();
            if (is_array($results) && !empty($results))
            {
                $return = array_shift($results);
            }
        }
        return $return;
    }
}