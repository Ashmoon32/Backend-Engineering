<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Travel Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="text-center">Admin Control Panel</h1>
                        <form action="add_package_logic.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label>Package Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Price ($)</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Transport</label>
                                <select name="transport" class="form-control">
                                    <option value="Bus">Bus</option>
                                    <option value="Train">Train</option>
                                    <option value="Flight">Flight</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Destination Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="d-grid gap-2 col-2 mx-auto">
                                <button type="submit" name="add_package_btn" class="btn btn-primary">
                                    Add Package
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>