<?php

/* Custom search form */
?>
<form class="col s12 m8 l10" role="search" method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="">
  <div class="searchform">
    <input type="search" class="search-red-border" placeholder="Sök efter annons" aria-label="search nico" name="s" id="search-input" value="<?php echo esc_attr( get_search_query() ); ?>">
    <button class="search-button" type="submit" id="searchsubmit">Sök <i class="material-icons search">search</i></button>
      <div class="">
         <span class="">
          <i class=""></i>
         </span>
    </div>
  </div>
</form>