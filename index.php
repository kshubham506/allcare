<?php

    require('connect.php');
    if ($conn->connect_error)
    {
        alert("Database Connection Error : ".$conn->error);
    }

   
    
     
?>

<!doctype html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>All Care | One Stop Solution For All</title>
       
        <link rel="stylesheet" href="includes/css/bootstrap.min.css">
        <link rel="stylesheet" href="includes/css/font-awesome.min.css">
        <link rel="stylesheet" href="includes/css/main.css">
        <link rel="stylesheet" href="includes/css/owl.carousel.css">
        <link rel="stylesheet" href="includes/css/owl.theme.default.min.css">
        <!--<link rel="stylesheet" href="includes/slick/slick.css">
        <link rel="stylesheet" href="includes/slick/slick-theme.css">-->
        <link rel="stylesheet" href="includes/css/animate.min.css">        
        
        <style>
            #loader{
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url('includes/image/eclipse.gif') 50% 50% no-repeat rgb(249,249,249);
            }
        </style>
        
        
    <script src="includes/js/jquery-3.2.1.min.js"></script>
    <script src="includes/js/bootstrap.bundle.min.js"></script>
    <script src="includes/js/owl.carousel.min.js"></script>
    <!--<script src="includes/slick/slick.min.js"></script>-->
    <script src="includes/js/angular.min.js"></script>
    <!--
    <script src="https://cdn.firebase.com/libs/angularfire/2.3.0/angularfire.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.2.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.2.2/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.2.2/firebase-auth.js"></script>
    -->
        <script src="includes/js/angularfire.min.js"></script>
        <script src="includes/js/firebase-app.js"></script>
        <script src="includes/js/firebase-analytics.js"></script>
        <!--<script src="includes/js/firebase-auth.js"></script>-->
