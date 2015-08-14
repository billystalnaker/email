<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Modules extends LF_Model
{
// The following method prevents an error occurring when $this->data is modified.
// Error Message: 'Indirect modification of overloaded property Demo_cart_admin_model::$data has no effect'.
    public function &__get($key)
    {
        $CI = &get_instance();
        return $CI->$key;
    }
###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
// User Accounts
###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
    /**
     * get_user_accounts
     * Gets a paginated list of users that can be filtered via the user search form, filtering by the users email and first and last names.
     */
    function get_users($return = false)
    {
// Select user data to be displayed.
        $sql_select = array(
            $this->flexi_auth->db_column('user_acc', 'id'),
            $this->flexi_auth->db_column('user_acc', 'email'),
            $this->flexi_auth->db_column('user_acc', 'username'),
            $this->flexi_auth->db_column('user_group', 'name'),
            $this->flexi_auth->db_column('user_group', 'id'),
            'upro_first_name',
            'upro_last_name',
            'upro_headshot_image_id',
            'upro_body_image_id',
            'upro_address_line1',
            'upro_address_line2',
            'upro_city',
            'upro_state_id',
            'upro_race',
            'upro_height',
            'upro_weight',
            'upro_shoe_size',
            'upro_shirt_size',
            'upro_jacket_size',
            'upro_pant_size',
            'upro_pet',
        );
        $sql_where = false;
        if (!$this->flexi_auth->is_admin())
        {
            $sql_where = [$this->flexi_auth->db_column('user_acc', 'id') . " !=" => $this->auth->auth_settings['admin_user']];
        }
        $this->flexi_auth->sql_select($sql_select);
        $ret = $this->flexi_auth->get_user_array(FALSE, $sql_where);
        if ($return)
        {
            return $ret;
        }
        $this->data['users'] = $ret;
    }

    function get_user($user_id, $return = false)
    {
        $filters[$this->flexi_auth->db_column('user_acc', 'id')] = $user_id;

        $ret = array_shift($this->flexi_auth->get_users_query(FALSE, $filters)->result_array());
        if ($return)
        {
            return $ret;
        }
        $this->data['user'] = $ret;
    }

    /**
     * update_user_account
     * Updates the account and profile data of a specific user.
     * Note: The user profile table ('demo_user_profiles') is used in this demo as an example of relating additional user data to the auth libraries account tables.
     */
    function update_user_account($user_id)
    {
        $this->load->library('form_validation');

// Set validation rules.

        $validation_rules = array(
            array(
                'field' => 'update_user_first_name',
                'label' => 'First Name',
                'rules' => 'required'),
            array(
                'field' => 'update_user_last_name',
                'label' => 'Last Name',
                'rules' => 'required'),
            array(
                'field' => 'update_user_email',
                'label' => 'Email Address',
                'rules' => 'required|valid_email'),
        );
        if ($this->flexi_auth->is_privileged('Edit Groups'))
        {
            $validation_rules[] = array(
                'field' => 'update_user_group_id',
                'label' => 'User Group',
                'rules' => 'required|integer');
        }

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run())
        {
// 'Update User Account' form data is valid.
// IMPORTANT NOTE: As we are updating multiple tables (The main user account and user profile tables), it is very important to pass the
// primary key column and value in the $profile_data for any custom user tables being updated, otherwise, the function will not
// be able to identify the correct custom data row.
// In this example, the primary key column and value is 'upro_id' => $user_id.
            $profile_data = array(
                'upro_first_name'                                 => $this->input->post('update_user_first_name'),
                'upro_last_name'                                  => $this->input->post('update_user_last_name'),
                $this->flexi_auth->db_column('user_acc', 'email') => $this->input->post('update_user_email'),
            );
            if ($this->flexi_auth->is_privileged('Edit Groups'))
            {
                $profile_data[$this->flexi_auth->db_column('user_acc', 'group_id')] = $this->input->post('update_user_group_id');
            }


// If we were only updating profile data (i.e. no email, username or group included), we could use the 'update_custom_user_data()' function instead.
            $this->flexi_auth->update_user($user_id, $profile_data);

// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect('module/users/view');
        }

        return FALSE;
    }

    /**
     * update_user_account_extra
     * Updates the account and profile data of a specific user.
     * Note: The user profile table ('demo_user_profiles') is used in this demo as an example of relating additional user data to the auth libraries account tables.
     */
    function update_user_account_extra($user_id)
    {
        $this->load->library('form_validation');

// Set validation rules.

        $validation_rules = array(
            array(
                'field' => 'update_user_first_name',
                'label' => 'First Name',
                'rules' => 'required'),
            array(
                'field' => 'update_user_last_name',
                'label' => 'Last Name',
                'rules' => 'required'),
            array(
                'field' => 'update_user_email',
                'label' => 'Email',
                'rules' => 'required|valid_email'),
            array(
                'field' => 'update_user_city',
                'label' => 'City',
                'rules' => 'required'),
            array(
                'field' => 'update_user_state_id',
                'label' => 'State',
                'rules' => 'required|integer'),
            array(
                'field' => 'update_user_address_line1',
                'label' => 'Address Line 1',
                'rules' => ''),
            array(
                'field' => 'update_user_address_line2',
                'label' => 'Address Line 2',
                'rules' => ''),
            array(
                'field' => 'update_user_race',
                'label' => 'Race',
                'rules' => ''),
            array(
                'field' => 'update_user_height',
                'label' => 'Height',
                'rules' => ''),
            array(
                'field' => 'update_user_weight',
                'label' => 'Weight',
                'rules' => ''),
            array(
                'field' => 'update_user_shoe_size',
                'label' => 'Shoe Size',
                'rules' => ''),
            array(
                'field' => 'update_user_shirt_size',
                'label' => 'Shirt Size',
                'rules' => ''),
            array(
                'field' => 'update_user_jacket_size',
                'label' => 'Jacket Size',
                'rules' => ''),
            array(
                'field' => 'update_user_pant_size',
                'label' => 'Pant Size',
                'rules' => ''),
            array(
                'field' => 'update_user_pet',
                'label' => 'Pet',
                'rules' => ''),
        );

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run())
        {
// 'Update User Account' form data is valid.
// IMPORTANT NOTE: As we are updating multiple tables (The main user account and user profile tables), it is very important to pass the
// primary key column and value in the $profile_data for any custom user tables being updated, otherwise, the function will not
// be able to identify the correct custom data row.
// In this example, the primary key column and value is 'upro_id' => $user_id.

            $this->load->model('image_model');
            $headshot_image = $_FILES['headshot_image'];
            $upro_headshot_image_id = 0;
            if ($headshot_image['error'] == 0)
            {
                $hf = new stdClass();
                $hf->file_name = $headshot_image['name'];
                $hf->file_path = $headshot_image['tmp_name'];
                $upro_headshot_image_id = $this->image_model->create_image($hf);
            }
            $body_image = $_FILES['body_image'];
            $upro_body_image_id = 0;
            if ($body_image['error'] == 0)
            {
                $bf = new stdClass();
                $bf->file_name = $body_image['name'];
                $bf->file_path = $body_image['tmp_name'];
                $upro_body_image_id = $this->image_model->create_image($bf);
            }
            $profile_data = array(
                'upro_first_name'                                 => $this->input->post('update_user_first_name'),
                'upro_last_name'                                  => $this->input->post('update_user_last_name'),
                $this->flexi_auth->db_column('user_acc', 'email') => $this->input->post('update_user_email'),
                'upro_address_line1'                              => $this->input->post('update_user_address_line1'),
                'upro_address_line2'                              => $this->input->post('update_user_address_line2'),
                'upro_city'                                       => $this->input->post('update_user_city'),
                'upro_race'                                       => $this->input->post('update_user_race'),
                'upro_state_id'                                      => $this->input->post('update_user_state_id'),
                'upro_weight'                                     => $this->input->post('update_user_weight'),
                'upro_height'                                     => $this->input->post('update_user_height'),
                'upro_shoe_size'                                  => $this->input->post('update_user_shoe_size'),
                'upro_shirt_size'                                 => $this->input->post('update_user_shirt_size'),
                'upro_jacket_size'                                => $this->input->post('update_user_jacket_size'),
                'upro_pant_size'                                  => $this->input->post('update_user_pant_size'),
                'upro_pet'                                        => $this->input->post('update_user_pet'),
            );
            if ($upro_headshot_image_id > 0)
            {
                $profile_data['upro_headshot_image_id'] = $upro_headshot_image_id;
            }

            if ($upro_body_image_id > 0)
            {
                $profile_data['upro_body_image_id'] = $upro_body_image_id;
            }
// If we were only updating profile data (i.e. no email, username or group included), we could use the 'update_custom_user_data()' function instead.
            $this->flexi_auth->update_user($user_id, $profile_data);
// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect('module/users/view');
        }

        return FALSE;
    }

    /**
     * delete_users
     * Delete all user accounts that have not been activated X days since they were registered.
     */
    function delete_users($inactive_days)
    {
// Deleted accounts that have never been activated.
        $this->flexi_auth->delete_unactivated_users($inactive_days);

// Save any public or admin status or error messages to CI's flash session data.
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
        redirect('auth_admin/manage_user_accounts');
    }

    /**
     * update_user_accounts
     * The function loops through all POST data checking the 'Suspend' and 'Delete' checkboxes that have been checked, and updates/deletes the user accounts accordingly.
     */
    function update_users()
    {
// If user has privileges, delete users.
        if ($this->input->post())
        {
            if ($this->flexi_auth->is_privileged('Delete Users'))
            {
                if ($delete_users = $this->input->post('delete_user'))
                {
                    foreach ($delete_users as $user_id => $delete)
                    {
// Note: As the 'delete_user' input is a checkbox, it will only be present in the $_POST data if it has been checked,
// therefore we don't need to check the submitted value.
                        $this->flexi_auth->delete_user($user_id);
                    }
                }
            }

// Update User Suspension Status.
// Suspending a user prevents them from logging into their account.
            if ($user_status = $this->input->post('suspend_status'))
            {
// Get current statuses to check if submitted status has changed.
                $current_status = $this->input->post('current_status');

                foreach ($user_status as $user_id => $status)
                {
                    if ($current_status[$user_id] != $status)
                    {
                        if ($status == 1)
                        {
                            $this->flexi_auth->update_user($user_id, array(
                                $this->flexi_auth->db_column('user_acc', 'suspend') => 1));
                        }
                        else
                        {
                            $this->flexi_auth->update_user($user_id, array(
                                $this->flexi_auth->db_column('user_acc', 'suspend') => 0));
                        }
                    }
                }
            }

// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect('module/users/view');
        }
    }

    /**
     * insert_user
     * Inserts a new user .
     */
    function insert_user()
    {
        $this->load->library('form_validation');

// Set validation rules.
        $validation_rules = array(
            array(
                'field' => 'insert_user_user_name',
                'label' => 'User Name',
                'rules' => 'required'),
            array(
                'field' => 'insert_user_user_name',
                'label' => 'User Name',
                'rules' => 'is_unique[user_accounts.uacc_username]'),
            array(
                'field' => 'insert_user_first_name',
                'label' => 'First Name',
                'rules' => 'required'),
            array(
                'field' => 'insert_user_last_name',
                'label' => 'Last Name',
                'rules' => 'required'),
            array(
                'field' => 'insert_user_email',
                'label' => 'Email',
                'rules' => 'required|valid_email'),
            array(
                'field' => 'insert_user_group_id',
                'label' => 'Group ID',
                'rules' => 'integer|required'),
            array(
                'field' => 'insert_user_password',
                'label' => 'Password',
                'rules' => 'required'),
            array(
                'field' => 'insert_user_password_confirmation',
                'label' => 'Password Confirmation',
                'rules' => 'matches[insert_user_password]')
        );
        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run())
        {
// Get user group data from input.
            $user_name = $this->input->post('insert_user_user_name');
            $user_email = $this->input->post('insert_user_email');
            $password = $this->input->post('insert_user_password');
            $user_first_name = $this->input->post('insert_user_first_name');
            $user_last_name = $this->input->post('insert_user_last_name');
            $user_group_id = $this->input->post('insert_user_group_id');
            $user_data = array(
                'upro_first_name'      => $user_first_name,
                'upro_last_name'       => $user_last_name,
                'upro_date_registered' => date('Y-m-d H:i:s'),
            );
            if ($this->flexi_auth->insert_user($user_email, $user_name, $password, $user_data, $user_group_id, true))
            {
// Redirect user.
                redirect('module/users/view');
            }
// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        }
    }

    function insert_extra()
    {
        $this->load->library('form_validation');

// Set validation rules.
        $validation_rules = array(
            array(
                'field' => 'insert_user_user_name',
                'label' => 'User Name',
                'rules' => 'required'),
            array(
                'field' => 'insert_user_user_name',
                'label' => 'User Name',
                'rules' => 'is_unique[user_accounts.uacc_username]'),
            array(
                'field' => 'insert_user_first_name',
                'label' => 'First Name',
                'rules' => 'required'),
            array(
                'field' => 'insert_user_last_name',
                'label' => 'Last Name',
                'rules' => 'required'),
            array(
                'field' => 'insert_user_email',
                'label' => 'Email',
                'rules' => 'required|valid_email'),
            array(
                'field' => 'insert_user_password',
                'label' => 'Password',
                'rules' => 'required'),
            array(
                'field' => 'insert_user_password_confirmation',
                'label' => 'Password Confirmation',
                'rules' => 'matches[insert_user_password]'),
            array(
                'field' => 'insert_user_city',
                'label' => 'City',
                'rules' => 'required'),
            array(
                'field' => 'insert_user_state_id',
                'label' => 'State',
                'rules' => 'required|integer'),
            array(
                'field' => 'insert_user_address_line1',
                'label' => 'Address Line 1',
                'rules' => ''),
            array(
                'field' => 'insert_user_address_line2',
                'label' => 'Address Line 2',
                'rules' => ''),
            array(
                'field' => 'insert_user_race',
                'label' => 'Race',
                'rules' => ''),
            array(
                'field' => 'insert_user_height',
                'label' => 'Height',
                'rules' => ''),
            array(
                'field' => 'insert_user_weight',
                'label' => 'Weight',
                'rules' => ''),
            array(
                'field' => 'insert_user_shoe_size',
                'label' => 'Shoe Size',
                'rules' => ''),
            array(
                'field' => 'insert_user_shirt_size',
                'label' => 'Shirt Size',
                'rules' => ''),
            array(
                'field' => 'insert_user_jacket_size',
                'label' => 'Jacket Size',
                'rules' => ''),
            array(
                'field' => 'insert_user_pant_size',
                'label' => 'Pant Size',
                'rules' => ''),
            array(
                'field' => 'insert_user_pet',
                'label' => 'Pet',
                'rules' => ''),
        );
        $this->form_validation->set_rules($validation_rules);
        if (!empty($_FILES))
        {
            $this->load->model('image_model');
            $headshot_image = $_FILES['headshot_image'];
            if ($headshot_image['error'] > 0)
            {
                $this->form_validation->set_rules('headshot_image', 'Head Shot Image', 'required');
            }
            $hf = new stdClass();
            $hf->file_name = $headshot_image['name'];
            $hf->file_path = $headshot_image['tmp_name'];
            $body_image = $_FILES['body_image'];
            if ($body_image['error'] > 0)
            {
                $this->form_validation->set_rules('body_image', 'Body Image', 'required');
            }
            $bf = new stdClass();
            $bf->file_name = $body_image['name'];
            $bf->file_path = $body_image['tmp_name'];
        }
        if ($this->form_validation->run())
        {
// Get user group data from input.
            $user_name = $this->input->post('insert_user_user_name');
            $user_email = $this->input->post('insert_user_email');
            $password = $this->input->post('insert_user_password');
            $user_first_name = $this->input->post('insert_user_first_name');
            $user_last_name = $this->input->post('insert_user_last_name');
            $user_address_line1 = $this->input->post('insert_user_address_line1');
            $user_address_line2 = $this->input->post('insert_user_address_line2');
            $user_race = $this->input->post('insert_user_race');
            $user_city = $this->input->post('insert_user_city');
            $user_state = $this->input->post('insert_user_state_id');
            $weight = $this->input->post('insert_user_weight');
            $height = $this->input->post('insert_user_height');
            $shoe_size = $this->input->post('insert_user_shoe_size');
            $shirt_size = $this->input->post('insert_user_shirt_size');
            $jacket_size = $this->input->post('insert_user_jacket_size');
            $pant_size = $this->input->post('insert_user_pant_size');
            $pet = $this->input->post('insert_user_pet');
            $upro_body_image_id = $this->image_model->create_image($bf);
            $upro_headshot_image_id = $this->image_model->create_image($hf);
            $user_data = array(
                'upro_first_name'        => $user_first_name,
                'upro_last_name'         => $user_last_name,
                'upro_address_line1'     => $user_address_line1,
                'upro_address_line2'     => $user_address_line2,
                'upro_city'              => $user_city,
                'upro_race'              => $user_race,
                'upro_state_id'             => $user_state,
                'upro_weight'            => $weight,
                'upro_height'            => $height,
                'upro_shoe_size'         => $shoe_size,
                'upro_shirt_size'        => $shirt_size,
                'upro_jacket_size'       => $jacket_size,
                'upro_pant_size'         => $pant_size,
                'upro_pet'               => $pet,
                'upro_headshot_image_id' => $upro_headshot_image_id,
                'upro_body_image_id'     => $upro_body_image_id,
            );
            if ($this->flexi_auth->insert_user($user_email, $user_name, $password, $user_data, 2, true))
            {
// Redirect user.
                redirect('module/users/view');
            }
// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        }
    }

    function get_groups($return = false)
    {
// Select user data to be displayed.
        $sql_select = array(
            $this->flexi_auth->db_column('user_group', 'id'),
            $this->flexi_auth->db_column('user_group', 'name'),
            $this->flexi_auth->db_column('user_group', 'description'),
        );
        $sql_where = false;
        if (!$this->flexi_auth->is_admin())
        {
            $sql_where = [$this->flexi_auth->db_column('user_group', 'id') . " !=" => $this->auth->auth_settings['admin_group']];
        }
        $this->flexi_auth->sql_select($sql_select);
        $groups = $this->flexi_auth->get_user_group_array(FALSE, $sql_where);
        if ($return)
        {
            return $groups;
        }
        $this->data['groups'] = $groups;
    }

    function get_privileges($return = false)
    {
// Select user data to be displayed.
        $sql_select = array(
            $this->flexi_auth->db_column('user_privilege', 'id'),
            $this->flexi_auth->db_column('user_privilege', 'name'),
            $this->flexi_auth->db_column('user_privilege', 'description'),
        );
        if (!$this->flexi_auth->is_admin())
        {
            $this->flexi_auth->sql_where('upriv_id !=', 5);
            $this->flexi_auth->sql_where('upriv_id !=', 6);
            $this->flexi_auth->sql_where('upriv_id !=', 8);
            $this->flexi_auth->sql_where('upriv_id !=', 12);
            $this->flexi_auth->sql_where('upriv_id !=', 17);
        }
        $this->flexi_auth->sql_select($sql_select);
        $privileges = $this->flexi_auth->get_privilege_array();
        if ($return)
        {
            return $privileges;
        }
        $this->data['privileges'] = $privileges;
    }

    function get_manifests($return = false)
    {
// Select user data to be displayed.
        $sql_select = array('id', 'title', 'content', 'date_of_last_blast', 'admin_id', 'date_of_show');
        $ret = $this->db->select($sql_select)->where('admin_id', USER_ID)->get('manifest')->result_array();
        if ($return)
        {
            return $ret;
        }
        $this->data['manifests'] = $ret;
    }

    public function get_states($return = false, $for_select = true)
    {

// Select user data to be displayed.
        $sql_select = array('id', 'abbreviation', 'name');
        $ret = $this->db->select($sql_select)->get('states')->result_array();
        if ($for_select)
        {
            $states = array();
            foreach ($ret as $state)
            {
                $states[$state['id']] = $state['name'];
            }
            $ret = $states;
        }
        if ($return)
        {
            return $ret;
        }
        $this->data['states'] = $ret;
    }

    function get_group($group_id)
    {
        $filters = array(
            $this->flexi_auth->db_column('user_group', 'id') => $group_id);
        $this->data['group'] = array_shift($this->flexi_auth->get_user_group_array(FALSE, $filters));
    }

    function get_privilege($privilege_id)
    {
        $filters = array(
            $this->flexi_auth->db_column('user_privileges', 'id') => $privilege_id);
        $this->data['privilege'] = array_shift($this->flexi_auth->get_privilege_array(FALSE, $filters));
    }

    function get_manifest($manifest_id, $return = false)
    {
        $filters = array('id' => $manifest_id);
        $ret = array_shift($this->db->where($filters)->get('manifest')->result_array());
        if ($return)
        {
            return $ret;
        }
        $this->data['manifest'] = $ret;
    }

    /**
     * update_user_group
     * Updates a specific user group.
     */
    function update_group($group_id)
    {
        $this->load->library('form_validation');

// Set validation rules.
        $validation_rules = array(
            array(
                'field' => 'update_group_name',
                'label' => 'Group Name',
                'rules' => 'required'),
        );

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run())
        {
// Get user group data from input.
            $data = array(
                $this->flexi_auth->db_column('user_group', 'name')        => $this->input->post('update_group_name'),
                $this->flexi_auth->db_column('user_group', 'description') => $this->input->post('update_group_desc'),
            );

            $this->flexi_auth->update_group($group_id, $data);

// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect('module/groups/view');
        }
    }

    /**
     * update_privilege
     * Updates a specific privilege.
     */
    function update_privilege($privilege_id)
    {
        $this->load->library('form_validation');

// Set validation rules.
        $validation_rules = array(
            array(
                'field' => 'update_privilege_name',
                'label' => 'Privilege Name',
                'rules' => 'required')
        );

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run())
        {
// Get privilege data from input.
            $data = array(
                $this->flexi_auth->db_column('user_privileges', 'name')        => $this->input->post('update_privilege_name'),
                $this->flexi_auth->db_column('user_privileges', 'description') => $this->input->post('update_privilege_desc')
            );

            $this->flexi_auth->update_privilege($privilege_id, $data);

// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect('module/privileges/view');
        }
    }

    function update_manifest($manifest_id, $ajax = false)
    {
        $manifest = $this->get_manifest($manifest_id, true);
        if ($manifest['admin_id'] == USER_ID)
        {
            $this->load->library('form_validation');

// Set validation rules.
            $validation_rules = array(
                array(
                    'field' => 'update_manifest_title',
                    'label' => 'Title',
                    'rules' => 'required'),
                array(
                    'field' => 'update_manifest_content',
                    'label' => 'Content',
                    'rules' => 'required'),
                array(
                    'field' => 'update_manifest_date_of_show',
                    'label' => 'Date of Show',
                    'rules' => ''),
            );

            $this->form_validation->set_rules($validation_rules);

            if ($this->form_validation->run())
            {
// Get st_light data from input.
                $data = array();
                $data['title'] = $this->input->post('update_manifest_title');
                $data['content'] = $this->input->post('update_manifest_content');
                $data['date_of_show'] = date('Y-m-d H:i:s', strtotime($this->input->post('update_manifest_date_of_show')));

                $sql_where = array('id' => $manifest_id);
                $this->db->update('manifest', $data, $sql_where);

                if ($this->db->affected_rows() == 1)
                {
                    $this->flexi_auth_model->set_status_message('update_successful', 'config');
                }
                else
                {
                    $this->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
                }
// Save any public or admin status or error messages to CI's flash session data.
                $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
                if (!$ajax)
                {
// Redirect user.
                    redirect('module/manifests/view');
                }
            }
        }
        else
        {
            $this->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
        }
    }

    /**
     * update_user_privileges
     * Updates the privileges for a specific user.
     */
    function update_user_privileges($user_id)
    {
// If 'Update User Privilege' form has been submitted, update the user privileges.
        if ($this->input->post('update_user_privilege'))
        {
// Update privileges.
            foreach ($this->input->post('update') as $row)
            {
                if ($row['current_status'] != $row['new_status'])
                {
// Insert new user privilege.
                    if ($row['new_status'] == 1)
                    {
                        $this->flexi_auth->insert_privilege_user($user_id, $row['id']);
                    }
// Delete existing user privilege.
                    else
                    {
                        $sql_where = array(
                            $this->flexi_auth->db_column('user_privilege_users', 'user_id')      => $user_id,
                            $this->flexi_auth->db_column('user_privilege_users', 'privilege_id') => $row['id']
                        );

                        $this->flexi_auth->delete_privilege_user($sql_where);
                    }
                }
            }
// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect("module/user_privileges/$user_id");
        }
// Get users profile data.
        $sql_select = array(
            'upro_first_name',
            'upro_last_name',
            $this->flexi_auth->db_column('user_acc', 'group_id'),
            $this->flexi_auth->db_column('user_group', 'name')
        );
        $sql_where = array(
            $this->flexi_auth->db_column('user_acc', 'id') => $user_id);
        $this->data['user'] = $this->flexi_auth->get_users_row_array($sql_select, $sql_where);

// Get all privilege data.
        $this->data['privileges'] = $this->get_privileges(true);
// Get user groups current privilege data.
        $sql_select = array(
            $this->flexi_auth->db_column('user_privilege_groups', 'privilege_id'));
        $sql_where = array(
            $this->flexi_auth->db_column('user_privilege_groups', 'group_id') => $this->data['user'][$this->flexi_auth->db_column('user_acc', 'group_id')]);
        $group_privileges = $this->flexi_auth->get_user_group_privileges_array($sql_select, $sql_where);
        $this->data['group_privileges'] = array();
        foreach ($group_privileges as $privilege)
        {
            $this->data['group_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_groups', 'privilege_id')];
        }

