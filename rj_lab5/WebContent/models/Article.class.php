<?php
class Article {
	private $articleId;
	private $editorId;
	private $articleTitle;
	private $submissionDate;
	private $retailerLinks;
	private $videoLinks;
	private $articleLinks;
	private $otherLink;
	public function __construct($formInput = null) {
		$this->formInput = $formInput;
		Messages::reset ();
		$this->initializeEmpty ();
	}
	private function extractForm($linkName, $linkLocation) {
		$keys = null;
		$values = null;
		$tempSpot = "";
		
		foreach ( $this->formInput as $title => $array ) {
			if ($title == $linkName) {
				if (is_array ( $array )) {
					foreach ( $array as $key => $value ) {
						$keys[] = $value;
						
						//echo "<br>-----------------------<br>";
						//echo "$key and $value";
					}
				} else {
					$keys[] = $value;
				}
			} elseif ($title == $linkLocation) {
				if (is_array ( $array )) {
					foreach ( $array as $key => $value ) {
					$values[] = $value;
					}
				} else {
					$values[] = $value;
				}
			}
		}

		//echo "<br><br>";
		if(is_array($keys) && is_array($values)){
			$returnVal = array_combine($keys,$values);
			//print_r ( $returnVal );
			return $returnVal;
		} else {
			return null;
		}
	}
	private function initializeEmpty() {
		// print_r($this->formInput);
		if (isset ( $this->formInput ["articleID"] )) {
			$this->articleId = $this->formInput ["articleID"];
			$this->editorId = $this->formInput ["editorID"];
			$this->articleTitle = $this->formInput ["articleTitle"];
			$this->submissionDate = $this->formInput ["submissionDate"];
			
			// unseralize
			$this->retailerLinks = unserialize ( $this->formInput ["retailers"] );
			$this->videoLinks = unserialize ( $this->formInput ["videos"] );
			$this->articleLinks = unserialize ( $this->formInput ["articles"] );
			$this->otherLinks = unserialize ( $this->formInput ["others"] );
		} else {
			$this->initialize ();
		}
	}
	private function initialize() {
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		$this->editorId = $user->getUserId ();
		if (isset ( $this->formInput ["pageTitle"] )) {
			$title = $this->formInput ["pageTitle"];
			$title = trim ( $title );
			$title = stripslashes ( $title );
			$title = htmlspecialchars ( $title );
			$title = str_replace(' ', '_', $title);
			$this->articleTitle = $title;
		}
		$this->retailerLinks = $this->extractForm ( "retailerTitle", "retailerLink" );
		$this->videoLinks = $this->extractForm ( "videoTitle", "videoLink" );
		$this->articleLinks = $this->extractForm ( "articleTitle", "articleLink" );
		$this->otherLinks = $this->extractForm ( "otherTitle", "otherLink" );
		//print_r($this->retailerLinks);
	}
	
	// get
	public function getArticleId() {
		return $this->articleId;
	}
	public function getEditorId() {
		return $this->editorId;
	}
	public function getArticleTitle() {
		$title = $this->articleTitle;
		$title = str_replace('_', ' ', $title);
		return $title;
	}
	public function getDBArticleTitle() {
		return $this->articleTitle;
	}
	public function getSubmissionDate() {
		return $this->submissionDate;
	}
	public function getRetailLinks() {
		return $this->retailerLinks;
	}
	public function getVideoLinks() {
		return $this->videoLinks;
	}
	public function getArticleLinks() {

		return $this->articleLinks;
	}
	public function getOtherLinks() {
		return $this->otherLinks;
	}
	
	public function getAllLinks(){
		$allArray;
		foreach ((array)$this->retailerLinks as $link){
			$allArray[] = $link;
		}
		foreach ((array)$this->videoLinks as $link){
			$allArray[] = $link;
		}
		foreach ((array)$this->articleLinks as $link){
			$allArray[] = $link;
		}
		foreach ((array)$this->otherLinks as $link){
			$allArray[] = $link;
		}
		return $allArray;
	}
	
	// MySQL serealized!!
	public function getSerializedRetailers() {
		return serialize ( $this->retailerLinks );
	}
	public function getSerializedVideos() {
		return serialize ( $this->videoLinks );
	}
	public function getSerializedArticles() {
		return serialize ( $this->articleLinks );
	}
	public function getSerializedOthers() {
		return serialize ( $this->otherLinks );
	}
	
	// set
	public function setArticleId($articleId) {
		$this->articleId = $articleId;
	}
	public function setArticleTitle($title) {
		$this->articleTitle = $title;
	}
	public function setSubmissionDate($date) {
		$this->submissionDate = $date;
	}
	public function setPageText($text) {
		$this->pageText = $text;
	}
}