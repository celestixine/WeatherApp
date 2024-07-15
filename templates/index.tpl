<!DOCTYPE html>
<html lang="DE-de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Sat, 01 Jan 2000 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="Access-Control-Allow-Origin" content="{$APP_URL}" />
    <title>{$APP_NAME}</title>
    <link rel="stylesheet" type="text/css" href="{$APP_URL}/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="{$APP_URL}/public/css/app.css" />
    <script src="{$APP_URL}/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{$APP_URL}/vendor/components/jquery/jquery.min.js"></script>
    <script src="{$APP_URL}/public/js/app.js"></script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="col-3">
                <a class="navbar-brand" href="{$APP_URL}">
                    <img src="/images/frog.png" alt="Logo WeatherFrog" id="logo" /> WeatherFrog
                </a>
            </div>
            <div class="col-6"></div>
            <div class="collapse navbar-collapse col-3">
                <div class="navbar-nav me-auto mb-2 mb-lg-0"></div>
            </div>
        </div>
    </nav>

    <div id="main-container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1>Wärmster und kältester Tag des letzten Jahres</h1>
                <form id="get-location" onsubmit="return false;">
                    <label for="location">Gib einen Ort ein:</label>
                    <input class="form-control" type="text" id="location" onkeyup="Weather.getLocation(this.value);" />
                    <div id="suggestions" class="d-none"></div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-xl-6" id="hottest-day">
                        <div>
                            <div class="temperature"></div>
                            <div class="date"></div>
                            <div class="text"></div>
                        </div>
                    </div>
                    <div class="col-xl-6" id="coldest-day">
                        <div>
                            <div class="temperature"></div>
                            <div class="date"></div>
                            <div class="text"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

</body>
</html>
