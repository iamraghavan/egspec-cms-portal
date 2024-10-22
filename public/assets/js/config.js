(function () {
  var primary = localStorage.getItem("primary") || "#00176e";
  var secondary = localStorage.getItem("secondary") || "#af005e";

  window.ZonoAdminConfig = {
    // Theme Primary Color
    primary: primary,
    // theme secondary color
    secondary: secondary,
  };
})();
