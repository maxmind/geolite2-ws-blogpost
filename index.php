<!doctype html>
<html>

<head>
    <title>GeoLite2 WebService Demo</title>
</head>

<body>

    <form method="POST">
        <label>
            IP Address to look up:
            <input type="text" name="ip_address" value="<?= isset($_POST['ip_address']) ? $_POST['ip_address'] : '' ?>">
        </label>

        <input type="submit" value="Perform look up">
    </form>

    <?php
    require_once 'vendor/autoload.php';

    use GeoIp2\WebService\Client;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ip_address']) && $_POST['ip_address']) {
        // This creates a Client object that can be reused across requests.
        // To use the GeoIP2 Precision City instead of GeoLite2, you can remove the last parameter.
        // Replace MM_ACCOUNT_ID with your MaxMind Account ID and MM_LICENSE_KEY with your License Key.
        $client = new Client(MM_ACCOUNT_ID, 'MM_LICENSE_KEY', ['en'], ['host' => 'geolite.info']);

        // You can replace "city" with the method corresponding to the web service that
        // you are using, e.g., "country".
        $record = $client->city($_POST['ip_address']);
    ?>
        <table>
            <tr>
                <th>IP Address</th>
                <td><?= $record->traits->ipAddress ?></td>
            </tr>
            <tr>
                <th>Network</th>
                <td><?= $record->traits->network ?></td>
            </tr>
            <tr>
                <th>Country ISO code</th>
                <td><?= $record->country->isoCode ?></td>
            </tr>
            <tr>
                <th>Country name (en)</th>
                <td><?= $record->country->name ?></td>
            </tr>
            <tr>
                <th>Country name (zh-CN)</th>
                <td><?= $record->country->names['zh-CN'] ?></td>
            </tr>
            <tr>
                <th>Most specific subdivision ISO Code</th>
                <td><?= $record->mostSpecificSubdivision->name ?></td>
            </tr>
            <tr>
                <th>Most specific subdivision name</th>
                <td><?= $record->mostSpecificSubdivision->isoCode ?></td>
            </tr>
            <tr>
                <th>City name</th>
                <td><?= $record->city->name ?></td>
            </tr>
            <tr>
                <th>Postal code</th>
                <td><?= $record->postal->code ?></td>
            </tr>
            <tr>
                <th>Latitude</th>
                <td><?= $record->location->latitude ?></td>
            </tr>
            <tr>
                <th>Longitude</th>
                <td><?= $record->location->longitude ?></td>
            </tr>
            <tr>
                <th>Accuracy Radius</th>
                <td><?= $record->location->accuracyRadius ?>km</td>
            </tr>
        </table>
    <?php
    }
    ?>
</body>

</html>