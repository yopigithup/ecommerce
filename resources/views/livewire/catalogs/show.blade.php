<div class="card card-compact bg-base-100 w-96 shadow-xl mx-auto">
    <figure>
        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Shoes" />
    </figure>
    <div class="card-body">

        <h2 class="card-title">{{ $product->name }} </h2>

        <p>{{ $product->description }}</p>


        <div class="card-actions justify-end">
            <button class="btn btn-primary">Add to cart </button>
        </div>
    </div>
</div>
