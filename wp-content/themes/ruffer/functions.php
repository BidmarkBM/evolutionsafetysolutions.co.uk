<?php
/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/ruffer-constants.php';

//theme setup
require_once RUFFER_DIR_PATH_INC . 'theme-setup.php';

//essential scripts
require_once RUFFER_DIR_PATH_INC . 'essential-scripts.php';

// Woo Hooks
require_once RUFFER_DIR_PATH_INC . 'woo-hooks/ruffer-woo-hooks.php';

// Woo Hooks Functions
require_once RUFFER_DIR_PATH_INC . 'woo-hooks/ruffer-woo-hooks-functions.php';

// plugin activation
require_once RUFFER_DIR_PATH_FRAM . 'plugins-activation/ruffer-active-plugins.php';

// theme dynamic css
require_once RUFFER_DIR_PATH_INC . 'ruffer-commoncss.php';

// meta options
require_once RUFFER_DIR_PATH_FRAM . 'ruffer-meta/ruffer-config.php';

// page breadcrumbs
require_once RUFFER_DIR_PATH_INC . 'ruffer-breadcrumbs.php';

// sidebar register
require_once RUFFER_DIR_PATH_INC . 'ruffer-widgets-reg.php';

//essential functions
require_once RUFFER_DIR_PATH_INC . 'ruffer-functions.php';

// helper function
require_once RUFFER_DIR_PATH_INC . 'wp-html-helper.php';

// Demo Data
require_once RUFFER_DEMO_DIR_PATH . 'demo-import.php';

// pagination
require_once RUFFER_DIR_PATH_INC . 'wp_bootstrap_pagination.php';

// ruffer options
require_once RUFFER_DIR_PATH_FRAM . 'ruffer-options/ruffer-options.php';

// hooks
require_once RUFFER_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once RUFFER_DIR_PATH_HOOKS . 'hooks-functions.php';

/**
 * AJAX Load More Posts Function
 */
function load_more_posts() {
    // Verify nonce for security
    check_ajax_referer('load_more_posts_nonce', 'nonce');

    // Get the page number from the AJAX request
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    // Set up query arguments for loading more posts
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'paged'          => $paged,
        'posts_per_page' => get_option('posts_per_page'),
    );

    $query = new WP_Query($args);

    // Check if there are posts
    if ($query->have_posts()) :
        ob_start();
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
        $output = ob_get_clean();
        wp_reset_postdata();
        wp_send_json_success($output);
    else :
        wp_send_json_error(array('message' => 'No more posts'));
    endif;
    wp_die();
}

// Hook for logged-in users
add_action('wp_ajax_load_more_posts', 'load_more_posts');
// Hook for non-logged-in users
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

// Remove default pagination (if using Load More)
remove_action('ruffer_blog_pagination', 'ruffer_blog_pagination_cb', 10);

/**
 * Display Category Name, Description, and Search Bar at the Top of Product Category Page
 */
add_action('woocommerce_before_main_content', 'custom_show_category_name_description', 5);
function custom_show_category_name_description() {
    if (is_product_category()) {
        $category_name = esc_html(single_cat_title('', false));
        $category_description = wp_kses_post(category_description());
        $current_category = get_queried_object();
        $category_slug = $current_category->slug;
        ?>
        <div class="custom-category-header" style="margin-bottom: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
            <h1 class="category-title" style="font-size: 2em; margin-bottom: 10px; color: #333;"><?php echo $category_name; ?></h1>
            <?php if (!empty($category_description)) : ?>
                <div class="category-description" style="font-size: 1em; color: #666; line-height: 1.6; margin-bottom: 15px;"><?php echo $category_description; ?></div>
            <?php endif; ?>
            <form role="search" method="get" class="category-search-form" action="<?php echo esc_url(home_url('/')); ?>" style="display: flex; align-items: center; gap: 10px;">
                <input type="search" class="search-field" placeholder="Search products in this category..." value="<?php echo get_search_query(); ?>" name="s" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;" />
                <input type="hidden" name="post_type" value="product" />
                <input type="hidden" name="product_cat" value="<?php echo esc_attr($category_slug); ?>" />
                <button type="submit" style="padding: 8px 15px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Search</button>
            </form>
        </div>
        <?php
    }
}


/**
 * Replace 'Ruffer' with 'Evolution Safety Solutions' in content
 */
add_filter('the_content', 'ess_replace_ruffer_in_content');
function ess_replace_ruffer_in_content($content) {
    return str_replace('Ruffer', 'Evolution Safety Solutions', $content);
}



function disable_multiple_anchors_script() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Target both selectors
        $('.service-box h3.box-title a, .service-featured_content h3.box-title a')
          .removeAttr('href')
          .css({
            'pointer-events': 'none',
            'cursor': 'default',
            'text-decoration': 'none',
            'color': 'inherit'
          })
          .hover(
            function() {
              $(this).css('color', 'white'); // Hover in
            },
            function() {
              $(this).css('color', 'inherit'); // Hover out
            }
          );
    });
    </script>
    <?php
}
add_action('wp_footer', 'disable_multiple_anchors_script');


