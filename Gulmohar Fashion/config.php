<?php
define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/shoptime/');
define('CART_COOKIE','SBwi72klLsLL10');
define('CART_COOKIE_EXPIRE',time() + (86400 *30));
define('TAXRATE',0.15);

define('CURRENCY','usd');
define('CHECKOUTMODE','TEST');

if(CHECKOUTMODE == 'TEST'){
  define('STRIPE_PRIVATE','sk_test_DBECablti9nkdJAZYFmJ9nDI');
  define('STRIPE_PUBLIC','pk_test_LLKWE6qMXKr6mbKcZzBaAQpg');
}

?>
