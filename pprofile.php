<html>
<head>
    <link rel="stylesheet" href="profile2.css">
    <script>
        function validateFile() {
            var fileInput = document.getElementsByName('image')[0];
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload only images with the following extensions: .jpg, .jpeg, .png, .gif');
                fileInput.value = '';
                console.log('Validation function executed');
                return false;
            }

            var nameInput = document.getElementsByName('name')[0];
            var nameValue = nameInput.value.trim();

            if (nameValue === '') {
                alert('Name cannot be empty');
                nameInput.value = '';
                nameInput.focus();
                return false;
            }

            var rateInput = document.getElementsByName('rate')[0];
            var rateValue = rateInput.value.trim();

            if (rateValue === '') {
                alert('Rate cannot be empty');
                rateInput.value = '';
                rateInput.focus();
                return false;
            }
        }

        function validate() {
            var fileInput = document.getElementById('profilepic');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload only images with the following extensions: .jpg, .jpeg, .png, .gif');
                fileInput.value = '';
                console.log('Validation function executed');
                return false;
            }

            var nameInput = document.getElementsByName('name')[0];
            var nameValue = nameInput.value.trim();

            if (nameValue === '') {
                alert('Name cannot be empty');
                nameInput.value = '';
                nameInput.focus();
                return false;
            }

            var rateInput = document.getElementsByName('rate')[0];
            var rateValue = rateInput.value.trim();

            if (rateValue === '') {
                alert('Rate cannot be empty');
                rateInput.value = '';
                rateInput.focus();
                return false;
            }
        }

        function deleteImage(imageId) {
            if (confirm('Are you sure you want to delete this image?')) {
                fetch('delete_image.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        'image_id': imageId
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.response === 'success') {
                        alert('Image deleted successfully.');
                        // Reload the page
                        location.reload();
                    } else {
                        alert('Error deleting image: ' + data.response);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }

        function uploadImage() {
            var fileInput = document.getElementById('image');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload only images with the following extensions: .jpg, .jpeg, .png, .gif');
                fileInput.value = '';
                console.log('Validation function executed');
                return false;
            }

            var form = document.getElementById('uploadForm'); // Updated ID
            var formData = new FormData(form);

            fetch('add_image.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.response === 'success') {
                    alert('Image uploaded successfully.');
                    // Reload the page or update the image grid dynamically
                } else {
                    alert('Error uploading image: ' + data.response);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        fetch('add_image.php', {
    method: 'POST',
    body: formData
})
.then(response => {
    console.log('Response Headers:', response.headers);
    return response.json();
})
.then(data => {
    if (data.response === 'success') {
        alert('Image uploaded successfully.');
        // Reload the page or update the image grid dynamically
    } else {
        alert('Error uploading image: ' + data.response);
    }
})
.catch(error => {
    console.error('Error:', error);
});
    </script>
</head>
<body>
    <div class="home">
        <div class="navbar">
            <img src="logo.png" class="logo">
            <ul>
                <li><a href="slogin.php">Home</a></li>
                <li><a href="newabout.php">About</a></li>
                <li><a href="aimg.php">Image</a></li>
                <li><a href="photog.php">Photographer</a></li>
            </ul>
        </div>
    </div>

    <div class="profile-header">
        <div class="profile-info">
            <h1>Info :</h1>
        </div>
        <div class="about">
            <form id="infoForm" onsubmit="event.preventDefault(); validateFile(); uploadImage();">
                Name: <input type="text" name="name"><br><br>
                Email: <input type="text" name="email"><br><br>
                Contact: <input type="number" name="contact"><br><br>
                Rate: <input type="number" name="rate"><br><br>
            </form>
            <form id="uploadForm" onsubmit="event.preventDefault(); uploadImage();">
                Image To Upload: <input type="file" name="image" id="image">
                <input type="submit" name="submit" value="Upload">
            </form>
        </div>
        <div class="profile-picture">
            <form action="prof.php" method="POST" enctype="multipart/form-data" onsubmit="return validate();">
                Add Profile Picture: <input type="file" name="profilepic" id="profilepic">
                <input type="submit" name="submit-profilepic" value="Upload">
            </form>
        </div>
    </div>

    <div class="post-grid">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT id, name, email, contact, image_data FROM Image";  // Added 'id' in the SELECT statement
        $result = mysqli_query($conn, $sql);
        $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (isset($_POST['delete_image'])) {
            $imageId = $_POST['image_id'];
            
            // Perform deletion query
            $deleteQuery = "DELETE FROM Image WHERE id = '$imageId'";
            $deleteResult = mysqli_query($conn, $deleteQuery);
        
            if ($deleteResult) {
                echo "Image deleted successfully.";
            } else {
                echo "Error deleting image: " . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
        $included = true;
        include('delete_image.php');
        ?>
        <?php foreach ($images as $image): ?>
            <?php $base64Image = base64_encode($image['image_data']); ?>
            <div class="image-container">
                <img src="data:image/jpg;base64,<?= $base64Image ?>" alt="<?= $image['name'] ?>">
                <form action="delete_image.php" method="POST">
                    <input type="hidden" name="image_id" value="<?= $image['id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="profilepic">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql1 = "SELECT name, type, data FROM ProfilePictures";
        $result1 = mysqli_query($conn, $sql1);
        $profilePictures = mysqli_fetch_all($result1, MYSQLI_ASSOC);

        mysqli_close($conn);
        ?>
        <?php foreach ($profilePictures as $picture): ?>
            <?php $base64Image = base64_encode($picture['data']); ?>
            <img src="data:<?= $picture['type'] ?>;base64,<?= $base64Image ?>" alt="<?= $picture['name'] ?>">
        <?php endforeach; ?>
    </div>
</body>
</html>
