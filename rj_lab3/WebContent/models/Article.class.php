<?php
class Article {
	private $articleId;
	private $editorId;
	private $articleTitle;
	private $submissionDate;
	private $pageText;
	public function __construct($articleId = null, $editorId = null, $articleTitle = null, $submissionDate = null, $pageText = null) {
		$this->articleId = $articleId;
		$this->editorId = $editorId;
		$this->articleTitle = $articleTitle;
		$this->submissionDate = $submissionDate;
		$this->pageText = $pageText;
		$this->initialize ();
	}
	private function initialize() {
		if (is_null ( $this->articleId ))
			$this->initializeEmpty ();
	}
	private function initializeEmpty() {
		$user = $_SESSION ['user'];
		$this->editorId = $user->getUserId ();
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