<?php

namespace Ferre\Gastos\models;

use Ferre\Gastos\models\Database;

class Expense extends Database
{
    private Category $category;
    private string $date;

    public function __construct(private string $title, private int $categoryId, private float $expense)
    {
        parent::__construct();
    }

    public function save(): void
    {
        try {
            $query = $this->connect()->prepare("INSERT INTO expenses (title, expense, category_id, date) VALUES (:title, :expense, :category_id, NOW())");

            $query->execute(["title" => $this->title, "expense" => $this->expense, "category_id" => $this->categoryId]);
        } catch (\Throwable $th) {
            throw new \Error("Error al guardar: " . $th->getMessage());
        }
    }

    public static function getAll(): array | null
    {
        $data = [];

        try {
            $db = new Database();
            $query = $db->connect()->query("SELECT * FROM expenses");
        } catch (\Throwable $th) {
            throw new \Error("Error al obtener los datos: " . $th->getMessage());
        }

        while ($result = $query->fetch()) {
            $data[] = Expense::createFromArray($result);
        }

        return $data;
    }

    public static function createFromArray(array $data): Expense
    {
        $expense = new Expense($data["title"], $data["category_id"], $data["expense"]);
        $expense->setDate($data["date"]);
        $expense->setCategory(Category::get($data["category_id"]));

        return $expense;
    }

    public static function getTotal(array $expenses): int | float
    {
        $total = 0;

        foreach ($expenses as $expense) {
            $total += $expense->getExpense();
        }

        return $total;
    }

    public function setDate(string $value): void
    {
        $this->date = $value;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setCategory(Category $value): void
    {
        $this->category = $value;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getExpense(): float
    {
        return $this->expense;
    }
}
