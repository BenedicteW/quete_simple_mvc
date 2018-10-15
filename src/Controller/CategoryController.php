<?php
/**
 * Created by PhpStorm.
 * User: Benedicte
 * Date: 08/10/2018
 * Time: 15:43
 */

namespace Controller;

use Model;

class CategoryController extends AbstractController
{
    protected $twig;

    public function index(){
        $categoryManager = new Model\CategoryManager($this->pdo);
        $categories = $categoryManager->selectAll();
        return $this->twig->render('category.html.twig', ['categories' => $categories]);
    }

    public function show(int $id)
    {
        $categoryManager = new Model\CategoryManager($this->pdo);
        $category = $categoryManager->selectOneById($id);

        return $this->twig->render('ShowCategory.html.twig', ['category' => $category]);
    }

    public function add()
    {
        if (!empty($_POST)) {
            // TODO : validations des valeurs saisies dans le form
            // création d'un nouvel objet Item et hydratation avec les données du formulaire
            $category = new Model\Category();
            $category->setName($_POST['name']);

            $categoryManager = new Model\CategoryManager($this->pdo);
            // l'objet $item hydraté est simplement envoyé en paramètre de insert()
            $categoryManager->insert($category);
            // si tout se passe bien, redirection
            header('Location: /categories');
            exit();
        }
        // le formulaire HTML est affiché (vue à créer)
        return $this->twig->render('AddCategory.html.twig');
    }

    public function edit($id)
    {
        //On récupère l'objet (même chose que la méthode show()
        $categoryManager = new Model\CategoryManager($this->pdo);
        $category = $categoryManager->selectOneById($id);

        //Si on poste quelque chose dans le formulaire :
        if (isset($_POST['name'])) {
            $category->setName($_POST['name']); //La catégorie dont on a indiqué le nom
            //L'objet $category hydraté est envoyé en paramètre de update() afin d'être édité
            $categoryManager->update($category);
            //Si tout se passe bien, redirection
            header('Location: /categories');
            exit();
        }
        //Le formulaire HTML est affiché
        return $this->twig->render('EditCategory.html.twig', ['category' => $category]);
    }

    public function delete($id)
    {
        //Même fonctionnement que pour edit
        $categoryManager = new Model\CategoryManager($this->pdo);
        $category = $categoryManager->selectOneById($id);

        if (!empty($_POST)) {
            $categoryManager->delete($category);
            header('Location: /categories');
            exit();
        }
        return $this->twig->render('DeleteCategory.html.twig', ['category' => $category]);
    }
}