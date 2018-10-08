<?php
/**
 * Created by PhpStorm.
 * User: Benedicte
 * Date: 08/10/2018
 * Time: 14:59
 */

namespace Controller;

use Model\ItemManager;
use View\View;

use Twig_Loader_Filesystem;
use Twig_Environment;

class ItemController{

    private $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem('../src/View');
        $this->twig = new Twig_Environment($loader, array(
            "cache" => false
        ));
    }

    public function index(){
        $itemManager = new ItemManager();
        $items = $itemManager->selectAllItems();
        return $this->twig->render('Item.html.twig', ['items' => $items]);
    }

    public function show(int $id)
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneItem($id);

        return $this->twig->render('ShowItem.html.twig', ['item' => $item]);
    }

}



