<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
        $clantag = "<CLANTAG>";

        $token = "<APITOKEN>";

        $url = "https://api.clashofclans.com/v1/clans/" . urlencode($clantag);

        $ch = curl_init($url);

        $headr = array();
        $headr[] = "Accept: application/json";
        $headr[] = "Authorization: Bearer ".$token;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);
        $data = json_decode($res, true);
        curl_close($ch);

        if (isset($data["reason"])) {
        $errormsg = true;
        }

        $members = $data["memberList"];

        ?>
    <title><?php echo $data["name"]; ?></title>
</head>
<body>

</body>
</html>