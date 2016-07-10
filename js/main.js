 /* function windowResize() {
    var w = window.innerWidth;
    var h = window.innerHeight;
    var numbersH = document.getElementById("backup_numbers").offsetHeight;
    document.getElementById("start").style.height = h+"px";
    document.getElementById("start").style.width = w+"px";
    document.getElementById("backup_numbers").style.top = h-numbersH-50+"px";
  }
  windowResize();
  window.addEventListener("load",windowResize,true);
  window.addEventListener("resize",windowResize,true);
  */


    $(".de").removeClass("rotate");
    $(".en").addClass("rotate");

$("#de").click(function() {
  if ( $("#de").hasClass("active") === false) {
    $("#de").addClass("active");
    $("#en").removeClass("active");

      $(".de").each(function(index){
        var self = this;
        setTimeout(function() {
          $(".de:eq("+index+")").removeClass("rotate");
          $(".en:eq("+index+")").addClass("rotate");
        },index*10);
      });

  }
});
$("#en").click(function() {
  if ( $("#en").hasClass("active") === false) {
      $("#en").addClass("active");
      $("#de").removeClass("active");
    $(".en").each(function(index){
        var self = this;
        setTimeout(function() {
          $(".en:eq("+index+")").removeClass("rotate");
          $(".de:eq("+index+")").addClass("rotate");
        },index*10);
      });
  }
});