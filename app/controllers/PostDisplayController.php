<?php
	
	namespace Controllers ;
	use Models\Posts ;

	class PostDisplayController
	{
		protected $twig ;

		public function __construct()
		{
			$loader = new \Twig_Loader_Filesystem( __DIR__ . "/../views") ;
			$this->twig = new \Twig_Environment($loader) ;
		}

		public function get()
		{
			session_start() ;
			if(isset($_SESSION['status']) && $_SESSION['status']=="1")
			{
				$username = $_SESSION['username'] ;
				$fullname = $_SESSION['fullname'] ;
				$all_posts = array() ;
				$all_posts = Posts::displayAllPosts() ;
				echo $this->twig->render("posts.html" , array(
					"all_posts" => $all_posts,
					"username" => $username,
					"fullname" => $fullname,
					"title" => "Posts"
					)) ;
			}
			else
			{
				echo $this->twig->render("login.html" , array(
					"error" => "Please login to Continue" ,
					"title" => "Login"
					)) ;
			}
		}
	}

?>