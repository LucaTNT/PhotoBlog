<?php /* Smarty version 2.6.19, created on 2010-03-02 12:58:12
         compiled from style.css.tpl */ ?>
<?php echo '
/*
Theme Name: Bytetips
Theme URI: http://www.bytetips.com/wordpress-theme-bytetips/
Description: Bytetips 3 colum Wordpress theme designed by Jim at <a href="http://www.bytetips.com">Bytetips</a>. Replace header.jpg with your Logo And have fun.<p>The CSS, XHTML and design is released under a <a href="http://www.gnu.org/copyleft/gpl.html">GNU General Public License</a></p>
Author: Jim
Author URI: http://www.bytetips.com
Tags: simple, Dark, Blue, Three Columns
version: 1.6
Change: Adding Pagination in the theme, Fixed some Css Issues, Removed Dotted Border and fixed some other Problems.

*/



/* basics */

*{margin:0; padding:0;}

body {
	background: #fff;
	font-family: verdana, arial, tahoma, sans-serif;
	font-size: 8pt;
	margin: 20px;
	}
	
h1 {font-size: 18pt;}
h2 {font-size: 14pt; margin-top:10px;}
h3 {font-size: 10pt; margin-top:10px;}
h4 {font-size: 9pt;}


/* images and misc. */

img{ border: none; padding: 6px; }
img a{border:none;}

img.left{ float: left; border: none; padding: 6px; }
img#right{ float: right; border: none; padding: 6px; }

blockquote{
	border-left:1px solid #A5ABAB;
	margin:15px;
	padding:0 12px 0 12px;
	}

code{
	margin:10px;
	font-family:"Courier New", Courier, monospace;}

.rss {
	background: url('; ?>
<?php echo $this->_tpl_vars['template']['path_www']; ?>
<?php echo '/images/ficon.png) left center no-repeat;
	padding-left: 12px;
	}
	
/* links */

a{
	color:#333;
	text-decoration:none;
	border: none;
	}

a:hover{color:#6A7CA0;text-decoration: underline; border: none;}



/* container */


#container {
	width: 90%;
	margin: 0 auto;
	padding: 0px;
	background:#fff;
	color:#333;
	border: 1px solid #333;
	}
	
.row {
	display: table-row;
}
	
/* header */

#header {
	background: #454D4E url('; ?>
<?php echo $this->_tpl_vars['template']['path_www']; ?>
<?php echo '/images/head.jpg) 0 0 no-repeat;
        width: 100%; 
        height: 131px;
        color: #fff;
	margin-right: 100%;
        }

#header h1{
	font-family: palatino linotype, georgia, arial, times;
	font-size: 1.5em;
	letter-spacing: 1px;
	margin: 0;	
	padding: 40px 0 0 600px;
	}
	
#header h1 a{color: #fff; text-decoration: none;}
#header h1 a:hover{color: #666; text-decoration: none;}


#header h2{
	font-family: palatino linotype, georgia, arial, times;
	font-size: 10pt;
	font-weight: 300;
	font-style: italic;
	color: #fff;
	letter-spacing: 1px;
	padding: 5px 0 0 600px;
	}

/* main menu */


#menu {
	background: #454D4E;
	font-family: verdana, arial, times, serif;
	font-size: 8pt;
	font-weight: bold;
	width:100%; 
	height:25px;
	border-top: 2px solid #FFF;
}


#menu ul {
	margin: 6px 0 0 0;
	padding: 0;
	text-align: left;
}

#menu ul li {
	list-style-type: none;
	display: inline;
	margin: 0;
	padding: 0;
}

#menu ul li a {
	padding: 6px 13px 6px 13px;
	margin: 0;
	text-decoration: none;
	color: #fff;
}

#menu ul li a:hover {
	background-color: #333;
	color:#fff;
}

#main {
	padding: 5px;
	display: table-cell;
	width: 80%;
}


/* content */


#content {
	float: left;
	width: 60%;
	overflow: hidden;
	text-align: justify;
	}

.post {
	margin: 0 10px;
	padding:15px;
	line-height: 14pt;
	}
	
.post h2{
	font-family: baskerville, georgia, times, serif;
	font-size: 14pt;
	font-weight: 300;
	color: #08122E;
	}
	
.post h2 a{
	color: #015D82;
	text-decoration: none;
	}
	
.post h2 a:hover{
	color: #666;
	text-decoration: none;
	}
	
.post p{font-size: 8pt;}

.post a{text-decoration:underline;}

.post ul {}

.post li {}

.entry p{margin:12px 0;}

.postmetadata{
	clear: both;
	background:#F7F7F7;
	padding:6px;
	margin-top: 16px;
	border-left:solid 1px #A2A2A2;
	border-bottom:solid 1px #A2A2A2;
	}
	

.navigation {
	margin: 12px 0 20px 0;
	padding:2px;
	font-size:.9em;
	float:left;
	width:98%;
	}
	
	.alignleft {float:left;}
	.alignright {float:right;}

.pagetitle {}

.error {
	padding-left: 3em;
}

#left {
	font-family: verdana, arial, tahoma;
	font-size:8pt;
	width: 20%;
	float:left;
	margin: 12px 0 24px 0;
	padding: 0;
	}

#left h2{
	font-family: verdana, times, georgia;
	font-weight: bold; 
	font-size: 10pt; 
	text-align: left;
	color: #fff;	
	margin-bottom: 5px;
	padding: 4px;
	background: url('; ?>
<?php echo $this->_tpl_vars['template']['path_www']; ?>
<?php echo '/images/bar.png);
}

