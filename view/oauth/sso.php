<?php
define('DISQUS_SECRET_KEY', '3nfyqWADVhAHrDVUGRPXQw1WF5VAseQf0WQaD9hbgBAoKFJBLY6C0I3b8oxrhv0m');
define('DISQUS_PUBLIC_KEY', 'CFdwBHTkz28s3951gIuQXWsY0cXyg2n8EsJZh6Utx3DYeGEt5U3mXUqaC9kIxhut');
 
$data = array(
        "id" => 1,
        "username" => "username",
        "email" => "email@gmail.com"
    );
 
function dsq_hmacsha1($data, $key) {
    $blocksize=64;
    $hashfunc='sha1';
    if (strlen($key)>$blocksize)
        $key=pack('H*', $hashfunc($key));
    $key=str_pad($key,$blocksize,chr(0x00));
    $ipad=str_repeat(chr(0x36),$blocksize);
    $opad=str_repeat(chr(0x5c),$blocksize);
    $hmac = pack(
                'H*',$hashfunc(
                    ($key^$opad).pack(
                        'H*',$hashfunc(
                            ($key^$ipad).$data
                        )
                    )
                )
            );
    return bin2hex($hmac);
}
 
$message = base64_encode(json_encode($data));
$timestamp = time();
$hmac = dsq_hmacsha1($message . ' ' . $timestamp, DISQUS_SECRET_KEY);
?>
<script type="text/javascript">
var disqus_config = function() {
    this.page.remote_auth_s3 = "<?php echo "$message $hmac $timestamp"; ?>";
    this.page.api_key = "<?php echo DISQUS_PUBLIC_KEY; ?>";
}
</script>