<?php
//=======================================================================
// File:	PDF417_BACKENDS.INC
// Description:	Backen modules to handle image and PS output
// Created: 	2004-02-25
// Author:	Johan Persson (johanp@aditus.nu)
// Ver:		$Id: pdf417_backends.inc.php 506 2006-02-04 15:56:23Z ljp $
//
// License:	This code is released under JpGraph Professinoal License
// Copyright (C) 2004 Johan Persson
//========================================================================
// TODO: Remove degubg from Stroke
DEFINE('ADD_DEMOTXT',false);

// Backends
DEFINE("BACKEND_IMAGE",'IMAGE');
DEFINE("BACKEND_PS",'PS');

//--------------------------------------------------------------
// BarcodePrintSpec 
// All encodings gets translated to this uniform format which
// is captured by this class. This information is then send to
// the backend which is responsible for the actual generation of
// the image.
//--------------------------------------------------------------
class BarcodePrintSpec {

    // Width (in pixels) of each module
    public $iModuleWidth=1;
    // Encoding used
    public $iEncoding;
    // Original data
    public $iData;
    // String to print to left of barcode (small font)
    public $iLeftData;
    // String to print to the right of barcode (small font)
    public $iRightData;
    // Left margin (number of modules) before left guard
    public $iLeftMargin=15;
    // Right margin (number of modules) after right guard
    public $iRightMargin=15;

    // Bar specification as an array
    // array(array(ENCODED_CHAR,PARITY,LENGTH,ENCODING),...)
    // ENCODED_CHAR = ASCII representation of encoded char
    //                For special chracters like left and right
    //                guard this is coded as 0
    // PARITY = 0-Start with space, 1-Start with black
    // HIDECHAR = 1-Don't print data underneath, 0-Make bar short and print data char
    // ENCODING = Module width encoding, e.g. 2311 (UPC-A)
    // 
    public $iBar;
    // Small and large font size
    public $iFontSizeLarge=12, $iFontSizeSmall=10;
    // Some code need an extra inter character module space
    // which isn't encoded in the symbols
    public $iInterCharModuleSpace=false;
    // Stroke data over or under bar centered
    public $iStrokeDataAbove=false, $iStrokeDataBelow=false;
    // Custom information string that can be used to display 
    // debug information for a specific encoding
    public $iInfo;

    function BarcodePrintSpec() {
	$this->iBar = array();
    }

    function ToString() {
	$r='';
	$n=count($this->iData);
	//print_r($this->iData);echo "<p>";
	/*
	    for( $i=0; $i < $n; ++$i ) {
		$t=$this->iData[$i][0];
		switch($t) {
		    case 0: $r .= "[TC], '".$this->iData[$i][1]."'<br>\n"; break;
		    case 1: $r .= "[NC], '".$this->iData[$i][1]."'<br>\n"; break;
		    case 2: $r .= "[BC], '".$this->iData[$i][1]."'<br>\n"; break;
		}
	    }
	*/
	$n=count($this->iBar);
	for( $i=0; $i < $n; ++$i ) {
	    $m = count($this->iBar[$i]);
	    $r .= "Row #$i ($m): ";
	    for( $j=0; $j < $m; ++$j ) {
		    
		$r .=  sprintf("%3s",$this->iBar[$i][$j][0]);
		$r .=  ' ('.sprintf("%02s",$this->iBar[$i][$j][1]).':'.sprintf("%02s",$this->iBar[$i][$j][2]).') ';
	    }
	    $r .=  "<br>\n";
	}
	return $r;
    }
}


