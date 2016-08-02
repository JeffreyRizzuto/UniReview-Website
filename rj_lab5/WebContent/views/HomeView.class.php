<?php
class HomeView {
	public static function show() {
		$_SESSION ['headertitle'] = "UniReview Home Page";
		MasterView::showHeader ();
		MasterView::showNavbar ();
		HomeView::showDetails ();
		$_SESSION ['footertitle'] = "<h3>Unireview 2015</h3>";
		MasterView::showFooter ();
	}
	public static function showDetails() {
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		?>

<div class="jumbotron row container-fluid">
	<div class="row">
		<div class="col col-md-3"></div>
		
		<form action ="/<?php echo $base?>/search" method="post">
		<div class="search col col-md-6">
			<input type="text" name="search" class="form-control input-sm" maxlength="64"
				placeholder="Search" />
		</div>
		<div class="col col-md-3">
			<button type="submit" class="btn btn-primary btn-sm">Search</button>
		</div>
		</form>
		<div class="col col-md-3"></div>
		<span class = "col col-md-6"><a href='/<?php echo $base;?>/create'>Create your own product page</a></span>
		<div class="col col-md-3"></div>
	</div>
</div>


<hr>

<section>
	<p>UniReview is a site dedicated to helping you find the information
		you need on the product you want. Featuring mostly hardware, UniReview
		will be your go to site in finding consumer opinions.</p>
</section>



<br>
<br>
<p>Valid User - Username: theflash password: speedster</p>
<br>
<br>


<!--  
	<a href="/rj_lab5/tests/ShowAllUsers_Tests.php">Show All Users</a>
	<a href="/rj_lab5/tests/ShowAllArticles.php">Show All Articles</a>
	<a href="/rj_lab5/create">Create Article</a>
	-->
<?php
	}
}