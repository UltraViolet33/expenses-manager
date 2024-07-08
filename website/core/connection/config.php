<?php

define("DEBUG", false);

if (DEBUG) {
    define("DBNAME", "expenses-manager");
} else {
    define("DBNAME", "expenses-manager-prod");
}

define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
