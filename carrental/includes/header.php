<?php
$is_index = (basename($_SERVER['PHP_SELF']) == 'index.php');
?>
<header class="premium-header">
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      
      <!-- Premium Design for All Pages -->
      <div class="premium-nav-wrap">
        <div class="logo-left">
            <a href="index.php">Torq</a>
        </div>
        
        <div class="nav-right">
           <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="page.php?type=aboutus">About</a></li>
              <li><a href="car-listing.php">Vehicles</a></li>
              <li><a href="my-booking.php">Booking</a></li>
              <li><a href="contact-us.php">Contacts</a></li>
              <?php if($_SESSION['login']) {?>
              <li class="user-icon"><a href="profile.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
              <?php } else { ?>
              <li class="user-icon"><a href="login-page.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
              <?php } ?>
              <li style="display: flex; align-items: center; margin-left: 15px;">
                <div class="theme-switch-wrapper">
                  <label class="theme-switch" for="checkbox-premium">
                    <input type="checkbox" id="checkbox-premium" />
                    <div class="slider round"></div>
                  </label>
                  <i class="fa fa-moon-o" style="margin-left: 10px; font-size: 18px; color: #fff;"></i>
                </div>
              </li>
           </ul>
        </div>
      </div>
      
    </div>
  </nav>
  <!-- Navigation end -->
</header>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all theme toggle switches
    const toggleSwitches = document.querySelectorAll('.theme-switch input[type="checkbox"]');
    const currentTheme = localStorage.getItem('theme');

    // Apply saved theme on page load
    if (currentTheme) {
        document.body.classList.add(currentTheme);
        if (currentTheme === 'dark-mode') {
            toggleSwitches.forEach(toggle => {
                toggle.checked = true;
            });
        }
    }

    // Theme switch function
    function switchTheme(e) {
        if (e.target.checked) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark-mode');
            // Sync all toggles
            toggleSwitches.forEach(toggle => {
                toggle.checked = true;
            });
        } else {
            document.body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light-mode');
            // Sync all toggles
            toggleSwitches.forEach(toggle => {
                toggle.checked = false;
            });
        }    
    }

    // Add event listener to all toggle switches
    toggleSwitches.forEach(toggle => {
        toggle.addEventListener('change', switchTheme, false);
    });
});
</script>
