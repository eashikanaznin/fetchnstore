<?php

namespace Drupal\job_builder\Utils;

use Drupal\Component\Serialization\Json;

/**
 * URL to of the api.
 */
define('API_URL', "https://api.apprenticeships.education.gov.uk/vacancies/vacancy?_format=json&DistanceInMiles=40&Lat=51.49962&Lon=-0.13573&Sort=DistanceAsc");

class CurlGenerator {
    /**
     * Initiates cURL request
     *
     * @return json array
     * Returns an array if there is an response
     * Returns null if the data is empty
     * */
    public static function curlFunction($api_key,$url) {
        //fetch the total number of record first;
        // then fetch all records if server permits

        $curl = curl_init();
        curl_setopt_array(
            $curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "host: api.apprenticeships.education.gov.uk",
            "ocp-apim-subscription-key: ".$api_key,
            "x-version: 1"
            ),
            )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            \Drupal::messenger()->addMessage("cURL Error #:".$err);
            return false;
        } else {
            return $response;
        }
    }

    /**
     * Executes cURL request
     *
     * @return json array
     * Returns the response from the API
     * */
    public static function curlreq() {

        //fetching the API key
        // from the key module
        $api_key=\Drupal::service('key.repository')->getKey('displayadvartapi')->getKeyValue();

        //calling first time to get the total number of records;
        // then fetching the records
        $res= self::curlFunction($api_key, API_URL);

        if ($res) {

            $res=Json::decode($res);
            $item_total=$res['totalFiltered'];

            //second call with the item number
            $res= self::curlFunction($api_key, $url.'&PageSize='.$item_total);
            return $res;
        }
    }

}
