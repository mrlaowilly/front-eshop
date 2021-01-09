<?php

# Chargement de l'autoload
require_once './vendor/autoload.php';

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\RetryableHttpClient;

# Récupération du client HTTP Symfony
$client = new RetryableHttpClient(HttpClient::create(["verify_peer" => false, "verify_host" => false]));

# Requête à notre API pour récupérer les articles
$response = $client->request('GET', 'https://localhost:8001/api/products', [
    'auth_bearer' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MTAxOTgyNzQsImV4cCI6MTYxMDIwMTg3NCwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoibWFyaW9uQGhvdG1haWwuZnIifQ.fi8epwK1o04e6fd4dLCAoBa0hGMovdLn6EVQArmBITjq7vAN3gu20RQri5_PDt4gFHZVHmvf0I18oxf2TAxRKxidlMABKPStFRyUdN7HSvf6zoUHnzSdNxeQplk4u7UO6ovlT-swYbbpxxjPGKGRxYt7AVYIQq-jEv9AM9LsNLznX8vpTC8jHS8qP3VbjKL6FNrkwqfT0bGOT8RB9UpSQELzzWzkpIbv-sLCWzfdusfZzgW868dDZvlkAfoZV0VE0Pvs9McYYV9hh_VjkeJucc-Bc0PscXRuU5mDQl7zla-MVC4GWcXDsgljojTAMHXLR49d33RLnPvoFKFC8o0fL53qX3yEYAHl67m21IabZkEus2VDa0t9ERwQTc3prUb6sy_E-Cc8xLMf_MjZ93NY9TDLLTLLAwO9fDl0YOnNBP6Sj6d57Om_ZdvMBIOT9MtUdFIeHt5ZbLqS18ocVKyBitxZ92j_aBmh3bL2YDHO47p10_QUp69FLaQBx-NX_cNwBncdN8Bku72fggsQNWDz9mqgR73upeQdr_TJVGXjrNfqGhyQgH_rZTSDtZe-TXOSltcnZL_9US46CHcIxOS6LSzX2ZuEvxBQOC1-VcOcrTpweQjSiTIn0QXbNIX7nSevzQZ24thFzyhI0j8PzHTAOx-h-9Ibx3-iTYvB2UJV7iY'
]);

# Debbugage de la requète dans le navigateur
# dump($response->toArray());

# Récupération des articles
$posts = $response->toArray();

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Eshop</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">
            <h3>Mes produits E-shop</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">image</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($posts['hydra:member'] as $post) { ?>
                    <tr>
                        <th scope="row"><?= $post['@id'] ?></th>
                        <td><?= $post['title'] ?></td>
                        <td><?= $post['description'] ?></td>
                        <td><?= $post['image'] ?></td>
                        <td><?= $post['createdAt'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>