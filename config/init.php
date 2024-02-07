<?php
// config

//DSN : Data Source Name qui contient des informations sur la base de données
define('DSN', 'mysql:dbname=amiens_zen_installation;host =localhost');

// Personnaliser les privilèges avec un nom d'utilisateur et un mot de passe spécifique
define('LOGIN', 'admin_AZI');
define('PASSWORD', '1!Z-zvPtp8p92uaN');

// regex
define('REGEX_NAME', '^[a-zA-Zàáčćèéëėìíîï \'\-]{2,50}$');
define('REGEX_PASSWORD', '^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$');
define ('REGEX_TELEPHONE','^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$');

// key
define ('SECRET_KEY', 's$hhshshshshsh34');