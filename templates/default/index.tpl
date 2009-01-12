{*Smarty*}
{include file="`$template.path_absolute`/header.tpl"}
  <div class="row">
   <div id="main">
{if $no_posts == 1}
     <div class="error">
      <h2>{$lang.no_posts}</h2>
     </div>
{else}
{section name=k loop=$posts}
     <div class="post">
      <h2><a href="{$posts[k].link}">{$posts[k].title}</a></h2>
      <small>{$lang.posted} {$lang.date_prefix} {$posts[k].date|date_format:$PhotoBlog.date_format} {$lang.time_prefix} {$posts[k].date|date_format:$PhotoBlog.time_format}</small>
      <div class="entry">
       {$posts[k].html}
      </div>
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