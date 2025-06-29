<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Updater extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        date_default_timezone_set(get_settings('timezone'));
        
        $this->load->database();
        $this->load->library('session');

        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        // CHECK CUSTOM SESSION DATA
    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(site_url('admin/dashboard'), 'refresh');
    }

    /***** UPDATE PRODUCT *****/

    function update($task = '', $purchase_code = '')
    {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        // Create update directory.
        $dir = 'update';
        if (!is_dir($dir))
            mkdir($dir, 0777, true);

        $zipped_file_name = $_FILES["file_name"]["name"];
        $path = 'update/' . $zipped_file_name;

        if (class_exists('ZipArchive')) {
            move_uploaded_file($_FILES["file_name"]["tmp_name"], $path);
            // Unzip uploaded update file and remove zip file.
            $zip = new ZipArchive;
            $res = $zip->open($path);
            $zip->extractTo('update');
            $zip->close();
            unlink($path);
        }else{
            $this->session->set_flashdata('error_message', get_phrase('your_server_is_unable_to_extract_the_zip_file').'. '.get_phrase('please_enable_the_zip_extension_on_your_server').', '.get_phrase('then_try_again'));
            redirect(site_url('admin/system_settings'), 'refresh');
        }

        $unzipped_file_name = substr($zipped_file_name, 0, -4);
        
        // Run common php modifications if needed
        require './update/' . $unzipped_file_name . '/common_script.php';

        $str = file_get_contents('./update/' . $unzipped_file_name . '/update_config.json');
        $json = json_decode($str, true);

        if (strval($json['require_version']) != strval(get_settings('version'))){
            $this->session->set_flashdata('error_message', get_phrase('it_looks_like_you_are_skipping_a_version').'. '.get_phrase('please_update_version').' '.$json['require_version'].' '.get_phrase('first'));
            redirect(site_url('admin/system_settings'), 'refresh');
        }
           

        // Create new directories.
        if (!empty($json['directory'])) {
            foreach ($json['directory'] as $directory) {
                if (!is_dir($directory['name']))
                    mkdir($directory['name'], 0777, true);
            }
        }

        // Create/Replace new files.
        if (!empty($json['files'])) {
            foreach ($json['files'] as $file)
                copy($file['root_directory'], $file['update_directory']);
        }

        // CREATE OR REPLACE NEW LIBRARIES
        if (!empty($json['libraries'])) {
            foreach ($json['libraries'] as $libraries){
                copy($libraries['root_directory'], $libraries['update_directory']);

                //Unzip zip file and remove zip file.
                $library_path = $libraries['update_directory'];

                // PATH OF EXTRACTING LIBRARY FILE
                $library_path_array = explode('/', $library_path);
                array_pop($library_path_array);
                $extract_to = implode('/', $library_path_array);
                $library_zip = new ZipArchive;
                $library_result = $library_zip->open($library_path);
                $library_zip->extractTo($extract_to);
                $library_zip->close();
                unlink($library_path);
            }
        }

        // Run php modifications
        require './update/' . $unzipped_file_name . '/update_script.php';

        $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        redirect(site_url('admin/system_settings'));
    }

}
