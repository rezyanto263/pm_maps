<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Gmaps extends CI_Controller {

    public function index()
    {
        $location = array(
            array(
                "nama" => "Lokasi A",
                "lat" => -8.671071,
                "long" => 115.229885
            ),
            array(
                "nama" => "Lokasi B",
                "lat" => -8.672089,
                "long" => 115.219063
            ),
            array(
                "nama" => "Lokasi C",
                "lat" => -8.671071,
                "long" => 115.243283
            ),
            array(
                "nama" => "Lokasi D",
                "lat" => -8.660040, 
                "long" => 115.226277
            ),
            array(
                "nama" => "Lokasi E",
                "lat" => -8.710198, 
                "long" => 115.188086
            ),
        );
    }

}

/* End of file Gmaps.php */

?>