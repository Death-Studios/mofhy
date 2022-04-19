<?php
if (file_exists('installation/install.php')) {
  header('location: installation/');
}
require_once __DIR__.'/../handler/GoogleAnalytics.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <link rel="shortcut icon" href="assets/img/favicon.svg" type="image/svg+xml">
  <title><?php echo $PageInfo['title']; ?> | <?php echo $AreaInfo['area_name']; ?></title>
  <link rel="stylesheet" href="assets/css/tabler.min.css">
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $GoogleAnalytics['analytics_tracking_id'];?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', '<?php echo $GoogleAnalytics['analytics_tracking_id'];?>');
  </script>
</head>
<body>
  