// Single product page par "Add to cart" button ka text change karna
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_single_add_to_cart_text' );
function custom_single_add_to_cart_text() {
    return __( 'Book Now', 'woocommerce' ); // Apna custom text yahan likhein
}


// Add "View Course" button after each product in the loop
add_action( 'woocommerce_after_shop_loop_item', 'add_view_course_button', 10 );

function add_view_course_button() {
    global $product;
    $link = $product->get_permalink();
    echo '<a href="' . esc_url( $link ) . '" class="view-course-button">View Course</a>';
}




// 
// 
// 
// 
// 
// 

/*
 * Internal Function for Fluent Forms Custom Slug
 * Do not EDIT this function
 */
function customFfLandingPageSlug($slug)
{
    add_action('init', function () use ($slug) {
        add_rewrite_endpoint($slug, EP_ALL);
    });
    add_action('wp', function () use ($slug) {
        global $wp_query;
        if (isset($wp_query->query_vars[$slug])) {
            $formString = $wp_query->query_vars[$slug];
            if (!$formString) {
                return;
            }
            $array = explode('/', $formString);

            $formId = $array[0];

            if (!$formId || !is_numeric($formId)) {
                return;
            }

            $secretKey = '';
            if (count($array) > 1) {
                $secretKey = $array[1];
            }

            $paramKey = apply_filters('fluentform/conversational_url_slug', 'fluent-form');

            $_GET[$paramKey] = $formId;
            $_REQUEST[$paramKey] = $formId;

            $request = wpFluentForm('request');
	    $request->set($paramKey, $formId);
	    $request->set('form', $secretKey);
        }
    });
}

/*
 * Creating custom slug for conversational form landing page
 *
 * my-forms is your custom slug for the form
 * if your form id is 123 then the landing page url will be then
 * https://your-domain.com/my-forms/123
 * if you use Security Code on conversational form then the url will be
 * https://your-domain.com/my-forms-x/123/SECURITY-CODE
 *
 * After paste the code to your theme's functions.php file please re-save the permalink settings
*/

customFfLandingPageSlug('https://evolutionsafetysolutions.co.uk/contact-us-evolution-safety-solutions/'); // you may change the "my-forms" for your own page slug



add_action('fluentform_submission_success', 'custom_redirect_with_entry_id', 10, 3);
function custom_redirect_with_entry_id($entryId, $formData, $form) {
    if ($form->id == 1) { // Form ID 1 ke liye
        $redirect_url = 'https://staging-6489-evolutionsafetysolutions.wpcomstaging.com/thank-you/?ff_entry_id=' . $entryId;
        // Fields ke data pass karna (agar Redirect Query String use kar rahe hain)
        if (!empty($formData['full_name'])) {
            $redirect_url .= '&name=' . urlencode($formData['full_name']);
        }
        if (!empty($formData['input_email'])) {
            $redirect_url .= '&email=' . urlencode($formData['input_email']);
        }
        wp_redirect($redirect_url);
        exit;
    }
}

add_shortcode('display_url_submission', 'show_url_submission_data');
function show_url_submission_data() {
    $name = isset($_GET['name']) ? sanitize_text_field($_GET['name']) : 'N/A';
    $email = isset($_GET['email']) ? sanitize_email($_GET['email']) : 'N/A';
    $output = '<p>Name: ' . esc_html($name) . '</p>';
    $output .= '<p>Email: ' . esc_html($email) . '</p>';
    return $output;
}

