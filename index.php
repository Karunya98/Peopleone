<!DOCTYPE html>
<html>
<head>
    <title>User Authentication System</title>
    <style>
        body{
            background-image: url('Ref.gif');
            background-repeat: no-repeat;
            background-size: cover;
        }
    
        .fading-image {
            opacity: 0;
            animation: fade-in 2s ease-in-out;
        }

        .sliding-image {
            transform: translateX(-100%);
            animation: slide-in 2s ease-in-out;
        }

        .bouncing-image {
            animation: bounce 2s infinite;
        }

        .rotating-image {
            animation: rotate 2s infinite linear;
        }
        .container{
            margin: auto;
            width: 50%;
           
            padding: 109px;
        }

       

      

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        
    </style>
</head>
<body>
<a href="register.php">Login</a>
<a href="login.php">Login</a>
<a href="logout.php">Logout</a>
    <div class="container">
   
    <div class="bouncing-image">
        <img src="image1.png" alt="Bouncing Image">
    </div>
   
    </div>
</body>
</html>