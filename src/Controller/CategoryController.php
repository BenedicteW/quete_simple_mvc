<?php
/**
 * Created by PhpStorm.
 * User: Benedicte
 * Date: 08/10/2018
 * Time: 15:43
 */

namespace Controller;

use Model\CategoryManager;

use Twig_Loader_Filesystem;
use Twig_Environment;


class CategoryController
{
    private $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem('../src/View');
        $this->twig = new Twig_Environment($loader, array(
            "cache" => false
        ));
    }

    public function showAllCategories(){
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();
        return $this->twig->render('Categories.html.twig', ['categories' => $categories]);
    }

    public function showOneCategory(int $id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneCategory($id);
        return $this->twig->render('ShowCategory.html.twig', ['category' => $category]);
    }

}