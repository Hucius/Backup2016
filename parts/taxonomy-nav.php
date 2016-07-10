<ul>

  <li class="first">AWARD:</li>

  <?php

  $taxonomy = 'bckp_award';
  $tax_terms = get_terms(  $taxonomy  );
  ?>

  <?php
  foreach ($tax_terms as $tax_term) {
    if (  $active_term === $tax_term->slug  ) {
      echo '<li class="page-title '.$tax_term->slug.'">' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '><span class="title">' . str_replace(  "Award","",$tax_term->name  ).'</span></a></li>';
    } else {
      echo '<li class="iii '.$tax_term->slug.'">' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '><span class="title">' . str_replace(  "Award","",$tax_term->name  ).'</span></a></li>';
    }
  }
  ?>
</ul>

<div class="award-description">
  <h1><?php echo($active_term_name) ?></h1>
  <span><?php echo str_replace("|","</span><br/><span>",$active_term_desc) ?></span>
</div>