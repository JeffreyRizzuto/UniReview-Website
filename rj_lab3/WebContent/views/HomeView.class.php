<?php
class HomeView {
	public static function show() {
		$_SESSION ['headertitle'] = "UniReview Home Page";
		MasterView::showHeader ();
		MasterView::showNavbar ();
		HomeView::showDetails ();
		$_SESSION ['footertitle'] = "<h3>Made by Jeff</h3>";
		MasterView::showFooter ();
	}
	public static function showDetails() {
		?>
	<section>
		<p>UniReview is a site dedicated to helping you find the information
			you need on the product you want. Featuring mostly hardware,
			UniReview will be your go to site in finding consumer opinions.</p>
	</section>
	<br><br>
	<a href="/rj_lab3/tests/ShowAllUsers_Tests.php">Show All Users</a>
	<a href="/rj_lab3/tests/ShowAllArticles.php">Show All Articles</a>
	<a href="/rj_lab3/create">Create Article</a>
	<aside></aside>
<?php
	}
}