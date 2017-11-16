<?php
/**
* Controllers Upload library
* Last update 4 Jan 2017
* 
* @package upload
* @copyright AirTrippy
* @author contact@panpic.vn
* @author pos: PHP Developer
* @since 4 Jan 2017
*/

abstract class SlimStatus {
    const Failure = 'failure';
    const Success = 'success';
}

class Slim_library {
    
    var $CI = ''; 
    
    function __construct()
    {
        $this->CI = & get_instance();
    }

    public static function getImages($inputName = 'slim') {

        $values = Slim_library::getPostData($inputName);

        // test for errors
        if ($values === false) {
            return false;
        }

        // determine if contains multiple input values, if is singular, put in array
        $data = array();
        if (!is_array($values)) {
            $values = array($values);
        }

        // handle all posted fields
        foreach ($values as $value) {
            $inputValue = Slim_library::parseInput($value);
            if ($inputValue) {
                array_push($data, $inputValue);
            }
        }

        // return the data collected from the fields
        return $data;

    }

    // $value should be in JSON format
    private static function parseInput($value) {

        // if no json received, exit, don't handle empty input values.
        if (empty($value)) {return null;}

        // The data is posted as a JSON String so to be used it needs to be deserialized first
        $data = json_decode($value);

        // shortcut
        $input = null;
        $actions = null;
        $output = null;
        $meta = null;

        if (isset ($data->input)) {
            $inputData = isset($data->input->image) ? Slim_library::getBase64Data($data->input->image) : null;
            $input = array(
                'data' => $inputData,
                'name' => $data->input->name,
                'type' => $data->input->type,
                'size' => $data->input->size,
                'width' => $data->input->width,
                'height' => $data->input->height,
            );
        }

        if (isset($data->output)) {
            $outputData = isset($data->output->image) ? Slim_library::getBase64Data($data->output->image) : null;
            $output = array(
                'data' => $outputData,
                'width' => $data->output->width,
                'height' => $data->output->height,
                'name' => $data->input->name
            );
        }

        if (isset($data->actions)) {
            $actions = array(
                'crop' => $data->actions->crop ? array(
                    'x' => $data->actions->crop->x,
                    'y' => $data->actions->crop->y,
                    'width' => $data->actions->crop->width,
                    'height' => $data->actions->crop->height,
                    'type' => $data->actions->crop->type
                ) : null,
                'size' => $data->actions->size ? array(
                    'width' => $data->actions->size->width,
                    'height' => $data->actions->size->height
                ) : null
            );
        }

        if (isset($data->meta)) {
            $meta = $data->meta;
        }

        // We've sanitized the base64data and will now return the clean file object
        return array(
            'input' => $input,
            'output' => $output,
            'actions' => $actions,
            'meta' => $meta
        );
    }

    /*
     * 
     *  $path should have trailing slash
     */
    public static function saveFile($data, $name, $path = 'tmp/', $uid = true) {
        
        $prefex = date("ymd-his");
        
        if (substr($path, -1) !== '/') {
            $path .= '/';
        }
        
        // Test if directory already exists
        /*
        if(!is_dir($path)){
            mkdir($path, 0755);
        }
        */

        if ($uid) {
            $name = $prefex.'-'.$name; // uniqid().'-'.$name;
        }
        
        $path = $path . $name;

        // store the file
        Slim_library::save($data, $path);

        return array('name' => $name,'path' => $path);
    }

    public static function outputJSON($status, $fileName = null, $filePath = null) {

        header('Content-Type: application/json');

        if ($status !== SlimStatus::Success) {
            echo json_encode(array('status' => $status));
            return;
        }

        echo json_encode(
            array(
                'status' => $status,
                'name' => $fileName,
                'path' => $filePath
            )
        );
    }
    
    /**
     * Gets the posted data from the POST or FILES object. If was using Slim to upload it will be in POST (as posted with hidden field) if not enhanced with Slim it'll be in FILES.
     * @param $inputName
     * @return array|bool
     */
    private static function getPostData($inputName) {

        $values = array();

        if (isset($_POST[$inputName])) {
            $values = $_POST[$inputName];
        }
        else if (isset($_FILES[$inputName])) {
            // Slim was not used to upload this file
            return false;
        }

        return $values;
    }

    /**
     * Saves the data to a given location
     * @param $data
     * @param $path
     */
    private static function save($data, $path) {
        file_put_contents($path, $data);
    }

    /**
     * Strips the "data:image..." part of the base64 data string so PHP can save the string as a file
     * @param $data
     * @return string
     */
    private static function getBase64Data($data) {
        return base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
    }
    
    
    /**
     * get only Image Name
     * 
     * @param string $old_img | /2017/1/file.jpg
     * @return string | file.jpg
     */
    public function oldImageName($old_img) {
        if($old_img == '') return;
        
        $arr = explode('/', $old_img);
        return $arr[sizeof($arr)-1];
    }
    

}