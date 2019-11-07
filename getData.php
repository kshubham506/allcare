<?php

    require('connect.php');

    $item=$_GET['item'];
    if(isset($_GET['uid']))
        $uid=$_GET['uid'];
    
    
    if(!isset($_GET['uid']))
    {
       
            $sql="select * from $item;";
            $res=$conn->query($sql);
            $row=$res->fetch_assoc();

            echo json_encode($row['data']); 
    }
    else
    {
        $task=$_GET['task'];
        if($task=="showaddress")
        {
                $msg=['msg'=>'','status'=>1,'sql'=>'','address'=>'','temp'=>''];
            
                $sql="select address from address where uid='".$uid."';";
                $msg['sql']=$sql;
                $res=$conn->query($sql);
            
                if($conn->error)
                        $msg['msg']=$conn->error;
            
                if($res->num_rows>0 ){
                    $row=$res->fetch_assoc();
                    
                    if($row['address']==null){
                        $msg['status']=2;
                        $msg['msg']=$row['address'];
                        $address=json_decode("[{}]");
                    }
                    else{
                        $msg['status']=3;
                        $msg['msg']=$row['address'];
                        
                        $address=($row['address']);
                        $msg['temp']=$address;
                    }
                    
                }
                else{
                    $msg['status']=4;
                    $address=json_decode("[{}]");
                }
            
            $msg['address']=$address;
            echo json_encode($msg);
        }
        else if($task=="saveaddress")
        {
            
            $msg=['msg'=>'','status'=>1,'sql'=>''];
            $orgSize=$_GET['orgSize'];
            $newaddress=$_GET['address'];
           
            
            $sql1="select * from address where uid='$uid';";
            $res=$conn->query($sql1);
             
            if($res->num_rows==0){
                $sql="insert into address (uid,address) values('$uid','$newaddress');";
            }
            else {
                $sql="update address set address='$newaddress' where uid='$uid' ;";
            }
            
          $msg['sql']=$sql;
            $res=$conn->query($sql);
            if($conn->error){
                $msg['msg']=$conn->error;
                $msg['status']=0;
            }

            echo json_encode($msg);
        }
        else if($task=="confirmOrder")
        {
            $msg=['msg'=>'','status'=>1,'sql'=>''];
            
            $time=time();
            $product=($_GET['product']);
            $address=($_GET['address']);
            
            $sql="insert into orders (time,uid,product,address) values($time,'$uid','$product','$address');";
            
            $msg['sql']=$sql;
            $conn->query($sql);
            if($conn->error){
                 $msg['msg']=$conn->error;
                $msg['status']=0;
            }
            $msg['msg']=$time;
             echo json_encode($msg);
            
        }
        else if($task=="getOrders")
        {
            $msg=['msg'=>'','status'=>1,'sql'=>'','product'=>[],'address'=>[],'orderid'=>[]];
            
            
            $sql="select * from orders where uid='$uid' order by time desc;";
            
            $msg['sql']=$sql;
            $res=$conn->query($sql);
            if($conn->error){
                 $msg['msg']=$conn->error;
                $msg['status']=0;
            }
            else{
                if($res->num_rows>0)
                {
                    while($row=$res->fetch_assoc())
                    {
                        array_push($msg['product'],json_decode($row['product'],true));
                        array_push($msg['address'],json_decode($row['address'],true));
                        array_push($msg['orderid'],json_decode($row['time'],true));
                    }
                    
                }else{
                    $msg['msg']="No Orders Yet.";
                    $msg['status']=3;
                }
            }
            //$msg['msg']=$time;
             echo json_encode($msg);
            
        }
        
        
    }

?>