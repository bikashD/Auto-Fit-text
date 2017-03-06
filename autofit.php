<?php
class  Auto_fit_text_test extends CI_Model {

	function textBox($arr,$i){

		extract($arr);
		extract($prop);

		$draw = new ImagickDraw();
		$image = new Imagick();

		$image->readimageblob($i);

		$text = strtr(utf8_decode($text), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');

        $message = preg_replace( "/[^a-zA-Z ]/", '', "$text");

        $align = $text_align;

		$font_to_use = "/var/www/meaww/fonts_test/" . $font_to_use;
		$word_spacing = 15;

		$draw->setFillColor($font_color);
		$draw->setFont($font_to_use);
		$font_size = $height;

        $font = new Imagick();

        $d = "";

        do {
				$d = imagettfbbox($font_size, 0,$font_to_use , "$message");
				$font_size--;
        }while($height <= (abs($d[1] + $d[7])));

        do {
				$d = imagettfbbox($font_size, 0, $font_to_use, "$message");
				$font_size--;
        }while($width <= abs($d[2]));
		
		$draw->setFontSize($font_size );

        if($align == 1){

            $font_metrics = $font->queryFontMetrics($draw, "$message");
            $text_width = $font_metrics['textWidth'];
			$draw->setTextAlignment(Imagick::ALIGN_LEFT);
			$draw->rotate($rotate_angle);
			if($bold_strength!=0){
				$draw->setStrokeColor($font_color);
				$draw->setStrokeColor($stroke_color);
				$draw->setStrokeWidth($bold_strength);
			}
			$draw->setTextDecoration($decoration);
			if(isset($word_spacing))
				$draw->setTextInterwordSpacing($word_spacing);
			$draw->annotation($width_offset + 3, $height_offset + $height - $font_size*2/10 , "$message");
			$image->drawImage($draw);

        }elseif($align == 2){
            $font_metrics = $font->queryFontMetrics($draw, "$message");
            $text_width = $font_metrics['textWidth'];
			$draw->setTextAlignment(Imagick::ALIGN_CENTER);
			$draw->rotate($rotate_angle);
			if($bold_strength!=0){
				$draw->setStrokeColor($font_color);
				$draw->setStrokeColor($stroke_color);
				$draw->setStrokeWidth($bold_strength);
			}
			$draw->setTextDecoration($decoration);
			if(isset($word_spacing))
				$draw->setTextInterwordSpacing($word_spacing);
			$draw->annotation($width_offset + $width/2 ,$height_offset + $height/2 + $font_size /2, "$message");
			$image->drawImage($draw);

        }elseif($align == 3){

            $font_metrics = $font->queryFontMetrics($draw, "$message");
            $text_width = $font_metrics['textWidth'];
			$draw->setTextAlignment(Imagick::ALIGN_RIGHT);
			$draw->rotate($rotate_angle);
			if($bold_strength!=0){
				$draw->setStrokeColor($font_color);
				$draw->setStrokeColor($stroke_color);
				$draw->setStrokeWidth($bold_strength);
			}
			$draw->setTextDecoration($decoration);
			if(isset($word_spacing))
				$draw->setTextInterwordSpacing($word_spacing);			
			$draw->annotation($width_offset + $width , $height_offset + $height - $font_size*2/10, "$message");
			$image->drawImage($draw);
        }

		return $image->getImageBlob();
	}
}