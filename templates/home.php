<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Is nick fired?</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="static/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/cover.css">
    </head>
    <body>
        <div class="site-wrapper">
            <div class="site-wrapper-inner">
                <div class="cover-container">
                    <div class="inner cover">
                        <h1 class="cover-heading">Status: <?php echo $this->data->status['Status']; ?></h1>
                        <?php if($this->data->status['Status_code'] == 1) { ?>
                            <p class="lead">Fired by: <?php echo $this->data->status['Name'] ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
