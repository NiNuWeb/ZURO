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
		$adminRouter[] = new Route('admin/[<locale=en en|sk>/]<presenter>/<action>/<id>', array(
			'presenter' => 'Default',
			'action' => 'default',
			'id' => NULL,
		));

		$router[] = $frontRouter = new RouteList('Front');
		//Front
		$frontRouter[] = new Route('[<locale=en en|sk>/]<slug [a-z0-9_-]+>', array(
			'presenter' => 'Homepage',
			'action' => 'page',
			'slug' => NULL
		));

		$router[] = new Route('[<locale=en en|sk>/]register/register', 'Front:Register:register');
		$router[] = new Route('[<locale=en en|sk>/]sign/in', 'Front:Sign:in');
		$router[] = new Route('[<locale=en en|sk>/]news/single/<id>', 'Front:News:single');

		return $router;
	}

}
