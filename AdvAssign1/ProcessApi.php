<?php

require_once "vendor/autoload.php";
use GuzzleHttp\Client;
class ProcessApi {

    private string $domain = "https://www.innoraft.com";
    public string $url;
    public $client;
    public $title = [];
    public $main_img = [];
    public $icons = [];
    public $desc = [];
    public $explore = [];

    /**
     * Initialises the main api url passed.
     * Creates a new Client() object.
     * 
     * @param string $url
     * 
     * @return object of ProcessApi class
     * 
     */
    public function __construct(string $url) {
        $this->url = $url;
        $this->client = new Client();
    }

    /**
     * Takes the api url as input and returns the PHP array which was encoded in json format.
     * 
     * @param string $url
     * 
     * @return array 
     * 
     */
    public function fetchData($url) {
        $response = $this->client->request("GET", $url);
        return json_decode($response->getBody(), true);
    } 

    /**
     * Processes the api values and extracts the required values.
     * Stores the values in the corresponding arrays.
     * The value of title, image path, description, icon path and explore links are fetched.
     * 
     */
    public function process() {
        $result = $this->fetchData($this->url);

        for ($i = 12; $i <= 15; $i++) {
            $dataAttr = $result['data'][$i]['attributes'];
            $dataRelations = $result['data'][$i]['relationships'];
            // Accessing the description lists.
            $fieldService = $dataAttr['field_services']['value'];
            // Accessing the explore links.
            $exploreLink = $dataAttr['path']['alias'];

            // Acessing the main images.
            $imgResponseResult = $this->fetchData($dataRelations['field_image']['links']['related']['href']);
            $img = $imgResponseResult['data']['attributes']['uri']['url'];
            // Accessing the icons.
            $dataRelationsData = $this->fetchData($dataRelations['field_service_icon']['links']['related']['href']);
            
            // Array to temporarily store icons of each service.
            $iconArr = [];
            // Accessing icons for a single service.
            foreach ($dataRelationsData['data'] as $iconData){
                $iconDataApi = $iconData['relationships']['field_media_image']['links']['related']['href'];
                $iconDataResult = $this->fetchData($iconDataApi);
                $icon = $iconDataResult['data']['attributes']['uri']['url'];
                array_push($iconArr, "$this->domain.$icon");
            }

            /**
             * The first service values is present at the last location of 'data' field.
             * Hence checking if the 'data' field is at last value,then pushing the corresponding
             * required values at the first of the array.
             * 
             */
            if($i==15)
            {
                // Accessing and storing the titles.
                array_unshift($this->title, $dataAttr['field_secondary_title']['value']);
                // Storing the description lists.
                array_unshift($this->desc, $fieldService);
                // Storing Explore more links.
                array_unshift($this->explore, "$this->domain.$exploreLink");
                // Storing the main images.
                array_unshift($this->main_img, "$this->domain.$img");
                // Storing the icons
                array_unshift($this->icons, $iconArr);
            }
            else
            {
                array_push($this->title, $dataAttr['field_secondary_title']['value']);
                array_push($this->desc, $fieldService);
                array_push($this->explore, "$this->domain.$exploreLink");
                array_push($this->main_img, "$this->domain.$img");
                array_push($this->icons, $iconArr);
            }
        }
    }
}
?>