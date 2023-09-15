<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Filter</title>
</head>
<body>
    <h1>Product Filter</h1>
    <div id="price-filter">
        <label for="min-price">Min Price:</label>
        <input type="number" id="min-price" name="min-price" value="0">
        <label for="max-price">Max Price:</label>
        <input type="number" id="max-price" name="max-price" value="100">
        <button id="filter-button">Filter</button>
    </div>

    <div id="product-list">
        <!-- Product list will be displayed here -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function filterProducts(minPrice, maxPrice) {
                $.ajax({
                    url: 'filter_products.php',
                    method: 'POST',
                    data: {
                        min_price: minPrice,
                        max_price: maxPrice
                    },
                    success: function(response) {
                        $('#product-list').html(response);
                    }
                });
            }

            // Initial load of all products
            filterProducts(0, 100);

            $('#filter-button').click(function() {
                const minPrice = $('#min-price').val();
                const maxPrice = $('#max-price').val();
                filterProducts(minPrice, maxPrice);
            });
        });
    </script>
</body>
</html>
