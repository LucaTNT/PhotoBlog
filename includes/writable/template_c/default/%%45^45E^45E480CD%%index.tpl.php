<?php /* Smarty version 2.6.19, created on 2009-01-12 19:24:21
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 13, false),array('function', 'execute_plugin_hook', 'index.tpl', 26, false),)), $this); ?>
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
<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['posts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
     <div class="post">
      <h2><a href="<?php echo $this->_tpl_vars['posts'][$this->_sections['k']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['posts'][$this->_sections['k']['index']]['title']; ?>
</a></h2>
      <small><?php echo $this->_tpl_vars['lang']['posted']; ?>
 <?php echo $this->_tpl_vars['lang']['date_prefix']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['posts'][$this->_sections['k']['index']]['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['PhotoBlog']['date_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['PhotoBlog']['date_format'])); ?>
 <?php echo $this->_tpl_vars['lang']['time_prefix']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['posts'][$this->_sections['k']['index']]['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['PhotoBlog']['time_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['PhotoBlog']['time_format'])); ?>
</small>
      <div class="entry">
       <?php echo $this->_tpl_vars['posts'][$this->_sections['k']['index']]['html']; ?>

      </div>
     </div>
<?php endfor; endif; ?>
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