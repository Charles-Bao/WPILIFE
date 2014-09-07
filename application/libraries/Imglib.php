<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Imglib
{

	public $CI = NULL;
	public function __construct()
	{	
		$this->CI =& get_instance();
		$this->CI->load->helper('security');
	}

	public function ImageUpload($sizeLimit = 9999,$widthLimit = 9999, $heightLimit = 9999 ) //default sizeLimit=3072 widthLimit=3k heightLimit=3k 
	{
		$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/images/shop/';
		$config['allowed_types'] = 'gif|jpg|png|bmp';
		$config['max_size']	= $sizeLimit;
		$config['max_width']  = $widthLimit;
		$config['max_height']  = $heightLimit;

		$this->CI->load->library('upload', $config);
		$this->CI->upload->initialize($config);
		if ( ! $this->CI->upload->do_upload())
		{
			$data = array(
					'key' 	=> false,
					'data'  => $this->CI->upload->display_errors()
					);
			//echo $this->CI->upload->display_errors();
			return $data;
		}
		else
		{
			$data = array(
					'key'	=> true,
					'data'  => $this->CI->upload->data()
				);
			//print_r($this->CI->upload->data());
			return $data;
		}
	}

	function createThumb( $image, $path='/images/', $width=400, $height=325, $prefix = "")
	{
		$prefix = trim($prefix);
		if($prefix == "")
		{
			$newImages = substr_replace($image, '_small', -4, 0);
		}
		else
		{
			$newImages = $prefix.$image;
		}

		//$newImages = substr_replace($image, '_small', -4, 0);
		$ResizedImage = substr_replace($image, '_resize', -4, 0);
		
		$pathToImages = $_SERVER['DOCUMENT_ROOT'].$path.$image;
		$pathToNewImages = $_SERVER['DOCUMENT_ROOT'].$path.$newImages;
		$pathToResizedImage = $_SERVER['DOCUMENT_ROOT'].$path.$ResizedImage;
		
		list($originalWidth, $originalHeight) = getimagesize($pathToImages);
		$ratio = $width/$height;
		$orginalRatio = $originalWidth/$originalHeight;
		if($orginalRatio < $ratio)
		{
			$resizeWidth = $width;
			$resizeHeight = $width/$orginalRatio;
			$cropX = 0;
			$cropY = ($resizeHeight - $height)/2;
		}
		else
		{
			$resizeHeight = $height;
			$resizeWidth = $height*$orginalRatio;
			$cropX = ($resizeWidth - $width)/2;
			$cropY = 0;
		}
		//echo $originalWidth."-111-". $originalHeight."-222-";
		//die($ratio);
		//die($pathToImages);

		//RESIZE
		$config = array(
	        'image_library' 	=> 'gd2',
	        'quality' 			=> '100%',
	        'source_image' 		=>  $pathToImages,
	        'maintain_ratio' 	=> false,
	        'new_image' 		=> $pathToResizedImage,
	        'create_thumb' 		=> false,
	        'width' 			=> $resizeWidth,
	        'height' 			=> $resizeHeight
	    );     

		
		$this->CI->load->library('image_lib', $config); 
		$this->CI->image_lib->initialize($config);
		if($this->CI->image_lib->resize())
		{
			$this->CI->image_lib->clear();
		}
		else
		{
			return false;
		}
		
		//CROP
		$config = array(
	        'image_library' 	=> 'gd2',
	        'quality' 			=> '100%',
	        'source_image' 		=> $pathToResizedImage,
	        'x_axis' 			=> $cropX,
	        'y_axis' 			=> $cropY,
	        'new_image' 		=> $pathToNewImages,
	        'maintain_ratio' 	=> false,
	        'create_thumb' 		=> false,
	        'width' 			=> $width,
	        'height' 			=> $height
	    );     

		
		$this->CI->load->library('image_lib', $config); 
		$this->CI->image_lib->initialize($config);
		if($this->CI->image_lib->crop())
		{
			unlink($pathToResizedImage);
			$this->CI->image_lib->clear();
			return $newImages;
		}
		else
		{
			 return false;
		}
		
	}
	

	
	function addWaterMarking($imagePath)
	{
		$imagePath = $_SERVER['DOCUMENT_ROOT'].'/elfinder/files/'.$imagePath;
		$waterMarkingPath = $_SERVER['DOCUMENT_ROOT']."/images/logo_waterMark.png";
		$config['source_image']	= $imagePath;
		$config['wm_overlay_path'] = $waterMarkingPath;
		$config['wm_type'] = 'overlay';
		$config['wm_opacity'] = 50;
		$config['wm_x_transp']	= 4;
		$config['wm_y_transp'] = 4;
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'right';
		//$config['padding'] = '20';

		$this->CI->load->library('image_lib', $config); 
		$this->CI->image_lib->initialize($config);

		$this->CI->image_lib->watermark();

	}

	function getAlbums()
	{
		$albumList = array();
		if ($handle = opendir($_SERVER['DOCUMENT_ROOT'].'/elfinder/files'))
		{
			while (false !== ($album = readdir($handle))) 
			{
				if ($album[0] != "." ) 
				{
					array_push($albumList, $album);
				}
				
			}
			closedir($handle);
		}
		return $albumList;
	}

	function getImagesForAlbum($album)
	{
		$imageList = array();
		// check, the album path cannot be null or hidden folder
		$album = trim($album);
		if( $album== "" || $album[0] == ".") return false;

		if ($handle = opendir($_SERVER['DOCUMENT_ROOT'].'/elfinder/files/'.$album)) 
		{
			// This is the correct way to loop over the directory. 
			while (false !== ($image = readdir($handle))) 
			{
				if ($image[0] != "." ) 
				{
					array_push($imageList, $image);
				}
				
			}
			closedir($handle);

			return $imageList;
		}
		else
		{
			return false;
		}
		
	}
	
}
?>
