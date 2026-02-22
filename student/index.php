<!DOCTYPE html>
<html>
<head>
	<title>Online Library Management System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<style type="text/css">
		nav {
			float: right;
			word-spacing: 20px;
			padding: 10px;
		}

		nav ul {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		nav li {
			display: inline;
			line-height: 20px;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<header>
			<div class="logo">
				<img src="images/9.png">
				<h1 style="color: white;">ONLINE LIBRARY MANAGEMENT SYSTEM</h1>
			</div>

			<nav>
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li><a href="books.php">BOOKS</a></li>
					<li><a href="student_login.php">LOGOUT</a></li>					
					<li><a href="feedback.php">FEEDBACK</a></li>
				</ul>
			</nav>
		</header>

		<section>
			<div class="sec_img">
				<div class="w3-content w3-section" style="width: 100%; height: 100px">
					<img class="mySlides w3-animate-left" src="images/a.jpg" style="width: 100%;height:735%">
					<img class="mySlides w3-animate-left" src="images/b.jpg" style="width: 100%;height:735%">
					<img class="mySlides w3-animate-fading" src="images/d.jpg" style="width: 100%;height:735%">
					<img class="mySlides w3-animate-fading" src="images/66.jpg" style="width: 100%;height:735%">
				</div>
	
				<script type="text/javascript">
					var a=0;
					carousel();

					function carousel()
					{
						var i;
						var x= document.getElementsByClassName("mySlides");

						for(i=0; i<x.length; i++)
						{
							x[i].style.display="none";
						}

						a++;  
						if(a > x.length) {a = 1}
							x[a-1].style.display = "block";
							setTimeout(carousel, 5000);
					}
				</script>

				<div class="box">
					<br>
					<h1 style="text-align: center;font-size: 35px;">&nbsp Welcome to the library</h1><br>
					<h1 style="text-align: center;font-size: 25px;">Opens at: 09:00 </h1>
					<h1 style="text-align: center;font-size: 25px;">Closes at: 15:00 </h1>
				</div>
			</div>
		</section>

		<footer>
			<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        footer {
            background-color: black;
            color: white;
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 200px; /* Set a fixed height for the footer */
        }
        .social-icons {
            margin-top: 10px; /* Adjusted margin to center vertically */
        }
        .fa {
            margin:  15px;
            padding: 10px;
            font-size: 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 50%;
        }
        .fa:hover {
            opacity: .7;
        }
        .fa-facebook {
            background: #3B5998;
            color: white;
        }
        .fa-twitter {
            background: #55ACEE;
            color: white;
        }
        .fa-google {
            background: #dd4b39;
            color: white;
        }
        .fa-instagram {
            background: #125688;
            color: white;
        }
        .fa-yahoo {
            background: #400297;
            color: white;
        }
    </style>
</head>
<body>
    <footer>
        <h3>Contact us through social media</h3>
        <div class="social-icons">
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-yahoo"></a>
        </div>
        <p>
            Email: Online.library@gmail.com <br>
            Mobile: +880171*******
        </p>
    </footer>
</body>
</html>
		</footer>
	</div>
</body>
</html>
