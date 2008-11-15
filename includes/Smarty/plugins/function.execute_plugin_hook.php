<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * {execute_plugin_hook} function plugin for Smarty
 *
 * Type:     function<br>
 * Name:     execute_plugin_hook<br>
 * Purpose:  execute a PhotoBlog plugin hook from a template<br>
 * @author Luca Zorzi <luca at tuttoeniente dot net>
 * @param array
 * @param Smarty
 */
function smarty_function_execute_plugin_hook($params, &$smarty)
{

    if (!isset($params['hook'])) {
        $smarty->trigger_error("execute_plugin_hook: missing 'hook' parameter");
        return;
    }

    if($params['hook'] == '') {
        return;
    }
    
    $PhotoBlog = new PhotoBlog(1, 1);
    $PhotoBlog->hook($params['hook']);
    
    return;
}

?>
