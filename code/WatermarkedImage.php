<?php

class WatermarkedImage extends Image {
	static $backend = "GDWatermarkBackend";

	public function addWatermark($watermark) {
		return $this->getFormattedImage('addWatermark', $watermark);
	}


	/**
	 * Generate a resized copy of this image with the given width & height.
	 * Use in templates with $ResizedImage.
	 * 
	 * @param Image_Backend $backend
	 * @param integer $width Width to resize to
	 * @param integer $height Height to resize to
	 * @return Image_Backend
	 */
	public function generateaddWatermark(Image_Backend $backend, $watermark) {
		if(!$backend){
			user_error("Image::generateFormattedImage - generateResizedImage is being called by legacy code"
				. " or Image::\$backend is not set.",E_USER_WARNING);
		}else{
			return $backend->addWatermark($watermark);
		}
	}

}