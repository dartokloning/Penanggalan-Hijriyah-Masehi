<?php
/*
Plugin Name: Penanggalan Hijriyah dan Masehi
Plugin URI: http://www.kloningspoon.com/penanggalan-hijriyah-masehi/
Description: Menampilkan penanggalan hijriyah dan masehi dengan bahasa dan format penanggalan Indonesia
Author: Darto KLoning
Version: 2.0
Author URI: http://www.kloningspoon.com/

Copyright 2014  Darto KLoning (email: darto@kloningspoon.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA 
*/

/* ----------------------------------------------------------
Declare vars
------------------------------------------------------------- */
$PHMname = "Penanggalan Hijriyah &amp; Masehi";
$shortname = "PHM";

/* ---------------------------------------------------------
Declare options
----------------------------------------------------------- */
 
$PHM_options = array (
 
array( "name" => $PHMname." Options",
"type" => "title"),

/* ---------------------------------------------------------
Adjustment section
----------------------------------------------------------- */
array( "name" => "Penyesuaian Penanggalan // <i>Adjustment Date</i>",
"type" => "section",
"class" => "dashicons-calendar-alt"),
array( "type" => "open"),

array( "name" => "Penyesuaian // <i>Adjust</i>",
"desc" => "Contoh: -1, 1, 2 atau angka lainnya yang disesuaikan dengan penanggalan hijriyah saat ini.<br /><i>Example: -1, 1, 2 or any number that you want adjust based on your regional</i>",
"id" => $shortname."_adjust",
"type" => "text",
"std" => ""),

array( "name" => "Pemisah // <i>Separator</i>",
"desc" => "Contoh: -, /, atau dengan symbol lainnya yang anda inginkan sebagai pemisah antara tanggal hijriyyah dan tanggal masehi<br /><i>Example: -, / or any symbol that you want to use for separate between hijri and gregorian date</i>",
"id" => $shortname."_separator",
"type" => "text",
"std" => ""),

array( "name" => "CSS Style",
"desc" => "Anda bisa mengatur tampilan dari penanggalan hijriyah dan masehi dan juga separatornya. Class yang terdaftar adalah .hijriyah, .masehi dan .separator. Contoh: .hijriyah {color: green;}, .masehi {color: red;}, .separator {font-size: 24px;}<br /><i>You can customize for hijri and gregorian date and also the separator. Class that registered is .hijriyah, .masehi and .separator. Example: .hijriyah {color: green;}, .masehi {color: red;}, .separator {font-size: 24px;}</i>",
"id" => $shortname."_style",
"type" => "textarea",
"std" => ""),
 
array( "type" => "close"),


/* ---------------------------------------------------------
Name of day and month section
----------------------------------------------------------- */
array( "name" => "Merubah nama hari dan bulan // <i>Changes Day and Month Names</i>",
"type" => "section",
"class" => "dashicons dashicons-editor-rtl"),
array( "type" => "open"),

array( "name" => "Nama hari dalam Hijriyah // <i>Hijri day</i>",
"desc" => "Masukkan nama-nama hari dalam Hijriyah yang dipisahkan dengan koma:,<br /><i>Write your preferred name for hijri day with coma separator.</i>",
"id" => $shortname."_hijrday",
"type" => "text",
"std" => ""),

array( "name" => "Nama bulan dalam Hijriyah // <i>Hijri month</i>",
"desc" => "Masukkan nama-nama bulan dalam Hijriyah yang dipisahkan dengan koma:,<br /><i>Write your preferred name for hijri month with coma separator.</i>",
"id" => $shortname."_hijrmonth",
"type" => "text",
"std" => ""),

array( "name" => "Nama hari dalam Masehi // <i>Gregorian day</i>",
"desc" => "Masukkan nama-nama hari dalam masehi yang dipisahkan dengan koma:,<br /><i>Write your preferred name for gregorian day with coma separator.</i>",
"id" => $shortname."_masehiday",
"type" => "text",
"std" => ""),

array( "name" => "Nama hari dalam Masehi // <i>Gregorian month</i>",
"desc" => "Masukkan nama-nama hari dalam masehi yang dipisahkan dengan koma:,<br /><i>Write your preferred name for gregorian month with coma separator.</i>",
"id" => $shortname."_masehimonth",
"type" => "text",
"std" => ""),

array( "type" => "close")
 
);


