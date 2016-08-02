<?php
class CreateArticleView {
	public static function show() {
		$_SESSION ['headertitle'] = "Create Page";
		MasterView::showHeader ();
		MasterView::showNavbar ();
		CreateArticleView::showDetails ();
		$_SESSION ['footertitle'] = "";
		MasterView::showFooter ();
	}
	public static function showDetails() {
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		$base = (array_key_exists ( 'base', $_SESSION )) ? $_SESSION ['base'] : "";
		?>
<h1>UniReview Create Page</h1>
<div class="container-fluid">
	<form id="createArticleForm" class="form-horizontal" action="create"
		method="Post">
		<label class="sr-only" for="articleTitle">Article Title</label>
		<div class="form-group">
			<input type="text" class="form-control" id="pageTitle"
				name="pageTitle" placeholder="Article Title" required>
		</div>

		<h3 id="Retailer">
			Retailer
			<button type="button"
				class="btn glyphicon glyphicon-plus addRetailer">
				<i class="fa fa-plus"></i>
			</button>
		</h3>

		<!-- The template for adding new Retailer -->
		<div class="form-group hide" id="retailerTemplate">
			<div class="row">
				<div class=" col-md-5 ">
					<input type="text" class="form-control" disabled="disabled" name="retailerTitle[]"
						placeholder="Title"/>
				</div>
				<div class=" col-md-5">
					<input type="text" class="form-control" disabled="disabled" name="retailerLink[]"
						placeholder="Link"/>
				</div>
				<div class=" col-md-2">
					<button type="button"
						class="btn glyphicon glyphicon-minus removeRetailer">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>

		<h3 id="Video">
			Video
			<button type="button" class="btn glyphicon glyphicon-plus addVideo">
				<i class="fa fa-plus"></i>
			</button>
		</h3>

		<!-- The template for adding new Video -->

		<div class="form-group hide" id="videoTemplate">
			<div class="row">
				<div class=" col-md-5 ">
					<input type="text" class="form-control" disabled="disabled" name="videoTitle[]"
						placeholder="Title"/>
				</div>
				<div class=" col-md-5">
					<input type="text" class="form-control" disabled="disabled" name="videoLink[]"
						placeholder="Link"/>
				</div>
				<div class=" col-md-2">
					<button type="button"
						class="btn glyphicon glyphicon-minus removeVideo">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>

		<h3 id="Article">
			Article/Blog
			<button type="button" class="btn glyphicon glyphicon-plus addArticle">
				<i class="fa fa-plus"></i>
			</button>
		</h3>

		<!-- The template for adding new Article -->

		<div class="form-group hide" id="articleTemplate">
			<div class="row">
				<div class=" col-md-5 ">
					<input type="text" class="form-control" disabled="disabled" name="articleTitle[]"
						placeholder="Title"/>
				</div>
				<div class=" col-md-5">
					<input type="text" class="form-control" disabled="disabled" name="articleLink[]"
						placeholder="Link"/>
				</div>
				<div class=" col-md-2">
					<button type="button"
						class="btn glyphicon glyphicon-minus removeArticle">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>

		<h3 id="Other">
			Other
			<button type="button" class="btn glyphicon glyphicon-plus addOther">
				<i class="fa fa-plus"></i>
			</button>
		</h3>

		<!-- The template for adding new Other -->

		<div class="form-group hide" id="otherTemplate">
			<div class="row">
				<div class=" col-md-5 ">
					<input type="text" class="form-control" disabled="disabled" name="otherTitle[]"
						placeholder="Title"/>
				</div>
				<div class=" col-md-5">
					<input type="text" class="form-control" disabled="disabled" name="otherLink[]"
						placeholder="Link"/>
				</div>
				<div class=" col-md-2">
					<button type="button"
						class="btn glyphicon glyphicon-minus removeOther">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>

		<input id="submitButton"
			type="submit" value="Submit">
	</form>
</div>
<script>
$(document).ready(function() {
	retailerIndex = 0;
	videoIndex = 0;
	articleIndex = 0;
	otherIndex = 0;
	$('#createArticleForm')

	 // Add button click handler
    .on('click', '.addRetailer', function() {
    	retailerIndex++;
        var $template = $('#retailerTemplate'),
            $clone    = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .attr('retailer-link-index', retailerIndex)
                            .prop('required',true)
                            .insertBefore($template)
                            .find(".form-control").prop("disabled", false);
    })
     // Remove button click handler
     .on('click', '.removeRetailer', function() {
         var $row  = $(this).parents('.form-group'),
                index = $row.attr('retailer-link-index');
         $row.remove();
     })
      .on('click', '.addVideo', function() {
    	videoIndex++;
        var $template = $('#videoTemplate'),
            $clone    = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .attr('video-link-index', videoIndex)
                            .prop('required',true)
                            .insertBefore($template)
                            .find(".form-control").prop("disabled", false);
    })
     // Remove button click handler
     .on('click', '.removeVideo', function() {
         var $row  = $(this).parents('.form-group'),
                index = $row.attr('video-link-index');
         $row.remove();
     })
      .on('click', '.addArticle', function() {
    	articleIndex++;
        var $template = $('#articleTemplate'),
            $clone    = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .attr('article-link-index', articleIndex)
                            .prop('required',true)
                            .insertBefore($template)
                            .find(".form-control").prop("disabled", false);
    })
     // Remove button click handler
     .on('click', '.removeArticle', function() {
         var $row  = $(this).parents('.form-group'),
                index = $row.attr('article-link-index');
         $row.remove();
     })
      .on('click', '.addOther', function() {
        otherIndex++;
        var $template = $('#otherTemplate'),
            $clone    = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .attr('other-link-index', otherIndex)
                            .prop('required',true)
                            .insertBefore($template)
                            .find(".form-control").prop("disabled", false);
        //$template.find(".form-control").prop("disabled", false);
    })
     // Remove button click handler
     .on('click', '.removeOther', function() {
         var $row  = $(this).parents('.form-group'),
                index = $row.attr('other-link-index');
         $row.remove();
    });
});
</script>
<?php
	}
}
?>
