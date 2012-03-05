<?php
class FileTools {
	function __construct(){
		
	}
		public function generateRandomName($Type)
		{
		    $strFileName = '';
		    switch ($Type) {
		        case 'jpg': //map cover image
		        $strFileName.='mapImage_';
		        $strEnd = '.jpg';
		        break;
		        
		        case 'jpeg': //map cover image
		        $strFileName.='mapImage_';
		        $strEnd = '.jpeg';
		        break;
		        
		        case 'bmp': //map cover image
		        $strFileName.='mapImage_';
		        $strEnd = '.bmp';
		        break;
		        
		        case 'png': //map cover image
		        $strFileName.='mapImage_';
		        $strEnd = '.png';
		        break;
		
		        case 'swf': //map description swf
		        $strFileName.='mapMovie_';
		        $strEnd = '.swf';
		        break;
		        
		        case 'flv': //map description swf
		        $strFileName.='mapMovie_';
		        $strEnd = '.flv';
		        break;
		
		        case 'gif': //map description image
		        $strFileName.='mapImage_';
		        $strEnd = '.gif';
		        break;
		
		        case 'rar': //map version file
		        $strFileName.='mapFile_';
		        $strEnd = '.rar';
		        break;
		        
		        case 'pdf': //map cover image
		        $strFileName.='mapImage_';
		        $strEnd = '.pdf';
		        break;
		
		        default://default name
		        $strFileName.='mapUpload_';
		        $strEnd = '.unknown';
		        break;
		    }
		
		    $strFileName.=time().'_';
		
		    $strFileName.=$this->randStr();
		
		    $strFileName.=$strEnd;
		
		    return $strFileName;
		}

		function randStr($len=6,$format='ALL_WORD') {
		     switch($format) {
		     case 'ALL_WORD':
		     $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; break;
		     case 'ALL':
		     $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; break;
		     case 'CHAR':
		     $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~'; break;
		     case 'NUMBER':
		     $chars='0123456789'; break;
		     default :
		     $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
		     break;
		     }
		
		     mt_srand((double)microtime()*1000000*getmypid());
		     $password="";
		     while(strlen($password)<$len)
		        $password.=substr($chars,(mt_rand()%strlen($chars)),1);
		     return $password;
		 }
		  //循环生成文件夹
	public function mk_dir($dir, $mode = 0755) 
	{ 
  	  if (is_dir($dir) || @mkdir($dir,$mode)) return true; 
	  if (!$this->mk_dir(dirname($dir),$mode)) return false; 
	  return @mkdir($dir,$mode); 
	} 
	function makethumb($srcfile,$dir,$thumbwidth,$thumbheight,$ratio=0) {
/*图象缩略函数 适用于不同的图象存在不同的目录中。 creat by cao2xi 2008-12-19
参数说明：$srcfile 原图地址；
          $dir  新图目录
          $thumbwidth 缩小图宽最大尺寸
          $thumbheitht 缩小图高最大尺寸
          $ratio 默认等比例缩放 为1是缩小到固定尺寸。
*/
    //判断文件是否存在
    if (!file_exists($srcfile)) {
        return '';
    }
    //生成新的同名文件，但目录不同
    $imgname=explode('/',$srcfile);
    $arrcount=count($imgname);
    $dstfile = $dir.$imgname[$arrcount-1];
    //缩略图大小
    $tow = $thumbwidth;
    $toh = $thumbheight;
    if($tow < 40) $tow = 40;
    if($toh < 45) $toh = 45;   
    //获取图片信息
    $im = '';
    if($data = getimagesize($srcfile)) {
        if($data[2] == 1) {
            $make_max = 0;//gif不处理
            if(function_exists("imagecreatefromgif")) {
                $im = imagecreatefromgif($srcfile);
            }
        } elseif($data[2] == 2) {
            if(function_exists("imagecreatefromjpeg")) {
                $im = imagecreatefromjpeg($srcfile);
            }
        } elseif($data[2] == 3) {
            if(function_exists("imagecreatefrompng")) {
                $im = imagecreatefrompng($srcfile);
            }
        }
    }
    if(!$im) return '';
    $srcw = imagesx($im);
    $srch = imagesy($im);
    $towh = $tow/$toh;
    $srcwh = $srcw/$srch;
    if($towh <= $srcwh){
        $ftow = $tow;
        $ftoh = $ftow*($srch/$srcw);
    } else {
        $ftoh = $toh;
        $ftow = $ftoh*($srcw/$srch);
    }
    if($ratio){
        $ftow = $tow;
        $ftoh = $toh;
    }
    //缩小图片
    if($srcw > $tow || $srch > $toh || $ratio) {
        if(function_exists("imagecreatetruecolor") && function_exists("imagecopyresampled") && @$ni = imagecreatetruecolor($ftow, $ftoh)) {
            imagecopyresampled($ni, $im, 0, 0, 0, 0, $ftow, $ftoh, $srcw, $srch);
        } elseif(function_exists("imagecreate") && function_exists("imagecopyresized") && @$ni = imagecreate($ftow, $ftoh)) {
            imagecopyresized($ni, $im, 0, 0, 0, 0, $ftow, $ftoh, $srcw, $srch);
        } else {
            return '';
        }
        if(function_exists('imagejpeg')) {
            imagejpeg($ni, $dstfile);
        } elseif(function_exists('imagepng')) {
            imagepng($ni, $dstfile);
        }
    }else {
        //小于尺寸直接复制
    copy($srcfile,$dstfile);
    }
    imagedestroy($im);
    if(!file_exists($dstfile)) {
        return '';
    } else {
        return $dstfile;
    }
}
	
}