class OutputBackend {
    protected $iModuleWidth=1;
    protected $iUseChecksum=0;
    protected $iNoHumanText=true;
    protected $iFontFam='FF_FONT2',$iFontStyle='FS_NORMAL',$iFontSize=10;
    protected $iSmallFontFam='FF_FONT1',$iSmallFontStyle='FS_NORMAL',$iSmallFontSize=8;
    protected $iColor='black',$iBkgColor='white';
    protected $iVertical=false;
    protected $iShowFrame=false;
    protected $iDebugBackground = false;
    protected $iHeight=4; // As multiple of width
    protected $iScale=1;
    protected $iEncoder=null;

    
    function AdjustSpec(&$aSpec) {
	$aSpec->iModuleWidth = $this->iModuleWidth;
	if( $this->iNoHumanText ) {
	    $aSpec->iStrokeDataBelow=false;
	    $aSpec->iLeftData = '';
	    $aSpec->iRightData = '';
	}
    }

    function SetVertical($aFlg=true) {
	$this->iVertical=$aFlg;
    }

    function SetScale($aScale) {
	$this->iScale = $aScale;
    }

    function SetModuleWidth($aWidth) {
	$this->iModuleWidth = $aWidth;
    }

    function SetHeight($aHeight) {
	$this->iHeight = $aHeight;
    }

    function NoText($aFlg=true) {
	$this->iNoHumanText = $aFlg;
    }

    function ShowFrame($aFlg=true) {
	$this->iShowFrame=$aFlg;
    }

    function AddChecksum($aFlag=true) {
	$this->iUseChecksum = $aFlag;
    }

    function SetFont($aFontFam,$aFontStyle,$aFontSize) {
	$this->iFontFam   = $aFontFam ;
	$this->iFontStyle = $aFontStyle;
	$this->iFontSize  = $aFontSize;
    }

    function SetSmallFont($aFontFam,$aFontStyle,$aFontSize) {
	$this->iSmallFontFam   = $aFontFam ;
	$this->iSmallFontStyle = $aFontStyle;
	$this->iSmallFontSize  = $aFontSize;
    }

    function SetColor($aColor,$aBkgColor) {
	$this->iColor = $aColor;
	$this->iBkgColor = $aBkgColor;
    }
}

//--------------------------------------------------------------
// BackendFactory
//
//--------------------------------------------------------------

class PDF417BackendFactory {
    static function Create($aBackend,$aEncoder=null) {
	$backends = array('IMAGE','PS');
	if( array_search($aBackend,$backends) === false ) {
	    return false;
	}
	$b = 'OutputBackend_'.$aBackend;
	return new $b($aEncoder);
    }
}

//--------------------------------------------------------------
// OutputBackend_IMAGE
//
//--------------------------------------------------------------
class OutputBackend_IMAGE extends OutputBackend {
    private $iImgFormat='png';
    function OutputBackend_IMAGE($aEncoder) {
	$this->iEncoder = $aEncoder;
    }

    function SetImgFormat($aFormat) {
	$this->iImgFormat=$aFormat;
    }

    function SetModuleWidth($aWidth) {
	$this->iModuleWidth = round($aWidth);
    }

    function Rotate($src_img, $degrees = 90) {
	if( !function_exists('imagerotate') )
	    return $src_img;
	$degrees %= 360;
	if ($degrees == 0) {
	    $dst_img = $src_img;
	} elseif ($degrees == 180) {
	    $dst_img = imagerotate($src_img, $degrees, 0);
	} else {
	    $width = imagesx($src_img);
	    $height = imagesy($src_img);
	    if ($width > $height) {
		$size = $width;
	    } else {
		$size = $height;
	    }
	    $dst_img = imagecreatetruecolor($size, $size);
	    imagecopy($dst_img, $src_img, 0, 0, 0, 0, $width, $height);
	    $dst_img = imagerotate($dst_img, $degrees, 0);
	    $src_img = $dst_img;
	    $dst_img = imagecreatetruecolor($height, $width);
	    if ((($degrees == 90) && ($width > $height)) || (($degrees == 270) && ($width < $height))) {
		imagecopy($dst_img, $src_img, 0, 0, 0, 0, $size, $size);
	    }
	    if ((($degrees == 270) && ($width > $height)) || (($degrees == 90) && ($width < $height))) {
           imagecopy($dst_img, $src_img, 0, 0, $size - $height, $size - $width, $size, $size);
	    }
	}
	return $dst_img;
    }

