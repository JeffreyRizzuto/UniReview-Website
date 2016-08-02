<!-- eventually these will be in the database, and the page with be created -->
<!-- for now, this is a hardcoded basic mock up -->

<?php
class TestReviewView {
	public static function show() {
		?>

<!DOCTYPE html>
<html>
<head>
<title>UniReview</title>
<!-- using open graph protocol http://ogp.me/ -->
<meta name="og:url"
	content="http://10.242.148.221/lab2/rj_lab2/testReview" />
<meta name="og:site_name" content="UniReview" />
<meta name="og:type" content="article" />
<meta name="og:title" content="GeForce GTX 980 Ti" />
<meta name="og:image" content="GeForce GTX 980 Ti" />
</head>

<body>
	<!-- Article header -->
	<div class="article-header">
		<!-- Article title -->
		<h1 class="article-title">GeForce GTX 980 Ti</h1>
	</div>
	<!-- Site subtitle -->
	<div id="site-sub">From UniReview, the wiki for reviews</div>

	<!-- Body content container -->
	<div id="body-content">

		<!-- Main product info panel -->
		<table class="vertical-navbox template-infobox" id="infobox">
			<caption class="template-infobox-title">GeForce GTX 980 Ti</caption>
			<tr>
				<td class="template-infobox-cover" colspan="2"><a
					href="resources/geforce_980_ti.jpg" class="image"><img
						alt="GeForce GTX 980 Ti" src="resources/geforce_980_ti.jpg"
						width="300" height="200" data-file-width="1920"
						data-file-height="1080" /></a></td>
				<!--  srcset for loading different size images -->
			</tr>


			<tr>
				<th class="template-infobox-header" colspan="2">Release Date</th>
			</tr>
			<tr>
				<td class="template-infobox-info">May 31, 2015</td>
			</tr>

			<tr>
				<th class="template-infobox-header" colspan="2">Developer</th>
			</tr>
			<tr>
				<td class="template-infobox-info"><a href="http://www.nvidia.com"
					title="Company:Nvidia">Nvidia</a></td>
			</tr>
			<tr>
				<th class="template-infobox-header" colspan="2">Codename</th>
			</tr>
			<tr>
				<td class="template-infobox-type"></td>
				<td class="template-infobox-info"><a
					href="https://en.wikipedia.org/wiki/Maxwell_(microarchitecture)"
					title="Codename:Maxwell">Maxwell</a></td>
			</tr>
			</tbody>
		</table>
		<table>

		</table>

		<!-- Page content tables -->

		<h3>
			<span class="headline" id="Retailers">Retailers</span> <span
				class="editselection"><span class="editsection-bracket">[</span><a
				href="home" title="Edit section: Retailers">edit</a><span
				class="meditsection-bracket">]</span></span>
		</h3>

		<table class="wikitable">
			<tr>
				<td style="width: 820px;">
					<ul>
						<li><a rel="link" class="external text"
							href="http://smile.amazon.com/EVGA-GeForce-Superclocked-Graphics-06G-P4-4992-KR/dp/B00YDAYOJG?sa-no-redirect=1#customerReviews">Amazon</a></li>
						</li>
					</ul>
				</td>
			</tr>
		</table>



		<h3>
			<span class="headline" id="Videos">Videos</span> <span
				class="editselection"><span class="editsection-bracket">[</span><a
				href="home" title="Edit section: Videos">edit</a><span
				class="meditsection-bracket">]</span></span>
		</h3>
		<h3>
			<span class="headline" id="Blogs">Blogs</span> <span
				class="editselection"><span class="editsection-bracket">[</span><a
				href="home" title="Edit section: Blogs">edit</a><span
				class="meditsection-bracket">]</span></span>
		</h3>
		<h3>
			<span class="headline" id="Reddit">Reddit</span> <span
				class="editselection"><span class="editsection-bracket">[</span><a
				href="home" title="Edit section: Reddit">edit</a><span
				class="meditsection-bracket">]</span></span>
		</h3>
	</div>
</body>
</html>
<?php
	}
}
?>