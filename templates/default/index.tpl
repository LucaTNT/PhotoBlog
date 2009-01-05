{*Smarty*}
{include file="`$template.path_absolute`/header.tpl"}
  <div class="row">
   <div id="main">
{if $no_posts == 1}
     <div class="error">
      <h2>{$lang.no_posts}</h2>
     </div>
{else}
     There should be posts, but showing them is not yet implemented
{section name=k loop=$posts}
     <div class="post">
      <h2><a href="{$posts[k].link}">{$posts[k].title}</a></h2>
     </div>
{/section}
{/if}
   </div>
{if !@$nosidebar}
{include file="`$template.path_absolute`/sidebar.tpl"}
{/if}
   </div>

   {execute_plugin_hook hook="dummy"}
{include file="`$template.path_absolute`/footer.tpl"}