<div style="margin-bottom:10px;"><?php if($lingua=="ita"){?>Condividi questo articolo su<?php }else{?>Share this article on<?php }?>:</div>
<div style="float:left;width:110px;">
	<a href="https://www.facebook.com/sharer.php?u=<?php echo $ind_fb;?>" target="_blank" title="<?php if($lingua=="ita"){?>Condividi su<?php }else{?>Share on<?php }?> Facebook">
		<div style="padding:3px 7px;background:#395498; color:#fff">
			<i class="fab fa-facebook-f"></i>&nbsp;&nbsp;Facebook
		</div>
	</a>
</div>
<div style="float:left;width:110px;">
	<a href="https://twitter.com/intent/tweet?url=<?php echo $ind_fb;?>" target="_blank" title="<?php if($lingua=="ita"){?>Condividi su<?php }else{?>Share on<?php }?> X (Twitter)">
		<div style="padding:3px 7px;background:#000000; color:#fff">
			<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#fff" d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>&nbsp;&nbsp;X (Twitter)
		</div>
	</a>
</div>
<div style="float:left;width:110px;">
	<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $ind_fb;?>&media=<?php if(str_replace("http://","",$img)==$img){?>{{ config('app.url') }}/<?php }?><?php echo $img;?>&description=<?php echo $page_title;?>: <?php echo $new_url;?>"  target="_blank" title="<?php if($lingua=="ita"){?>Condividi su<?php }else{?>Share on<?php }?>  Pinterest">
		<div style="padding:3px 7px;background:#0A66C2; color:#fff">
			<i class="fab fa-linkedin"></i>&nbsp;&nbsp;LinkedIn
		</div>
	</a>
</div>
<div style="clear:both"></div>