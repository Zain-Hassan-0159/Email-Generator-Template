<?php 

/**

* Plugin Name: Email Template Generator 
* Version: 1.0.0
* Author: Zain Hassan
*/

if(!defined('ABSPATH')){
    exit;
}
    

register_activation_hook( __FILE__, 'signaturegenerator' );
function signaturegenerator() {

    $post_id = -1;

    // Setup custom vars
    $author_id = 1;
    $slug = 'signature-generator';
    $title = 'Email Signature HTML Generator';

    // Check if page exists, if not create it
    if ( null == get_page_by_title( $title )) {

        $profileImger_page = array(
            'comment_status'        => 'closed',
            'ping_status'           => 'closed',
            'post_author'           => $author_id,
            'post_name'                     => $slug,
            'post_title'            => $title,
            'post_status'           => 'publish',
            'post_type'                     => 'page'
        );

        $post_id = wp_insert_post( $profileImger_page );


        if ( !$post_id ) {

            wp_die( 'Error creating template page' );

        } else {

            update_post_meta( $post_id, '_wp_page_template', 'email_generator.php' );

        }
    } // end check if

}

add_action( 'template_include', 'uploadr_redirect' );
function uploadr_redirect( $template ) {

    $plugindir = dirname( __FILE__ );

    if ( is_page_template( 'email_generator.php' )) {

        $template = $plugindir . '/email_generator.php';
    }

    return $template;

}


register_deactivation_hook( __FILE__, 'deactivate_plugin' );
function deactivate_plugin() {
    wp_delete_post(get_page_by_path('signature-generator')->ID, true);
}



add_action('wp_ajax_generateEmailSignature', 'generateEmailSignature_callback_mail');
add_action('wp_ajax_nopriv_generateEmailSignature', 'generateEmailSignature_callback_mail');

