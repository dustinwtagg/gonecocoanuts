<?php
/*
*      Robo Gallery     
*      Version: 1.3.5
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2016, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/

if(!defined('WPINC'))die;
if(!defined("ABSPATH"))exit;

class Robo_Gallery_Activator {
	public static function activate() {
		delete_option("robo_gallery_after_install");
		add_option( 'robo_gallery_after_install', '1' );
	}

	public static function deactivate() {

	}
}
