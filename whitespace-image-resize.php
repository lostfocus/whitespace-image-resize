<?php
/*
Plugin Name: Whitespace Image Resize
Plugin URI: http://lostfocus.de
Description: Rewrites the image urls to use TimThumb to resize and add whitespace instead of cropping
Version: 1.1
Author: Dominik Schwind
Author URI: http://lostfocus.de/
License: GPL2
*/

/*  Copyright 2014  Dominik Schwind  (email : dschwind@lostfocus.de)

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

function whitespace_image_resize($unused ,$post_ID, $size){
    global $_wp_additional_image_sizes;
    if(!isset($_wp_additional_image_sizes[$size])) return false;
    extract($_wp_additional_image_sizes[$size]);
    $url = wp_get_attachment_url($post_ID);
    $tturl = plugins_url('timthumb.php',__file__);
    $tturl = $tturl."?src=".urlencode($url);
    if($height < 999) $tturl .= "&h=" . $height;
    if($width < 999) $tturl .= "&w=".$width;
    if($crop) $tturl .= "&zc=2";
    return array( $tturl, $width, $height, true );
}

add_action( 'image_downsize', 'whitespace_image_resize',10,3);