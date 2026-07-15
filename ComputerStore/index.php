<?php include("header.php"); ?>

<!-- CAROUSEL -->
<div id="featuredCarousel"
    class="carousel slide carousel-fade mb-5 shadow"
    data-bs-ride="carousel">

    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button"
            data-bs-target="#featuredCarousel"
            data-bs-slide-to="0"
            class="active"></button>

        <button type="button"
            data-bs-target="#featuredCarousel"
            data-bs-slide-to="1"></button>

        <button type="button"
            data-bs-target="#featuredCarousel"
            data-bs-slide-to="2"></button>
    </div>

    <!-- Slides -->
    <div class="carousel-inner rounded">

        <div class="carousel-item active">
            <img src="Feature Item 1.jpg"
                class="d-block w-100"
                alt="Featured Item 1">
        </div>

        <div class="carousel-item">
            <img src="Feature Item 2.jpg"
                class="d-block w-100"
                alt="Featured Item 2">
        </div>

        <div class="carousel-item">
            <img src="Feature Item 3.jpg"
                class="d-block w-100"
                alt="Featured Item 3">
        </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev"
        type="button"
        data-bs-target="#featuredCarousel"
        data-bs-slide="prev">

        <span class="carousel-control-prev-icon"></span>

    </button>

    <button class="carousel-control-next"
        type="button"
        data-bs-target="#featuredCarousel"
        data-bs-slide="next">

        <span class="carousel-control-next-icon"></span>

    </button>

</div>

<!-- FEATURED CATEGORIES -->
<div class="mt-5">

    <h1 class="text-center mb-4">
        Featured Categories
    </h1>

</div>

<!-- FEATURED PRODUCTS -->
<div class="mt-5">

    <h2 class="text-center mb-4">
        Latest Products
    </h2>

    <div class="row">

        <?php

        $result = $conn->query("
            SELECT *
            FROM products
            ORDER BY id DESC
            LIMIT 4
        ");

        while ($row = $result->fetch_assoc()) {

        ?>

            <div class="col-md-3 mb-4">

                <div class="card shadow h-100">

                    <a href="product.php?id=<?= $row['id'] ?>"
                        class="text-decoration-none text-dark">

                        <?php

                        $imagePath = "uploads/" . $row['image'];

                        if (!empty($row['image']) && file_exists($imagePath)) {

                        ?>

                            <img
                                src="<?= htmlspecialchars($imagePath) ?>"
                                class="card-img-top"
                                style="height:200px; object-fit:cover;"
                                alt="<?= htmlspecialchars($row['name']) ?>">

                        <?php } else { ?>

                            <img
                                src="https://via.placeholder.com/300x200?text=No+Image"
                                class="card-img-top"
                                style="height:200px; object-fit:cover;"
                                alt="No Image">

                        <?php } ?>

                        <div class="card-body">

                            <h5>
                                <?= htmlspecialchars($row['name']) ?>
                            </h5>

                            <p class="text-success fw-bold">
                                ₱<?= number_format($row['price'], 2) ?>
                            </p>

                        </div>

                    </a>

                    <div class="card-footer bg-white border-0">

                        <a
                            href="product.php?id=<?= $row['id'] ?>"
                            class="btn btn-primary w-100">

                        View Details

                        </a>

                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

</div>

<?php include("footer.php"); ?>