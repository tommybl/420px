<!DOCTYPE html>
<html lang="en">

<head>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=749545525092512";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="420px is a photo community for discovering and sharing inspiring photography">
    <meta name="author" content="Tommy Lopes">

    <title>420px - Insipring photograhy</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">

    <!-- DataTables CSS -->
    <link href="bower/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <link rel="alternate" type="application/rss+xml" title="420px global rss feed" href="./feeds/rss-xml.php" />
    <?php if (isset($user_to_show)) echo '<link rel="alternate" type="application/rss+xml" title="420px global rss feed" href="./feeds/rss-xml.php?usr='.$user_to_show->id.'" />'; ?>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <!-- Placez cette balise dans l'en-tête ou juste avant la balise de fermeture du corps de texte. -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
