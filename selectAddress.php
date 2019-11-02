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
      const productDesc=<?php echo ($_GET['product']);?>;
        
        
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
            
            $scope.addresses = []; 
            
           
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
            
        
            //fetch saved address
            jQuery.ajax({
                url: 'getData.php?item=address&task=showaddress&uid='+userId,
                success: function (result) {
                    var tok=JSON.parse(result);
                    
                    if(tok.status==3){
                            console.log(tok.address);
                            console.log(JSON.parse(tok.address));
                           // console.log(JSON.parse(JSON.parse(tok.address)));
                            var addR=JSON.parse(tok.address );
                            //console.log("Size : "+addR.length+" ,"+result);
                            for(var i=0;i<addR.length;i++){
                                delete addR[i]['$$hashKey'];

                                $scope.addresses.push(addR[i]);
                            }
                    }
                    console.log($scope.addresses);

                },
                async: false
            });  
                                     
                        
          $scope.saveAddress = async function() {
              
                $("#loader").show();
                var name=$("#pname").val();
                var phone=$("#pphone").val();
                var pin=$("#ppin").val();
                var add1=$("#padd1").val();
                var add2=$("#padd2").val();
                var land=$("#pland").val();
                var city=$("#pcity").val();
                var state=$("#pstate").val();
              var k=1;var msg="";
              if(name==undefined || name.length<2){
                  k=0;
                  msg+="<br>Please enter your full name.";
              }
              if(phone==undefined || phone.length!=10){
                  k=0;
                  msg+="<br>Please enter correct phone number.";
              }
              if(pin==undefined || pin.length!=6){
                  k=0;
                  msg+="<br>Invalid Pin Code.";
              }
              if(add1==undefined || add1.length<5){
                  k=0;
                  msg+="<br>Please enter corect address.";
              }
              if(city==undefined || city.length<2){
                  k=0;
                  msg+="<br>Please enter correct city name.";
              }
              if(state==undefined || state.length<2){
                  k=0;
                  msg+="<br>Please enter correct state.";
              }
              
              
              if(k==1){
                  $("#loader").hide();
                  document.getElementById("errormsg").innerHTML=msg;
                  
                  
                  
                  
              }
              else{
                  //ready to insert
                  $("#loader").hide();
                  console.log("Insert ADdress");
                  
                  $("#loader").show();
                  const orgSize=$scope.addresses.length;
                  var abc={"name":"hello122","desc":"nice122"};
                  $scope.addresses.push(abc);
                  console.log(JSON.stringify($scope.addresses));
                  //fetch saved address
                    jQuery.ajax({
                        url: 'getData.php?item=address&task=saveaddress&uid='+userId+'&orgSize='+orgSize+'&address='+JSON.stringify($scope.addresses),
                        success: function (result) {
                            $("#loader").hide();
                            var tok=JSON.parse(result);

                            if(tok.status==0)
                                alert("Error : "+tok.msg)

                        },
                        async: false
                    }); 
              }
                
              
            }
            
               
          $scope.placeOd = async function(addr) {
              window.open("confirmOrder.php?uid="+userId+"&address="+JSON.stringify(addr)+"&product="+JSON.stringify(productDesc),"_self");
          };
            
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
        
    <!--saved address section-->
    <div class="container section-gap-top">
        <div class="row">
            <div class="col-12">
                <h3>Saved Address</h3>
            </div>
            
            <div class="container row">
                <div ng-if="addresses.length==0" class="col">
                    <p >You have not saved any address yet!</p>
                </div>
                <div class="col" ng-repeat="address in addresses">
                    {{address}}
                    
                    <div class=" row">
                        <div class="col-12 ">
                            <button type="button" class="btn btn-primary btn-sm " ng-click="placeOd(address)" style="padding:7px;" name="sub">ORDER</button>        
                        </div>
                    </div>
                </div>  
                
            </div>
        </div>    
    </div>
        
    <!--save an address-->
    <div class="container section-gap-top" style="margin-bottom:30px;">
            <div class="row">
                <div class="col-12">
                    <h3>Add New Address</h3>
                </div>
                
                <div class="col-12 ">
                    <p id="errormsg" style="color:red"></p>
                </div>
                
                <div class="container row" style="margin-top:30px;">
                <div class="col">
                   
                      <form action=""  enctype="multipart/form-data">

                            <div class="form-group row">
                                    <label for="pname" class="col-3 col-form-label ">Full Name</label>
                                    <div class="col-6 ">
                                        <input type="text" class="form-control" id="pname" placeholder="Full Name">
                                    </div> 
                            </div>  
                           
                            <div class="form-group row">
                                    <label for="pphone" class="col-3 col-form-label">Phone</label>
                                    <div class="col-6 ">
                                        <input type="number" class="form-control" id="pphone" placeholder="Phone Number">
                                    </div> 
                            </div>
                   
                            <div class="form-group row">
                                    <label for="ppin" class="col-3 col-form-label">Pin Code</label>
                                    <div class="col-6 ">
                                        <input type="number" class="form-control" id="ppin" placeholder="Pin Code">
                                    </div> 
                            </div>
                          
                           <div class="form-group row">
                                    <label for="padd1" class="col-3 col-form-label">Address Line 1</label>
                                    <div class="col-6 ">
                                        <input type="text" class="form-control" id="padd1" placeholder="Address Line 1">
                                    </div> 
                            </div>
                          
                          <div class="form-group row">
                                    <label for="padd2" class="col-3 col-form-label">Address Line 2</label>
                                    <div class="col-6 ">
                                        <input type="text" class="form-control" id="padd2" placeholder="Address Line 2">
                                    </div> 
                            </div>
                          
                          <div class="form-group row">
                                    <label for="pland" class="col-3 col-form-label">Landmark</label>
                                    <div class="col-6 ">
                                        <input type="text" class="form-control" id="pland" placeholder="Landmark">
                                    </div> 
                            </div>
                          
                          <div class="form-group row">
                                    <label for="pcity" class="col-3 col-form-label">City</label>
                                    <div class="col-6 ">
                                        <input type="text" class="form-control" id="pcity" placeholder="City">
                                    </div> 
                            </div>
                          
                          <div class="form-group row">
                                    <label for="pstate" class="col-3 col-form-label">State</label>
                                    <div class="col-6 ">
                                        <input type="text" class="form-control" id="pstate" placeholder="State">
                                    </div> 
                            </div>
                            
                           

                            <!--submit button-->
                             <div class=" row">
                                <div class="col-12 ">
                                    <button type="button" class="btn btn-primary btn-sm " ng-click="saveAddress()" style="padding:7px;" name="sub">ADD ADDRESS</button>        
                                </div>
                            </div>

                        </form>
                    
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
