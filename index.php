<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        background-image: url('1.jpg'); /* Change to your actual file name */
        background-size: cover;          /* Stretches and scales the image to fill the whole screen */
        background-position: center;     /* Keeps the center of the image focused */
        background-repeat: no-repeat;    /* Prevents the image from repeating */
        background-attachment: fixed;    /* Locks the background in place when scrolling */
        min-height: 100vh;               /* Forces the body to take up the full screen height */
    }
    .container {
        margin-top: 30px;
        background: rgba(255, 255, 255, 0.95); 
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
    }
    /* Mountain-Matched Forest-to-Sage Header Banner Styling */
    .header-banner {
        background: linear-gradient(135deg, #1b4332, #40916c);
        color: white;
        padding: 20px 25px;
        border-radius: 8px;
        margin-bottom: 25px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
    }
    /* Custom button override to match the moody dark forest green */
    .btn-mountain {
        background-color: #2d6a4f;
        border-color: #2d6a4f;
        color: white;
    }
    .btn-mountain:hover {
        background-color: #1b4332;
        border-color: #1b4332;
        color: white;
    }
</style>
</head>
<body>
    <div class="container">

        <!-- HEADER BANNER -->
        <div class="header-banner d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="fw-bold mb-1">Student Information System</h2>
            </div>
            <span class="badge bg-light text-dark px-3 py-2 fs-6 shadow-sm">BSIS Portal</span>
        </div>
        
        <!-- Button trigger modal for Adding -->
        <button type="button" class="btn btn-mountain mb-3" data-bs-toggle="modal" data-bs-target="#add">
            + Add Student
        </button>

        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'database.php';

                        $query = "SELECT id, firstname, lastname, email FROM students";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_result($id, $firstname, $lastname, $email);
                        $stmt->execute();
                        
                        while ($stmt->fetch()) {
                        ?>
                        <tr>
                            <td><?php echo $firstname ?></td>
                            <td><?php echo $lastname ?></td>
                            <td><?php echo $email ?></td>
                            <td>
                                <!-- Edit Button trigger modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $id ?>">
                                    Edit Student
                                </button>
                                
                                <!-- Delete Link -->
                                <a type="button" href="delete.php?id=<?php echo $id ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>

                        <!-- Modal for Editing (Inside the loop so each row has its own modal ID) -->
                        <div class="modal fade" id="edit<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="update.php" method="post">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">edit student</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">
                                            <div class="mb-3">
                                                <label class="form-label">First Name</label>
                                                <input type="text" value="<?php echo $firstname ?>" name="firstname" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Last name</label>
                                                <input type="text" name="lastname" value="<?php echo $lastname ?>" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" value="<?php echo $email ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-mountain">SAVE CHANGES</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Student -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="insert.php" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Student</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last name</label>
                            <input type="text" name="lastname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-mountain">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>