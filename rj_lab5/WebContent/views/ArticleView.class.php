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
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		$base = (array_key_exists ( 'base', $_SESSION )) ? $_SESSION ['base'] : "";
		?>

<!-- Page Title -->

<div class="container">
	<div class="row">
		<div class="page-header col col-md-10">
			<h1><?php echo $article->getArticleTitle();?></h1>
		</div>
		<div class="page-header col col-md-2">
			<h1><a href="/<?php echo $base; echo "/"; echo $article->getArticleTitle();?>/edit" class="glyphicon glyphicon-cog"></a></h1>
		</div>
	</div>

	<!-- Retailers -->

	<div class="row">
		<div class="col col-md-8" id="Tables">
			<h2>Retailers</h2>
			<table class="table">
				<tbody>
			    		<?php
		if (! is_null ( $article->getRetailLinks () )) {
			foreach ( $article->getRetailLinks () as $name => $link ) {
				ArticleView::fillTable ( $name, $link );
			}
		}
		
		?>
				</tbody>

			</table>

		</div>
	</div>

	<!-- Videos -->

	<div class="row">
		<div class="col col-md-8" id="Tables">
			<h2>Videos</h2>
			<table class="table">
				<tbody>
			    			
			    		<?php
		if (! is_null ( $article->getVideoLinks () )) {
			foreach ( $article->getVideoLinks () as $name => $link ) {
				ArticleView::fillTable ( $name, $link );
			}
		}
		
		?>
				</tbody>

			</table>

		</div>
	</div>

	<!-- Articles -->

	<div class="row">
		<div class="col col-md-8" id="Tables">
			<h2>Articles</h2>
			<table class="table">
				<tbody>
			    			
			    		<?php
		if (! is_null ( $article->getArticleLinks () )) {
			foreach ( $article->getArticleLinks () as $name => $link ) {
				ArticleView::fillTable ( $name, $link );
			}
		}
		
		?>
				</tbody>

			</table>

		</div>
	</div>

	<!-- Other -->

	<div class="row">
		<div class="col col-md-8" id="Tables">
			<h2>Other</h2>
			<table class="table">
				<tbody>
			    			
			    		<?php
		if (! is_null ( $article->getOtherLinks () )) {
			foreach ( $article->getOtherLinks () as $name => $link ) {
				ArticleView::fillTable ( $name, $link );
			}
		}
		
		?>
				</tbody>

			</table>

		</div>
	</div>


</div>

<script>
$(document).ready(function() {

})
.on('click','.upvote', function() {
    $.post('vote', {voteType: 'upvote', linkName: $(this).attr("id")}, 'updateIcon(data, textStatus)', 'json');
    $(this).prop('disabled', true);
    $(this).find(".numberOfVotes").html(parseInt($($(this).find(".numberOfVotes")).html(), 10)+1)
})
.on('click','.downvote', function() {
	$.post('vote', {voteType: 'downvote', linkName: $(this).attr("id")}, 'updateIcon(data, textStatus)', 'json');
	$(this).prop('disabled', true);
	$(this).find(".numberOfVotes").html(parseInt($($(this).find(".numberOfVotes")).html(), 10)+1)
});

function updateIcon(data, textStatus) {
	
}

</script>

<?php
	}
	public static function fillTable($name, $link) {
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		$voteStatus;
		if (isset ( $user )) {
			$voteStatus = Vote::hasVoted ( $link );
		} else {
			echo "no user found";
			$voteStatus = true;
		}
		?>
<tr class='col'>
	<!-- upvote -->
	<td class="col-md-1"><button type="button"
			class="upvote btn btn-xs glyphicon glyphicon-thumbs-up <?php if($voteStatus)echo "disabled";?>"
			id="<?php echo $link?>" <?php if($voteStatus)echo "disabled";?>>
			<span class="numberOfVotes text-primary"><?php echo Vote::getUpvotes($link);?></span>
		</button></td>
	<!-- downvote -->
	<td class="col-md-1"><button type="button"
			class="downvote btn btn-xs glyphicon glyphicon-thumbs-down <?php if($voteStatus)echo "disabled";?>"
			id="<?php echo $link?>" <?php if($voteStatus)echo "disabled";?>>
			<span class="numberOfVotes text-danger"><?php echo Vote::getDownvotes($link);?></span>
		</button></td>
	<!-- link -->
	<td class="col-md-4"><?php echo $name;?></td>
	<td class="col-md-6"><?php
		
		if (! filter_var ( $link, FILTER_VALIDATE_URL ) === FALSE) {
			echo "<a href='$link'>$link</a>";
		} else {
			echo $link;
		}
		?>
			</td>
</tr>
<?php
	}
	public static function showBlankArticle($article) {
		?>
<h1 class="display-3">Error</h1>
<p class="display-1 text-muted">404 - File not found</p>

<p class="lead">
	That page you are looking for doesn't exist...<a href='create'>yet</a>
</p>


<?php
	}
}
