# silverstripe-watermark

include into your Silverstripe directory

Usage: Add a watermarked image somewhere (could be in the CMS or otherwise).

Call addWatermark() on your image, and pass to it an image object (the watermark)

```
public function getWaterMarkedImage() {
	$watermarkImageObject = $this->Page()->Watermark();
	return $this->HighResolutionDownload()->addWatermark($watermarkImageObject);
}
```
