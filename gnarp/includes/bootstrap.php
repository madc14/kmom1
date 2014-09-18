<?php
/**
 * Bootstrapping functions, essential and needed for Anax to work together with some common helpers. 
 *
 */

/**
 * Default exception handler.
 *
 */

function myExceptionHandler($exception) {
  echo "Gnarp: Uncaught exception: <p>" . $exception->getMessage() . "</p><pre>" . $exception->getTraceAsString(), "</pre>";
}
set_exception_handler('myExceptionHandler');


/**
 * Autoloader for classes.
 *
 */
function myAutoloader($class) {
  $path = GNARP_INSTALL_PATH . "/src/{$class}/{$class}.php";

  if(is_file($path)) {
    include($path);
  }
  else {
    throw new Exception("Classfile '{$class}' does not exists.");
  }
}
spl_autoload_register('myAutoloader');

/* Dump function */
function dump($array) {
  return "<pre>" . htmlentities(print_r($array, 1)) . "</pre>";
}

/* Function for modifying date output */
function showDate($dated) // for the DATETIME format

{
    $hour = substr($dated, 11, 2);
    $minute = substr($dated, 14, 2);
    $second = substr($dated, 17, 2);
    $month = substr($dated, 5, 2);
    $day = substr($dated, 8, 2);
    $year = substr($dated, 0, 4);
    $mktime = mktime($year, $month, $day, $hour, $minute);
    //$formatted = date("F j, Y g:i a",$mktime);
    $formatted = $day . "/" . $month . " - " . $hour . ":" . $minute;
    return $formatted;
}