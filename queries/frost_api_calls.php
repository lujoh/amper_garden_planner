<?php
/** Class sends API calls to retrieve frost dates for a given zip code */
require_once '../pwd.php';
class Frost_API_Call {
    const HEADERS = ["Token: " . NOAA_TOKEN];
    const LOCATION_URL = "https://www.ncei.noaa.gov/cdo-web/api/v2/locations?datasetid=NORMAL_ANN&locationcategoryid=ZIP";
    const FIRST = "ANN-TMIN-PRBFST-T32FP50";
    const LAST = "ANN-TMIN-PRBLST-T32FP50";
    private $error_text;

    public function get_frost_dates($zip_code){
        $url = $this->create_frost_date_url($zip_code);
        if (!$url){
            $this->error_text = "Please enter a 5 digit US zip code or enter your frost dates in the dates section.";
            return false;
        }
        $result = $this->send_api_call($url);
        $result = json_decode($result, true);
        if (!$result){
            $this->error_text = "There was an error processing your zip code. Please enter your frost dates in the bottom form.";
            return false;
        }
        $output = $this->calculate_dates($result["results"]);
        return $output;
    }

    public function get_error_message(){
        return $this->error_text;
    }

    private function create_frost_date_url($zip_code){
        $pattern = '/^[0-9]{5}$/';
        if (preg_match($pattern, $zip_code)){
            $frost_date_url = "https://www.ncei.noaa.gov/cdo-web/api/v2/data?datasetid=NORMAL_ANN&datatypeid=ANN-TMIN-PRBFST-T32FP50&datatypeid=ANN-TMIN-PRBLST-T32FP50&locationid=ZIP:" . urlencode($zip_code) . "&startdate=2010-01-01&enddate=2010-01-01&units=standard&limit=100";
            return $frost_date_url;
        } else {
            return false;
        }
    }

    private function send_api_call($url){
        $request = curl_init($url);
        curl_setopt($request, CURLOPT_HTTPHEADER, self::HEADERS);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($request);
        curl_close($request);
        if (!empty($response)){
            return $response;
        } else {
            return false;
        }
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
                $this->error_text = "Valid frost dates couldn't be found for your zip code. Your region might be too hot or too cold to have regular frost dates. If this is a mistake please enter your frost dates in the second form. Otherwise you might need to look elsewhere for planting date information.";
                return false;
            }
        }
        if (empty($dates[self::FIRST]) || empty($dates[self::LAST])){
            $this->error_text = "There was an error processing your zip code. Please enter your frost dates in the bottom form.";
            return false;
        }
        $output['first'] = date_format($dates[self::FIRST], 'j-n-y');
        $output['last'] = date_format($dates[self::LAST], 'j-n-y');
        return $output;
    }
}
?>