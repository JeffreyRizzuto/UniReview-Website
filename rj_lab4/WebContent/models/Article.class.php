<?php
class Article {
	private $articleId;
	private $editorId;
	private $articleTitle;
	private $submissionDate;
	private $pageText;
	
	public function __construct($formInput = null) {
		$this->formInput = $formInput;
		Messages::reset ();
		$this->initialize ();
	}
	
	private function extractForm($valueName) {
		$value = "";
		if (isset ( $this->formInput [$valueName] )) {
			$value = trim ( $this->formInput [$valueName] );
			$value = stripslashes ( $value );
			$value = htmlspecialchars ( $value );
			return $value;
		}
	}
	
	private function initialize() {
		if (is_null ( $this->articleId ))
			$this->initializeEmpty ();
	}
	private function initializeEmpty() {
		$user = $_SESSION ['user'];
		$this->editorId = $user->getUserId ();
		$this->articleTitle = extractForm("title");
		$this->pageText = extractForm("content");
	}
	
	// get
	public function getArticleId() {
		return $this->articleId;
	}
	public function getEditorId() {
		return $this->editorId;
	}
	public function getArticleTitle() {
		return $this->articleTitle;
	}
	public function getSubmissionDate() {
		return $this->submissionDate;
	}
	public function getPageText() {
		return $this->pageText;
	}
	
	// set
	public function setArticleId($articleId) {
		$this->articleId = $articleId;
	}
	public function setArticleTitle($title) {
		$this->articleTitle = $title;
	}
	public function setPageText($text) {
		$this->pageText = $text;
	}
}