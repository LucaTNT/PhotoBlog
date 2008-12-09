<?php /* Smarty version 2.6.19, created on 2008-12-09 16:41:28
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'execute_plugin_hook', 'index.tpl', 19, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['template']['path_absolute'])."/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div class="row">
   <div id="main">
<?php if ($this->_tpl_vars['no_posts'] == 1): ?>
     <div class="error">
      <h2><?php echo $this->_tpl_vars['lang']['no_posts']; ?>
</h2>
     </div>
<?php else: ?>
     There should be posts, but showing them is not yet implemented
<?php endif; ?>
   </div>
<?php if (! @ $this->_tpl_vars['nosidebar']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['template']['path_absolute'])."/sidebar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

   </div>

   <?php echo smarty_function_execute_plugin_hook(array('hook' => 'dummy'), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['template']['path_absolute'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>