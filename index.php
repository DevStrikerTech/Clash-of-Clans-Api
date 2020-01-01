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
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <?php
    if (isset($errormsg)) {
        echo "<p>", "Failed: ", $data["reason"], " : ", isset($data["message"]) ? $data["message"] : "", "</p></body></html>";
        exit;
    }
    ?>
    <table border="1">
        <tr>
            <td rowspan="11">Clan level : <?php echo $data["clanLevel"]; ?><br/><img src="<?php echo $data["badgeUrls"]["medium"]; ?>" alt="<?php echo $data["name"]; ?>"/></td>
            <td><?php echo $data["name"]; ?></td><td><?php echo $data["tag"]; ?></td>
            <td rowspan="11"><?php echo $data["description"]; ?></td>
        </tr>
        <tr>
            <td>Total points</td><td><?php echo $data["clanPoints"]; ?></td>
        </tr>
        <tr>
            <td>Wars won</td><td><?php echo $data["warWins"]; ?></td>
        </tr>
        <tr>
            <td>War win streak</td><td><?php echo $data["warWinStreak"]; ?></td>
        </tr>
        <tr>
            <td>Wars drawn</td><td><?php echo $data["warTies"]; ?></td>
        </tr>
        <tr>
            <td>Wars lost</td><td><?php echo $data["warLosses"]; ?></td>
        </tr>
        <tr>
            <td>Members</td><td><?php echo $data["members"]; ?>/50</td>
        </tr>
        <tr>
            <td>Type</td><td><?php echo $data["type"]; ?></td>
        </tr>
        <tr>
            <td>Required trophies</td><td><?php echo $data["requiredTrophies"]; ?></td>
        </tr>
        <tr>
            <td>War frequency</td><td><?php echo $data["warFrequency"]; ?></td>
        </tr>
        <tr>
            <td>Clan location</td><td><?php echo $data["location"]["name"]; ?></td>
        </tr>
    </table>
    <table border="1">
        <?php
        foreach ($members as $member) {
            ?>
            <tr>
                <td><?php echo $member["clanRank"], "(", $member["previousClanRank"], ")"; ?></td>
                <td><img src="<?php echo $member["league"]["iconUrls"]["tiny"]; ?>" alt="<?php echo $member["league"]["name"]; ?>"/></td>
                <td><?php echo $member["expLevel"]; ?></td>
                <td><?php echo "<b>", $member["name"], "</b><br/>", $member["role"]; ?></td>
                <td>Donated:<br/><?php echo $member["donations"]; ?></td>
                <td>Received:<br/><?php echo $member["donationsReceived"]; ?></td>
                <td><?php echo $member["trophies"]; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>