<!doctype html>
<html>

<head>
    <title>GeoLite2 Web Service Demo</title>
</head>

<body>

    <?php
    function h($input) {
        return htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
    ?>

    <form method="POST">
        <label>
            IP Address to look up:
            <input type="text" name="ip_address" value="<?= isset($_POST['ip_address']) ? h($_POST['ip_address']) : '' ?>">
        </label>

        <input type="submit" value="Perform lookup">
    </form>

    <?php
    require_once 'vendor/autoload.php';

    use GeoIp2\WebService\Client;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ip_address']) && $_POST['ip_address']) {
        // This creates a Client object that can be reused across requests.
        // To use the GeoIP2 Precision City instead of GeoLite2, you can remove the host parameter in the client object.
        // Replace MM_ACCOUNT_ID with your MaxMind Account ID and MM_LICENSE_KEY with your License Key.
        $client = new Client(getenv('MM_ACCOUNT_ID'), getenv('MM_LICENSE_KEY'), ['en'], ['host' => 'geolite.info']);

        // You can replace "city" with the method corresponding to the web service that
        // you are using, e.g., "country".
        $record = $client->city(h($_POST['ip_address']));
    ?>
        <table>
            <tr>
                <th>IP Address</th>
                <td><?= h($record->traits->ipAddress) ?></td>
            </tr>
            <tr>
                <th>Network</th>
                <td><?= h($record->traits->network) ?></td>
            </tr>
            <tr>
                <th>Country ISO code</th>
                <td><?= h($record->country->isoCode) ?></td>
            </tr>
            <tr>
                <th>Country name (en)</th>
                <td><?= h($record->country->name) ?></td>
            </tr>
            <tr>
                <th>Country name (zh-CN)</th>
                <td><?= h($record->country->names['zh-CN']) ?></td>
            </tr>
            <tr>
                <th>Most specific subdivision ISO Code</th>
                <td><?= h($record->mostSpecificSubdivision->name) ?></td>
            </tr>
            <tr>
                <th>Most specific subdivision name</th>
                <td><?= h($record->mostSpecificSubdivision->isoCode) ?></td>
            </tr>
            <tr>
                <th>City name</th>
                <td><?= h($record->city->name) ?></td>
            </tr>
            <tr>
                <th>Postal code</th>
                <td><?= h($record->postal->code) ?></td>
            </tr>
            <tr>
                <th>Latitude</th>
                <td><?= h($record->location->latitude) ?></td>
            </tr>
            <tr>
                <th>Longitude</th>
                <td><?= h($record->location->longitude) ?></td>
            </tr>
            <tr>
                <th>Accuracy Radius</th>
                <td><?= h($record->location->accuracyRadius) ?>km</td>
            </tr>
        </table>
    <?php
    }
    ?>
</body>

</html>