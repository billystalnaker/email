<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Api extends LF_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function forgot_password()
    {
        $this->output
            ->set_content_type('application/json');
        $ret = false;
        if ($identifier = $this->input->post('identifier'))
        {
            $ret = $this->flexi_auth->forgotten_password($identifier);
        }

        $this->output
            ->set_output(json_encode($ret));
    }

    public function get_project_tasks()
    {
        $this->load->model('modules');
        $this->output
            ->set_content_type('application/json');
        $ret = false;

        if ($project_id = $this->input->post('project_id'))
        {
            $project_tasks = $this->modules->get_project_tasks($project_id, true);
            foreach ($project_tasks as $project_task)
            {
                $task_id = $project_task['task_id'];
                $task_info = $this->modules->get_task($task_id, true);
//				var_dump($task_id, $task_info);
                $ret[$project_task['id']] = $task_info['name'];
            }
        }
        $return = json_encode($ret);

        $this->output
            ->set_output($return);
    }

    public function start_task()
    {
        $this->load->model('modules');
        $this->output
            ->set_content_type('application/json');
        $ret = false;

        if ($project_task_id = $this->input->post('project_task_id'))
        {
            $data = [];
            $extras['status'] = 'unfinished';
            $extras['order_by'] = "clock_entry.start DESC,project_task.project_id,project_task.task_id,clock_entry.user_id";
            $extras['limit'] = "1";
            $data['user_id'] = USER_ID;
            $results = $this->modules->clock_report($data, $extras);
            if (!$results || empty($results))
            {
                $insert = [];
                $insert['project_task_id'] = $project_task_id;
                $insert['user_id'] = USER_ID;
                $insert['start'] = date('Y-m-d H:i:s');
                $this->db->insert('clock_entry', $insert);

                $ret = ($this->db->affected_rows() == 1) ? $this->db->insert_id() : ['error' => ['Something went wrong...']];
            }
            else
            {
                $ret = [];
                $ret['error'][] = "You are already working on a task, please complete this task and you can start a new one.";
            }
        }
        $return = json_encode($ret);

        $this->output
            ->set_output($return);
    }

    public function stop_task()
    {
        $this->load->model('modules');
        $this->output
            ->set_content_type('application/json');
        $ret = false;

        if ($clock_entry_id = $this->input->post('clock_entry_id'))
        {
            $sql_where = [];
            $sql_where['id'] = $clock_entry_id;
            $sql_where['user_id'] = USER_ID;
            $data = [];
            $data['stop'] = date('Y-m-d H:i:s');
            $this->db->where($sql_where)->update('clock_entry', $data);

            $ret = ($this->db->affected_rows() == 1) ? true : FALSE;
        }
        $return = json_encode($ret);

        $this->output
            ->set_output($return);
    }

    public function get_user_tasks()
    {
        ini_set('display_errors', 1);
        $this->load->model('modules');
//		$this->output
//				->set_content_type('application/json');
        $status = ($this->input->post('status') !== '') ? $this->input->post('status') : 'finished';
        $extras['status'] = $status;
        $extras['order_by'] = "clock_entry.start DESC,project_task.project_id,project_task.task_id,clock_entry.user_id";
        $extras['limit'] = "10";
        $data['user_id'] = USER_ID;
        $results = $this->modules->clock_report($data, $extras);
        $var = [];
        foreach ($results as $result)
        {
            $pj_id = $result['project_task_id'];
            $time = strtotime($result['stop']) - strtotime($result['start']);
            $var[$pj_id][] = [
                'clock_entry_id' => $result['clock_entry_id'],
                'total'          => $time,
                'start'          => $result['start'],
                'stop'           => $result['stop']
            ];
        }
        $tpl_data['results'] = $var;
        switch ($status)
        {
            case"unfinished":
                echo $this->load->view('tpl/result/user_unfinished_tasks', $tpl_data, true);
                break;
            case"finished":
            default:
                echo $this->load->view('tpl/result/user_finished_tasks', $tpl_data, true);
                break;
        }
//		echo $ret;
        die();
//		$return = json_encode($ret);
//
//		$this->output
//				->set_output($return);
    }

    public function add_manifest_users()
    {
        $this->load->model('modules');
        if ($posts = $this->input->post())
        {
            $users = $posts['user_ids'];
            $manifest_id = $posts['manifest_id'];
            foreach ($users as $user_id)
            {
                $this->modules->insert_manifest_user($manifest_id, $user_id);
            }
        }
        echo site_url('/module/manifest_users/' . $manifest_id);
    }
}

?>