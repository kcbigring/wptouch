<?php 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// WPtouch Core Header Functions
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function wptouch_core_header_enqueue() {
	$version = get_bloginfo('version'); 
		if ($version >= 2.5 && !bnc_wptouch_is_exclusive()) { 
		wp_enqueue_script('wptouch-core', '' . compat_get_plugin_url( 'wptouch' ) . '/themes/core/core.js', array('jquery'),'1.9' );		
		wp_head(); 

 			} elseif (bnc_wptouch_is_exclusive()) { 
			echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>';
			echo '<script src="' . compat_get_plugin_url( 'wptouch' ) . '/themes/core/core.js" type="text/javascript" charset="utf-8"></script>'; 

 			} else { 
			echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>';
			echo '<script src="' . compat_get_plugin_url( 'wptouch' ) . '/themes/core/core.js" type="text/javascript" charset="utf-8"></script>'; 
			wp_head(); 
		}
 }
  
function wptouch_core_header_home() {
	if (bnc_is_home_enabled()) {
		echo sprintf(__( "%sHome%s", "wptouch" ), '<li><a href="' . get_bloginfo('home') . '"><img src="' . bnc_get_title_image() . '" alt=""/>','</a></li>');
	}
}
  
function wptouch_core_header_pages() {
	$pages = bnc_wp_touch_get_pages();
	global $blog_id;
	foreach ($pages as $p) {
		if ( file_exists( compat_get_plugin_dir( 'wptouch' ) . '/images/icon-pool/' . $p['icon'] ) ) {
			$image = compat_get_plugin_url( 'wptouch' ) . '/images/icon-pool/' . $p['icon'];	
		} else {
		$image = compat_get_upload_url() . '/wptouch/custom-icons/' . $p['icon'];
	}
		echo('<li><a href="' . get_permalink($p['ID']) . '"><img src="' . $image . '" alt="icon" />' . $p['post_title'] . '</a></li>'); 
	}
  }
 
function wptouch_core_header_rss() {
	if (bnc_is_rss_enabled()) {
		echo sprintf(__( "%sRSS Feed%s", "wptouch" ), '<li><a href="' . get_bloginfo('rss2_url') . '"><img src="' . compat_get_plugin_url( 'wptouch' ) . '/images/icon-pool/RSS.png" alt="" />','</a></li>');
	}
}

function wptouch_core_header_email() {
	if (bnc_is_email_enabled()) {
		echo sprintf(__( "%sE-Mail%s", "wptouch" ), '<li><a href="mailto:' . get_bloginfo('admin_email') . '"><img src="' . compat_get_plugin_url( 'wptouch' ) . '/images/icon-pool/Mail.png" alt="" />','</a></li>');
	}
} 
  
function wptouch_core_header_check_use() {
	if (false && function_exists('bnc_is_iphone') && !bnc_is_iphone()) {
		echo '<div class="content post">';
		echo sprintf(__( "%sWarning%s", "wptouch" ), '<a href="#" class="h2">','</a>');
		echo '<div class="mainentry">';
		echo __( "Sorry, this theme is only meant for use with WordPress on Apple's iPhone and iPod Touch.", "wptouch" );
		echo '</div></div>';
		echo '' .get_footer() . '';
		echo '</body>';
	die; 
	} 
}

function wptouch_core_header_styles() {
	include('core-styles.php' );
}
  
  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// WPtouch Core Body Functions
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  

function wptouch_core_body_background() {
	$wptouch_settings = bnc_wptouch_get_settings();
	echo $wptouch_settings['style-background'];
  }
  
function wptouch_core_body_sitetitle() {  
	$str = bnc_get_header_title(); 
	echo stripslashes($str);  
  }

function wptouch_core_body_result_text() {  
	global $is_ajax; if (!$is_ajax) {
			if (is_search()) {
				echo sprintf( __("Browsing search results for &lsquo;%s&rsquo;", "wptouch"), get_search_query() );
			} if (is_category()) {
				echo sprintf( __("Browsing the category archive &lsquo;%s&rsquo;", "wptouch"), single_cat_title("", false));
			} elseif (is_tag()) {
				echo sprintf( __("Browsing the tag archive &lsquo;%s&rsquo;", "wptouch"), single_tag_title("", false));
			} elseif (is_day()) {
				echo sprintf( __("Browsing the archive &lsquo;%s&rsquo;", "wptouch"),  get_the_time('F jS, Y'));
			} elseif (is_month()) {
				echo sprintf( __("Browsing the archive &lsquo;%s&rsquo;", "wptouch"),  get_the_time('F, Y'));
			} elseif (is_year()) {
				echo sprintf( __("Browsing the archive &lsquo;%s&rsquo;", "wptouch"),  get_the_time('Y'));
		}
	}
}

