<?php
// We need to know how many posts per page we have to show
$posts_to_get = $PhotoBlog->get_config_value('posts_per_page');

// We also need to know from where we have to start
if(isset($PhotoBlog->pagination['page'])){
	$start = (($PhotoBlog->pagination['page'] - 1) * 10) + 1;
}else{
	$start = 0;
}

// Set the page title
$PhotoBlog->page_title = $PhotoBlog->get_config_value('site_name');



// Let's start: get the posts we need and process them
$q_posts = mysql_query('SELECT * FROM '.POSTS_TABLE.' ORDER BY id DESC LIMIT '.$start.','.$posts_to_get);
if(mysql_num_rows($q_posts) > 0){
	$smarty->assign('no_posts', 1);
}else{
	$smarty->assign('no_posts', 1);
}




// Set template to be used
$PhotoBlog->set_tpl('index');
?>