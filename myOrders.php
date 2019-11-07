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
                top: 70px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url('includes/image/eclipse.gif') 50% 50% no-repeat rgb(249,249,249);
            }
            
            .card1{
                 border-radius: 20px;
                box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1); 

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
        <script src="includes/js/firebase-auth.js"></script>


    <script>
      
      const userId="<?php echo $_GET['uid'];?>";
     
        
        
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
            
            
           
            $("#loader").show();
           
           //user logged in or logged out
           firebase.auth().onAuthStateChanged(function(user) {
                $("#loader").hide();
                  if (user) 
                  {
                      $("#loggedout").hide();
                      $("#loggedin").show();
                      $("#loggedinimg").attr({ "src": user.photoURL });
                      $("#username").text(user.displayName);
                       console.log("LoggedIn :");     
                  } 
               else 
               {
                    console.log("Not authorized");
                    window.open(index.php);
                  }
                });
            
        
            $scope.addresses = []; 
            $scope.products = []; 
            $scope.orderids = []; 
            $scope.status=0;
            //fetch orders
            jQuery.ajax({
                url: 'getData.php?item=random&task=getOrders&uid='+userId,
                success: function (result) {
                    var tok=JSON.parse(result);
                    //console.log(result);
                    
                    $scope.status=tok.status;
                    if(tok.status==1)
                        {
                            var pdt=tok.product;
                            var addr=tok.address;
                            var orderid=tok.orderid;
                            
                             for(var i=0;i<pdt.length;i++){
                                delete pdt[i]['$$hashKey'];
                                $scope.products.push(pdt[i]);
                                 delete addr[i]['$$hashKey'];
                                $scope.addresses.push(addr[i]);
                                 
                                 delete orderid[i]['$$hashKey'];
                                $scope.orderids.push(orderid[i]);
                            }
                            console.log($scope.addresses);
                            console.log($scope.products);
                        }

                },
                async: false
            });  
                  
            
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
                        
          
               
        
            
               
                          
                
        });
        
        
        

    </script>
    
      
    </head>
    <body  ng-app="home" ng-controller="homeCtr">
        
    <div id="loader" style="display:none"></div>
        
      
    
     <nav class="navbar navbar-dark navbar-scroll navbar-expand-sm fixed-top" id="navbar">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand " href="index.php"><img src="includes/image/logo.png" class="toplogo"></a>
                <div class="collapse navbar-collapse justify-content-end" id="Navbar">
                    <ul class="navbar-nav ">
                            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item active"><a class="nav-link" onclick="partner()" href="#">Partner With Us</a></li>
                        
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
        
    <!--show orders-->
    <div class="container section-gap-top">
        <div class="row">
            <div class="col-12">
                <h3>Your Recent Orders</h3>
            </div>
            
        </div>    
    </div>
        
    <div class="container section-gap-top" style="margin-top:25px;">
        <div class="row">
            <div class="col-12 text-center"  ng-if="status!=1" >
                <p>You have not placed any order yet.</p>
            </div>
            
            
            <div class="col-12"  ng-if="status==1" ng-repeat="address in addresses">
                <div class="card1" style="margin:10px;padding:5px">
                    <div class ="row align-items-center">
                    <div class="d-none d-md-block col-md-3">
                        <img ng-src="includes/image/{{products[$index].image}}"  style="width:100%; overflow: hidden;" >
                    </div>
                    
                    <div class="col-5">
                        <h4>{{products[$index].name}}</h4>
                        <p>{{products[$index].location}}</p>
                        <p>{{products[$index].rate}}</p>
                        
                        <p><b>Ordered For :</b> {{address.name}}
                        <br>
                        {{address.add1}},{{address.add2}},{{address.city}}
                        <br>
                        {{address.pin}},{{address.state}}
                        </p>
                    </div>
                    
                    <div class="col-4 align-self-center">
                        <b>Order Id : </b>{{orderids[$index]}}
                    </div>
                </div>
                </div>
            </div>  
        </div>    
    </div>
        
      

        
    <!-- Start Footer Area -->
	<footer class="footer-area section-gap"  id="footer">
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
           

           function partner(){
               alert("Sned us a mail with all your details like business details, rate , specialization etc.");
               window.open("mailto:3pg3h@ichigo.me","_blank");
           }
           
          
           
           //signout user
           function signout(){
               $("#loader").show();
               firebase.auth().signOut().then(function() {
                   $("#loader").hide();
                   window.open("index.php","_self") ;
                }).catch(function(error) {
                  // An error happened.
                   $("#loader").hide();
                });
           }
           
           
          
           
          
    </script>
    
    </body>
</html>
