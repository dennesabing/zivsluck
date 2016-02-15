<?php if(empty(zbase_is_dev())):?>
<span class='st_sharethis_large' displayText='ShareThis'></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_pinterest_large' displayText='Pinterest'></span>
<span class='st_googleplus_large' displayText='Google +'></span>
<span class='st_email_large' displayText='Email'></span>

@section('head_bottom')
<script type="text/javascript">var switchTo5x = true;</script>
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "39852a81-e27e-4c99-b342-72c9d05aac9a", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
@append
<?php endif;?>