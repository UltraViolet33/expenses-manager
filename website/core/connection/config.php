<?php

define("DEBUG", true);

if (DEBUG) {
    define("DBNAME", "expenses-manager");
} else {
    define("DBNAME", "expenses");
}

define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
