{* Smarty *}
<p>
{if $lightbox == 1}
 <a href="{$gallery_cover.image_link}" rel="lightbox[{$gallery_id}]" title="{$gallery_cover.description}">
{else}
 <a href="{$gallery_cover.image_link}">
{/if}
<img src="{$gallery_cover.image_url}" alt="{$gallery_cover.description}" /></a></p>

{section name=k loop=$images}
 {if $images[k].gallery_cover == 0}
  {if $lightbox == 1}
   <a href="{$images[k].image_link}" rel="lightbox[{$images[k].gallery_id}]" title="{$images[k].caption}" id="deviscrivermi">
  {else}
   <a href="{$images[k].image_link}">
  {/if}
  <img src="{$images[k].small_thumb_url}" alt="{$images[k].caption}" /></a>
  {if $images[k].last_in_row}
   <br />
  {/if}
 {/if}
{/section}

{if $show_link_for_gallery == 1}
<a href="{$gallery_link}">{$lang.go_to_gallery}</a>
{/if}