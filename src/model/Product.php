<?php

namespace app\model;

class Product
{

    public ?int $id = null;
    public string $title;
    public string $description;
    public float $price;
    public array $imageFile;
    public ?string $imagePath = null;

    public function load($data)
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'];
        $this->description = $data['description'] ?? '';
        $this->price = $data['price'];
        $this->imageFile = $data['imageFile'] ?? null;
        $this->imagePath = $data['image'] ?? null;
    }

    public function save()
    {
        $errors = [];
        if (!$this->title) {
            $errors[] = 'Product title is required';
        }
        if (!$this->price) {
            $errors[] = 'Product price is required';
        }
        if (!is_dir(__DIR__.'/../public/images')) {
            mkdir(__DIR__.'/../public/images');
        }

        if (empty($errors)) {
            if ($this->imageFile && $this->imageFile['temp_name']) {
                if ($this->imagePath) {
                    unlink(__DIR__.'/../public'.$this->imagePath);
                }
                $this->imagePath = "images/".randomString(8).'/'.$this->imageFile['name'];
                mkdir(dirname(__DIR__.'/../public/'.$this->imagePath));
                move_uploaded_file($this->imageFile['temp_name'],__DIR__.'/../public/'.$this->imagePath);
            }
        }
    }
}