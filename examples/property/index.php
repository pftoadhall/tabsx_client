<?php

/**
 * @name Requesting property information
 *
 * This file demonstrates how to request property information.
 */

require_once __DIR__ . '/../creating-a-new-connection.php';

try {
    if ($id = filter_input(INPUT_GET, 'id')) {
    $property = new \tabs\apiclient\Property($id);
    $property->get();
    ?>

    <h2><?php echo $property->getName(); ?></h2>
    <p><?php echo $property->getAddress(); ?></p>
    <p>Sleeps <?php echo $property->getSleeps(); ?></p>
    <p><?php echo $property->getBedrooms(); ?> bedrooms</p>

    <?php

        $today = new \DateTime(
            filter_input(INPUT_GET, 'fromdate') ? filter_input(INPUT_GET, 'fromdate') : 'first day of next month'
        );
        $cal = $property->getBrandings()->first()->getCalendar(
            $today
        );
        $cal->setProcessDay(function($cell, $day) use ($property) {
            if ($day && $day->getDaysavailable() > 0) {
                $cell = str_replace(
                    '{content}',
                    sprintf(
                        '<a href="../booking/booking-enquiry.php?fromdate=%s&propertybrandingid=%s">%s</a>',
                        $day->getDate()->format('Y-m-d'),
                        $property->getBrandings()->first()->getId(),
                        $day->getDate()->format('j')
                    ),
                    $cell
                );
            }

            return $cell;
        });
        echo (string) $cal;
        $next = new \DateTime($cal->getTargetMonth()->format('Y-m-d'));
        $next->add(new \DateInterval('P1M'));

        echo sprintf(
            '<p><a href="?id=%s&fromdate=%s">Next</a></p>',
            $property->getId(),
            $next->format('Y-m-d')
        );

        // Get available breaks prices for 'changeover' days
        if ($property->getBrandings()->first()
            && filter_input(INPUT_GET, 'fromdate')
        ) {
            // As we are getting multiple prices its a good idea to get all
            // prices to prime the cache
            $property->getAvailablebreaks();

            // Get the available days.  We can use the local store as we've already
            // fetched it by using the getCalendar method
            $days = $property->getBrandings()->first()->getAvailableDaysCollection();

            foreach ($days as $day) {
                if ($day->getPriceanchor() && $day->getDaysavailable() > 0) {
                    echo sprintf(
                        '<p><a href="getting-an-available-breaks-price.php?id=%s&fromdate=%s">Price on %s £%s</a></p>',
                        $property->getId(),
                        $day->getDate()->format('Y-m-d'),
                        $day->getDate()->format('Y-m-d'),
                        $property->getAvailableBreaksPrice($day->getDate())
                    );
                }
            }
        }

        if ($property->getBrandings()->first()
            && !filter_input(INPUT_GET, 'fromdate')
        ) {
            $branding = $property->getBrandings()->first();
            ?>
                <p>Marketing Brand: <?php echo $branding->getMarketingbrand()->getMarketingbrand()->getName(); ?></p>
            <?php

            $collection = $branding->getMarketingbrand()->getBrochures();
            include __DIR__ . '/../collection.php';

            $collection = $branding->getMarketingbrand()->getDescriptions();
            include __DIR__ . '/../collection.php';

            $collection = $branding->getMarketingbrand()->getGroupingvalues();
            include __DIR__ . '/../collection.php';
        }

        if (!filter_input(INPUT_GET, 'fromdate') && $property->getDocuments()->count() > 0) {
            ?><p>Documents limited to 2</p><?php
            $collection = $property->getDocuments()->findBy(function($ele) {
                return $ele->getDocument() instanceof tabs\apiclient\Image && !$ele->getDocument()->isPrivate();
            })->slice(0, 2);
            include __DIR__ . '/../collection.php';

            $collection = $property->getDocuments()->findBy(function($ele) {
                return !$ele->getDocument() instanceof tabs\apiclient\Image;
            });
            include __DIR__ . '/../collection.php';
        }

        if (!filter_input(INPUT_GET, 'fromdate')) {
            ?>
                <p><a href="add-document.php?id=<?php echo $property->getId(); ?>">Add a document</a></p>
                <p><a href="add-image.php?id=<?php echo $property->getId(); ?>">Add an image</a></p>
                <p><a href="add-attribute.php?id=<?php echo $property->getId(); ?>">Add an attribute</a></p>
            <?php
            $collection = $property->getNotes();
            include __DIR__ . '/../collection.php';
            ?>
                <p><a href="add-note.php?id=<?php echo $property->getId(); ?>">Add a note</a></p>
            <?php
        }
        if (!filter_input(INPUT_GET, 'fromdate')) {
            $collection = $property->getParkingpermits();
            include __DIR__ . '/../collection.php';

            $collection = $property->getEvents();
            include __DIR__ . '/../collection.php';

            $collection = $property->getInspections();
            include __DIR__ . '/../collection.php';

            $collection = $property->getPrimarypropertybranding()->getPrices();
            include __DIR__ . '/../collection.php';

            $collection = $property->getPrimarypropertybranding()->getSpecialoffers();
            include __DIR__ . '/../collection.php';

            $collection = $property->getAttributes();
            include __DIR__ . '/../collection.php';

            $collection = $property->getBrandings()->first()->getAvailableDays();
            include __DIR__ . '/../collection.php';

            $collection = $property->getSuppliers();
            include __DIR__ . '/../collection.php';

            $collection = $property->getTargets();
            include __DIR__ . '/../collection.php';

            $collection = $property->getRooms();
            include __DIR__ . '/../collection.php';

            $candm = $property->getCommentsandmetrics();
            $collection = $candm->getComments();
            include __DIR__ . '/../collection.php';
            $collection = $candm->getMetrics();
            include __DIR__ . '/../collection.php';
        }

} else {
    $brandings = \tabs\apiclient\Collection::factory(
        'branding',
        new tabs\apiclient\Branding()
    );
    $brandings->fetch();

    // Search for all live properties on the first branding found
    $collection = tabs\apiclient\Collection::factory(
        'property',
        new \tabs\apiclient\Property
    );
    $collection->setLimit(filter_input(INPUT_GET, 'limit'))
        ->setPage(filter_input(INPUT_GET, 'page'));
    $collection->addFilter('brandingid', $brandings->first()->getId());
    $collection->addFilter('brandingstatusid', 1);
    $collection->fetch();

    include __DIR__ . '/../collection.php';
}
} catch(Exception $e) {
    echo $e->getMessage();
}

require_once __DIR__ . '/../finally.php';