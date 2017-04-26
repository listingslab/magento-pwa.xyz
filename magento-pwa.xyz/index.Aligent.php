<?php
    include 'AligentIncludes/aligent.config.php';
    $pageTitle = $ALI->siteTitle . ' ' . $ALI->version;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php print $pageTitle; ?></title>
</head>
<body>

    <div id="app">
        <link rel = "stylesheet" type = "text/css" href = "AligentIncludes/style.css" />
        <?php include 'AligentIncludes/nav.php'; ?>
        <h1><?php print $pageTitle; ?></h1>
        <p>
            <strong>Requirements</strong>
            <ul>
                <li>
                    Apache 2
                </li>
                <li>
                    <a href="AligentIncludes/phpinfo.php" target="_blank">PHP Version 5.4.16 </a>
                </li>
            </ul>
        </p>
        <script type="text/javascript" src="AligentIncludes/script.js"></script>
    </div>

</body>
</html>