function generateEmailSignature_callback_mail(){

	$name  			        =	$_POST['Sender']['name'];
	$variation  			=	$_POST['Sender']['variation'];
    $broker     		    =	$_POST['Sender']['broker'];
    $realtor   				=	$_POST['Sender']['realtor'];
    $designations        	=	$_POST['Sender']['designations'];
    $phone       		    =	$_POST['Sender']['phone'];
    $web       		        =	$_POST['Sender']['web'];
	
	$url = parse_url($web);
	if($url['scheme'] !== 'https' &&  $url['scheme'] !== 'http' && $web !==""){
	    $web  =	'https://' . $web;
	}
	
    $award1 				=	$_POST['Sender']['award1'];
    $award2				    =	$_POST['Sender']['award2'];
    $award3	        	    =	$_POST['Sender']['award3'];
    $video	        	    =	$_POST['Sender']['video'];
	$url = parse_url($video);
	if($url['scheme'] !== 'https' &&  $url['scheme'] !== 'http' && $video !==""){
	    $video  =	'https://' . $video;
	}
    $facebook	        	=	$_POST['Sender']['facebook'];
	$url = parse_url($facebook);
	if($url['scheme'] !== 'https' &&  $url['scheme'] !== 'http' && $facebook !==""){
	    $facebook  =	'https://' . $facebook;
	}
	
    $instagram	        	=	$_POST['Sender']['instagram'];
	$url = parse_url($instagram);
	if($url['scheme'] !== 'https' &&  $url['scheme'] !== 'http' && $instagram !==""){
	    $instagram  =	'https://' . $instagram;
	}
	
    $linkedin	        	=	$_POST['Sender']['linkedin'];
	$url = parse_url($linkedin);
	if($url['scheme'] !== 'https' &&  $url['scheme'] !== 'http' && $linkedin !==""){
	    $linkedin  =	'https://' . $linkedin;
	}
	
    $pinterest	        	=	$_POST['Sender']['pinterest'];
	$url = parse_url($pinterest);
	if($url['scheme'] !== 'https' &&  $url['scheme'] !== 'http' && $pinterest !==""){
	    $pinterest  =	'https://' . $pinterest;
	}
	
    $security	        	=	$_POST['security'];
    $profileImg = '';
    $arr_img_ext = array('image/png', 'image/jpeg', 'image/jpg');
    if (in_array($_FILES['Sender']['type']["yourImg"], $arr_img_ext)) {
        $profileImg = wp_upload_bits($_FILES["Sender"]["name"]["yourImg"], null, file_get_contents($_FILES["Sender"]["tmp_name"]["yourImg"]));
    }


    // var_dump($profileImg);
    // exit;

	if( check_ajax_referer('form_Signature', 'security') ){
        ob_start();
        ?>
            <table id="signature_generated_form" border="0" cellspacing="0" cellpadding="0" <?php echo $variation === 'right' ? 'style= "margin-left: auto;"' : ""; ?> >
                <!-- NAME | TITLE | PORCHLIGHT REAL ESTATE GROUP -->
                <tr valign="bottom">
                        <td style="padding-bottom:8px;"><span style="text-align:left; color:#414042; font-family: 'FreightDisp Pro', Georgia, serif; font-style:normal; font-size:20px; font-weight:700"><?php 
                        if($variation !== 'simple' && $profileImg !== ''){
                            ?>
                            <img style="height: 50px;" src="<?php echo $profileImg['url']; ?>" alt=""></br>
                            <?php
                        }
                        echo $name; ?></span><br />
                    <span style="color:#6d6e71; font-family: 'Proxima Nova', 'Helvetica Neue', 'sans-serif'; font-style:normal; font-size:12px; font-weight:500">
                    <?php if($broker !== ''){
                        echo $broker;
                        echo "<br />";
                    } ?><?php echo $designations !=='' ? $designations . "<br />" : ""; ?>
                    <?php echo $realtor == 'yes' ? "REALTOR®" : ""; ?></span></td>
                    </tr>
                <!-- CELL PHONE | MAIN PHONE --> 
                    <tr valign="bottom">
                        <td style="padding-bottom:8px;"><span style="text-align:left; color:#414042; font-family: 'Proxima Nova', 'Helvetica Neue', 'sans-serif'; font-size:12px; font-style:normal; font-weight:600;"><?php echo $phone !== "" ? $phone . "<br />" : ""; ?>
                        <?php 
                        if($web !== ''){
                            ?>
                            <a href="<?php echo $web; ?>" style="text-decoration:none !important; color:#525249;"><?php echo $web; ?></a>
                            <?php
                        }
                        ?>
                </span></td>
                    </tr> 
                    
                <!-- AWARDS | AGENT VIDEO --> 
                    <tr valign="bottom">
                        <td style="padding-bottom:8px"><span style="color:#6d6e71; font-family: 'Proxima Nova', 'Helvetica Neue', 'sans-serif'; font-style:normal; font-size:12px; font-weight:500">
                        <?php echo $award1 !=='' ? $award1 . "<br />" : ""; ?><?php echo $award2 !=='' ? $award2 . "<br />" : ""; ?><?php echo $award3 !=='' ? $award3 . "<br />" : ""; ?>
                        </span>
                        <?php
                        if($video !== ''){
                            ?>
							<a href="<?php echo $video; ?>"><span style="text-align:left; color:#6d6e71; font-family: 'Proxima Nova', 'Helvetica Neue', 'sans-serif'; font-size:12px; font-weight:500; line-height:14pt">Watch my video to learn more.</span></a>
                            <?php
                        }
                        ?>
                    </td>
                    </tr>
                    <tr>
                        <td style="padding: 13px 0 20px;" >
                            <a href="https://porchlighthub.store/" >
								<img style="height: 35px" src="https://porchlighthub.store/wp-content/uploads/2022/11/PL_logo-rgb_horizontal_persimmon-1-1.png" height="35" nosend="1" title="Porchlight">
							</a>
                        </td>
                    </tr>
                    
                <!-- SOCIAL ICONS -->
                <tr valign="middle" height="50">  
                    <td style="border-top-color:#e6e7e8; border-top-width:2px; border-top-style: solid">
                        <?php
                        if($facebook !== ''){
                            ?>
                            <a href="<?php echo $facebook; ?>">
                            <img src="https://s3.amazonaws.com/files.usmre.com/8484/signaturegfx/2021/2021_fb-logo.png" height="50" nosend="1" title="Facebook" alt="Facebook"></a>
                            <?php
                        }
                        if($instagram !== ''){
                            ?>
                            <a href="<?php echo $instagram; ?>">
                            <img src="https://s3.amazonaws.com/files.usmre.com/8484/signaturegfx/2021/2021_insta-logo.png" height="50" nosend="1" title="Instagram" alt="Instagram"></a>
                            <?php
                        }
                        if($linkedin !== ''){
                            ?>
                            <a href="<?php echo $linkedin; ?>">
                            <img src="https://s3.amazonaws.com/files.usmre.com/8484/signaturegfx/2021/2021_linkedin-logo.png" height="50" nosend="1" title="LinkedIn" alt="LinkedIn"></a>
                            <?php
                        }
                        if($pinterest !== ''){
                            ?>
                            <a href="<?php echo $pinterest; ?>">
                            <img src="https://s3.amazonaws.com/files.usmre.com/8484/signaturegfx/2021/2021_pinterest-logo.png" height="50" nosend="1" title="Pinterest" alt="Pinterest"></a>
                            <?php
                        }
                        ?>
                        <img src="https://s3.amazonaws.com/files.usmre.com/8484/signaturegfx/2021/2021_spacer.png" height="50" nosend="1" title="spacer" alt="spacer">
                        <img src="https://s3.amazonaws.com/files.usmre.com/8484/signaturegfx/2021/2021_spacer.png" height="50" nosend="1" title="spacer" alt="spacer">
                        <a href="https://www.leadingre.com/ourcompanies/porchlight-real-estate-group/113326">
                        <img src="https://s3.amazonaws.com/files.usmre.com/8484/signaturegfx/2021/2021_leadingre-logo.png" height="50" nosend="1" title="Leading RE" alt="Leading RE logo"></a>
                        <img src="https://s3.amazonaws.com/files.usmre.com/8484/signaturegfx/2021/2021_verticalline.png" height="50" nosend="1" title="vertical line" alt="vertical line spacer">
                        <a href="https://www.luxuryportfolio.com/brokers/porchlight-real-estate-group">
                        <img src="https://s3.amazonaws.com/files.usmre.com/8484/signaturegfx/2021/2021_lpint-logo.png" height="50" nosend="1" title="Luxury Portfolio International" alt="LPI logo"></a>
                    </td>
                </tr>
            </table>
        <?php
        $content = ob_get_clean();
        echo $content;
        ?>
        <div class="code" style="margin-top: 20px">
            <button onClick="copyToClickBoard()">Copy</button>
            <textarea id="textareaForCode" style="width: -webkit-fill-available;" rows="10">
                <?php  echo $content; ?></textarea>
        </div>
        <?php
	}else{
		echo "incorrect";
	}
	wp_die();
}




