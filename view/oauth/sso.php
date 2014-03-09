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
echo $message . "<br>";
$timestamp = 1394379690;
//$timestamp = time();
echo $timestamp . "<br>";
$hmac = dsq_hmacsha1($message . ' ' . $timestamp, "Qt13AeMq2EHk6CxBuAxnhLL8OKtsZZSvG2KhJNbueGi1GtTkcemmsJnJ1QzWTNph");
echo $hmac;
?>


<html>
<head>
</head>
<body>
<script type="text/javascript">
        var disqus_config = function () {
        // The generated payload which authenticates users with Disqus
    this.page.remote_auth_s3 = "<?php echo "$message $hmac $timestamp"; ?>";
    this.page.api_key = "<?php echo DISQUS_PUBLIC_KEY; ?>";

        // This adds the custom login/logout functionality
        this.sso = {
          name:    "HotspotMap login",
          button:  "http://localhost/images/samplenews.gif",
          icon:    "http://localhost/favicon.png",
          url:     "http://localhost/controller/login.php",
          logout:  "http://localhost/controller/logout.php",
          width:   "800",
          height:  "400"
        };
      };
      </script>

<!-- DISQUS AJAX -->
      <div id="disqus_thread"></div>




      <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'hotspotmap'; // required: replace example with your forum shortname
        var disqus_identifier = '1';
        var disqus_url = "http://localhost/home.php";

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
      </script>
      <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
      <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>

  </body>
  </html>