    function Stroke($aData,$aFile='',$aOnlyDebug=false) {
	$topmargin=10;
	$bottommargin=10;
	$textmargin=5;
	$txtmargin=4;
	$this->iHeight *= $this->iModuleWidth;

	$spec = $this->iEncoder->Enc($aData);
	if( $aOnlyDebug ) {
	    return $spec->toString();
	}
	$this->AdjustSpec($spec);

	$data = '';
	if( is_array($aData) ) {
	    $n = count($aData);
	    for( $i=0; $i < $n; ++$i ) {
		$data .= $aData[$i][1];
	    }
	}
	elseif( is_string($aData) ) {
	    $data = $aData;
	}

	if( $this->iModuleWidth > 1 ) {
	    $this->iFontFam = 'FF_ARIAL';
	    $this->iFontStyle = 'FS_BOLD';
	    $this->iFontSize = 10;
	}
	else {
	    $this->iFontFam = 'FF_ARIAL';
	    $this->iFontStyle = 'FS_NORMAL';
	    $this->iFontSize = 7;
	}

	$s = '';

	$g = new CanvasGraph(0,0); // Dummy graph context
	$g->img->SetImgFormat($this->iImgFormat);
	$w = round($spec->iModuleWidth);

	
	// Calculate total width
	$totwidth=$spec->iLeftMargin*$w;
	$n = count($spec->iBar[0]);
	for( $i=0; $i < $n; ++$i ) {
	    $b = $spec->iBar[0][$i];
	    $bn = strlen($b[3]);
	    for( $j=0; $j < $bn; ++$j ) {
		$wb = substr($b[3],$j,1)*$w;
		$totwidth += $wb;
	    }
	}
	$totwidth += $spec->iRightMargin*$w;

	// Calculate total height
	$height = $this->iHeight*count($spec->iBar)+$topmargin+$bottommargin;
	$g->img->SetFont($this->iFontFam, $this->iFontStyle, $this->iFontSize);
	$th = $g->img->GetTextHeight($data)+$txtmargin;
	if( $spec->iStrokeDataBelow ) {
	    $height += $th;
	}

	$width = $totwidth;

	$g->img->SetFont(FF_FONT2);
	$tw = 2*$textmargin + $g->img->GetTextWidth($s);
	if( $width < $tw )
	    $width = $tw;


	$g = new CanvasGraph($width,$height);
	$g->img->SetImgFormat($this->iImgFormat);

	$g->SetMarginColor($this->iBkgColor);
	$g->SetColor($this->iBkgColor);
	if( $this->iShowFrame ) {
	    $g->InitFrame();
	}
	else {
	    $g->frame_weight = 0;
	    $g->InitFrame();
	}
	$g->img->SetLineWeight(1);
	$g->img->SetColor('black');
	$x = $w*$spec->iLeftMargin;
	$ystart = $topmargin;

	$inunder=false;
	$under_s = '';
	$startx=$x;
	for($r=0; $r < count($spec->iBar); ++$r ) {
	    $yend = $ystart + $this->iHeight-1;
	    $x = $startx;
	    for( $i=0; $i < $n; ++$i ) {
		$b = $spec->iBar[$r][$i];
		$bn = strlen($b[3]);
		for( $j=0; $j < $bn; ++$j ) {
		    $wb = substr($b[3],$j,1)*$w;
		    if( !( $j % 2) ) {
			$g->img->SetColor($this->iColor);
			$g->img->FilledRectangle($x,$ystart,$x+$wb-1,$yend);
		    }	
		    $x += $wb;
		}

	    }
	    $ystart += $this->iHeight;
	} // row

	$g->img->SetColor($this->iColor);



	if( $spec->iStrokeDataBelow ) {
	    // Center data underneath
	    $y = $yend+$txtmargin; 
	    $bw = $totwidth - $spec->iLeftMargin*$w - $spec->iRightMargin*$w;
	    $x = $spec->iLeftMargin*$w + floor($bw/2);
	    $g->img->SetTextAlign('center','top');
	    $g->img->SetFont($this->iFontFam, $this->iFontStyle, $this->iFontSize);	 
   	    $g->img->StrokeText($x,$y,$data); 
	}

	if( ADD_DEMOTXT  ) {

	    $ystart=0;
	    $t = new Text(" DEMO ",$totwidth/2,$ystart);
	    if( $this->iModuleWidth > 1 ) {
		if( $this->iModuleWidth > 2 ) {
		    $t->SetFont(FF_ARIAL,FS_BOLD,24);
		    $step = 120;
		}
		else {
		    $t->SetFont(FF_ARIAL,FS_BOLD,16);
		    $step = 100;
		}
	    }
	    else {
		$t->SetFont(FF_ARIAL,FS_BOLD,12);
		$step = 80;
	    }
	    $t->SetColor('red@0.5');
	    $t->Align('center','top');
	    $t->SetAngle(-15);
	    $n = ceil($totwidth/$step);
	    for($y=$ystart; $y < $yend; $y += 50 ) {
		for( $i=0; $i < $n; ++$i ) {
		    $t->SetPos(-30+$i*$step,$y);
		    $t->Stroke($g->img);
		}
	    }
	    
	}


	if( $this->iVertical ) 
	    $g->img->img = $this->Rotate($g->img->img,90);

	if( $this->iScale != 1 ) {
	    $nwidth = round($width*$this->iScale);
	    $nheight = round($height*$this->iScale);
	    
	    
	    if( $this->iVertical ) {
		$tmp = $height; $height = $width; $width=$tmp;
		$tmp = $nheight; $nheight = $nwidth; $nwidth=$tmp;
	    }
	    $img = @imagecreatetruecolor($nwidth, $nheight);
	    if( $img ) {
		imagealphablending($img,true);
		imagecopyresampled($img,$g->img->img,0,0,0,0,$nwidth,$nheight,$width,$height);
		$g->img->CreateImgCanvas($nwidth,$nheight);
		$g->img->img = $img;
	    }
	    else 
		return false; 
	}
	$g->Stroke($aFile);
	return true;
    }
}

