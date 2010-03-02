<?php /* Smarty version 2.6.19, created on 2010-03-02 12:58:12
         compiled from gallery_for_index.tpl */ ?>
<p>
<?php if ($this->_tpl_vars['lightbox'] == 1): ?>
 <a href="<?php echo $this->_tpl_vars['gallery_cover']['image_link']; ?>
" rel="lightbox[<?php echo $this->_tpl_vars['gallery_id']; ?>
]" title="<?php echo $this->_tpl_vars['gallery_cover']['description']; ?>
">
<?php else: ?>
 <a href="<?php echo $this->_tpl_vars['gallery_cover']['image_link']; ?>
">
<?php endif; ?>
<img src="<?php echo $this->_tpl_vars['gallery_cover']['image_url']; ?>
" alt="<?php echo $this->_tpl_vars['gallery_cover']['description']; ?>
" /></a></p>

<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 <?php if ($this->_tpl_vars['images'][$this->_sections['k']['index']]['gallery_cover'] == 0): ?>
  <?php if ($this->_tpl_vars['lightbox'] == 1): ?>
   <a href="<?php echo $this->_tpl_vars['images'][$this->_sections['k']['index']]['image_link']; ?>
" rel="lightbox[<?php echo $this->_tpl_vars['images'][$this->_sections['k']['index']]['gallery_id']; ?>
]" title="<?php echo $this->_tpl_vars['images'][$this->_sections['k']['index']]['caption']; ?>
">
  <?php else: ?>
   <a href="<?php echo $this->_tpl_vars['images'][$this->_sections['k']['index']]['image_link']; ?>
">
  <?php endif; ?>
  <img src="<?php echo $this->_tpl_vars['images'][$this->_sections['k']['index']]['small_thumb_url']; ?>
" alt="<?php echo $this->_tpl_vars['images'][$this->_sections['k']['index']]['caption']; ?>
" /></a>
  <?php if ($this->_tpl_vars['images'][$this->_sections['k']['index']]['last_in_row']): ?>
   <br />
  <?php endif; ?>
 <?php endif; ?>
<?php endfor; endif; ?>

<?php if ($this->_tpl_vars['show_link_for_gallery'] == 1): ?>
<a href="<?php echo $this->_tpl_vars['gallery_link']; ?>
"><?php echo $this->_tpl_vars['lang']['go_to_gallery']; ?>
</a>
<?php endif; ?>