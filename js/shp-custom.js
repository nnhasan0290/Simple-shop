jQuery(document).ready(function ($) {
  "use-strict";
  $("#primary, .woocommerce-sidebar").theiaStickySidebar();
  $(".main-slider").lightSlider({
    item: 1,
    auto: true,
    pager: true,
    loop: true,
    slideMargin: 0,
    speed: 2000,
    pause: 10000,
    enableTouch: false,
    onSliderLoad: function () {
      $(".main-slider").removeClass("cS-hidden");
    },
  });
  var initialFilter = $(".category-title").data("filter");
  var $pfcGrid = $(".product-wrap").isotope({
    filter: initialFilter,
    layoutMode: "fitRows",
  });
  // filter items click
  $(".category-title").on("click", function () {
    $(".category-title").removeClass("active");
    $(this).addClass("active");
    var filterValue = $(this).attr("data-filter");
    $pfcGrid.isotope({
      filter: filterValue,
      layoutMode: "fitRows",
      sortBy: "random",
      transitionDuration: 600,
    });
  });
});
