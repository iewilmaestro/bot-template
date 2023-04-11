class Modul {
	public function Curl($url, $header = 0, $post = 0, $metode = 0,$cookie = 0,$null = 0,$proxy = 0){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_COOKIE,TRUE);
		if($cookie){
			curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
			curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
		}
		if($post){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		if($header){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		}
		if($metode){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $metode);
		}
		if($proxy){
			curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
		}
		curl_setopt($ch, CURLOPT_HEADER, true);
		$r = curl_exec($ch);
		if($null)return 0;
		$c = curl_getinfo($ch);
		if(!$c) return "Curl Error : ".curl_error($ch); else{
			$hd = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			$bd = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			curl_close($ch);
			return array($hd,$bd);
		}
	}
	public function Line(){
		return b.str_repeat('~',50).n;
	}
	public function Simpan($n){
		if(file_exists($n)) {
			$d = file_get_contents($n);
		}else{
			$d = readline("Input ".$n." : ".n);
			print n;
			file_put_contents($n,$d);
		}
		return $d;
	}
	public function hapus($n){
		unlink($n);
	}
	public function Tmr($tmr){
		date_default_timezone_set("UTC");
		$timr = time()+$tmr;
		$len = 21;
		while(true){
			$ran = rand(1,4);
			$str = c.str_repeat('•',$ran);
			print "\r                                                  \r";
			$res=$timr-time();
			if($res < 1) {break;}
			print str_repeat(" ",$len-$ran).c.$str.p.date('H:i:s',$res).c.$str;sleep(1);
		}
	}
	public function Recaptchav2($apikey, $sitekey, $pageurl){
		$ua = ["host: ocr.captchaai.com","content-type: application/json/x-www-form-urlencoded"];
		while(true){
			$r = self::curl("https://ocr.captchaai.com/in.php?key=$apikey&method=userrecaptcha&googlekey=$sitekey&pageurl=$pageurl",$ua)[1];
			$id = explode('|',$r)[1];
			if(!$id){sleep(20);continue;}
			sleep(20);
			while(true){
				print "prosess......";
				$r = self::curl("https://ocr.captchaai.com/res.php?key=$apikey&action=get&id=$id",$ua)[1];
				if($r == "CAPCHA_NOT_READY"){
					print "\r                 \r";
					print "prosess...";
					sleep(10);
					print "\r                    \r";
					continue;
				}
				print "\r                 \r";
				return explode('|', $r)[1];
			}
		}
	}
}
class FaucetRoll extends Modul {
	public function h($xml=0){
		if($xml){
			$h[] = "x-requested-with: XMLHttpRequest";
		}
		$h[] = "cookie: ".$this->Simpan("Cookie");
		$h[] = "user-agent: ".$this->Simpan("User_Agent");
		return $h;
	}
	public function Dashboard(){
		$source = self::Curl(host,self::h())[1];
		if(preg_match("/Just a moment.../",$source)) {
			return ["status"=>0,"msg"=>"Cloudflare"];
		}
		if(preg_match("/firewall/",$source)) {
			return ["status"=>0,"msg"=>"Firewall"];
		}
		$data["status"] = 1;
		
		$user = explode('</font>', explode('<font class="text-success">', $source)[1])[0];
		if(!$user){
		}
		$data["user"] = $user;
		
		$bal = explode('</b>', explode('<div class="text-primary"><b>', $source)[1])[0];
		if(!$bal){
		}
		$data["bal"] = $bal;
		
		$bits = explode('</b>', explode('<div class="text-warning"><b>', $source)[1])[0];
		if(!$bits){
		}
		$data["bits"] = $bits;
		
		return $data;
	}
	public function Roll(){
		$source = self::Curl(host,self::h())[1];
		if(preg_match("/Just a moment.../",$source)) {
			return ["status"=>0,"msg"=>"Cloudflare"];
		}
		if(preg_match("/firewall/",$source)) {
			return ["status"=>0,"msg"=>"Firewall"];
		}
		$data["status"] = 1;
		
		$sisa = explode("</span>",explode('<span id="claimTime">',$source)[1])[0];
		if(!$sisa){
		}
		$data["sisa"] = $sisa;
		
		$tmr = explode(' ',explode('Claim FREE Bits every ',$source)[1])[0];
		if(!$tmr){
			$tmr = explode(' ',explode('Claim free Litoshi every ',$source)[1])[0];
		}
		if(is_numeric($tmr)){
			$data["timer"] = $tmr*60;
		}
		$short = explode(' &amp;',explode('<i class="fa fa-exclamation-triangle fa-fw"></i><br />',$source)[1])[0];
		if(!$short){
		}
		$data["short"] = $short;
		
		$sitekey = explode('"',explode('data-sitekey="',$source)[1])[0];
		if(!$sitekey){
		}
		$data["sitekey"] = $sitekey;
		
		$token = explode("'", explode("var token = '",$source)[1])[0];
		if(!$token){
		}
		$data["token"] = $token;
		
		return $data;
	}
	public function Roll_Verif($data){
		return json_decode(self::Curl(host.'system/ajax.php',self::h(),$data)[1],1);
	}
	public function Ptc(){
		$source = self::Curl(host."ptc.html",self::h())[1];
		if(preg_match("/Just a moment.../",$source)) {
			return ["status"=>0,"msg"=>"Cloudflare"];
		}
		if(preg_match("/firewall/",$source)) {
			return ["status"=>0,"msg"=>"Firewall"];
		}
		$data["status"] = 1;
		
		$id = explode('">',explode('<div class="website_block" id="',$source)[1])[0];
		if(!$id){
			return ["status"=>0,"msg"=>"Ptc Habis"];
		}
		$data["id"] = $id;
		
		$key = explode("',",explode("&key=",$source)[1])[0];
		if(!$key){
		}
		$source = self::Curl(host.'surf.php?sid='.$id.'&key='.$key,self::h())[1];
		
		if(preg_match('/Session expired!/',$source)){
			return ["status"=>0,"msg"=>"Session Expired"];
		}
		$token = explode("';",explode("var token = '",$source)[1])[0];
		$data["token"] = $token;
		$tmr = explode(";",explode('var secs = ',$source)[1])[0];
		self::tmr($tmr);
		
		return $data;
	}
	public function Ptc_Captcha(){
		$dtx = "cID=0&rT=1&tM=light";
		$r = json_decode(self::Curl(host.'system/libs/captcha/request.php',self::h(1),$dtx)[1],1);
		$dtx = "cID=0&pC=".($r)[1]."&rT=2";
		self::Curl(host.'system/libs/captcha/request.php',self::h(1),$dtx,'','',1);
		return $r[1];
	}
	public function Ptc_Verif($data){
		return json_decode(self::Curl(host.'system/ajax.php',self::h(),$data)[1],1);
	}
}
