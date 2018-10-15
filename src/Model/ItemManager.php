<?php
/**
 * Created by PhpStorm.
 * User: Benedicte
 * Date: 08/10/2018
 * Time: 14:58
 */

namespace Model;

use Model\Item;

class ItemManager extends AbstractManager{

    const TABLE = 'item';

    public function __construct($pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    public function insert($item): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }

    public function update(Item $item) //requête SQL d'insertion pour éditer.
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE ." SET item.`title` = :title WHERE item.`id` = :id"); //UPDATE ... SET = syntaxe SQL pour éditer
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR); //On associe la nouvelle valeur au paramètre
        $statement->bindValue('id', $item->getId(), \PDO::PARAM_INT); //On associe la nouvelle valeur au paramètre
        return $statement->execute();
    }

    public function delete(Item $item) //requête SQL pour supprimer.
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE `id` = :id");
        $statement->bindValue('id', $item->getId(), \PDO::PARAM_INT);
        return $statement->execute();
    }

}

// récupération de tous les items

