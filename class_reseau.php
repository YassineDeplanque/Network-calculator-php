<?php
class classReseau {
private $ip;
private $cidr;
public function __construct($ip, $cidr) {
$this->ip = $ip;
$this->cidr = $cidr;
}
public function testIp() {
$valide = explode('.', $this->ip);
if (count($valide) == 4) {
if ($valide[0] >= 0 && $valide[0] < 256 && $valide[1] >= 0 && $valide[1] < 256 &&
$valide[2] >= 0 && $valide[2] < 256 && $valide[3] >= 0 && $valide[3] < 256) {
return true;
} else {
return false;
}
} else {
return false;
}
}
public function testCidr() {
if ($this->cidr >= 1 && $this->cidr <= 32) {
return true;
} else {
return false;
}
}
public function getIp() {
return $this->ip;
}
public function getCidr() {
return $this->cidr;
}
public function getBinMask() {
$var = $this->cidr;
$bin = "";
for ($deb = 0; $deb < 32; $deb++) {
if ($var > 0) {
$bin = $bin . "1";
} else {
$bin = $bin . "0";
}
$var--;
}
return $bin;
}
public function getDecMask() {
$var = $this->cidr;
$bin = "";
$resultat = "";
for ($deb = 0; $deb < 32; $deb++) {
if ($var >= 1) {
$bin = $bin . "1";
} else {
$bin = $bin . "0";
}
$var--;
}
$piece = str_split($bin, 8);
$resultat = bindec($piece[0]) . "." . bindec($piece[1]) . "." . bindec($piece[2]) . "." .
bindec($piece[3]);
return $resultat;
}
public function getBinIp() {
$binIp = "";
$tabIp = explode(".", $this->ip);
$binIp = sprintf("%08d", decbin($tabIp[0])) . sprintf("%08d", decbin($tabIp[1])) .
sprintf("%08d", decbin($tabIp[2])) . sprintf("%08d", decbin($tabIp[3]));
return $binIp;
}
public function getAddressReseau() {
$binIp = $this->getBinIp();
$binMask = $this->getBinMask();
$result = $binIp & $binMask;
$piece = str_split($result, 8);
$resultat = bindec($piece[0]) . "." . bindec($piece[1]) . "." . bindec($piece[2]) . "." .
bindec($piece[3]);
return $resultat;
}
public function getinverseBinMask() {
$var = $this->cidr;
$bin = "";
for ($deb = 0; $deb < 32; $deb++) {
if ($var > 0) {
$bin = $bin . "0";
} else {
$bin = $bin . "1";
}
$var--;
}
return $bin;
}
public function getAdressBroad() {
$binIp = $this->getBinIp();
$bininvers = $this->getinverseBinMask();
$adress = $binIp | $bininvers;
$piece = str_split($adress, 8);
$resultat = bindec($piece[0]) . "." . bindec($piece[1]) . "." . bindec($piece[2]) . "." .
bindec($piece[3]);
return $resultat;
}
public function getFirstAdress() {
$reseau = $this->getAddressReseau();
$piece = explode(".", $reseau);
$piece[3]++;
return $piece[0] . "." . $piece[1] . "." . $piece[2] . "." . $piece[3];
}
public function getLastAdress() {
$reseau = $this->getAdressBroad();
$piece = explode(".", $reseau);
$piece[3]--;
return $piece[0] . "." . $piece[1] . "." . $piece[2] . "." . $piece[3];
}
public function getNbreAdress(){
$cidr = $this->cidr;
$nbr = 2**(32-$cidr)-2;
return $nbr;
}
}