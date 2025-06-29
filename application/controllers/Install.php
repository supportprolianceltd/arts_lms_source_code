<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

     ini_set('max_execution_time', 0);
     ini_set('memory_limit','2048M');

class Install extends CI_Controller {

  public function index() {
    if ($this->router->default_controller == 'install') {
      redirect(site_url('install/step0'), 'refresh');
    }
    redirect(site_url('login'), 'refresh');
  }

  function step0() {
    if ($this->router->default_controller != 'install') {
      redirect(site_url('login'), 'refresh');
    }
    $page_data['page_name'] = 'step0';
    $this->load->view('install/index', $page_data);
  }

  function step1() {
    if ($this->router->default_controller != 'install') {
      redirect(site_url('login'), 'refresh');
    }
    $page_data['page_name'] = 'step1';
    $this->load->view('install/index', $page_data);
  }

  function step2($param1 = '', $param2 = '') {
    if ($this->router->default_controller != 'install') {
      redirect(site_url('login'), 'refresh');
    }
    if ($param1 == 'error') {
      $page_data['error'] = 'Verification Failed';
    }
    $page_data['page_name'] = 'step2';
    $this->load->view('install/index', $page_data);
  }

  function step3($param1 = '', $param2 = '') {
    if ($this->router->default_controller != 'install') {
      redirect(site_url('login'), 'refresh');
    }

    if ($param1 == 'error_con_fail') {
      $page_data['error_con_fail'] = 'Error establishing a database conenction using your provided information. Please
      recheck hostname, username, password and try again with correct information';
    }
    if ($param1 == 'error_nodb') {
      $page_data['error_con_fail'] = 'The database you are trying to use for the application does not exist. Please create
      the database first';
    }
    if ($param1 == 'configure_database') {
      $hostname = $this->input->post('hostname');
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $dbname   = $this->input->post('dbname');
      // check db connection using the above credentials
      $db_connection = $this->check_database_connection($hostname, $username, $password, $dbname);
      if ($db_connection == 'failed') {
        redirect(site_url('install/step3/error_con_fail'), 'refresh');
      } else if ($db_connection == 'db_not_exist') {
        redirect(site_url('install/step3/error_nodb'), 'refresh');
      } else {
        // proceed to step 4
        session_start();
        $_SESSION['hostname'] = $hostname;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['dbname']   = $dbname;
        redirect(site_url('install/step4'), 'refresh');
      }
    }
    $page_data['page_name'] = 'step3';
    $this->load->view('install/index', $page_data);
  }

  function check_database_connection($hostname, $username, $password, $dbname) {
    $link = mysqli_connect($hostname, $username, $password, $dbname);
		if (!(bool)$link) {
		  mysqli_close($link);
		  return 'failed';
		}
		$db_selected = mysqli_select_db($link, $dbname);
		if (!$db_selected) {
		  mysqli_close($link);
		  return "db_not_exist";
		}
		mysqli_close($link);
		return 'success';
  }

  function step4($param1 = '') {
    if ($this->router->default_controller != 'install') {
      redirect(site_url('login'), 'refresh');
    }
    if ($param1 == 'confirm_install') {
      // write database.php
      $this->configure_database();

      // run sql
      $this->run_blank_sql();

      // redirect to admin creation page
      redirect(site_url('install/finalizing_setup'), 'refresh');
    }

    $page_data['page_name'] = 'step4';
    $this->load->view('install/index', $page_data);
  }

  function configure_database() {
    // write database.php
    $data_db = file_get_contents('./application/config/database.php');
    session_start();
    $data_db = str_replace('db_name',	$_SESSION['dbname'],	$data_db);
    $data_db = str_replace('db_user',	$_SESSION['username'],	$data_db);
    $data_db = str_replace('db_pass',	$_SESSION['password'],	$data_db);
    $data_db = str_replace('db_host',	$_SESSION['hostname'],	$data_db);
    file_put_contents('./application/config/database.php', $data_db);
  }

  function run_blank_sql() {
    $this->load->database();
    // Set line to collect lines that wrap
    $templine = '';
    // Read in entire file
    $lines = file('./uploads/install.sql');
    // Loop through each line
    foreach ($lines as $line) {
      // Skip it if it's a comment
      if (substr($line, 0, 2) == '--' || $line == '')
        continue;
      // Add this line to the current templine we are creating
      $templine .= $line;
      // If it has a semicolon at the end, it's the end of the query so can process this templine
      if (substr(trim($line), -1, 1) == ';') {
        // Perform the query
        $this->db->query($templine);
        // Reset temp variable to empty
        $templine = '';
      }
    }
  }

  function finalizing_setup($param1 = '', $param2 = '') {
    if ($this->router->default_controller != 'install') {
      redirect(site_url('login'), 'refresh');
    }
    if ($param1 == 'setup_admin') {
     // $admin_data['unique_identifier'] = '1j7hdmsw8d';
      $admin_data['first_name']       = html_escape($this->input->post('first_name'));
      $admin_data['last_name']       = html_escape($this->input->post('last_name'));
      $admin_data['email']      = html_escape($this->input->post('email'));
      $admin_data['password']   = sha1($this->input->post('password'));
      $social_links = array(
          'facebook' => "",
          'twitter'  => "",
          'linkedin' => ""
      );
      $admin_data['social_links']   = json_encode($social_links);
      $admin_data['role_id']   = 1;
      $admin_data['status']    = 1;
      $admin_data['is_instructor']    = 1;
      $this->load->database();
      $this->db->insert('users', $admin_data);

      $data['value']  = $this->input->post('system_name');
      $this->db->where('key', 'system_name');
      $this->db->update('settings', $data);

      redirect(site_url('install/success'), 'refresh');
    }

    $page_data['page_name'] = 'finalizing_setup';
    $this->load->view('install/index', $page_data);
  }

  function success($param1 = '') {
    if ($this->router->default_controller != 'install') {
      redirect(site_url('login'), 'refresh');
    }
    if ($param1 == 'login') {
      $this->configure_routes();
      redirect(site_url('login'), 'refresh');
    }

    $this->load->database();
    $admin_email = $this->db->get_where('users', array('id' => 1))->row()->email;

    session_start();
    if (isset($_SESSION['purchase_code'])) {
      $data['value']  = $_SESSION['purchase_code'];
      $this->db->where('key', 'purchase_code');
      $this->db->update('settings', $data);
    }
    session_destroy();

    $page_data['admin_email'] = $admin_email;
    $page_data['page_name'] = 'success';
    $this->load->view('install/index', $page_data);
  }

  function configure_routes() {
    // write routes.php
    $data_routes = file_get_contents('./application/config/routes.php');
    $data_routes = str_replace('install',	'home',	$data_routes);
    file_put_contents('./application/config/routes.php', $data_routes);
  }

}
