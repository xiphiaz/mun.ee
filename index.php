<?php
/*

Daux.io
==================

Description
-----------

This is a tool for auto-generating documentation based on markdown files
located in the /docs folder of the project. To see all of the available
options and to read more about how to use the generator, visit:

http://daux.io


Author
------
Justin Walsh (Todaymade): justin@todaymade.com, @justin_walsh
Garrett Moon (Todaymade): garrett@todaymade.com, @garrett_moon


Feedback & Suggestions
----

To give us feedback or to suggest an idea, please create an request on the the
GitHub issue tracker:

https://github.com/justinwalsh/daux.io/issues

Bugs
----

To file bug reports please create an issue using the github issue tracker:

https://github.com/justinwalsh/daux.io/issues


Copyright and License
---------------------
Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are
met:

*	Redistributions of source code must retain the above copyright notice,
	this list of conditions and the following disclaimer.

*	Redistributions in binary form must reproduce the above copyright
	notice, this list of conditions and the following disclaimer in the
	documentation and/or other materials provided with the distribution.

This software is provided by the copyright holders and contributors "as
is" and any express or implied warranties, including, but not limited
to, the implied warranties of merchantability and fitness for a
particular purpose are disclaimed. In no event shall the copyright owner
or contributors be liable for any direct, indirect, incidental, special,
exemplary, or consequential damages (including, but not limited to,
procurement of substitute goods or services; loss of use, data, or
profits; or business interruption) however caused and on any theory of
liability, whether in contract, strict liability, or tort (including
negligence or otherwise) arising in any way out of the use of this
software, even if advised of the possibility of such damage.

*/

require_once('libs/functions.php');

$options = get_options();
$tree = get_tree("docs");
$homepage_url = homepage_url($tree);
$docs_url = docs_url($tree);

// Redirect to docs, if there is no homepage
if ($homepage && $homepage_url !== '/') {
	header('Location: '.$homepage_url);
}