function insert_jquery(){
	?>
   <script>
        // function download() {
        //     var el = document.getElementById("signature_generated");
        //     var a = document.body.appendChild(
        //        document.createElement("a")
        //     );
        //    a.download = "newfile.html";
        //    a.href = 'data:text/html,' + el;
        //    a.click(); //Trigger a click on the element
        // }

        function copyToClickBoard(){
            document.getElementById("textareaForCode").select();
            document.execCommand('copy');
  
        }
            

        // ON Form Submit
        function profileOption(value){
            console.log(event);
            if(value === "simple"){
                document.querySelector("#email_Generator_Form #form .profile_image").classList.add("d-none")
            }else{
                document.querySelector("#email_Generator_Form #form .profile_image").classList.remove("d-none")
            }
            
        }
        jQuery("#email_Generator_Form #form").submit(function (event) {
            event.preventDefault();
            // Collecting the whole form data

        form_data = new FormData(this);
        form_data.append('action', 'generateEmailSignature');
        form_data.append('security', '<?php echo wp_create_nonce( 'form_Signature' ); ?>');

    
        // Transfering data through AJAX
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                document.querySelector("#generating_file").innerHTML = response;
            }
        });

        return false;
        
        });

    </script>
	<?php
	}
	add_filter('wp_footer','insert_jquery');