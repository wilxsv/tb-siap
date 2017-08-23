<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('', array (
));

$catalogueEs_SV = new MessageCatalogue('es_SV', array (
));
$catalogue->addFallbackCatalogue($catalogueEs_SV);


return $catalogue;
