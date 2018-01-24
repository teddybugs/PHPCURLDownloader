<?php
	$buffer ="";
	$content = "";
	$URL = "";
	$SCRAP_URL = "http://www.yourbulletin.com/";
	$save_path = "C:\\wamp64\\www\\scraper\\tmp\\";
	
	if (isset($_POST['URL']) && $_POST['URL'] !=''){
		$curl_handle=curl_init();
		$URL = $_POST['URL'];
		curl_setopt($curl_handle,CURLOPT_URL, $URL);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);  
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		if (empty($buffer)){
		$content = "Nothing returned from url.";
		}
	}
	
	function grab_image($url,$save_path,$id){
		$ch = curl_init ($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$raw=curl_exec($ch);
		
		$filename = $id.'.jpg';
		$saveto = $save_path.$filename;
		
		curl_close ($ch);
		if(file_exists($saveto)){
			unlink($saveto);
		}
		$fp = fopen($saveto,'x');
		fwrite($fp, $raw);
		fclose($fp);
		echo " - [Done]\n";
	}	
?>
<form name="myform" action="<?=($_SERVER['PHP_SELF'])?>" method="POST">
<center>FF Photo Attachment Scrapper</center><br />
URL: <input type="text" name="URL" size="200" value="<?=$URL?>"><input type="submit" value="GET RESULT"/>
</form>
Result:<br />
<textarea style="width:100%; height:100%">
<?php 
if (isset($_POST['URL']) && $_POST['URL'] !=''){
$matches = array();
$dom = new DOMDocument;
libxml_use_internal_errors(true);
$dom->loadHTML($buffer);
libxml_clear_errors();

	foreach ($dom->getElementsByTagName('a') as $node)
	{
	  //echo $node->getAttribute("href")."\n";
			
			if (preg_match('#attachment\.php\?attachmentid=[0-9,]+&d=[0-9,]+#', $node->getAttribute("href"), $matches)) {
				$the_url = $SCRAP_URL.$matches[0];
				echo $the_url.' - ';
				if (preg_match('/attachmentid=[0-9]&*/', $matches[0], $the_id))
					$id = $matches[0];

				$req_id = explode('=', $id);
				$real_id = explode('&', $req_id[1]);
				echo $real_id[0];		
				grab_image($the_url,$save_path,$real_id[0]);
				
			}
	}
}
?>
</textarea>
