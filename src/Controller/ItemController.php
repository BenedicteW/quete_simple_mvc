<?php
/**
 * Created by PhpStorm.
 * User: Benedicte
 * Date: 08/10/2018
 * Time: 14:59
 */

namespace Controller;

use Model;


class ItemController extends AbstractController {

    protected $twig;

    public function index(){
        $itemManager = new Model\ItemManager($this->pdo);
        $items = $itemManager->selectAll();
        return $this->twig->render('Item.html.twig', ['items' => $items]);
    }

    public function show(int $id)
    {
        $itemManager = new Model\ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);

        return $this->twig->render('ShowItem.html.twig', ['item' => $item]);
    }

    public function add()
    {
        if (!empty($_POST)) {
            // TODO : validations des valeurs saisies dans le form
            // création d'un nouvel objet Item et hydratation avec les données du formulaire
            $item = new Model\Item();
            $item->setTitle($_POST['title']);

            $itemManager = new Model\ItemManager($this->pdo);
            // l'objet $item hydraté est simplement envoyé en paramètre de insert()
            $itemManager->insert($item);
            // si tout se passe bien, redirection
            header('Location: /');
            exit();
        }
        // le formulaire HTML est affiché (vue à créer)
        return $this->twig->render('AddItem.html.twig');
    }

    public function edit($id)
    {
        //On récupère l'objet (même chose que la méthode show()
        $itemManager = new Model\ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);

        //Si on poste quelque chose dans le formulaire :
        if (isset($_POST['title'])) {
            $item->setTitle($_POST['title']); //La catégorie dont on a indiqué le nom
            //L'objet $category hydraté est envoyé en paramètre de update() afin d'être édité
            $itemManager->update($item);
            //Si tout se passe bien, redirection
            header('Location: /');
            exit();
        }
        //Le formulaire HTML est affiché
        return $this->twig->render('EditItem.html.twig', ['item' => $item]);
    }

    public function delete($id)
    {
        //Même fonctionnement que pour edit
        $itemManager = new Model\ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);

        if (!empty($_POST)) {
            $itemManager->delete($item);
            header('Location: /');
            exit();
        }
        return $this->twig->render('DeleteItem.html.twig', ['item' => $item]);
    }

}



