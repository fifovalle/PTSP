<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin PTSP</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- OUR CSS -->
    <link rel="stylesheet" href="../assets/our/css/index.css">
    <link rel="stylesheet" href="../assets/our/css/profile.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- FAVICON -->
    <link rel="icon" href="../assets/image/logo/1.png">
</head>

<body>
    <!-- NAVBAR START-->
    <?php
    include "../partials/components/navbar.php";
    ?>
    <!-- NAVBAR END-->
    <section class="container-fluid mainWebsite">
        <section class="row">
            <!-- SIDEBAR START -->
            <?php
            include "../partials/components/sidebar.php"
            ?>
            <!-- SIDEBAR END -->
            <div class="container-fluid">
                <!-- MAIN START -->
                <main class="col-md-1 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between align-items-center text-center">
                        <h1 class="breadcrumb">Profil Saya</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <div class="avatar">
                                            <img src="../assets/image/logo/avatar2.jpg" class="avatarimage" alt="Avatar">
                                            <div class="middle" id="editAvatar"><i class='bx bx-pencil'></i></div>
                                        </div>
                                        <h3 class="mt-3">John Doe</h3>
                                        <p class="text-small">Junior Software Engineer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <form action="#" method="get">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" value="John Doe">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" value="john.doe@example.net">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" value="083xxxxxxxxx">
                                        </div>
                                        <div class="form-group">
                                            <label for="birthday" class="form-label">Birthday</label>
                                            <input type="date" name="birthday" id="birthday" class="form-control" placeholder="Your Birthday">
                                        </div>
                                        <div class="form-group">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FOOTER START -->
                    <?php include "../partials/components/footer.php" ?>
                    <!-- FOOTER END -->
                </main>
                <!-- MAIN END -->
            </div>
        </section>
    </section>

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <!-- OUR JS -->
    <script src="../assets/our/js/index.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>