//--------------------------------------------------------------
// OutputBackend_PS
//
//--------------------------------------------------------------
class OutputBackend_PS extends OutputBackend {
    private $iBottomMargin=6;
    private $iEPS=false;
    private $ixoffset=0, $iyoffset=10;

    function OutputBackend_PS($aEncoder) {
	$this->iEncoder = $aEncoder;
	$this->iFontSize = 12;
	$this->iSmallFontSize = 10;
	$this->iModuleWidth = 1.1;
    }

    function SetEPS($aFlg=true) {
	$this->iEPS = $aFlg;
    }

    function Stroke($aData,$aFile='',$aOnlyDebug=false) {

	if( $this->iModuleWidth < 0.9 ) {
	    $this->iFontSize=9;
	    $this->iSmallFontSize=9;
	}

	$data = '';
	if( is_array($aData) ) {
	    $n = count($aData);
	    for( $i=0; $i < $n; ++$i ) {
		$data .= $aData[$i][1];
	    }
	}
	elseif( is_string($aData) ) {
	    $data = $aData;
	}

	$spec = $this->iEncoder->Enc($data);
	if( $aOnlyDebug ) {
	    return $spec->toString();
	}

	$this->AdjustSpec($spec);

	$s = '';
	$n = count($spec->iBar);
	$w = $this->iModuleWidth; 
	
	// Calculate total width
	$totwidth=$spec->iLeftMargin*$w;
	$n = count($spec->iBar[0]);
	for( $i=0; $i < $n; ++$i ) {
	    $b = $spec->iBar[0][$i];
	    $bn = strlen($b[3]);
	    for( $j=0; $j < $bn; ++$j ) {
		$wb = substr($b[3],$j,1)*$w;
		$totwidth += $wb;
	    }
	}
	$totwidth += $spec->iRightMargin*$w;
	$height = $this->iHeight*$this->iModuleWidth;
	
	// Start X-value
	$startx = $w*$spec->iLeftMargin + $this->ixoffset;
	$ystart = $height + $this->iyoffset;

	if( $spec->iStrokeDataBelow ) {
	    $ystart += $this->iFontSize+1;
	}

	$psbar='';
	for( $r=count($spec->iBar)-1, $y=$ystart; $r >= 0 ; --$r, $y += $height ) {
	    $psbar .= '[';
	    $x = $startx;
	    for( $i=0; $i < $n; ++$i ) {
		$b = $spec->iBar[$r][$i];
		$bn = strlen($b[3]);
		for( $j=0; $j < $bn; ++$j ) {
		    $wb = substr($b[3],$j,1)*$w; 
		    if( $j & 1) {
			$x += $wb;
		    }
		    else {
			$x += $wb/2;
			$psbar .= " [$height $x $wb] ";
			$x += $wb/2 ;
		    }
		}
		$psbar .= "\n";
	    }
	    $psbar .= "] ";
	    $psbar .= "{{} forall setlinewidth $y moveto -1 mul 0 exch rlineto stroke} forall\n\n";
	}

	$ps = 
	    ($this->iEPS ? "%!PS-Adobe EPSF-3.0\n" : "%!PS-Adobe-3.0\n" ) .
	    "%%Title: PDF417 Barcode for \"$data\"\n".
	    "%%Creator: JpGraph Barcode http://www.aditus.nu/jpgraph/\n".
	    "%%CreationDate: ".date("D j M H:i:s Y",time())."\n";
	
	if( $this->iEPS ) {
	    if( $this->iVertical ) 
		$ps .= "%%BoundingBox: 0 0 $ystart $totwidth \n";
	    else
		$ps .= "%%BoundingBox: 0 0 $totwidth $y\n";
	}
	else 
	    $ps .= "%%DocumentPaperSizes: A4\n";

	$ps .=
	    "%%EndComments\n".
	    "%%BeginProlog\n".
	    "%%EndProlog\n\n".
	    "%%Page: 1 1\n\n".
	    "%%Module width: $this->iModuleWidth pt\n\n";

	if( $this->iScale != 1 ) {
	    $ps .= 
		"%%Scale barcode\n".
		"$this->iScale $this->iScale scale\n\n";
	}
	
	if( $this->iVertical ) {
	    $ps .= "%%Rotate barcode 90 degrees\n".
		($y+1)." -".($spec->iLeftMargin*$w)." translate\n90 rotate\n\n";
	}

	$ps .=
	    "%%Font definition for normal and small fonts\n".
	    "/f {/Helvetica findfont $this->iFontSize scalefont setfont} def\n".
	    "/fs {/Helvetica findfont $this->iSmallFontSize scalefont setfont} def\n\n".
	    "%%Data for bars. Only black bars are defined. \n".
	    "%%The figures are for each row and in format: [height xpos width]\n";

	$ps .= $psbar;

	$center_text = "{ {} forall 1 index stringwidth pop 2 div sub 1 $this->iyoffset add moveto show} forall\n";

	if( !$this->iNoHumanText ) {
	    $ps .= "\n\n%%Readable text\nf\n[[($data) ".($totwidth/2)."]]\n".$center_text;
	}
	$ps .= "\n\n%%End of PDF417 barcode\n";

	if( !$this->iEPS ) {
	    $ps .= "\nshowpage\n";
	}
	$ps .= "\n%%Trailer\n";
	if( $aFile != '' ) {
	    $fp = @fopen($aFile,'w');
	    if( $fp ) {
		fwrite($fp,$ps);
		fclose($fp);
	    }
	    else {
		JpGraphError::RaiseL(26005,$aFile);// " Can't open file: $aFile for ");
		return false;
	    }
	}
	return $ps; 
    }
}




?>
