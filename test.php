<?php
require('src/BelgianStructuredCommunication.php');

// convert ID to StructuredCommunication
var_dump(BelgianStructuredCommunication::create("0123456789", 3));

// get ID
var_dump(BelgianStructuredCommunication::check("+++012/3456/78939+++", 1));

// get checksum
var_dump(BelgianStructuredCommunication::check("+++012/3456/78939+++", 2));

// check if valid
var_dump(BelgianStructuredCommunication::check("+++012/3456/78939+++", 3));
// of invalid...
var_dump(BelgianStructuredCommunication::check("+++912/3456/78939+++", 3));