// Get users current privilege data.
        $sql_select = array(
            $this->flexi_auth->db_column('user_privilege_users', 'privilege_id'));
        $sql_where = array(
            $this->flexi_auth->db_column('user_privilege_users', 'user_id') => $user_id);
        $user_privileges = $this->flexi_auth->get_user_privileges_array($sql_select, $sql_where);

// For the purposes of the example demo view, create an array of ids for all the users assigned privileges.
// The array can then be used within the view to check whether the user has a specific privilege, this data allows us to then format form input values accordingly.
        $this->data['user_privileges'] = array();
        foreach ($user_privileges as $privilege)
        {
            $this->data['user_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_users', 'privilege_id')];
        }

// Set any returned status/error messages.
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
    }

    /**
     * update_group_privileges
     * Updates the privileges for a specific user group.
     */
    function update_group_privileges($group_id)
    {
// Update privileges.

        if ($this->input->post('update_group_privilege'))
        {
            foreach ($this->input->post('update') as $row)
            {
                if ($row['current_status'] != $row['new_status'])
                {
// Insert new user privilege.
                    if ($row['new_status'] == 1)
                    {
                        $this->flexi_auth->insert_user_group_privilege($group_id, $row['id']);
                    }
// Delete existing user privilege.
                    else
                    {
                        $sql_where = array(
                            $this->flexi_auth->db_column('user_privilege_groups', 'group_id')     => $group_id,
                            $this->flexi_auth->db_column('user_privilege_groups', 'privilege_id') => $row['id']
                        );
                        $this->flexi_auth->delete_user_group_privilege($sql_where);
                    }
                }
            }

// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect("module/group_privileges/$group_id");
        }

// Get data for the current user group.
        $sql_where = array(
            $this->flexi_auth->db_column('user_group', 'id') => $group_id);
        $this->data['group'] = $this->flexi_auth->get_groups_row_array(FALSE, $sql_where);

// Get all privilege data
        $this->data['privileges'] = $this->get_privileges(true);

// Get data for the current privilege group.
        $sql_select = array(
            $this->flexi_auth->db_column('user_privilege_groups', 'privilege_id'));
        $sql_where = array(
            $this->flexi_auth->db_column('user_privilege_groups', 'group_id') => $group_id);
        $group_privileges = $this->flexi_auth->get_user_group_privileges_array($sql_select, $sql_where);

// For the purposes of the example demo view, create an array of ids for all the privileges that have been assigned to a privilege group.
// The array can then be used within the view to check whether the group has a specific privilege, this data allows us to then format form input values accordingly.
        $this->data['group_privileges'] = array();
        foreach ($group_privileges as $privilege)
        {
            $this->data['group_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_groups', 'privilege_id')];
        }

