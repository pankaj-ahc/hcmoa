<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dynamic Boxes</title>
    <style>
        .box {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row" id="boxContainer"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="./include/jquery.min.js"></script>
    <script>
        // Function to generate rectangular boxes dynamically
        function generateBoxes(boxCount) {
            var boxContainer = $('#boxContainer');
            boxContainer.empty();

            // Calculate the number of columns based on boxCount
            var columns = Math.ceil(Math.sqrt(boxCount));

            // Calculate the size of each box
            var boxSize = 100 / columns;

            // Create boxes dynamically
            for (var i = 1; i <= boxCount; i++) {
                var box = $('<div class=" box">Box ' + i + '</div>');
                boxContainer.append(box);
            }
        }

        // Example: Generate boxes based on a specific count
        generateBoxes(20);
    </script>
</body>
</html>
