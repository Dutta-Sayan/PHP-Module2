<?php

require_once "vendor/autoload.php";
use GuzzleHttp\Client;

/**
 * Takes the api url as input.
 *
 * The variables are string type arrays which store the different values
 * regarding the services.
 *
 * @param string $title
 *  $title stores the title of each service.
 * @param string $main_img
 *  $main_img and $icons store the image and icons of each service respectively.
 * @param string $desc
 *  Stores the description of each service.
 * @param string $explore
 *  Stores the explore links for each service.
 */
class ProcessApi
{
  // Stores the domain to concatenate at the first of the relative image links.
  private const domain = "https://www.innoraft.com";
  // Stores the API url.
  public string $url;
  // Stores the Client object.
  public $client;
  // Array to store the titles of services.
  public $title = [];
  // Array to store the images of services.
  public $main_img = [];
  // Array to store the icons of each service.
  public $icons = [];
  // Array to store the description of each service.
  public $desc = [];
  // Array to store the explore links of each service.
  public $explore = [];

  /**
   * Initialises the main api url passed.
   * Creates a new Client() object.
   *
   * @param string $url
   *  The API url is passed.
   *
   * @return object
   *  Object of ProcessApi class
   */
  public function __construct(string $url) {
    $this->url = $url;
    $this->client = new Client();
  }

  /**
   * Takes the api url as input and returns the PHP array which was encoded in json format.
   * @param string $url
   *
   * @return array
   */
  public function fetchData(string $url) {
    // Stores the response from API url as json data.
    $response = $this->client->request("GET", $url);
    // Converts the json data into PHP array.
    return json_decode($response->getBody(), TRUE);
  }

  /**
   * Processes the api values and extracts the required values.
   * Stores the values in the corresponding arrays.
   * The value of title, image path, description, icon path and explore links are fetched.
   */
  public function process() {
    // Stores the returned decoded json data as array.
    $result = $this->fetchData($this->url);

    // The services data is contained in the data values 12 to 15 of the API data.
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
      foreach ($dataRelationsData['data'] as $iconData) {
        $iconDataApi = $iconData['relationships']['field_media_image']['links']['related']['href'];
        $iconDataResult = $this->fetchData($iconDataApi);
        $icon = $iconDataResult['data']['attributes']['uri']['url'];
        array_push($iconArr, "domain.$icon");
      }

      // The first service values is present at the last location of 'data' field.
      // Hence checking if the 'data' field is at last value,then pushing the corresponding
      // equired values at the first of the array.
      if ($i == 15) {
        // Accessing and storing the titles.
        array_unshift($this->title, $dataAttr['field_secondary_title']['value']);
        // Storing the description lists.
        array_unshift($this->desc, $fieldService);
        // Storing Explore more links.
        array_unshift($this->explore, "domain.$exploreLink");
        // Storing the main images.
        array_unshift($this->main_img, "domain.$img");
        // Storing the icons
        array_unshift($this->icons, $iconArr);
      }

      // Storing the others services values in array as it is, serially.
      // The first service values arestores at the 0th index of the arrays.
      else {
        array_push($this->title, $dataAttr['field_secondary_title']['value']);
        array_push($this->desc, $fieldService);
        array_push($this->explore, "domain.$exploreLink");
        array_push($this->main_img, "domain.$img");
        array_push($this->icons, $iconArr);
      }
    }
  }
}
?>
