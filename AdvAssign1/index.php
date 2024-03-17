<?php
// Class used for processing the API urls and extracting data from it.
require 'ProcessApi.php';
// API url.
$url = 'https://www.innoraft.com/jsonapi/node/services';
// Passing the API url to the class for extracting data from it.
$newProcess = new ProcessApi($url);
$newProcess->process();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advance 1</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <div class="container">
      <!-- div block for each service, displaying the services which are
      displayed using loop.
      Loops through the title array and display each title and its respective
      contents. -->
      <?php for ($i = 0; $i < count($newProcess->title); $i++) { ?>
        <!-- 4 services each of which are shown in alternate left and right directions
        in the browser. Hence adding a class named odd for seperating the alternate
        services. -->
        <div class="services <?php if ($i % 2 == 0)
          echo "odd"; ?>">
          <div class="title">
            <?php echo $newProcess->title[$i]; ?>
            <!-- div block for service icons, each title has multiple icons
            under it. -->
            <div class="icons">
              <?php for ($j = 0; $j < count($newProcess->icons[$i]); $j++) { ?>
                <img class="service-icon"
                  src="<?php echo $newProcess->icons[$i][$j]; ?>" alt="">
              <?php }?>
            </div>
            <!-- div block for description ofeach service. -->
            <div class="services-desc">
              <?php echo $newProcess->desc[$i]; ?>
              <a class="explore"
                href="<?php echo $newProcess->explore[$i]; ?>"><strong>Explore</strong></a>
            </div>
          </div>

          <div class="image">
            <img src="<?php echo $newProcess->main_img[$i] ?>" alt="">
          </div>
        </div>
      <?php }?>
    </div>
  </body>
</html>