/*---------------------------------------------------
Plugin Panel Output
----------------------------------------------------*/
function PHM_settings_page() {
    global $PHMname,$PHM_options;
    $i=0;
    $message='';
    if ( 'save' == $_REQUEST['action'] ) {
      
        foreach ($PHM_options as $value) {
            update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
      
        foreach ($PHM_options as $value) {
            if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
        $message='saved';
    }
    else if( 'reset' == $_REQUEST['action'] ) {
          
        foreach ($PHM_options as $value) {
            delete_option( $value['id'] ); }
        $message='reset';       
    }
  
    ?>
    <div class="wrap options_wrap_PHM">
        <div id="dashicons-admin-settings"></div>
        <h2><?php _e( ' Penanggalan Hijriyah &amp; Masehi<br /><i>Hijri &amp; Gregorian Date</i>' ) ?></h2>
        <?php
        if ( $message=='saved' ) echo '<div class="updated settings-error" id="setting-error-settings_updated">
        <p>'.$PHMname.' settings saved.</strong></p></div>';
        if ( $message=='reset' ) echo '<div class="updated settings-error" id="setting-error-settings_updated">
        <p>'.$PHMname.' settings reset.</strong></p></div>';
        ?>
        <div class="content_options_PHM">
            <form method="post">
  
            <?php foreach ($PHM_options as $value) {
          
                switch ( $value['type'] ) {
              
                    case "open": ?>
                    <?php break;
                  
                    case "close": ?>
                    </div>
                    </div><br />
                    <?php break;
                  
                    case "title": ?>
                    <div class="message">
                        <p>Untuk memudahkan melakukan perubahan output pada <?php echo $PHMname;?>, silahkan untuk menyesuaikan pada panel yang sudah disediakan.<br /><i>Use the option bellow to easy customize display of Hijri and Gregorian dates.</i></p>
                    </div>
                    <?php break;
                  
                    case 'text': ?>
                    <div class="option_input_PHM option_text_PHM">
                    <label for="<?php echo $value['id']; ?>">
                    <?php echo $value['name']; ?></label>
                    <input id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" name="<?php echo $value['id']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo htmlspecialchars(stripslashes(get_option( $value['id']))); } else { echo $value['std']; } ?>" />
                    <small><?php echo $value['desc']; ?></small>
                    <div class="clearfix"></div>
                    </div>
                    <?php break;
                  
                    case 'textarea': ?>
                    <div class="option_input_PHM option_textarea_PHM">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <textarea name="<?php echo $value['id']; ?>" rows="" cols=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
                    <small><?php echo $value['desc']; ?></small>
                    <div class="clearfix"></div>
                    </div>
                    <?php break;
                  
                    case "section":
                    $i++; ?>
                    <div class="input_section_PHM">
                    <div class="input_title_PHM">
                         
                        <h3><div class="dashicons <?php echo $value['class']; ?>"></div>&nbsp;<?php echo $value['name']; ?></h3>
                        <span class="submit"><input name="save<?php echo $i; ?>" type="submit" class="button-primary" value="Save changes" /></span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="all_options_PHM">
                    <?php break;
                     
                }
            }?>
          <input type="hidden" name="action" value="save" />
          </form>
          <form method="post">
              <p class="submit">
              <input class="button-primary" name="reset" type="submit" value="Reset" />
              <input type="hidden" name="action" value="reset" />
              </p>
          </form>

<?php /*---------------------------------------------------
Plugin Panel Output
----------------------------------------------------*/ ?>
<div class="input_section_PHM">
<div class="input_title_PHM">
<h3><div class="dashicons dashicons-editor-code"></div>
 Cara menggunakan // <i>How to use</i></h3>
<div class="clearfix"></div>
</div>
<div class="all_options_PHM">
<div class="shortcode_option_PHM">
<p>Untuk menampilkan penanggalan Hijriyah &amp; Masehi dengan konfigurasi standar panel, anda cukup salin dan tempel kode berikut ini di tempat di mana saja anda ingin menampilkan penanggalan Hijriyah &amp; Masehi.<br /><i>To show hijri and gregorian date with standard value from panel, copy bellow code:</i></p>
<p><code>[hijriyah-masehi]</code></p>
<br />
<p>Untuk merubah perbedaan atau untuk menyesuaikan penanggalan Hijriyah bisa menggunakan atribut <code>adjust="-1"</code>. Contoh:<br /><i>To adjust the hijri date, you could use shortcode attribut <code>adjust="-1"</code>. Example:</i></p>
<p><code>[hijriyah-masehi adjust="-1"]</code></p>
<br /><br /><br />
<p>Semoga bermanfaat<br /><i>Hope be useful</i></p>

<div class="clearfix"></div>
</div>
</div>
</div>

        </div>
        <div class="footer-credit">
            <p>This plugin was made by <a title="darto kloning" href="http://www.kloningspoon.com" target="_blank" >Darto KLoning</a>.</p>
        </div>
    </div>
    <?php }


/*---------------------------------------------------
add settings page to menu
----------------------------------------------------*/
function PHM_add_settings_page() {

add_options_page('Penanggalan Hijriyah &amp; Masehi', 'Hijri &amp; Gregorian Dates', 'manage_options', 'tanggalan.php', 'PHM_settings_page');
}


function PHM_admin_script() {
echo '<style type="text/css">.input_section_PHM{border:1px solid #ddd;border-bottom:0;background:#f9f9f9;border-radius:3px 3px 3px 3px}.option_input_PHM label{font-size:12px;font-weight:700;width:15%;display:block;float:left}.option_input_PHM{padding:30px 10px;border-bottom:1px solid #ddd;border-top:1px solid #fff}.option_input_PHM small{display:block;float:right;width:50%;color:#999}.option_input_PHM input[type="text"]{width:20%;font-size:12px;padding:4px;color:#333;line-height:1em;background:#f3f3f3}.option_input_PHM input:focus,.option_input_PHM textarea:focus{background:#fff}.option_input_PHM textarea{width:20%;height:175px;font-size:12px;padding:4px;color:#333;line-height:1.5em;background:#f3f3f3}.input_title_PHM h3{color:#464646;cursor:pointer;float:left;font-size:14px;margin:0;padding:5px 0 0;text-shadow:0 1px 0 #FFF}.input_title_PHM{cursor:pointer;border-bottom:1px solid #ddd;margin:0;padding:7px 10px;background-color:#F1F1F1;background-image:-moz-linear-gradient(center top,#F9F9F9,#ECECEC);font-size:15px;font-weight:400;line-height:1;border-bottom-color:#DFDFDF;box-shadow:0 1px 0 #FFF}.input_title_PHM h3 img{position:relative;top:-2px;vertical-align:middle;margin-right:5px}.input_title_PHM span.submit{display:block;float:right;margin:0 20px;padding:0}.clearfix{clear:both}form > p.submit{float:right;padding:0;margin-right:30px}.options_wrap_PHM > ul li{display:inline;margin-right:5px}.content_options_PHM .message{margin-top:30px}.footer-credit{margin-top:60px}shortcode_section_PHM{margin-top:100px}.shortcode_option_PHM{padding:10px;border-bottom:1px solid #ddd;border-top:1px solid #fff}</style>';
}

// Creating the widget 
class PHM_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'PHM_widget', 

// Widget name will appear in UI
__('Penanggalan Hijriyah &amp; Masehi', 'PHM_kloningspoon'), 

// Widget description
array( 'description' => __( 'Menambahkan penanggalan Hijriyah dan Masehi berbahasa Indonesia di widget', 'PHM_kloningspoon' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
echo do_shortcode( '[hijriyah-masehi]' );
echo $args['after_widget'];
}
        
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Penanggalan Hijriyah &amp; Masehi', 'PHM_kloningspoon' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
    
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class wpb_widget ends here

// Register and load the widget
function PHM_load_widget() {
    register_widget( 'PHM_widget' );
}
add_action( 'widgets_init', 'PHM_load_widget' );


function PHM_scripts() {
    $hijrday = get_option('PHM_hijrday');
    $hijrmonth = get_option('PHM_hijrmonth');
    $masehiday = get_option('PHM_masehiday');
    $masehimonth = get_option('PHM_masehimonth');
    $exp_hijrday = explode(",",$hijrday);
    $exp_hijrmonth = explode(",",$hijrmonth);
    $exp_masehiday = explode(",",$masehiday);
    $exp_masehimonth = explode(",",$masehimonth);
    echo '<style type="text/css">'.get_option('PHM_style').'</style>';
    echo '<script type="text/javascript">';
    echo 'function gmod(e,t){return(e%t+t)%t}function kuwaiticalendar(e){var t=new Date;if(e){adjustmili=1e3*60*60*24*e;todaymili=t.getTime()+adjustmili;t=new Date(todaymili)}day=t.getDate();month=t.getMonth();year=t.getFullYear();m=month+1;y=year;if(m<3){y-=1;m+=12}a=Math.floor(y/100);b=2-a+Math.floor(a/4);if(y<1583)b=0;if(y==1582){if(m>10)b=-10;if(m==10){b=0;if(day>4)b=-10}}jd=Math.floor(365.25*(y+4716))+Math.floor(30.6001*(m+1))+day+b-1524;b=0;if(jd>2299160){a=Math.floor((jd-1867216.25)/36524.25);b=1+a-Math.floor(a/4)}bb=jd+b+1524;cc=Math.floor((bb-122.1)/365.25);dd=Math.floor(365.25*cc);ee=Math.floor((bb-dd)/30.6001);day=bb-dd-Math.floor(30.6001*ee);month=ee-1;if(ee>13){cc+=1;month=ee-13}year=cc-4716;if(e){wd=gmod(jd+1-e,7)+1}else{wd=gmod(jd+1,7)+1}iyear=10631/30;epochastro=1948084;epochcivil=1948085;shift1=8.01/60;z=jd-epochastro;cyc=Math.floor(z/10631);z=z-10631*cyc;j=Math.floor((z-shift1)/iyear);iy=30*cyc+j;z=z-Math.floor(j*iyear+shift1);im=Math.floor((z+28.5001)/29.5);if(im==13)im=12;id=z-Math.floor(29.5001*im-29);var n=new Array(8);n[0]=day;n[1]=month-1;n[2]=year;n[3]=jd-1;n[4]=wd-1;n[5]=id;n[6]=im-1;n[7]=iy;return n}function writeIslamicDate(e){var t='.json_encode($exp_hijrday).';var n='.json_encode($exp_hijrmonth).';var r=kuwaiticalendar(e);var i=t[r[4]]+", "+r[5]+" "+n[r[6]]+" "+r[7]+" H";return i}now=new Date;if(now.getTimezoneOffset()==0)a=now.getTime()+7*60*60*1e3;else a=now.getTime();now.setTime(a);var tahun=now.getFullYear();var hari=now.getDay();var bulan=now.getMonth();var tanggal=now.getDate();var hariarray='.json_encode($exp_masehiday).';var bulanarray='.json_encode($exp_masehimonth);
    echo '</script>';
}


// create hijr calendar shortcode
function hijr_calendar($atts, $content = null) {  
    extract(shortcode_atts(array(  
        "adjust"       => ''
    ), $atts));

    return '<script type="text/javascript">document.write("<span class=\"hijriyah\">"+ writeIslamicDate('.get_option('PHM_adjust').')+"</span><span class=\"separator\">'.get_option('PHM_separator').'</span><span class=\"masehi\">"+tanggal+" "+bulanarray[bulan]+" "+tahun+" M</span>");</script>';  
}

add_shortcode("hijriyah-masehi", "hijr_calendar");

/*---------------------------------------------------
add actions
----------------------------------------------------*/
add_action( 'admin_menu', 'PHM_add_settings_page' );
add_action('admin_head', 'PHM_admin_script');
add_action('wp_head', 'PHM_scripts');

?>
