<header class="header" id="header">
<div class="header_toggle"> <i id="header-toggle" class='fa fa-bars' ></i> </div>
    <div class="header_items">
        <?php
        if(isset($_SESSION["M_ID"]) || isset($_SESSION["A_ID"])){
            echo'<div class="header_img"> <img id="userImg" src="'.$_SESSION["nav_Img"].'" alt=""> </div>';
            echo '<div class="header_item">'.$_SESSION["nav_Name"].'</div>';
        }else{
            echo'<div class="header_img"> <img id="userImg" src="https://images.macrumors.com/t/n4CqVR2eujJL-GkUPhv1oao_PmI=/1600x/article-new/2019/04/guest-user-250x250.jpg"" alt=""> </div>';
            echo '<div class="header_item">Guest</div>';
        }
        error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
        ?>
    </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div> <a href="#" class="nav_logo">
                <img src="Images/lib.png" style="width:50%">  <span class="nav_logo-name">ABC Library</span> </a>
            <div class="nav_list" id="nav_list">
                <?php echo generate_navigation_links(); ?>
            </div>
        </div>

    </nav>
</div>
<?php
function generate_navigation_links() {
    // Start the session
    session_start();

    // Check if the user is logged in as a member or an admin
    $is_member = isset($_SESSION["M_ID"]);
    $is_admin = isset($_SESSION["A_ID"]);

    // Generate the navigation links based on the user's role
    $navigation_links = '';
    $navigation_links .= '<a href="./dashboard.php" class="nav_link '.(basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '').'"><i class="fa fa-home nav_icon"></i><span class="nav_name">Dashboard</span></a>';
    if(!isset($_SESSION["M_ID"]) && !isset($_SESSION["A_ID"])){
        $navigation_links .= '<a href="./login.php" class="nav_link '.(basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : '').'"><i class="fa fa-sign-in nav_icon"></i><span class="nav_name">Login</span></a>';
    }

    if ($is_member) {
        $navigation_links .= '<a href="./my-reservations.php" class="nav_link '.(basename($_SERVER['PHP_SELF']) == 'my-reservations.php' ? 'active' : '').'" style="column-gap:13px"><i class="fa fa-calendar nav_icon" style="margin-left: 3px"></i><span class="nav_name">My Reservations</span></a>';
    }
    else if ($is_admin) {
        $navigation_links .= '<a href="./book.php" class="nav_link '.(basename($_SERVER['PHP_SELF']) == 'book.php' ? 'active' : '').'"><i class="fa fa-book nav_icon"></i><span class="nav_name">Books</span></a>';
        $navigation_links .= '<a href="./member.php" class="nav_link '.(basename($_SERVER['PHP_SELF']) == 'member.php' ? 'active' : '').'" style="column-gap:20px"><i class="fa fa-user nav_icon"></i><span class="nav_name">Users</span></a>';
        $navigation_links .= '<a href="./records.php" class="nav_link '.(basename($_SERVER['PHP_SELF']) == 'records.php' ? 'active' : '').'"><i class="fa fa-edit nav_icon"></i><span class="nav_name">Records</span></a>';
        $navigation_links .= '<a href="./penalty.php" class="nav_link '.(basename($_SERVER['PHP_SELF']) == 'penalty.php' ? 'active' : '').'" style="column-gap:20px"><i class="fa fa-usd nav_icon" style="margin-left: 3px"></i><span class="nav_name">Penalty</span></a>';
        $navigation_links .= '<a href="./reservations.php" class="nav_link '.(basename($_SERVER['PHP_SELF']) == 'reservations.php' ? 'active' : '').'" style="column-gap:20px"><i class="fa fa-calendar nav_icon" style="margin-left: 3px"></i><span class="nav_name">Reservations</span></a>';

    }

    if(isset($_SESSION["M_ID"]) || isset($_SESSION["A_ID"])){
        // Add the logout link
        $navigation_links .= '<a href="./includes/logout.php" class="nav_link" id="logout"><i class="fa fa-sign-out nav_icon"></i><span class="nav_name">Logout</span></a>';
    }

    // Return the generated navigation links
    return $navigation_links;
}
?>
