<?php
/**
 * Клас Product — модель товару
 *
 * Використовується у всіх завданнях ЛР3 (варіант 20).
 */

class Product
{
    public string $name;
    public float $diameter;
    public int $moons;

    /**
     * Конструктор — задає початкові значення властивостей
     */
    public function __construct(string $name = '', float $diameter = 0.0, int $moons = 0)
    {
        $this->name = $name;
        $this->diameter = $diameter;
        $this->moons = $moons;
    }

    /**
     * Виводить інформацію про товар
     */
    public function getInfo(): string
    {
        return "Планета: {$this->name}, Діаметр: {$this->diameter}, Супутників: {$this->moons}";
    }

    /**
     * При клонуванні — встановлює значення за замовчанням
     */
    public function __clone(): void
    {
        $this->name = 'Невідома';
        $this->diameter = 0.0;
        $this->moons = 0;
    }
}
