<?php
error_reporting(0);
const
host = "https://rushbitcoin.com/",	//wajib
b = "\033[1;34m",	//biru
c = "\033[1;36m",	//cyan
d = "\033[0m",	//default
h = "\033[1;32m",	//hijau
k = "\033[1;33m",	//kuning
m = "\033[1;31m",	//merah
n = "\n",	//enter
p = "\033[1;37m",	//putih
u = "\033[1;35m";	//ungu

try {
	//modul
	eval(file_get_contents("https://raw.githubusercontent.com/iewilmaestro/bot-template/main/Modul"));
	//template
	eval(file_get_contents("https://raw.githubusercontent.com/iewilmaestro/bot-template/main/Template/faucetroll"));
	//gas
	eval(file_get_contents("https://raw.githubusercontent.com/iewilmaestro/bot-template/main/Gas/gas_faucetroll"));
} catch (Exception $exception){
		print $exception->getMessage();
		print "\n";
		exit;
}
