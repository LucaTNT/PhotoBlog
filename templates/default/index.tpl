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
{/if}
   </div>
{if !@$nosidebar}
{include file="`$template.path_absolute`/sidebar.tpl"}
{/if}

   </div>

   {execute_plugin_hook hook="dummy"}
{include file="`$template.path_absolute`/footer.tpl"}