// Set any returned status/error messages.
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
    }

    /**
     * update_manifest_users
     * Updates the privileges for a specific user group.
     */
    function update_manifest_users($manifest_id)
    {
// Update privileges.

        if ($this->input->post('update_manifest_user'))
        {
            foreach ($this->input->post('update') as $row)
            {
                if ($row['current_status'] != $row['new_status'])
                {
// Insert new user privilege.
                    if ($row['new_status'] == 1)
                    {
                        $this->insert_manifest_user($manifest_id, $row['id']);
                    }
// Delete existing user privilege.
                    else
                    {
                        $this->delete_manifest_user($manifest_id, $row['id']);
                    }
                }
            }

// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect("module/manifest_users/$manifest_id");
        }

// Get data for the current user group.
        $this->get_manifest($manifest_id);
        $this->data['extras'] = $this->get_extras(true);
        $manifest_users = $this->get_manifest_users($manifest_id);
//var_dump($manifest_users);
// For the purposes of the example demo view, create an array of ids for all the privileges that have been assigned to a privilege group.
// The array can then be used within the view to check whether the group has a specific privilege, this data allows us to then format form input values accordingly.
        $this->data['manifest_users'] = array();
        $this->data['manifest_users_raw'] = array();//used to find the confirmed field
        foreach ($manifest_users as $manifest_user)
        {
            $this->data['manifest_users_raw'][$manifest_user['id']] = $manifest_user;
            $this->data['manifest_users'][$manifest_user['id']] = $manifest_user['user_id'];
        }

// Set any returned status/error messages.
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
    }
