<div class="clearfix"></div>
</div>
</div>
</div>


<footer id="footer">
  <div class="footer-wrapper">
    <div class="logo">
      <a href="<?php echo home_url(); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/img/backup_2016_logo_web.png" alt="backup festival weimar" />
      </a>
    </div>
    <div class="address">
      <p><strong>Adresse</strong><br/>
        Bauhaus-Universität Weimar <br/>
        backup_festival <br/>
        Bauhausstraße 15 <br/>
        99423 Weimar <br/>
      </p>
    </div>
    <div class="fb-like">
      <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fbackupfestival&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;colorscheme=light&amp;share=false&amp;height=80&amp;appId=247749955262270" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:200px;color:red" allowTransparency="true"></iframe>
    </div>
  </div>
</footer>

<!-- <canvas id="my-canvas" height="100%" width="100%" resize></canvas> -->
</div>

<script>
  var nav = responsiveNav(".menu");
</script>



<!-- Piwik -->
<script async type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://backup-festival.de/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();

</script>
<noscript><p><img src="http://backup-festival.de/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->

<?php wp_footer(); ?>

<script>

  jQuery(document).ready(function($) {


  // Isotope messes up in Chrome because it initiates before everything has loaded

  // This ensures everything has loaded before applying

  $(window).load(function() {


    $(".items").isotope('reLayout');

  });


});

</script>
</body>

</html>