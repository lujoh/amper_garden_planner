<?php
/** Class sends API calls to retrieve frost dates for a given zip code */
require_once '../pwd.php';
class Frost_API_Call {
    const HEADERS_NOAA = ["Token: " . NOAA_TOKEN, "Cache-Control: public, max-age=31536000"];
    const HEADERS_DEFAULT= ["Cache-Control: public, max-age=31536000"];
    const LOCATION_URL = "https://www.ncei.noaa.gov/cdo-web/api/v2/locations?datasetid=NORMAL_ANN&locationcategoryid=ZIP";
    const FIRST = "ANN-TMIN-PRBFST-T32FP50";
    const LAST = "ANN-TMIN-PRBLST-T32FP50";
    private $result_text;
    private $location_lat;
    private $location_lon;
    private $testing; 
    private $closest_station;

    //set testing to true in order to log results
    public function get_frost_dates($zip_code, $testing = false){
        $this->testing = $testing;
        $location_url = $this->create_zip_code_url($zip_code);
        if (!$location_url){
            $this->result_text = "Please enter a 5 digit US zip code or enter your frost dates in the dates section.";
            return false;
        }
        $location_result = $this->send_api_call($location_url, "Nominatim");
        //echo "<br>";
        //var_dump($location_result);
        if (!$location_result){
            $this->result_text = "There was an error processing your zip code. Please enter your frost dates in the bottom form.";
            return false;
        }
        $bounding_box = $this->process_location_result($location_result);
        //echo "<br><br>";
        //var_dump($bounding_box);
        $station_url = $this->create_station_id_url($bounding_box);
        //echo "<br><br>";
        //var_dump($station_url);
        $station_result = $this->send_api_call($station_url, "NOAA");
        //echo "<br><br>";
        //var_dump($station_result);
        if (!$station_result){
            $this->result_text = "There are no available weather stations nearby. Please enter your frost dates in the bottom form.";
            return false;
        }
        $station_id = $this->calculate_nearest_station($station_result);
        $frost_dates_url = $this->create_frost_date_url($station_id);
        $frost_dates_result = $this->send_api_call($frost_dates_url, "NOAA");
        //echo "<br><br>";
        //var_dump($frost_dates_result);
        if (!$frost_dates_result){
            $this->result_text = "There are no available weather stations nearby. Please enter your frost dates in the bottom form.";
            return false;
        }
        $output = $this->calculate_dates($frost_dates_result["results"]);
        return $output;
    }

    public function get_result_message(){
        if ($this->testing){
            file_put_contents("../queries/query_logs/frost_query_log.txt", $this->result_text, FILE_APPEND);
        }
        return $this->result_text;
    }

    //create the URL to get a bounding box and lat/long for a given zip code from Nominatim API
    private function create_zip_code_url($zip_code){
        $pattern = '/^[0-9]{5}$/';
        if (preg_match($pattern, $zip_code)){
            $frost_date_url =  "https://nominatim.openstreetmap.org/?addressdetails=1&postalcode=" . urlencode($zip_code) . "&countrycodes=us&format=json&limit=1";
            return $frost_date_url;
        } else {
            return false;
        }
    }

    //create the URL to get the station ids for a given location from NOAA API
    private function create_station_id_url($bounding_box){
        if (!empty($bounding_box)){
            $boundingbox_text = $bounding_box[0] . "," . $bounding_box[2] . "," . $bounding_box[1] . "," . $bounding_box[3];
            $frost_date_url = "https://www.ncei.noaa.gov/cdo-web/api/v2/stations?datasetid=NORMAL_ANN&datatypeid=ANN-TMIN-PRBFST-T32FP50&datatypeid=ANN-TMIN-PRBLST-T32FP50&extent="  .urlencode($boundingbox_text);
            return $frost_date_url;
        } else {
            return false;
        }
    }

    //create the URL to get the frost dates for a given station id from NOAA API
    private function create_frost_date_url($station_id){
        if (!empty($station_id)){
            $frost_date_url = "https://www.ncei.noaa.gov/cdo-web/api/v2/data?datasetid=NORMAL_ANN&datatypeid=ANN-TMIN-PRBFST-T32FP50&datatypeid=ANN-TMIN-PRBLST-T32FP50&stationid=" . urlencode($station_id) . "&startdate=2010-01-01&enddate=2010-01-01&units=standard&limit=100";
            return $frost_date_url;
        } else {
            return false;
        }
    }

