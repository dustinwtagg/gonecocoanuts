<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

class wpApeGalleryRenderHelperClass {
	
	private $optionsArray = array();
	
	private $id = 0;

	public function setId( $id){
		$this->id = $id;
	}

	public function setValue( $valName, $value, $type='string'){
		switch ($type) {
			case 'raw':      break;
			case 'string':
				$value = '"'.$value.'"'; break;
			case 'int':
				$value = (int)$value; 	break;
			case 'bool':
				if($value !='true' && $value !='false') $value = "false";
				break;
		}
		$this->optionsArray[] = '"'.$valName . '": '.$value;
	}

	public function addParam( $valName, $type = 'string' , $default = '' ){
		$value = get_post_meta( $this->id,  WPAPE_GALLERY_NAMESPACE.$valName, true );
		if($type=='bool'){
			if($value==1) $value = 'true';
			if(!$value) $value = 'false';
		}
		$this->setValue($valName , $value, $type);
	}

	public function getOptionList(){
		if( !isset($this->optionsArray) || !count($this->optionsArray) ) return '';
		return implode( ', ' , $this->optionsArray);
	}

	public function addWidth( $colums, $index ){
		$ret = array();
		if( isset($colums['autowidth'.$index]) ){
			$ret[] = '"columnWidth": "auto"';
			if($colums['colums'.$index]) $ret[] =  '"columns":'.$colums['colums'.$index];
		} elseif($colums['width'.$index]){
			$ret[] = '"columnWidth": '.$colums['width'.$index];
		}
		if( count($ret) ){
			switch ($index) {
				case '1': $r = '960'; break;
				case '2': $r = '650'; break;
				case '3': $r = '450'; break;
			}
			$ret[] = '"maxWidth": '.$r;
			return '{'.implode( ' , ', $ret ).'}';
		} else return '';
	}

} ?>