#left p {margin:0; padding: 0 6px 0 12px;}

#left img {padding: 0; margin: 0;}

#left ul {
	margin:12px;
	padding:0;
	list-style-type: none;
	}

#left ul li {
	margin: 0;
	padding: 0;
	line-height: 14pt;
	list-style-type: none;
}

#left ul ul {
	margin: 6px 0 6px 12px;
	padding: 0;
}

#left ul ul li {
	list-style-type: none;
	list-style-position: inside;
	}

#left ul ul ul{
	margin: 0;
	padding: 0;
}

#left ul ul ul li{
	padding: 0 0 0 15px;
	list-style-type: square;
	color: #898989;
}



/* right sidebar */


#right{
	font-family: verdana, arial, tahoma;
	font-size: 8pt;
	width: 20%;
	margin: 0px 0 0px 0px;
	padding-left: 25px;
	display: table-cell;
	background: url('; ?>
<?php echo $this->_tpl_vars['template']['path_www']; ?>
<?php echo '/images/right-fade.png) left repeat-y;
	background-color: #454D4E;
	color: #fff;
}

#right h2{
	font-family: verdana, times, georgia;
	font-weight: bold; 
	font-size: 10pt; 
	text-align: left;
	color: #fff;	
	margin-bottom: 5px;
	padding: 4px;
	background: url('; ?>
<?php echo $this->_tpl_vars['template']['path_www']; ?>
<?php echo '/images/bar.png);
}

#right p {margin:0; padding: 0 6px 0 12px;}

#right img {padding: 0; margin: 0;}

#right ul {
	margin:12px;
	padding:0;
	list-style-type: none;
	}

#right ul li {
	margin: 0;
	padding: 0;
	line-height: 14pt;
	list-style-type: none;

}

#right ul ul {
	margin: 6px 0 6px 12px;
	padding: 0;
}

#right ul ul li {
	list-style-type: none;
	list-style-position: inside;
	}

#right ul ul ul{
	margin: 0;
	padding: 0;
}

#right ul ul ul li{
	padding: 0 0 0 15px;
	list-style-type: square;
	color: #898989;
}

/* comments */

#commentssection{
	clear: both;
	padding: 2px 12px;
	margin: 0;
	}
	
#commentssection h3{
	font-family: georgia, times, verdana;
	font-size: 12pt;
	font-weight: 300;
	font-style: normal;
	color: #000;
	}

#commentform{
	background: #F0F0F0;
	margin: 12px 12px 20px 12px;
	padding:20px;
	}
	
#commentform p{
	color: #000;
	}
	
#commentform a{color: #000; text-decoration: none; border-bottom: 1px dotted #465D71;line-height: 14pt;}
	
#commentform h3{
	font-family: georgia, times, verdana;
	font-size: 10pt;
	font-weight: 300;
	color: #000;
	}
	
#commentbox{
	width:75%;
	min-width:400px;
	margin:5px 5px 0 0;
	}

#author, #email, #url, #commentbox, #submit{
	background: #fff;
	font-family: verdana, arial, times;
	font-size: 8pt;
	margin:5px 5px 0 0;
	border: none; 
	padding: 6px;
	border: 1px solid #B2B2B2;
	}

#submit{margin:5px 5px 0 0;}

#img.avatar {float:left; margin-right:5px;}

	
ol.commentlist {list-style-type: none;}

ol.commentlist li {
	background: #fff;
	margin:10px 0;
	padding:5px 0 5px 10px;
	overflow: hidden;
	}

ol.commentlist li.alt {background: #EDEDED;}
ol.commentlist li p {margin: 6px 0 6px 0; padding: 0 12px 0 0; line-height: 14pt;}

ol.commentlist a {color:#000;}

cite {
	font-family: arial, verdana, tahoma;
	font-size: 9pt;
	font-weight: bold;
	font-style: normal;
	}
	
cite a{color: #000; text-decoration: none; border-bottom: 1px dotted #465D71;}


/* search */

#searchform{
	padding: 6px 0 6px 6px;
	font-family: verdana, arial, times;
	}

#searchform input#s{
	font-family: verdana, arial, times;
	font-size: 8pt;
	padding: 2px;
	margin: 2px;
	border: 1px solid #B7B7B7;
	}

#searchform input#searchsubmit{
	font-family: verdana, arial, times;
	font-size: 7pt;
	padding: 2px;
	margin: 2px 0 0 2px;
	border: 1px solid #B7B7B7;
	background-color: #fff;
	color: #797979;
	}

/* footer */

#footer {
	background: #333;
	clear: both;
	width: 90%;
	margin-top: 10px;
	border-top: solid 2px #FFFFFF;
	font-family: verdana, arial, tahoma;
	font-size: 7pt;
	margin-left: 5%;
}
	
#footer p{padding:6px;margin: 0; color: #eee;}
#footer a{color: #FFFFFF;text-decoration: none;}
#footer a:hover{color: #5D5D5D;text-decoration: underline;}

/* Extra */

.aligncenter {
	display: block;
	margin-left: auto;
	margin-right: auto;
}

.alignleft {
	float: left;
}

.alignright {
	float: right;
}

.wp-caption {
	border: 1px solid #ddd;
	text-align: center;
	background-color: #f3f3f3;
	padding-top: 4px;
	margin: 10px;
	border-radius: 3px;
	width: 75%;
}

.wp-caption img {
	margin: 0;
	padding: 0;
	border: 0 none;
}

.wp-caption-dd {
	font-size: 11px;
	line-height: 17px;
	padding: 0 4px 5px;
	margin: 0;
}


'; ?>