function open_links_in_new_tab_about_slides() {
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const links = document.querySelectorAll(".about-slides a");

        links.forEach(link => {
            link.setAttribute("target", "_blank");
            link.setAttribute("rel", "noopener noreferrer");
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'open_links_in_new_tab_about_slides');

/*

function force_post_only_search_results( $query ) {
    if (
        $query->is_search() &&
        !is_admin() &&
        $query->is_main_query() &&
        isset($_GET['force_post_only_search']) &&
        $_GET['force_post_only_search'] === '1'
    ) {
        // Include posts and products in search results
        $query->set( 'post_type', array( 'post', 'product' ) );
    }
}
add_action( 'pre_get_posts', 'force_post_only_search_results' );

*/

add_action('wp_footer', 'cf7_redirect_thank_you');
function cf7_redirect_thank_you() {
    if (is_page()) {
        ?>
        <script>
        document.addEventListener('wpcf7mailsent', function(event) {
            window.location.href = "https://evolutionsafetysolutions.co.uk/thank-you/";
        }, false);
        </script>
        <?php
    }
}


// 	add_action('the_content', 'add_title_above_post_content');

// function add_title_above_post_content($content) {
//     if (is_single() && in_the_loop() && is_main_query()) {
//         $title = '<h1 style="text-align:center; margin-bottom:20px;" class="heading-name">' . get_the_title() . '</h1>';
//         return $title . $content;
//     }
//     return $content;
// }


function replace_view_course_buffer_start() {
    ob_start('replace_view_course_text_in_buffer');
}
add_action('template_redirect', 'replace_view_course_buffer_start');

function replace_view_course_text_in_buffer($buffer) {
    return str_replace('View Course', 'View Options', $buffer);
}


function display_single_post_title_h1() {
    if ( is_single() ) { // Check karta hai ke single post page hai
        echo '<h1 style="text-align: center;">' . get_the_title() . '</h1>';
    }
}
add_action( 'wp_hook_before_content', 'display_single_post_title_h1' );


add_action('woocommerce_before_shop_loop', 'add_ivory_search_shortcode_to_specific_categories', 20);
function add_ivory_search_shortcode_to_specific_categories() {
    // Check if we are on the HSEQ Consultancy or Learning & Development category pages
    if (is_product_category('hseq-consultancy') || is_product_category('learning-development')) {
        echo do_shortcode('[ivory-search id="23816" title="AJAX Search Form for WooCommerce"]');
    }
}

function custom_universal_search_form() {
    ob_start();
    ?>
    <form role="search" method="get" class="custom-search-form" action="<?php echo home_url('/'); ?>">
        <input type="search" class="search-field" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
        <input type="hidden" name="post_type" value="product" />
        <button type="submit" class="search-submit">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/55/Magnifying_glass_icon.svg" alt="Search">
        </button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('universal_search', 'custom_universal_search_form');



// Add search icon with custom class inside .header-button
add_action('wp_footer', 'insert_icon_into_header_button_with_class');
function insert_icon_into_header_button_with_class() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            if ($('.header-button').length && $('.header-button i.far.fa-search.my-custom-icon').length === 0) {
                $('.header-button').append('<i class="far fa-search my-custom-icon"></i>');
            }
        });
    </script>
    <?php
}


// Insert icon and trigger .search-icon a.elementor-icon on click
add_action('wp_footer', 'insert_icon_and_trigger_search_anchor');
function insert_icon_and_trigger_search_anchor() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Step 1: Add the icon with custom class if not already added
            if ($('.header-button').length && $('.header-button i.far.fa-search.my-custom-icon').length === 0) {
                $('.header-button').append('<i class="far fa-search my-custom-icon"></i>');
            }

            // Step 2: On icon click, trigger anchor click
            $(document).on('click', 'i.my-custom-icon', function() {
                $('.search-icon a.elementor-icon')[0]?.click();
            });
        });
    </script>
    <?php
}



add_action('wp_footer', 'add_call_us_link_script_clean');
function add_call_us_link_script_clean() {
    if (is_product()) {
        ?>
        <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let bookNowBtn = document.querySelector('.single-product .cart .th-btn[name="add-to-cart"]');
            if (bookNowBtn) {
                let callLink = document.createElement("a");
                callLink.href = "tel:03333399037";
                callLink.className = "call-us";
                callLink.textContent = "CALL US";
                bookNowBtn.parentNode.insertBefore(callLink, bookNowBtn.nextSibling);
            }
        });
        </script>
        <?php
    }
}
add_action('woocommerce_before_shop_loop', 'add_search_to_shop_page', 5);

function add_search_to_shop_page() {
    if (is_shop()) {
        echo do_shortcode('[ivory-search id="23816" title="AJAX Search Form for WooCommerce"]');
    }
}

// Change the "Have a coupon?" banner text
add_filter('woocommerce_checkout_coupon_message', function() {
    return 'Got a promo? <a href="#" class="showcoupon">Click here to enter it</a>';
});

// Change the "Apply coupon" button text
add_filter('woocommerce_coupon_apply_button_text', function($text) {
    return 'Apply Promo';
});

// Change the coupon input placeholder using JavaScript
add_action('wp_footer', function() {
    if (is_checkout()) {
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var input = document.querySelector('#coupon_code');
                if (input) {
                    input.placeholder = 'Enter Promo Code';
                }
                var button = document.querySelector('button[name="apply_coupon"]');
                if (button) {
                    button.textContent = 'Apply Promo';
                }
            });
        </script>
        <?php
    }
});
add_action('wp_footer', 'move_custom_note_below_heading');
function move_custom_note_below_heading() {
    if (is_checkout()) {
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let heading = document.querySelector('h3#order_review_heading');
                let noteSection = document.querySelector('.custom-note-above-order-notes');
                let orderNotes = document.querySelector('#order_comments_field');

                if (!noteSection && orderNotes) {
                    const customNote = document.createElement('div');
                    customNote.className = 'custom-note-above-order-notes';
                    customNote.style.cssText = 'margin-bottom: 10px; font-size: 14px;';
                    customNote.innerHTML = 'Please note: Learner details are required. Whether you are booking for one person or multiple people, please ensure you include their full names and email addresses so we can send them the joining instructions.';
                    orderNotes.parentNode.insertBefore(customNote, orderNotes);
                }
            });
        </script>
        <?php
    }
}


add_filter( 'woocommerce_checkout_fields', 'make_company_name_optional' );

function make_company_name_optional( $fields ) {
    // Set the 'company' field as not required
    $fields['billing']['billing_company']['required'] = false;

    return $fields;
}