function wptouch_core_body_post_arrows() {  
	 if (bnc_excerpt_enabled()) {
// Down arrow		
		echo '<a class="post-arrow" id="arrow-' . get_the_ID() . '" href="#" onclick="$wptouch(\'#entry-' . get_the_ID() . '\').fadeIn(500); $wptouch(\'#arrow-' . get_the_ID() . '\').hide(); $wptouch(\'#arrow-down-' . get_the_ID() . '\').show(); return false;"></a>';	
// Up arrow		
		echo '<a style="display:none" class="post-arrow-down month-' . get_the_time('m') . '" id="arrow-down-' . get_the_ID() . '" href="#" onclick="$wptouch(\'#entry-' . get_the_ID() . '\').fadeOut(500); $wptouch(\'#arrow-' . get_the_ID() . '\').show(); $wptouch(\'#arrow-down-' . get_the_ID() . '\').hide(); return false;"></a>';
	} 
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// WPtouch Core Footer Functions
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  

function wptouch_core_else_text() {	
	 global $is_ajax; if (($is_ajax) && !is_search()) {
		echo '' . __( "No more entries to display.", "wptouch" ) . '';
	 } elseif (is_search() && ($is_ajax)) {
		echo '' . __( "No more search results to display.", "wptouch" ) . '';
	 } elseif (is_search() && (!$is_ajax)) {
	 	echo '<div style="padding-bottom:127px">' . __( "No search results results found.", "wptouch" ) . '<br />' . __( "Try another query.", "wptouch" ) . '</div>';
	 } else {
	  echo '<div class="post">
	  	<h2>' . __( "404 Not Found", "wptouch" ) . '</h2>
	  	<p>' . __( "The page or post you were looking for is missing or has been removed.", "wptouch" ) . '</p>
	  </div>';
	}
}

function wptouch_core_footer_switch_link() {	
echo '<a onclick="document.getElementById(\'switch-on\').style.display=\'none\';document.getElementById(\'switch-off\').style.display=\'block\';" href="' . get_bloginfo('home') . '/?theme_view=normal' . '">' . __( "Mobile Theme", "wptouch" ) . '</a><img id="switch-on" src="' . compat_get_plugin_url( 'wptouch' ) . '/themes/core/core-images/on.jpg" alt="on switch image" /><img id="switch-off" style="display:none" src="' . compat_get_plugin_url( 'wptouch' ) . '/themes/core/core-images/off.jpg" alt="off switch image" />';
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// WPtouch Standard Functions
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//Favicon fetch and convert script // This script will convert favicons for the links listed on your Links page (if you have one).
function bnc_url_exists($url)
  {
// Version 4.x supported
      $handle = curl_init($url);
      if (false === $handle) {
          return false;
      }
      curl_setopt($handle, CURLOPT_HEADER, false);
      // this works
      curl_setopt($handle, CURLOPT_FAILONERROR, true);
      curl_setopt($handle, CURLOPT_NOBODY, true);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
      curl_setopt($handle, CURLOPT_TIMEOUT, 1);
      $connectable = curl_exec($handle);
      $d = curl_getinfo($handle, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
      return($d > 0);
  }
  
  
// This fetches the .ico files for the Links page generation 
// Check to see if function exists 
if (!function_exists('file_put_contents')) { 

    // Define constants used by function, if not defined 
    if (!defined('FILE_USE_INCLUDE_PATH')) define('FILE_USE_INCLUDE_PATH', 1); 
    if (!defined('FILE_APPEND'))           define('FILE_APPEND', 8); 
     
    // Define function and arguments 
    function file_put_contents($file, &$data, $flags=0) 
    { 
        // Varify arguments are correct types 
        if (!is_string($file)) return(false); 
        if (!is_string($data) && !is_array($data)) return(false); 
        if (!is_int($flags)) return(false); 
         
        // Set the include path and mode for fopen 
        $include = false; 
        $mode    = 'wb'; 
         
        // If data in array type.. 
        if (is_array($data)) { 
            // Make sure it's not multi-dimensional 
            reset($data); 
            while (list(, $value) = each($data)) { 
                if (is_array($value)) return(false); 
            } 
            unset($value); 
            reset($data); 
            // Join the contents 
            $data = implode('', $data); 
        } 
         
        // Check for flags.. 
        // If include path flag givin, set include path 
        if ($flags&FILE_USE_INCLUDE_PATH) $include = true; 
        // If append flag givin, set append mode 
        if ($flags&FILE_APPEND) $mode = 'ab'; 
         
        // Open the file with givin options 
        if (!$handle = @fopen($file, $mode, $include)) return(false); 
        // Write data to file 
        if (($bytes = fwrite($handle, $data)) === false) return(false); 
        // Close file 
        fclose($handle); 
         
        // Return number of bytes written 
        return($bytes); 
        
    }
  }  else {

function bnc_get_ico_file($ico) {
      $d = file_get_contents($ico);
      if (!file_exists(bnc_get_local_dir() . '/cache')) {
          mkdir(bnc_get_local_dir() . '/cache', 0755);
      }
      file_put_contents(bnc_get_local_dir() . '/cache/' . md5($ico) . '.ico', $d);
      exec('sh convert ico:' . bnc_get_local_dir() . '/cache/' . md5($ico) . '.ico' . bnc_get_local_dir() . '/cache/' . md5($ico) . '.png');
  }
}

// Where's the icon pool? Ah, there it is
function bnc_get_local_dir()
  {
      $dir = preg_split("#/plugins/wptouch/images/icon-pool/#", __FILE__, $test);
      return $dir[0] . '/plugins/wptouch/images/icon-pool';
  }


// This detects where the admin images are located, for all the page icons and such
function bnc_get_local_icon_url()
  {
      return compat_get_plugin_url( 'wptouch' ) . '/images/';
  }


// This does the fancy favicons as icons for WordPress links
function bnc_get_favicon_for_site($site)
  {// Yes we know this goes remote to handle things, but we do this to ensure that it works for everyone. No data is collected, as you'll see if you look at the script.
      $i = 'http://www.bravenewcode.com/code/favicon.php?site=' . urlencode($site) . '&amp;default=' . urlencode(bnc_get_local_icon_url() . '/icon-pool/default.png');
      return $i;
  }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// WPtouch Filters
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  

?>