###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
// User Groups
###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
    /**
     * manage_user_groups
     * The function loops through all POST data checking the 'Delete' checkboxes that have been checked, and deletes the associated user groups.
     */
    function update_groups()
    {
// Delete groups.
        if ($this->flexi_auth->is_privileged('Delete Groups'))
        {
            if ($delete_groups = $this->input->post('delete_group'))
            {
                foreach ($delete_groups as $group_id => $delete)
                {
// Note: As the 'delete_group' input is a checkbox, it will only be present in the $_POST data if it has been checked,
// therefore we don't need to check the submitted value.
                    $this->flexi_auth->delete_group($group_id);
                }
// Save any public or admin status or error messages to CI's flash session data.
                $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
                redirect('auth_admin/manage_user_groups');
            }
        }
    }

    /**
     * manage_privileges
     * The function loops through all POST data checking the 'Delete' checkboxes that have been checked, and deletes the associated privileges.
     */
    function update_privileges()
    {
// Delete privileges.
        if ($delete_privileges = $this->input->post('delete_privilege'))
        {
            foreach ($delete_privileges as $privilege_id => $delete)
            {
// Note: As the 'delete_privilege' input is a checkbox, it will only be present in the $_POST data if it has been checked,
// therefore we don't need to check the submitted value.
                $this->flexi_auth->delete_privilege($privilege_id);
            }


// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect('module/privileges/view');
        }
    }

    function update_manifests()
    {
// Delete st_lights.
        if ($this->flexi_auth->is_privileged('Delete Manifests'))
        {
            if ($delete_manifests = $this->input->post('delete_manifest'))
            {
                foreach ($delete_manifests as $manifest_id => $delete)
                {
// Note: As the 'delete_privilege' input is a checkbox, it will only be present in the $_POST data if it has been checked,
// therefore we don't need to check the submitted value.
                    $sql_where = array('id' => $manifest_id);
// Delete privileges.
                    $this->db->delete('manifest', $sql_where);
                }
// Save any public or admin status or error messages to CI's flash session data.
                $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
                redirect('module/manifests/view');
            }
        }
    }

    /**
     * insert_user_group
     * Inserts a new user group.
     */
    function insert_group()
    {
        $this->load->library('form_validation');

// Set validation rules.
        $validation_rules = array(
            array(
                'field' => 'insert_group_name',
                'label' => 'Group Name',
                'rules' => 'required'),
        );

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run())
        {
// Get user group data from input.
            $group_name = $this->input->post('insert_group_name');
            $group_desc = $this->input->post('insert_group_desc');

            $this->flexi_auth->insert_group($group_name, $group_desc, 0);

// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect('module/groups/view');
        }
    }

    /**
     * insert_privilege
     * Inserts a new privilege.
     */
    function insert_privilege()
    {
        $this->load->library('form_validation');

// Set validation rules.
        $validation_rules = array(
            array(
                'field' => 'insert_privilege_name',
                'label' => 'Privilege Name',
                'rules' => 'required')
        );

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run())
        {
// Get privilege data from input.
            $privilege_name = $this->input->post('insert_privilege_name');
            $privilege_desc = $this->input->post('insert_privilege_desc');

            $this->flexi_auth->insert_privilege($privilege_name, $privilege_desc);

// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            redirect('module/privileges/view');
        }
    }

    function insert_manifest($ajax = false)
    {
        $this->load->library('form_validation');

// Set validation rules.
        $validation_rules = array(
            array(
                'field' => 'insert_manifest_title',
                'label' => 'Title',
                'rules' => 'required'),
            array(
                'field' => 'insert_manifest_content',
                'label' => 'Content',
                'rules' => 'required'),
            array(
                'field' => 'insert_manifest_date_of_show',
                'label' => 'Date of Show',
                'rules' => '')
        );

        $this->form_validation->set_rules($validation_rules);
        $ret = false;
        if ($this->form_validation->run())
        {
// Get st_light data from input.

            $data = array();
            $data['title'] = $this->input->post('insert_manifest_title');
            $data['content'] = $this->input->post('insert_manifest_content');
            $data['date_of_show'] = date('Y-m-d H:i:s', strtotime($this->input->post('insert_manifest_date_of_show')));
            $data['admin_id'] = USER_ID;
            $this->db->insert('manifest', $data);

            $ret = ($this->db->affected_rows() == 1) ? $this->db->insert_id() : FALSE;
            if ($ret)
            {
                $this->flexi_auth_model->set_status_message('update_successful', 'config');
            }
            else
            {
                $this->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
            }

// Save any public or admin status or error messages to CI's flash session data.
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
            if ($ajax)
            {
                return $ret;
            }
            redirect('module/manifests/view');
        }
    }

    public function insert_manifest_user($manifest_id, $user_id)
    {
        $data = array();
        $data['manifest_id'] = $manifest_id;
        $data['user_id'] = $user_id;
        $query = $this->db->insert_string('manifest_users', $data);
        $query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $query);
        $this->db->query($query);
    }

    public function delete_manifest_user($manifest_id, $user_id)
    {
        $data = array();
        $data['manifest_id'] = $manifest_id;
        $data['user_id'] = $user_id;
        $this->db->delete('manifest_users', $data);
    }

    public function get_extras()
    {
        //get users of extra group
        return $this->flexi_auth->get_users_query(false, array('uacc_group_fk' => 2))->result_array();
    }

    public function get_manifest_users($manifest_id)
    {
        $where = array('manifest_id' => $manifest_id);
        return $this->db->select()->where($where)->get('manifest_users')->result_array();
    }

    public function get_manifest_user($manifest_user_id)
    {
        $where = array('id' => $manifest_user_id);
        $records = $this->db->select()->where($where)->get('manifest_users')->result_array();
        $return = array();
        if (!empty($records))
        {
            $return = array_shift($records);
        }
        return $return;
    }

    public function change_blast_fields($manifest)
    {
        $data = array();
        $data['date_of_last_blast'] = date('Y-m-d H:i:s');
        $data['content_of_last_blast'] = $manifest['content'];

        $sql_where = array('id' => $manifest['id']);
        $this->db->update('manifest', $data, $sql_where);

    }

    public function make_select($what, $table, $filters = array())
    {
        $cfg = $this->config->item('controller_table_conversion');
        $function = 'get_' . $cfg[$table]['controller'];
        if (is_array($filters) && count($filters) > 0)
        {
            foreach ($filters as $db_function => $filter)
            {
                $this->db->$db_function($filter);
            }
        }
        if ($function == 'get_defect_types')
        {//ugh i hate this but i will need to re-vamp crap
            $results = $this->$function(0, true);
        }
        else
        {
            $results = $this->$function(true);
        }
        if (is_array($results) && count($results) > 0)
        {
            $options[''] = 'Please Select...';
            foreach ($results as $result)
            {
                $options[$result[$cfg[$what]['view_vars']['select'][0]['value']]] = $result[$cfg[$what]['view_vars']['select'][0]['display']];
            }
            $this->data[$cfg[$what]['view_vars']['select'][0]['data_key']] = $options;
            return true;
        }
        return false;
    }

    public function update_manifest_user_confirmation($manifest_user_id, $value)
    {
        $data = array();
        $data['confirmed'] = intval($value);
        $sql_where = array('id' => $manifest_user_id);
        $this->db->update('manifest_users', $data, $sql_where);
    }
}

/* End of file demo_auth_admin_model.php */
/* Location: ./application/models/demo_auth_admin_model.php */