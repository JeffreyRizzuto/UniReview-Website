<?php
class ArticleView {
	public static function show($article) {
		$_SESSION ['headertitle'] = $article->getArticleTitle ();
		MasterView::showHeader ();
		MasterView::showNavbar ();
		ArticleView::showDetails ( $article );
		$_SESSION ['footertitle'] = "";
		MasterView::showFooter ();
	}
	public static function showBlank($article) {
		$_SESSION ['headertitle'] = "page not found";
		MasterView::showHeader ();
		MasterView::showNavbar ();
		ArticleView::showBlankArticle ( $article );
		$_SESSION ['footertitle'] = "";
		MasterView::showFooter ();
	}
	public static function showDetails($article) {
		?>
<!-- Article header -->
<div class="article-header">
	<!-- Article title -->
	<h1 class="article-title"><?php echo $article->getArticleTitle()?></h1>
</div>
<!-- Site subtitle -->
<div id="site-sub">From UniReview, the wiki for reviews</div>
<!-- Body content container -->
<div id="body-content">
		<?php echo $article->getPageText()?>
		</div>
<?php
	}
	public static function showBlankArticle($article) {
		?>
<div class="blank-article-header">
	<h1 class="black-article-title">This page doesn't exist yet</h1>
</div>
<!-- Body content container -->
<br>
<div id="body-content">
	<p>
		This page doesn't exist yet <br> <a href="/<?php echo "$base"?>/new">Be
			the first to create it</a>

</div>
<?php
	}
}
?>
