<?php
require_once "config.php"; // Include the database configuration file

class Dashboard {
    private $db;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Start the session only if it's not already started
        }
        $this->db = (new Database())->connect(); // Establish database connection
    }

    // Check if user is logged in
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Display user session details
    public function displaySessionData() {
        if ($this->isLoggedIn()) {
            echo "Welcome, " . htmlspecialchars($_SESSION['first_name']) . "";
           // echo "<p>Email: " . htmlspecialchars($_SESSION['email']) . "</p>";
        } else {
            echo "<p>Please <a href='index.php'>log in</a> to access the dashboard.</p>";
        }
    }

    public function verifyEmailAndRedirect($email)
{
    // Query to check if the email exists
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Set the session or any required authentication logic
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];

        return true; // Email exists
    }

    return false; // Email not found
}


    public function createSlidingImage($data)
{
    $query = "INSERT INTO sliding_images (image, intro_text, main_text, sub_text, button_name) 
              VALUES (:image, :intro_text, :main_text, :sub_text, :button_name)";
    $stmt = $this->db->prepare($query);

    return $stmt->execute([
        ':image' => $data['image'],
        ':intro_text' => $data['intro_text'],
        ':main_text' => $data['main_text'],
        ':sub_text' => $data['sub_text'],
        ':button_name' => $data['button_name']
    ]);
}
public function getSlidingImages()
{
    $query = "SELECT * FROM sliding_images ORDER BY id DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function getUsers()
{
    $query = "SELECT * FROM users ORDER BY id DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function changePassword($userId, $currentPassword, $newPassword)
{
    // Fetch the current password hash for the user
    $query = "SELECT password FROM users WHERE id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return false; // User not found
    }

    // Verify the current password
    if (!password_verify($currentPassword, $user['password'])) {
        return false; // Current password is incorrect
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $updateQuery = "UPDATE users SET password = :new_password WHERE id = :user_id";
    $updateStmt = $this->db->prepare($updateQuery);
    $updateStmt->bindParam(':new_password', $hashedPassword, PDO::PARAM_STR);
    $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

    return $updateStmt->execute();
}

public function deleteSlidingImage($id)
{
    $query = "DELETE FROM sliding_images WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

public function getSlidingImageById($id)
{
    // Ensure the ID is sanitized
    $id = intval($id);

    // Database connection


    try {
        // Prepare the SQL query
        $query = "SELECT * FROM sliding_images WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch and return the record as an associative array
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log or handle the error as needed
        error_log("Error fetching sliding image by ID: " . $e->getMessage());
        return false;
    }
}


public function updateSlidingImage($id, $data)
{
    $query = "UPDATE sliding_images SET 
                image = :image,
                intro_text = :intro_text,
                main_text = :main_text,
                sub_text = :sub_text,
                button_name = :button_name
              WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
    $stmt->bindParam(':intro_text', $data['intro_text'], PDO::PARAM_STR);
    $stmt->bindParam(':main_text', $data['main_text'], PDO::PARAM_STR);
    $stmt->bindParam(':sub_text', $data['sub_text'], PDO::PARAM_STR);
    $stmt->bindParam(':button_name', $data['button_name'], PDO::PARAM_STR);
    return $stmt->execute();
}



    // Update user profile
    public function updateProfile($name, $email) {
        if ($this->isLoggedIn()) {
            $userId = $_SESSION['user_id'];
            $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id", $userId);

            if ($stmt->execute()) {
                $_SESSION['name'] = $name;  // Update session data
                $_SESSION['email'] = $email;
                return "Profile updated successfully.";
            } else {
                return "Failed to update profile.";
            }
        } else {
            return "You are not logged in.";
        }
    }

    // Logout functionality
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }

    // Fetch additional user-related data
    public function fetchUserData() {
        if ($this->isLoggedIn()) {
            $userId = $_SESSION['user_id'];
            $query = "SELECT * FROM some_user_data WHERE user_id = :user_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":user_id", $userId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }


    public function updateGeneralInfo($data) {
        try {
            $query = "
                UPDATE general_info
                SET 
                    google_map_address = :google_map_address,
                    phone_number_1 = :phone_number_1,
                    phone_number_2 = :phone_number_2,
                    facebook_link = :facebook_link,
                    instagram_link = :instagram_link,
                    youtube_link = :youtube_link,
                    whatsapp_link = :whatsapp_link,
                    office_address = :office_address,
                    email = :email
                WHERE id = 1"; // Assuming there's only one row to update
    
            $stmt = $this->db->prepare($query);
    
            // Debugging: Check if all keys in $data are set
            $requiredKeys = [
                'google_map_address',
                'phone_number_1',
                'phone_number_2',
                'facebook_link',
                'instagram_link',
                'youtube_link',
                'whatsapp_link',
                'office_address',
                'email'
            ];
            foreach ($requiredKeys as $key) {
                if (!isset($data[$key])) {
                    throw new Exception("Missing parameter: $key");
                }
            }
    
            // Bind parameters
            $stmt->bindParam(":google_map_address", $data['google_map_address']);
            $stmt->bindParam(":phone_number_1", $data['phone_number_1']);
            $stmt->bindParam(":phone_number_2", $data['phone_number_2']);
            $stmt->bindParam(":facebook_link", $data['facebook_link']);
            $stmt->bindParam(":instagram_link", $data['instagram_link']);
            $stmt->bindParam(":youtube_link", $data['youtube_link']);
            $stmt->bindParam(":whatsapp_link", $data['whatsapp_link']);
            $stmt->bindParam(":office_address", $data['office_address']);
            $stmt->bindParam(":email", $data['email']);
    
            // Execute query
            if ($stmt->execute()) {
                //return "General information updated successfully!";
                header("Location:../backend/dashboard.php");
            } else {
                return "Failed to update general information.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Validation Error: " . $e->getMessage();
        }
    }


    public function updateSocialInfo($data) {
        try {
            $query = "
                UPDATE social_proof
                SET 
                    number1 = :number1,
                    desc1 = :desc1,
                    number2 = :number2,
                    desc2 = :desc2,
                    number3 = :number3,
                    desc3 = :desc3,
                    number4 = :number4,
                    desc4 = :desc4
                WHERE id = 1"; // Assuming there's only one row to update
    
            $stmt = $this->db->prepare($query);
    
            // Debugging: Check if all keys in $data are set
            $requiredKeys = [
                'number1',
                'desc1',
                'number2',
                'desc2',
                'number3',
                'desc3',
                'number4',
                'desc4'
            ];
            foreach ($requiredKeys as $key) {
                if (!isset($data[$key])) {
                    throw new Exception("Missing parameter: $key");
                }
            }
    
            // Bind parameters
            $stmt->bindParam(":number1", $data['number1']);
            $stmt->bindParam(":desc1", $data['desc1']);
            $stmt->bindParam(":number2", $data['number2']);
            $stmt->bindParam(":desc2", $data['desc2']);
            $stmt->bindParam(":number3", $data['number3']);
            $stmt->bindParam(":desc3", $data['desc3']);
            $stmt->bindParam(":number4", $data['number4']);
            $stmt->bindParam(":desc4", $data['desc4']);
         
            // Execute query
            if ($stmt->execute()) {
                //return "General information updated successfully!";
                header("Location:../backend/dashboard.php");
            } else {
                return "Failed to update general information.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Validation Error: " . $e->getMessage();
        }
    }

    public function updateAboutInfo($data) {
        try {
            $query = "
                UPDATE about_page
                SET 
                    intro_video_url = :intro_video_url,
                    who_we_are= :who_we_are,
                    our_philosophy=:our_philosophy
                WHERE id = 1"; // Assuming there's only one row to update
    
            $stmt = $this->db->prepare($query);
    
            // Debugging: Check if all keys in $data are set
            $requiredKeys = [
                'intro_video_url',
                'who_we_are',
                'our_philosophy',
               
            ];
            foreach ($requiredKeys as $key) {
                if (!isset($data[$key])) {
                    throw new Exception("Missing parameter: $key");
                }
            }
    
            // Bind parameters
            $stmt->bindParam(":intro_video_url", $data['intro_video_url']);
            $stmt->bindParam(":who_we_are", $data['who_we_are']);
            $stmt->bindParam(":our_philosophy", $data['our_philosophy']);
    
            // Execute query
            if ($stmt->execute()) {
                //return "General information updated successfully!";
                header("Location:../backend/dashboard.php");
            } else {
                return "Failed to update about information.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Validation Error: " . $e->getMessage();
        }
    }

    public function updateValuesInfo($data) {
        try {
            $query = "
                UPDATE core_values
                SET 
                    title1 = :title1,
                    description1= :description1,
                     title2 = :title2,
                    description2= :description2,

                     title3 = :title3,
                    description3= :description3,

                     title4 = :title4,
                    description4= :description4

                    
                WHERE id = 1"; // Assuming there's only one row to update
    
            $stmt = $this->db->prepare($query);
    
            // Debugging: Check if all keys in $data are set
            $requiredKeys = [
                'title1',
                'description1',
                'title2',
                'description2',
                'title3',
                'description3',
                'title4',
                'description4',
                
               
            ];
            foreach ($requiredKeys as $key) {
                if (!isset($data[$key])) {
                    throw new Exception("Missing parameter: $key");
                }
            }
    
            // Bind parameters
            $stmt->bindParam(":title1", $data['title1']);
            $stmt->bindParam(":description1", $data['description1']);
            $stmt->bindParam(":title2", $data['title2']);
            $stmt->bindParam(":description2", $data['description2']);

            $stmt->bindParam(":title3", $data['title3']);
            $stmt->bindParam(":description3", $data['description3']);

            $stmt->bindParam(":title4", $data['title4']);
            $stmt->bindParam(":description4", $data['description4']);

           
            // Execute query
            if ($stmt->execute()) {
                //return "General information updated successfully!";
                header("Location:../backend/dashboard.php");
            } else {
                return "Failed to update about information.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Validation Error: " . $e->getMessage();
        }
    }



    public function updateServicesInfo($data) {
        try {
            $query = "
                UPDATE services
                SET 
                    title1 = :title1,
                    description1= :description1,
                     title2 = :title2,
                    description2= :description2,

                     title3 = :title3,
                    description3= :description3,

                     title4 = :title4,
                    description4= :description4

                    
                WHERE id = 1"; // Assuming there's only one row to update
    
            $stmt = $this->db->prepare($query);
    
            // Debugging: Check if all keys in $data are set
            $requiredKeys = [
                'title1',
                'description1',
                'title2',
                'description2',
                'title3',
                'description3',
                'title4',
                'description4',
                
               
            ];
            foreach ($requiredKeys as $key) {
                if (!isset($data[$key])) {
                    throw new Exception("Missing parameter: $key");
                }
            }
    
            // Bind parameters
            $stmt->bindParam(":title1", $data['title1']);
            $stmt->bindParam(":description1", $data['description1']);
            $stmt->bindParam(":title2", $data['title2']);
            $stmt->bindParam(":description2", $data['description2']);

            $stmt->bindParam(":title3", $data['title3']);
            $stmt->bindParam(":description3", $data['description3']);

            $stmt->bindParam(":title4", $data['title4']);
            $stmt->bindParam(":description4", $data['description4']);

           
            // Execute query
            if ($stmt->execute()) {
                //return "General information updated successfully!";
                header("Location:../backend/dashboard.php");
            } else {
                return "Failed to update about information.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Validation Error: " . $e->getMessage();
        }
    }

    public function updateAbout($data) {
        try {
            $query = "
                UPDATE about
                SET 
                    photo = :photo,
                    about_1= :about_1,
                     about_2 = :about_2
                    

                    
                WHERE id = 1"; // Assuming there's only one row to update
    
            $stmt = $this->db->prepare($query);
    
            // Debugging: Check if all keys in $data are set
            $requiredKeys = [
                'photo',
                'about_1',
                'about_2',
               
                
               
            ];
            foreach ($requiredKeys as $key) {
                if (!isset($data[$key])) {
                    throw new Exception("Missing parameter: $key");
                }
            }
    
            // Bind parameters
            $stmt->bindParam(":photo", $data['photo']);
            $stmt->bindParam(":about_1", $data['about_1']);
            $stmt->bindParam(":about_2", $data['about_2']);
           

           
            // Execute query
            if ($stmt->execute()) {
                //return "General information updated successfully!";
                header("Location:../backend/dashboard.php");
            } else {
                return "Failed to update about information.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Validation Error: " . $e->getMessage();
        }
    }

    public function updateTestimonialsInfo($data) {
        try {
            $query = "
                UPDATE testimonials
                SET 
                    name1 = :name1,
                    details1= :details1,
                     name2 = :name2,
                    details2= :details2,

                     name3 = :name3,
                    details3= :details3

                    
                WHERE id = 1"; // Assuming there's only one row to update
    
            $stmt = $this->db->prepare($query);
    
            // Debugging: Check if all keys in $data are set
            $requiredKeys = [
                'name1',
                'details1',
                'name2',
                'details2',
                'name3',
                'details3',
            
               
            ];
            foreach ($requiredKeys as $key) {
                if (!isset($data[$key])) {
                    throw new Exception("Missing parameter: $key");
                }
            }
    
            // Bind parameters
            $stmt->bindParam(":name1", $data['name1']);
            $stmt->bindParam(":details1", $data['details1']);
            $stmt->bindParam(":name2", $data['name2']);
            $stmt->bindParam(":details2", $data['details2']);

            $stmt->bindParam(":name3", $data['name3']);
            $stmt->bindParam(":details3",$data['details3']);

           
            // Execute query
            if ($stmt->execute()) {
                //return "General information updated successfully!";
                header("Location:../backend/dashboard.php");
            } else {
                return "Failed to update about information.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Validation Error: " . $e->getMessage();
        }
    }

    public function updateTeamInfo($data){
    try {
        $query = "
            UPDATE team_members
            SET 
                name1 = :name1,
                photo1 = :photo1,
                role1 = :role1,

                name2 = :name2,
                photo2 = :photo2,
                role2 = :role2,

                name3 = :name3,
                photo3 = :photo3,
                role3 = :role3,

                name4 = :name4,
                photo4 = :photo4,
                role4 = :role4
                
            WHERE id = 1"; // Assuming there's only one row to update

        $stmt = $this->db->prepare($query);

        // Bind parameters
        $stmt->bindParam(":name1", $data['name1']);
        $stmt->bindParam(":role1", $data['role1']);
        $stmt->bindParam(":photo1", $data['photo1']);
        
        $stmt->bindParam(":name2", $data['name2']);
        $stmt->bindParam(":role2", $data['role2']);
        $stmt->bindParam(":photo2", $data['photo2']);
        
        $stmt->bindParam(":name3", $data['name3']);
        $stmt->bindParam(":role3", $data['role3']);
        $stmt->bindParam(":photo3", $data['photo3']);
        
        $stmt->bindParam(":name4", $data['name4']);
        $stmt->bindParam(":role4", $data['role4']);
        $stmt->bindParam(":photo4", $data['photo4']);

        // Execute query
        if ($stmt->execute()) {
            header("Location:../backend/dashboard.php");
        } else {
            return "Failed to update team information.";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    } catch (Exception $e) {
        return "Validation Error: " . $e->getMessage();
    }
}


    public function updatePropertyInfo($data){
        try {
            $query = "
                UPDATE properties
                SET 
                    property1 = :property1,
                    location1 = :location1,
                    photo1 = :photo1,

                    property2 = :property2,
                    location2 = :location2,
                    photo2 = :photo2,


                    property3 = :property3,
                    location3 = :location3,
                    photo3 = :photo3,


                    property4 = :property4,
                    location4 = :location4,
                    photo4 = :photo4,


                    property5 = :property5,
                    location5 = :location5,
                    photo5 = :photo5,


                    property6 = :property6,
                    location6 = :location6,
                    photo6 = :photo6
    
                   
                    
                WHERE id = 1"; // Assuming there's only one row to update
    
            $stmt = $this->db->prepare($query);
    
            // Bind parameters
            $stmt->bindParam(":property1", $data['property1']);
            $stmt->bindParam(":location1", $data['location1']);
            $stmt->bindParam(":photo1", $data['photo1']);

            $stmt->bindParam(":property2", $data['property2']);
            $stmt->bindParam(":location2", $data['location2']);
            $stmt->bindParam(":photo2", $data['photo2']);


            $stmt->bindParam(":property3", $data['property3']);
            $stmt->bindParam(":location3", $data['location3']);
            $stmt->bindParam(":photo3", $data['photo3']);


            $stmt->bindParam(":property4", $data['property4']);
            $stmt->bindParam(":location4", $data['location4']);
            $stmt->bindParam(":photo4", $data['photo4']);


            $stmt->bindParam(":property5", $data['property5']);
            $stmt->bindParam(":location5", $data['location5']);
            $stmt->bindParam(":photo5", $data['photo5']);


            $stmt->bindParam(":property6", $data['property6']);
            $stmt->bindParam(":location6", $data['location6']);
            $stmt->bindParam(":photo6", $data['photo6']);
            
            
    
            // Execute query
            if ($stmt->execute()) {
                header("Location:../backend/dashboard.php");
            } else {
                return "Failed to update team information.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Validation Error: " . $e->getMessage();
        }
    }
    
    
        public function getGeneralInfo() {
            try {
                $query = "SELECT * FROM general_info WHERE id = 1"; // Assuming a single row exists
                $stmt = $this->db->prepare($query);
                $stmt->execute();
        
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($result) {
                    return $result;
                } else {
                    return []; // Return empty array if no data is found
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage(); // For debugging, you may log this error
            }
        }
    
    public function getAboutInfo() {
        try {
            $query = "SELECT * FROM about_page WHERE id = 1"; // Assuming a single row exists
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return $result;
            } else {
                return []; // Return empty array if no data is found
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // For debugging, you may log this error
        }
    }


    public function getAbout() {
        try {
            $query = "SELECT * FROM about WHERE id = 1"; // Assuming a single row exists
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return $result;
            } else {
                return []; // Return empty array if no data is found
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // For debugging, you may log this error
        }
    }


    public function getValuesInfo() {
        try {
            $query = "SELECT * FROM core_values WHERE id = 1"; // Assuming a single row exists
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return $result;
            } else {
                return []; // Return empty array if no data is found
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // For debugging, you may log this error
        }
    }
    

    public function getServicesInfo() {
        try {
            $query = "SELECT * FROM services WHERE id = 1"; // Assuming a single row exists
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return $result;
            } else {
                return []; // Return empty array if no data is found
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // For debugging, you may log this error
        }
    }
    

    public function getTestimonialsInfo() {
        try {
            $query = "SELECT * FROM testimoniAls WHERE id = 1"; // Assuming a single row exists
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return $result;
            } else {
                return []; // Return empty array if no data is found
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // For debugging, you may log this error
        }
    }

    public function getTeamInfo() {
        try {
            $query = "SELECT * FROM team_members WHERE id = 1"; // Assuming a single row exists
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return $result;
            } else {
                return []; // Return empty array if no data is found
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // For debugging, you may log this error
        }
    }

    public function getPropertyInfo() {
        try {
            $query = "SELECT * FROM properties WHERE id = 1"; // Assuming a single row exists
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return $result;
            } else {
                return []; // Return empty array if no data is found
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // For debugging, you may log this error
        }
    }


    public function getSocialInfo() {
        try {
            $query = "SELECT * FROM social_proof WHERE id = 1"; // Assuming a single row exists
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return $result;
            } else {
                return []; // Return empty array if no data is found
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // For debugging, you may log this error
        }
    }

}
