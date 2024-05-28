<?php
/**
 * Customizer.
 */

namespace App;

use Kirki;

if(class_exists( 'Kirki' )){
  
  /**
   * Include files for panels, section & fields.
   */
  include 'Customizer/fields-header.php';
  include 'Customizer/fields-footer.php';
  include 'Customizer/fields-sidebar.php';

}
