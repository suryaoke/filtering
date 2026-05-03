<?php

namespace App\Livewire;

use App\Interface\ProductRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class ProductManagerCopy extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $productId = null;

    public ?string $name = '';
    public ?string $sku = '';
    public ?string $description = '';
    public ?string $price = '';
    public ?int $stock = 0;
    public ?string $category = '';
    public ?int $is_active = 1;

    public bool $isOpen = false;
    public bool $isDeleteOpen = false;
    public ?int $confirmingDeletionId = null;

    // ✅ Tetap sebagai property array, bukan method
    protected array $rules = [
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
        'description' => 'nullable|string',
        'category'    => 'nullable|string|max:100',
        'is_active'   => 'required|in:0,1',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = app(ProductRepositoryInterface::class)->getAllPaginated(10, [
            'search' => $this->search,
        ]);

        return view('livewire.product-manager-copy', compact('products'));
    }

    public function create(): void
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal(): void
    {
        $this->isOpen = true;
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields(): void
    {
        $this->productId   = null;
        $this->name        = '';
        $this->sku         = '';
        $this->description = '';
        $this->price       = '';
        $this->stock       = 0;
        $this->category    = '';
        $this->is_active   = 1;
        $this->resetValidation(); // ✅ bersihkan error validasi lama
    }

    public function store(): void
    {
        $skuRule = $this->productId 
            ? 'required|string|max:100|unique:products,sku,' . $this->productId 
            : 'required|string|max:100|unique:products,sku';

        // ✅ Validasi SKU dinamis di sini saja
        $this->validate(array_merge($this->rules, [
            'sku' => $skuRule,
        ]));

        $data = [
            'name'        => $this->name,
            'sku'         => $this->sku,
            'description' => $this->description,
            'price'       => $this->price,
            'stock'       => $this->stock,
            'category'    => $this->category,
            'is_active'   => $this->is_active,
        ];

        $repository = app(ProductRepositoryInterface::class);

        if ($this->productId) {
            $repository->update($this->productId, $data);
            $message = 'Product updated successfully.';
        } else {
            $repository->create($data);
            $message = 'Product created successfully.';
        }

        $this->closeModal();
        $this->dispatch('swal:success', title: 'Success', text: $message);
    }

    public function edit(int $id): void
    {
        $product = app(ProductRepositoryInterface::class)->findOrFail($id);

        $this->productId   = $id;
        $this->name        = $product->name;
        $this->sku         = $product->sku;
        $this->description = $product->description ?? '';
        $this->price       = (string) $product->price;
        $this->stock       = (int) $product->stock;
        $this->category    = $product->category ?? '';
        $this->is_active   = $product->is_active ? 1 : 0;

        $this->resetValidation(); // ✅ bersihkan error dari form sebelumnya
        $this->openModal();
    }

    public function confirmDelete(int $id): void
    {
        $this->confirmingDeletionId = $id;
        $this->isDeleteOpen = true;
    }

    public function closeDeleteModal(): void
    {
        $this->isDeleteOpen = false;
        $this->confirmingDeletionId = null;
    }

    public function delete(): void
    {
        if (!$this->confirmingDeletionId) return;

        app(ProductRepositoryInterface::class)->delete($this->confirmingDeletionId);

        $this->closeDeleteModal();
        $this->dispatch('swal:success', title: 'Deleted', text: 'Product deleted successfully.');
    }
}