?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<html>
<head>
	<title><?php echo $options['title']; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="<?php echo $options['tagline'];?>" />
	<meta name="author" content="<?php echo $options['title']; ?>">
	<?php if ($options['colors']) { ?>
	<link rel="icon" href="/img/favicon.png" type="image/x-icon">
	<?php } else { ?>
	<link rel="icon" href="/img/favicon-<?php echo $options['theme'];?>.png" type="image/x-icon">
	<?php } ?>
	<!-- Mobile -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Font -->
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>

	<!-- LESS -->
	<?php if ($options['colors']) { ?>
		<style type="text/less">
			<?php foreach($options['colors'] as $k => $v) { ?>
		    @<?php echo $k;?>: <?php echo $v;?>;
		    <?php } ?>
		    @import "/less/import/daux-base.less";
		</style>
		<script src="/js/less.min.js"></script>
	<?php } else { ?>
		<link rel="stylesheet" href="/css/daux-<?php echo $options['theme'];?>.css">
	<?php } ?>

	<!-- hightlight.js -->
	<script src="/js/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>

	<!-- Navigation -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
	<script src="/js/custom.js"></script>
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<?php if ($homepage) { ?>
		<!-- Hompage -->
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand pull-left" href="<?php echo $homepage_url;?>"><?php echo $options['title']; ?></a>
					<p class="navbar-text pull-right">
						Generated by <a href="http://daux.io">Daux.io</a>
					</p>
				</div>
			</div>
		</div>

		<div class="homepage-hero well container-fluid">
			<div class="container">
				<div class="row">
					<div class="text-center span12">
						<?php if ($options['tagline']) { ?>
							<h2><?php echo $options['tagline'];?></h2>
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="span10 offset1">
						<?php if ($options['image']) { ?>
							<img class="homepage-image" src="<?php echo $options['image'];?>" alt="<?php echo $options['title'];?>">
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<div class="hero-buttons container-fluid">
			<div class="container">
				<div class="row">
					<div class="text-center span12">
						<?php if ($options['repo']) { ?>
							<a href="https://github.com/<?php echo $options['repo']; ?>" class="btn btn-secondary btn-hero">
								View On GitHub
							</a>
						<?php } ?>
						<a href="<?php echo $docs_url;?>" class="btn btn-primary btn-hero">
							View Documentation
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="homepage-content container-fluid">
			<div class="container">
				<div class="row">
					<div class="span10 offset1">
						<?php echo load_page($tree); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="homepage-footer well container-fluid">
			<div class="container">
				<div class="row">
					<div class="span5 offset1">
						<?php if (!empty($options['links'])) { ?>
							<ul class="footer-nav">
								<?php foreach($options['links'] as $name => $url) { ?>
									<li><a href="<?php echo $url;?>" target="_blank"><?php echo $name;?></a></li>
								<?php } ?>
							</ul>
						<?php } ?>
					</div>
					<div class="span5">
						<div class="pull-right">
							<?php if (!empty($options['twitter'])) { ?>
								<?php foreach($options['twitter'] as $handle) { ?>
									<div class="twitter">
										<iframe allowtransparency="true" frameborder="0" scrolling="no" style="width:162px; height:20px;" src="https://platform.twitter.com/widgets/follow_button.html?screen_name=<?php echo $handle;?>&amp;show_count=false"></iframe>
									</div>
								<?php } ?>
							<?php } ?>
                            <a href="http://flattr.com/thing/1191331/Munee-Optimising-Your-Assets" target="_blank"><img style="padding-bottom: 10px" src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a>
                            <a href="http://travis-ci.org/meenie/munee"><img style="padding-bottom: 10px" src="https://secure.travis-ci.org/meenie/munee.png?branch=master" alt="Build Status" style="max-width:100%;"></a>
                            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://mun.ee" data-text="Munee: Standalone PHP5.3 Asset Optimisation &amp; Manipulation - Easy Image Resizing &amp; LESS Compiling" data-via="MuneePHP">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php } else { ?>
		<!-- Docs -->
		<?php if ($options['repo']) { ?>
			<a href="https://github.com/<?php echo $options['repo']; ?>" target="_blank" id="github-ribbon"><img src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>
		<?php } ?>
		<div class="container-fluid fluid-height wrapper">
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<a class="brand pull-left" href="<?php echo $homepage_url;?>"><?php echo $options['title']; ?></a>
					<p class="navbar-text pull-right">
						Generated by <a href="http://daux.io">Daux.io</a>
					</p>
				</div>
			</div>

			<div class="row-fluid columns content">
				<div class="left-column article-tree span3">
					<!-- For Mobile -->
					<div class="responsive-collapse">
						<button type="button" class="btn btn-sidebar" data-toggle="collapse" data-target="#sub-nav-collapse">
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					    </button>
					</div>
					<div id="sub-nav-collapse" class="collapse in">
						<!-- Navigation -->
						<?php echo build_nav($tree); ?>

						<?php if (!empty($options['links']) || !empty($options['twitter'])) { ?>
							<div class="well well-sidebar">
								<!-- Links -->
								<?php foreach($options['links'] as $name => $url) { ?>
									<a href="<?php echo $url;?>" target="_blank"><?php echo $name;?></a><br>
								<?php } ?>
								<!-- Twitter -->
								<?php foreach($options['twitter'] as $handle) { ?>
									<div class="twitter">
												<hr/>
										<iframe allowtransparency="true" frameborder="0" scrolling="no" style="width:162px; height:20px;" src="https://platform.twitter.com/widgets/follow_button.html?screen_name=<?php echo $handle;?>&amp;show_count=false"></iframe>
									</div>
								<?php } ?>
                                <a href="http://flattr.com/thing/1191331/Munee-Optimising-Your-Assets" target="_blank"><img style="padding-bottom: 10px" src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a>
                                <a href="http://travis-ci.org/meenie/munee"><img style="padding-bottom: 10px" src="https://secure.travis-ci.org/meenie/munee.png?branch=master" alt="Build Status" style="max-width:100%;"></a>
                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://mun.ee" data-text="Munee: Standalone PHP5.3 Asset Optimisation &amp; Manipulation - Easy Image Resizing &amp; LESS Compiling" data-via="MuneePHP">Tweet</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="right-column <?php echo ($options['float']?'float-view':''); ?> content-area span9">
					<div class="content-page">
						<article>
							<?php echo load_page($tree); ?>
						</article>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>

<?php if ($options['google_analytics']) { ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $options['google_analytics'];?>', '<?php echo $_SERVER['HTTP_HOST'];?>');
  ga('send', 'pageview');

</script>
<?php } ?>
</body>
</html>