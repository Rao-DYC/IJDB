<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/jokes.css">
    <!-- <link rel="stylesheet" href="css/attriCSS.css"> -->
    <!-- <link rel="stylesheet" href="css/marx.css"> -->


    <!-- <link rel="stylesheet" href="https://unpkg.com/mvp.css"> -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/awsm.css/dist/awsm.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->


    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css"> -->
    <title><?php if (isset($title)) echo $title; ?></title>
</head>

<body>
    <?php include __DIR__ . '/../templates/nav.html.php'; ?>
    <main>
        <?php if (isset($output)) echo $output; ?>
    </main>
    <?php include __DIR__ . '/../templates/footer.html.php'; ?>
</body>

</html>