<?php
    define('REGEX_NAME', '^[a-zA-Zàáčćèéëėìíîï \'\-]{2,50}$');
    define('REGEX_PASSWORD', '^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$');
    define ('REGEX_TELEPHONE','^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$');