<?php

namespace Ferre\Gastos\models;

use Error;
use Ferre\Gastos\models\Database;

class Category extends Database
{
    private int $id;

    public function __construct(private string $name)
    {
        parent::__construct();
    }

    public function save(): void
    {
        try {
            $query = $this->connect()->prepare("INSERT INTO categories (name) VALUES (:name)");
            $query->execute(["name" => $this->name]);
        } catch (\Throwable $th) {
            throw new \Error("Error al guardar: " . $th->getMessage());
        }
    }

    public static function getAll(): array | null
    {
        $data = [];

        try {
            $db = new Database();
            $query = $db->connect()->query("SELECT * FROM categories");
        } catch (\Throwable $th) {
            throw new \Error("Error al obtener los datos: " . $th->getMessage());
        }

        while ($result = $query->fetch()) {
            $data[] = Category::createFromArray($result);
        }

        return $data;
    }

    public static function get(int | string $id): Category | null
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare("SELECT * FROM categories WHERE id = :id");
            $query->execute(["id" => $id]);
        } catch (\Throwable $th) {
            throw new \Error("Error al obtener el dato: " . $th->getMessage());
        }

        if ($query->rowCount() <= 0) {
            return null;
        }

        $category = Category::createFromArray($query->fetch());

        return $category;
    }

    public function exists(string $name): bool
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare("SELECT * FROM categories WHERE name = :name");
            $query->execute(["name" => $name]);
        } catch (\Throwable $th) {
            throw new Error("Error: " . $th->getMessage());

        }

        return $query->rowCount() > 0;
    }

    public static function createFromArray(array $data): Category
    {
        $category = new Category($data["name"]);
        $category->setId($data["id"]);

        return $category;
    }

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    public function getid(): string | int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
