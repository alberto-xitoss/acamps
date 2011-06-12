<?php

function barcode_image($file, $bars, $scale = 1, $height = 0){
	/* set defaults */
	if ($scale < 1) $scale = 1;
	$height = (int)($height);
	if ($height < 1) $height = (int)$scale * 30;
	
	/* count total width */
	$width = 0;
	for ( $i=0; $i<strlen($bars); $i++ ){
		$width += $bars[$i]*$scale;
	}

	/* allocate the image */
	$im = imagecreate($width, $height);
	$bg_color = imagecolorallocate($im, 255, 255, 255); //White
	$bar_color = imagecolorallocate($im, 0, 0, 0); //Black

	/* paint the bars */
	$xpos = 0;
	$swap=true;
	for ($i=0;$i<strlen($bars);$i++){
		if ($swap){
			imagefilledrectangle($im, $xpos, 0, $xpos+($bars[$i]*$scale)-1, $height, $bar_color);
			$xpos += $bars[$i]*$scale;
		}else{
			$xpos += $bars[$i]*$scale;
		}
		$swap = !$swap;
	}
	
        
	/* output the image */
	
	//header("Content-Type: image/png; name=\"barcode.png\"");
	//$CI =& get_instance();
	//$CI->firephp->warn($im);
	//$CI->firephp->warn($file);
	return imagepng($im, $file);
}

function barcode_table($bars, $scale = 1, $height = 0){
	/* set defaults */
	if ($scale < 1) $scale = 1;
	$height = (int)($height);
	if ($height < 1) $height = (int)$scale * 30;
	
	$out = '<table border=0 cellspacing=0 cellpadding=0 bgcolor="white">'."\n";
	$out .= '<tr><td>';
	
	$swap = true;
	for( $i=0; $i<strlen($bars); $i++){
		if($swap)
			$out .= '<div style="display:inline-block;background-color:#000;height:'.$height.';width:'.$bars[$i]*$scale.'" ></div>';
		else
			$out .= '<div style="display:inline-block;background-color:#FFF;height:'.$height.';width:'.$bars[$i]*$scale.'" ></div>';
		$swap = !$swap;
	}
	
	$out .= '</td></tr>'."\n";
	$out .= '</table>'."\n";

	return $out;
}

function encode_128C($string){
        $start = "211232";
        $end = "2331112";
        $patterns = array
        (
                "212222", /* 00 */
                "222122", /* 01 */
                "222221", /* 02 */
                "121223", /* 03 */
                "121322", /* 04 */
                "131222", /* 05 */
                "122213", /* 06 */
                "122312", /* 07 */
                "132212", /* 08 */
                "221213", /* 09 */
                "221312", /* 10 */
                "231212", /* 11 */
                "112232", /* 12 */
                "122132", /* 13 */
                "122231", /* 14 */
                "113222", /* 15 */
                "123122", /* 16 */
                "123221", /* 17 */
                "223211", /* 18 */
                "221132", /* 19 */
                "221231", /* 20 */
                "213212", /* 21 */
                "223112", /* 22 */
                "312131", /* 23 */
                "311222", /* 24 */
                "321122", /* 25 */
                "321221", /* 26 */
                "312212", /* 27 */
                "322112", /* 28 */
                "322211", /* 29 */
                "212123", /* 30 */
                "212321", /* 31 */
                "232121", /* 32 */
                "111323", /* 33 */
                "131123", /* 34 */
                "131321", /* 35 */
                "112313", /* 36 */
                "132113", /* 37 */
                "132311", /* 38 */
                "211313", /* 39 */
                "231113", /* 40 */
                "231311", /* 41 */
                "112133", /* 42 */
                "112331", /* 43 */
                "132131", /* 44 */
                "113123", /* 45 */
                "113321", /* 46 */
                "133121", /* 47 */
                "313121", /* 48 */
                "211331", /* 49 */
                "231131", /* 50 */
                "213113", /* 51 */
                "213311", /* 52 */
                "213131", /* 53 */
                "311123", /* 54 */
                "311321", /* 55 */
                "331121", /* 56 */
                "312113", /* 57 */
                "312311", /* 58 */
                "332111", /* 59 */
                "314111", /* 60 */
                "221411", /* 61 */
                "431111", /* 62 */
                "111224", /* 63 */
                "111422", /* 64 */
                "121124", /* 65 */
                "121421", /* 66 */
                "141122", /* 67 */
                "141221", /* 68 */
                "112214", /* 69 */
                "112412", /* 70 */
                "122114", /* 71 */
                "122411", /* 72 */
                "142112", /* 73 */
                "142211", /* 74 */
                "241211", /* 75 */
                "221114", /* 76 */
                "413111", /* 77 */
                "241112", /* 78 */
                "134111", /* 79 */
                "111242", /* 80 */
                "121142", /* 81 */
                "121241", /* 82 */
                "114212", /* 83 */
                "124112", /* 84 */
                "124211", /* 85 */
                "411212", /* 86 */
                "421112", /* 87 */
                "421211", /* 88 */
                "212141", /* 89 */
                "214121", /* 90 */
                "412121", /* 91 */
                "111143", /* 92 */
                "111341", /* 93 */
                "131141", /* 94 */
                "114113", /* 95 */
                "114311", /* 96 */
                "411113", /* 97 */
                "411311", /* 98 */
                "113141", /* 99 */
                "114131", /* CODE B */
                "311141", /* CODE A */
                "411131" /* FNC 1 */
        );
        
        //-----------------------------------------------------------
        $sum = 105; // Valor do StartCode da codificação 128C;
        for( $i=0; $i<strlen($string)/2; $i++ ) {
                $sum += (int)($string[$i*2].$string[$i*2+1]) * ($i+1);
        }
        $check = $patterns[$sum % 103];
        //-----------------------------------------------------------
        $bar = $start;
        
        for( $i=0; $i<strlen($string); $i+=2 ) {
                $bar .= $patterns[(int)($string[$i].$string[$i+1])];
        }
        $bar .= $check;
        $bar .= $end;
        //-----------------------------------------------------------
        return $bar;
} 