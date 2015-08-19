<?php

class GDWatermarkBackend extends GDBackend {

	private static $default_quality = 100;

	public function addWatermark($watermark) {
		if(!$this->gd) return;
		
		$newGD = imagecreatetruecolor($this->width, $this->height);
		// Preserves transparency between images
		imagealphablending($newGD, true);
		imagesavealpha($newGD, true);

    	imagecopy($newGD, $this->gd, 0, 0, 0, 0, $this->width, $this->height);

		// Load the stamp and the photo to apply the watermark to
		$stamp = imagecreatefrompng($watermark->getFullPath());

		// Set the margins for the stamp and get the height/width of the stamp image

		$sx = imagesx($stamp);
		$sy = imagesy($stamp);

		//bang in the middle
		$dest_x =  ceil(($this->width / 2));
        $dest_x -= ceil(($watermark->width / 2));
        $dest_y =  ceil(($this->height / 2));
        $dest_y -= ceil(($watermark->width / 2));

        //be safe prevent negatives
        if($dest_x < 0) $dest_x = 0;
        if($dest_y < 0) $dest_y = 0;

        // SS_Log::log('dest x: '.$dest_x.' dest y: '.$dest_y, SS_Log::ERR);

		// Copy the stamp image onto our photo using the margin offsets and the photo 
		// width to calculate positioning of the stamp. 
		imagecopymerge($newGD, 
			$stamp, 
			$dest_x, 
			$dest_y, 
			0, 
			0, 
			imagesx($stamp), 
			imagesy($stamp),
			50
		);

		$output = clone $this;
		$output->setImageResource($newGD);
		return $output;
	}

}