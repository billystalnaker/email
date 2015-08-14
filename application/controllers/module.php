<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Module extends LF_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function users($action = NULL, $id = NULL)
    {
        $action = (!is_null($action)) ? $action : 'view';
        $id = (!is_null($id)) ? $id : 0;
        if ($action === 'edit' && $id <= 0)
        {
//set flashdata sayign you must have id in order to edit
            redirect('module/users/view');
        }
        if (!$this->flexi_auth->is_privileged('Users') || !$this->flexi_auth->is_privileged(ucfirst($action) . ' Users'))
        {
//set flashdata saying you dont have access to this
            if (USER_ID !== $id)
            {
                redirect('home/dashboard');
            }
        }
        $this->load->model('modules');
        $groups = $this->modules->get_groups(true);
        $group_options = array();
        $group_options[''] = 'Please Select...';
        foreach ($groups as $group)
        {
            $group_options[$group['ugrp_id']] = $group['ugrp_name'];
        }
        $this->data['group_options'] = $group_options;
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        switch ($action)
        {
            case 'add':
                $this->modules->insert_user();
                $this->data['content'] = $this->load->view('module/user/add', $this->data, true);
                break;
            case 'edit':
                $this->modules->get_user($id);
                $this->modules->update_user_account($id);
                $this->data['content'] = $this->load->view('module/user/edit', $this->data, true);
                break;
            case 'view':
            default:
                $this->modules->get_states();
                $this->modules->get_users();
                $this->modules->get_manifests();
                $this->modules->update_users();
// Set any returned status/error messages.

                $this->data['content'] = $this->load->view('module/user/view', $this->data, true);
                break;
        }
        $this->load->view('tpl/structure', $this->data);
    }

    public function extras($action = NULL, $id = NULL)
    {
        $action = (!is_null($action)) ? $action : 'view';
        $id = (!is_null($id)) ? $id : 0;
        if ($action === 'edit' && $id <= 0)
        {
//set flashdata sayign you must have id in order to edit
            redirect('module/users/view');
        }
        if (!$this->flexi_auth->is_privileged('Users') || !$this->flexi_auth->is_privileged(ucfirst($action) . ' Users'))
        {
//set flashdata saying you dont have access to this
            if (USER_ID !== $id)
            {
                redirect('home/dashboard');
            }
        }
        $this->load->model('modules');
        $this->modules->get_states();
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        switch ($action)
        {
            case 'add':
                $this->modules->insert_extra();
                $this->data['content'] = $this->load->view('module/extra/add', $this->data, true);
                break;
            case 'edit':
                $this->modules->get_user($id);
                $this->modules->update_user_account_extra($id);
                $this->data['content'] = $this->load->view('module/extra/edit', $this->data, true);
                break;
        }
        $this->load->view('tpl/structure', $this->data);
    }

    public function groups($action = NULL, $id = NULL)
    {
        $action = (!is_null($action)) ? $action : 'view';
        $id = (!is_null($id)) ? $id : 0;
        if ($action === 'edit' && $id <= 0)
        {
//set flashdata sayign you must have id in order to edit
            redirect('module/groups/view');
        }
        if (!$this->flexi_auth->is_privileged('Groups') || !$this->flexi_auth->is_privileged(ucfirst($action) . ' Groups'))
        {
//set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        switch ($action)
        {
            case 'add':
                $this->modules->insert_group();
                $this->data['content'] = $this->load->view('module/group/add', $this->data, true);
                break;
            case 'edit':
                $this->modules->get_group($id);
                $this->modules->update_group($id);
                $this->data['content'] = $this->load->view('module/group/edit', $this->data, true);
                break;
            case 'view':
            default:
                $this->modules->get_groups();
                $this->modules->update_groups();
// Set any returned status/error messages.

                $this->data['content'] = $this->load->view('module/group/view', $this->data, true);
                break;
        }
        $this->load->view('tpl/structure', $this->data);
    }

    public function privileges($action = NULL, $id = NULL)
    {
        $action = (!is_null($action)) ? $action : 'view';
        $id = (!is_null($id)) ? $id : 0;
        if ($action === 'edit' && $id <= 0)
        {
//set flashdata sayign you must have id in order to edit
            redirect('module/privileges/view');
        }
        if (!$this->flexi_auth->is_privileged('Privileges') || !$this->flexi_auth->is_privileged(ucfirst($action) . ' Privileges'))
        {
//set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        switch ($action)
        {
            case 'add':
                $this->modules->insert_privilege();
                $this->data['content'] = $this->load->view('module/privilege/add', $this->data, true);
                break;
            case 'edit':
                $this->modules->get_privilege($id);
                $this->modules->update_privilege($id);
                $this->data['content'] = $this->load->view('module/privilege/edit', $this->data, true);
                break;
            case 'view':
            default:
                $this->modules->get_privileges();
                $this->modules->update_privileges();
// Set any returned status/error messages.

                $this->data['content'] = $this->load->view('module/privilege/view', $this->data, true);
                break;
        }
        $this->load->view('tpl/structure', $this->data);
    }

    public function user_privileges($id = NULL)
    {
        $id = (!is_null($id)) ? $id : 0;
        if ($id <= 0)
        {
//set flashdata sayign you must have id in order to edit
            redirect('module/users/view');
        }
        if (!$this->flexi_auth->is_privileged('User Privileges'))
        {
//set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->modules->update_user_privileges($id);
        $this->data['content'] = $this->load->view('module/user_privilege/edit', $this->data, true);

        $this->load->view('tpl/structure', $this->data);
    }

    public function group_privileges($id = NULL)
    {
        $id = (!is_null($id)) ? $id : 0;
        if ($id <= 0)
        {
//set flashdata sayign you must have id in order to edit
            redirect('module/groups/view');
        }
        if (!$this->flexi_auth->is_privileged('Group Privileges'))
        {
//set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->modules->update_group_privileges($id);
        $this->data['content'] = $this->load->view('module/group_privilege/edit', $this->data, true);

        $this->load->view('tpl/structure', $this->data);
    }

    public function manifest_users($id = NULL)
    {
        $id = (!is_null($id)) ? $id : 0;
        if ($id <= 0)
        {
//set flashdata sayign you must have id in order to edit
            redirect('module/manifests/view');
        }
        if (!$this->flexi_auth->is_privileged('Manifest Users'))
        {
//set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->modules->update_manifest_users($id);
        $this->data['content'] = $this->load->view('module/manifest_user/edit', $this->data, true);

        $this->load->view('tpl/structure', $this->data);
    }

    public function manifests($action = NULL, $id = NULL)
    {
        $action = (!is_null($action)) ? $action : 'view';
        $id = (!is_null($id)) ? $id : 0;
        if ($action === 'edit' && $id <= 0)
        {
//set flashdata sayign you must have id in order to edit
            redirect('module/manifests/view');
        }
        if (!$this->flexi_auth->is_privileged('Manifests') || !$this->flexi_auth->is_privileged(ucfirst($action) . ' Manifests'))
        {
//set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        switch ($action)
        {
            case 'add':
                $this->modules->insert_manifest();
                $this->data['content'] = $this->load->view('module/manifest/add', $this->data, true);
                break;
            case 'edit':
                $this->modules->get_manifest($id);

                if ($this->data['manifest']['admin_id'] == USER_ID)
                {
                    $this->modules->update_manifest($id);
                    $this->data['content'] = $this->load->view('module/manifest/edit', $this->data, true);
                }
                else
                {
                    redirect('module/manifests/view');
                }
                break;
            case 'view':
            default:
                $this->modules->get_manifests();
                $this->modules->update_manifests();
// Set any returned status/error messages.

                $this->data['content'] = $this->load->view('module/manifest/view', $this->data, true);
                break;
        }
        $this->load->view('tpl/structure', $this->data);
    }

    public function states($action = NULL, $id = NULL)
    {
        $action = (!is_null($action)) ? $action : 'view';
        $id = (!is_null($id)) ? $id : 0;
        if ($action === 'edit' && $id <= 0)
        {
//set flashdata sayign you must have id in order to edit
            redirect('module/states/view');
        }
        if (!$this->flexi_auth->is_privileged('States') || !$this->flexi_auth->is_privileged(ucfirst($action) . ' States'))
        {
//set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        switch ($action)
        {
            case 'add':
                $this->modules->insert_state();
                $this->data['content'] = $this->load->view('module/state/add', $this->data, true);
                break;
            case 'edit':
                $this->modules->get_state($id);
                $this->modules->update_state($id);
                $this->data['content'] = $this->load->view('module/state/edit', $this->data, true);
                break;
            case 'view':
            default:
                $this->modules->get_states(false, false);
                $this->modules->update_states();
// Set any returned status/error messages.

                $this->data['content'] = $this->load->view('module/state/view', $this->data, true);
                break;
        }
        $this->load->view('tpl/structure', $this->data);
    }


    public function blast_manifest($manifest_id = NULL)
    {
        $this->load->model('modules');
        $manifest = $this->modules->get_manifest($manifest_id, true);
        if (!$this->flexi_auth->is_privileged('Blast Manifest') || $manifest['admin_id'] !== USER_ID)
        {
            redirect('home/dashboard');
        }
        $this->load->library('email');
        $body = $manifest['content'];
        $link_base = '/module/confirmation/';
        $subject = $manifest['title'];
        $manifest_users = $this->modules->get_manifest_users($manifest_id);
        $this->data['results'] = array();
        foreach ($manifest_users as $manifest_user)
        {
            $user = $this->modules->get_user($manifest_user['user_id'], true);
            $link = '<a href="' . site_url($link_base . '/' . $manifest_user['manifest_user_id']) . '">Click to Confirm you have received.</a>';
            $result = $this->email
                ->from('contact@onandoffagain . com')
//                ->reply_to('yoursecondemail@somedomain . com')// Optional, an account where a human being reads.
                ->to($user['uacc_email'])
                ->subject($subject)
                ->message($body . $link)
                ->send();
            if ($result)
            {
                $this->data['results']['success'][$user['uacc_email']] = $user['uacc_email'];
            }
            else
            {
                $this->data['results']['fail'][$user['uacc_email']] = $this->email->print_debugger();
            }
        }
        $this->modules->change_blast_fields($manifest);
        $this->data['content'] = $this->load->view('module / blast_manifest / results', $this->data, true);

        $this->load->view('tpl / structure', $this->data);
    }

    public function confirmation($manifest_user_id = NULL)
    {
        $this->load->model('modules');
        $manifest_user = $this->modules->get_manifest_user($manifest_user_id);
//        var_dump($manifest_user );
        if (!empty($manifest_user))
        {
            $this->modules->update_manifest_user_confirmation($manifest_user_id, 1);
            $message = 'Confirmation Received. Thank You!';
        }
        else
        {
            $message = 'That record does not exist in our database..';
        }
        $this->data['message'] = $message;
        $this->data['content'] = $this->load->view('module/blast_manifest/confirmation', $this->data, true);

        $this->load->view('tpl/structure', $this->data);
    }

    public function valid_date($input)
    {
        $valid_date = strtotime('2000 - 01 - 01');
        $t_stamp = strtotime($input);
        if ($t_stamp > $valid_date)
        {
            return true;
        }
        $this->form_validation->set_message('valid_date', 'The % s field must be a valid date . ');
        return false;
    }
}