<script src="https://www.gstatic.com/firebasejs/7.2.2/firebase-auth.js"></script>

    <script>
      
     
      var firebaseConfig = {
        apiKey: "AIzaSyCfqV0av6NOMH1RMzJGZtKjsSmS6tZYuIM",
        authDomain: "allcare-95109.firebaseapp.com",
        databaseURL: "https://allcare-95109.firebaseio.com",
        projectId: "allcare-95109",
        storageBucket: "allcare-95109.appspot.com",
        messagingSenderId: "171970827611",
        appId: "1:171970827611:web:c7cb1e87b3fab278cb767e",
        measurementId: "G-NZ9BYJJN9L",
        databaseURL: "https://allcare-95109.firebaseio.com/",
        storageBucket: "allcare-95109.appspot.com"


      };
      
      firebase.initializeApp(firebaseConfig);
      firebase.analytics();
      //var database = firebase.database();
        
        
        
     
       var app = angular.module("home", ["firebase"]);

        
        app.controller("homeCtr", function($scope,  $firebaseArray) {
         
            
                
                $scope.carpenters = [];
                $scope.electricians = [];
            
                var xmlhttp = new XMLHttpRequest();
                 //carpenters
                xmlhttp.open("GET", "getData.php?item=carpenters", false);
                xmlhttp.send();
                if (xmlhttp.status == 200) {
                                    
                    var tok=JSON.parse(JSON.parse(xmlhttp.responseText));

                    for(var i=0;i<tok.length;i++){
                        delete tok[i]['$$hashKey'];
                        $scope.carpenters.push(tok[i]);
                    }

                    //console.log($scope.carpenters);

                }
                //electricians
                xmlhttp.open("GET", "getData.php?item=electrician", false);
                xmlhttp.send();
                if (xmlhttp.status == 200) {

                        var tok=JSON.parse(JSON.parse(xmlhttp.responseText));

                        for(var i=0;i<tok.length;i++){
                            delete tok[i]['$$hashKey'];
                            $scope.electricians.push(tok[i]);
                           
                        }

                       // console.log($scope.electricians);

                }
              
              
            
            
                $scope.placeOrder = async function(id) {	
                    $("#loader").show();
                    await firebase.auth().onAuthStateChanged(function(user) {
                          if (user) {
                                console.log("Place Order : "+id);
                              userID=user.uid;
                              window.open("selectAddress.php?uid="+user.uid+"&product="+JSON.stringify(id),"_self");
                          }
                           else{
                                 console.log("Please Login");
                                signin();
                           }
                    });
		        }
                
                $scope.myorders=async function(){
                    await firebase.auth().onAuthStateChanged(function(user) {
                          if (user) {
                             
                               window.open("myorders.php?uid="+user.uid,"_self");
                          }
                           else{
                                 console.log("Please Login");
                                signin();
                           }
                    });
                    
                }

                /*var ref = database.ref("carpentry");
                var ref1 = database.ref("electricians");
            
                $scope.carpenters =  $firebaseArray(ref);
                $scope.electricians = $firebaseArray(ref1);*/
                          
                
        });
        
        
        

    </script>
    
      
    </head>
    <body  ng-app="home" ng-controller="homeCtr">
        
    <div id="loader" style="display:none"></div>
        
      
    
     <nav class="navbar navbar-dark navbar-expand-sm fixed-top" id="navbar">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand " href="index.php"><img src="includes/image/logo.png" class="toplogo"></a>
                <div class="collapse navbar-collapse justify-content-end" id="Navbar">
                    <ul class="navbar-nav ">
                            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                            
                        
                            <li style="display:none" id="loggedin" class="nav-item dropdown">
                                 <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> 
                                     <img  class="rounded-circle" id="loggedinimg" style="width:25px;height:25px;" src="">
                                </a>
                                <ul class="dropdown-menu" style="padding:10px;">
                                    <li><a style="color:black" id="username" href="#"></a></li>
                                    <li><a style="color:black" ng-click="myorders()" href="#">My Orders</a></li>
                                    <li><a onclick="signout()" style="color:black" href="#">Sign Out</a></li>
                                </ul>
                            </li>
                            <li style="display:block" id="loggedout" class="nav-item ">
                                 <a  href="#" class="nav-link "> 
                                     <img onclick="signin()" class="rounded-circle" style="width:25px;height:25px;" src="includes/image/profile.jpg">
                                </a>
                            </li>
                
                    </ul>

                </div>
            </div>
    </nav>

    <section class="home_banner_area" >
            <div class=" banner_inner ">
				<div class=" container">
					<div class="row banner_content ">
						<div class="col-lg-9 " id="banner_text">
							<h2>One Stop Solution For All Your Needs</h2>
							<p>Be it carpentry, plumbing, electricity , we have it all.</p>
							
						</div>
						<div class="col-lg-3 " id="banner_img">
							<div class="banner_map_img">
								<img  class="img0 img-fluid" style="opacity: 0;" src="includes/banner/right-mobile.jpg" alt="mobile_home">
							</div>
						</div>
					</div>
				</div>
            </div>
    </section>
        
        
    <!--Carpenters -->
	<section class="feature-area section-gap-top" id="features">
		<div class="container">
			<div class="row ">
				<div class="col-lg-6 offset-0.5">
					<div class="section-title ">
						<h4>Capentry</h4>
					</div>
				</div>
			</div>
        
            <div  class="carpen row owl-carousel owl-theme" style="margin-top: 10px;">

                <div  style="margin-bottom: 50px;margin-left: 20px;" ng-repeat="carpenter in carpenters" >

                    <div class="single-feature">

                        <div class="row justify-content-center">
                            <div class="col-6 " style="display: inline-block;">
                                <img src="includes/image/enterprise.jpeg"  style="width:100px; overflow: hidden;" >
                            </div>
                        </div>

                        <h3>{{carpenter.name}}</h3>

                        <p>
                           Specializes in Interiors , 15+ years experience.
                        </p>

                         <p >
                            <b>Location  :</b>opps 51 block
                        </p>
                        
                        <p >
                            <b>Rate :</b>Rs. 100/ hr
                        </p>
                      
                        <p >
                            <b>Rating :</b>4.5/5
                        </p>
                        <br>
                        <p style="margin: auto;  float:right">
                            <button ng-click="placeOrder(carpenter)">ORDER</button>
                        </p>

                    </div>
                </div>

        </div>
          
		</div>
	</section>
	<!-- End carpneters Area -->
        
        
     <!--Electricains -->
	<section class="feature-area  section-gap" id="features">
		<div class="container">
			<div class="row ">
				<div class="col-lg-6 offset-0.5">
					<div class="section-title ">
						<h4>Electricians</h4>
					</div>
				</div>
			</div>
            
            <div class="electrici row owl-carousel owl-theme" style="margin-top: 10px;">

                <div style="margin-bottom: 50px;margin-left: 20px;" ng-repeat="electrician in electricians" >

                    <div class="single-feature">

                        <div class="row justify-content-center">
                            <div class="col-6 " style="display: inline-block;">
                                <img src="includes/image/enterprise.jpeg"  style="width:100px; overflow: hidden;" >
                            </div>
                        </div>

                        <h3>Sk Enterprises</h3>

                        <p>
                           Specializes in Interiors , 15+ years experience.
                        </p>

                         <p >
                            <b>Location  :</b>opps 51 block
                        </p>
                        
                        <p >
                            <b>Rate :</b>Rs. 100/ hr
                        </p>
                      
                        <p >
                            <b>Rating :</b>4.5/5
                        </p>
                        <br>
                        <p style="margin: auto;  float:right">
                            <button>ORDER</button>
                        </p>

                    </div>
                </div>

        </div>
        
               
          
		</div>
	</section>
	<!-- End vElectricains Area -->    
        
        
        
    <!-- Start Footer Area -->
	<footer class="footer-area section-gap" id="footer">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-3 single-footer-widget">
					<h4>ALL CARE</h4>
					<ul>
						<li><a href="privacy_policy.html">Privacy Policy</a></li>
						
					</ul>
				</div>
				
               
			
			</div>
            
            <br>
            
            <div class="row">
              <div class="col-12" align="center">
                  <a href="https://t.me/sktechhub" style="color:white"><i class="fa fa-telegram" aria-hidden="true" style="font-size: 34px;padding-right: 20px;"></i></a>
                  <a href="mailto:3pg3h@ichigo.me" style="color:white"><i class="fa fa-envelope" aria-hidden="true" style="font-size: 34px;padding-right: 20px;"></i></a>
                </div>
            </div>
            
          
		</div>
	</footer>
	<!-- End Footer Area -->
    
       <script>
           var sign=false;
           //scroll fucntion
            $(function () {
                $(document).scroll(function ()
                   {
                        var $nav = $(".navbar");
                        $nav.toggleClass('navbar-scroll', $(this).scrollTop() > $nav.height());
                    });
            }); 

           //loading cards
          
           setTimeout(function(){
                $('.carpen').owlCarousel({
                    margin: 10,
                    nav:true,
                    dots: true,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        768: {
                            items: 2,
                        },
                    }
                });
               
               $('.electrici').owlCarousel({
                    margin: 10,
                    nav:true,
                    dots: true,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        768: {
                            items: 2,
                        },
                    }
                });
               
               },500);     
           
               
                
          
           
           //user logged in or logged out
           firebase.auth().onAuthStateChanged(function(user) {
                  if (user) {
                      $("#loggedout").hide();
                      $("#loggedin").show();
                      $("#loggedinimg").attr({ "src": user.photoURL });
                      $("#username").text(user.displayName);
                     // console.log("LoggedIn :"+JSON.stringify(user));
                  } else {
                    console.log("Logged Out");
                      $("#loggedout").show();
                      $("#loggedin").hide();
                  }
                });
           
           //login user
           function signin(){
               $("#loader").show();
               sign=true;
               var provider = new firebase.auth.GoogleAuthProvider();
               firebase.auth().signInWithRedirect(provider);
           }
           
           //signout user
           function signout(){
               $("#loader").show();
               firebase.auth().signOut().then(function() {
                   $("#loader").hide();
                   document.location.reload() ;
                }).catch(function(error) {
                  // An error happened.
                   $("#loader").hide();
                });
           }
           
           
           firebase.auth().getRedirectResult().then(function(result) {
              if (result.credential) {              
                var token = result.credential.accessToken;
              }
              var user = result.user;
                console.log("Logged In USer : "+user.toString);
            }).catch(function(error) 
                     {
               
              var errorCode = error.code;
              var errorMessage = error.message;
              var email = error.email;
              var credential = error.credential;
              console.log("Error WHile SIgning : "+error.code+" , "+error.message);
               if(sign)
                    alert("Error while Signing You In! \nError Code : "+errorCode+"\nDetails : "+errorMessage);
            }).finally(function(){
                $("#loader").hide();   
            });
           
          
    </script>
    
    </body>
</html>