    private function send_api_call($url, $api){
        $request = curl_init($url);
        if ($api == "NOAA"){
            curl_setopt($request, CURLOPT_HTTPHEADER, self::HEADERS_NOAA);
        } else if ($api == "Nominatim"){
            curl_setopt( $request, CURLOPT_USERAGENT, USERAGENT );
            curl_setopt($request, CURLOPT_HTTPHEADER, self::HEADERS_DEFAULT);
        }
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($request);
        curl_close($request);
        if ($this->testing){
            $logtext = "Request URL: " . $url . "\r\n" . $response . "\r\n";
            file_put_contents("../queries/query_logs/frost_query_log.txt", $logtext, FILE_APPEND);
        }     
        if (!empty($response)){
            return json_decode($response, true);
        } else {
            return false;
        }
    }

    //get latitude, longitude and bounding box from Nominatim Response
    private function process_location_result($result){
        $this->location_lat = $result[0]["lat"];
        $this->location_lon = $result[0]["lon"];
        $bounding_box = $result[0]["boundingbox"];
        return $bounding_box;
    }

    // process station results from the first NOAA response and calculate nearest station
    private function calculate_nearest_station($result){
        if ($result["metadata"]["resultset"]["count"] <= 0){
            $this->result_text = "There was an error processing your zip code. Please enter your frost dates in the bottom form.";
            return false;
        }
        $closest_station = "";
        $closest_distance = 0;
        foreach ($result["results"] as $station){
            $station_lat = $station["latitude"];
            $station_lon = $station["longitude"];
            $earth_radius = 6371; //earth radius in kilometers
            //haversine formula: https://en.wikipedia.org/wiki/Haversine_formula
            $distance = 
            2* $earth_radius*asin(sqrt(
                pow(sin(deg2rad($station_lat-$this->location_lat)/2), 2)
                + cos(deg2rad($this->location_lat))
                * cos(deg2rad($station_lat))
                * pow(sin(deg2rad($station_lon-$this->location_lon)/2), 2)
            )); //distance in kilometers
            if ($this->testing){
                $logtext = "Station id: " . $station["id"] . " Calculated distance: " . $distance . "km\r\n";
                file_put_contents("../queries/query_logs/frost_query_log.txt", $logtext, FILE_APPEND);
            }
            //check which station is the closest
            if (empty($closest_station) || $distance < $closest_distance){
                $closest_station = $station["id"];
                $closest_distance = $distance;
                $this->closest_station = $station["name"];
            }
        }
        return $closest_station;
    }

    private function calculate_dates($results){
        $dates = [];
        foreach ($results as $result){
            if ($result['value'] > 0){
                $interval = new DateInterval("P" . floor($result['value']) . "D");
                $date = date_create('2023-01-01');
                date_add($date, $interval);
                $dates[$result['datatype']] = $date;
            } else {
                $this->result_text = "Valid frost dates couldn't be found for your zip code. Your region might be too hot or too cold to have regular frost dates. If this is a mistake please enter your frost dates in the second form. Otherwise you might need to look elsewhere for planting date information.";
                return false;
            }
        }
        if (empty($dates[self::FIRST]) || empty($dates[self::LAST])){
            $this->result_text = "There was an error processing your zip code. Please enter your frost dates in the bottom form.";
            return false;
        }     
        $output['first'] = date_format($dates[self::FIRST], 'j-n-y');
        $output['last'] = date_format($dates[self::LAST], 'j-n-y');
        if ($this->testing){
            $logtext = json_encode($output) . "\r\n";
            file_put_contents("../queries/query_logs/frost_query_log.txt", $logtext, FILE_APPEND);
        }
        $this->result_text = "Your submission was successful. Your nearest weather station is: " . $this->closest_station . " and the frost dates for your area are " . DateTime::createFromFormat('j-n-y', $output['last'])->format('M jS') . " and " . DateTime::createFromFormat('j-n-y', $output['first'])->format('M jS') . ".";
        return $output;
    }
}
?>