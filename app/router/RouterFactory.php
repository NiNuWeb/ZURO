<?php

use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public function createRouter()
	{

		$router = new RouteList();

		$router[] = new Route('index.php', 'Homepage:Default:page', Route::ONE_WAY);
		
		$router[] = $adminRouter = new RouteList('Admin');
		//Admin
		$adminRouter[] = new Route('admin/<presenter>/<action>/<id>', array(
			'presenter' => 'Default',
			'action' => 'default',
			'id' => NULL,
		));

		$router[] = $frontRouter = new RouteList('Front');
		//Front
		$frontRouter[] = new Route('<slug [a-z0-9_-]+>', array(
			'presenter' => 'Homepage',
			'action' => 'page',
			'slug' => NULL
		));

		$router[] = new Route('register/register', 'Front:Register:register');
		$router[] = new Route('sign/in', 'Front:Sign:in');
		$router[] = new Route('news/single/<id>', 'Front:News:single');

		return $router;
	}

}
