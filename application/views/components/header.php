<?php
if(isset($css)){

  foreach ($css as $styles) {
    if (is_array($styles)) {
      foreach ($styles as $subStyles)
        printf('<link href="%s" rel="stylesheet"/>', base_url(($subStyles)));
    } else {
      printf('<link href="%s" rel="stylesheet"/>', base_url($styles));
    }
  }
}
