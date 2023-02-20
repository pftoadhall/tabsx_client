<?php

/**
 * @name Requesting specific fields in property collections
 * 
 * In order to speed specific requests up, it is useful to limit the fields you are 
getting back from the api.  This reduces the work done by the api and reduces the
memory footprint of objects in your local instance.
 */

require_once __DIR__ . '/../creating-a-new-connection.php';

try {

    // Get all the fields for the property endpoint that you can get
    $root = tabs\apiclient\Root::fetch();
    $fields = $root->getScalarfields()['property'];

    // Search for all live properties on the first branding found
    $collection = tabs\apiclient\Collection::factory(
        'property',
        new \tabs\apiclient\Property
    );
    $collection->addFilter('brandingstatusid', 1)
        ->setFields($fields)

        // You can set a large limit when using fields
        ->setLimit(500);
    $collection->fetch();

    echo '<p>' . $collection->getTotal() . ' found</p>';

    // Output the fields from first response.
    foreach ($fields as $field) {
        echo '<p>' . $field . ': ' . $collection->first()->getDataFromResponse($field) . '</p>';
    }

} catch (Exception $e) {
    echo $e->getMessage();
}

require_once __DIR__ . '/../finally.php';