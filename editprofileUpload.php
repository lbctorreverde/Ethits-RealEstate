<?php
use Kreait\Firebase\Value\Email;

include_once 'header.php';
include ('dbconfig.php');
$id = $_SESSION['verified_user_id'];
?>

<style>
    <?php include 'css/editprofile.css' ?>
</style>

<script>
    <?php require_once 'js/editprofile.js' ?>
</script>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-database.js"></script>
<script type = 'module'>
    var uid = "<?php echo $id;?>";
   //paste here your copied configuration code
   const firebaseConfig = {
    apiKey: "AIzaSyCyDWYfM3b4Owdf8DSWY7u_WHggWba7iR4",
    authDomain: "agentfinderphp.firebaseapp.com",
    databaseURL: "https://agentfinderphp-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "agentfinderphp",
    storageBucket: "agentfinderphp.appspot.com",
    messagingSenderId: "455836025375",
    appId: "1:455836025375:web:bc5dba0687e3aadb690b2a"
    };

    firebase.initializeApp(firebaseConfig);

        var firebaseRef = firebase.database().ref('agentInfo/'+uid+'/License');
        firebaseRef.once("value", function(snapshot){
            var data = snapshot.val();
            document.getElementById('license').src = data;
            console.log(data);
        })

        var firebaseRef1 = firebase.database().ref('agentInfo/'+uid+'/Documents');
        firebaseRef1.once("value", function(snapshot){
            var data1 = snapshot.val();
            document.getElementById('docs').src = data1;
            console.log(data1);
        })

        var firebaseRef2 = firebase.database().ref('agentInfo/'+uid+'/Portfolio');
        firebaseRef2.once("value", function(snapshot){
            var data2 = snapshot.val();
            document.getElementById('port').src = data2;
            console.log(data2);
        })


</script>

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <ul class="sidebar nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="editprofile.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="editprofileUpload.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Documents</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="editproperty.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Properties</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="editcontract.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Contract Done</span>
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="content-form col py-3">
            <div>
                <div id="divTitle" class="text-top text-center text-light fs-2">Documents</div>
                <div class="text-center">
                </div>   
            </div>
            <div class="container text-center">
                <div class="row">
                    
                    <div class="col-sm-6">
                        <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" id='docs'alt="example placeholder" class="rounded" style="width: 380px;" height="400"/><br>
                        <label for="inputEmail4" class="form-label">Document</label>
                        <div id="custom1" style="display: none;"  class="text-center">
                        <input type="file" name="files" class="form-control" id="photo1" accept="image/png, image/jpeg">
                        <button type="button" class="btn btn-dark" id="upload1" onclick="uploadImage1()">Upload Image</button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" id='port' alt="example placeholder" class="rounded" style="width: 380px;" height="400"/><br>
                        <label for="inputEmail4" class="form-label">Portfolio</label>
                        <div id="custom2" style="display: none;" class="text-center">
                        <input type="file" name="files" class="form-control" id="photo2" accept="image/png, image/jpeg">
                        <button type="button" class="btn btn-dark" id="upload2" onclick="uploadImage2()">Upload Image</button>
                        </div>
                    </div>
                    <div class="col">
                        <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" id='license' alt="example placeholder" class="rounded" style="width: 500px;" height="320"/><br>
                        <label for="inputEmail4" class="form-label">License</label>
                        <div id="custom" style="display: none;" class="text-center">
                        <input type="file" name="files" class="form-control" id="photo" accept="image/png, image/jpeg">
                        <button type="button" class="btn btn-dark" id="upload" onclick="uploadImage()">Upload Image</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <?php 
                    if(isset($_SESSION['status']))
                    {
                        echo "<p class='alert alert-success'>".$_SESSION['status']."</p>";
                        unset($_SESSION['status']);
                    }
                ?>
                <br><br>
                <div class="d-flex col-12 justify-content-center">
                    <button name="btn_Edit" id="btn_Edit" onclick="setDisable()" class="btn btn-dark" style="display: block;">Edit</button>
                    <button name="btn_Cancel" id="btn_Cancel" onclick="window.location.href='editprofileUpload.php';" class="btn btn-dark" style="display: none;">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function setDisable(){
        document.getElementById("custom").style.display = "block";
        document.getElementById("custom1").style.display = "block";
        document.getElementById("custom2").style.display = "block";
        document.getElementById("btn_Cancel").style.display = "block";
        document.getElementById("btn_Edit").style.display = "none";
    }

    // function setCancel(){
    //     document.getElementById("btn_Cancel").style.display = "none";
    //     document.getElementById("btn_Edit").style.display = "block";
    //     document.getElementById("custom").style.display = "none";
    //     document.getElementById("custom1").style.display = "none";
    //     document.getElementById("custom2").style.display = "none";

    // }
</script>
<script>
    var uid = "<?php echo $id;?>";
   // Initialize Firebase
   function uploadImage() {
      const ref = firebase.storage().ref();
      const file = document.querySelector("#photo").files[0];
      console.log(file);
      if (typeof file === "undefined") {
        return alert('No image selected');
      }

      //const name = +new Date() + "-" + file.name;
      const metadata = {
         contentType: file.type
      };
      const getRef = "agentInfo/"+uid+"/License";
      const task = ref.child(getRef).put(file, metadata);


      task.then(snapshot => snapshot.ref.getDownloadURL()).then(url => {
      console.log(url);
      alert('image uploaded successfully');
    //   document.querySelector("#image").src = url;
        firebase.database().ref('agentInfo/'+uid+'/').update({
            License: url
        }).then(() => {
            console.log("URL added in database successfully.")
        }).catch(e => console.log(e))


    })
   .catch(console.error);
   }
   const errorMsgElement = document.querySelector('span#errorMsg');


   function uploadImage1() {
      const ref = firebase.storage().ref();
      const file = document.querySelector("#photo1").files[0];
      if (typeof file === "undefined") {
        return alert('No image selected');
      }

      //const name = +new Date() + "-" + file.name;
      const metadata = {
         contentType: file.type
      };
      const getRef = "agentInfo/"+uid+"/Documents";
      const task = ref.child(getRef).put(file, metadata);


      task.then(snapshot => snapshot.ref.getDownloadURL()).then(url => {
      console.log(url);
      alert('image uploaded successfully');

        firebase.database().ref('agentInfo/'+uid+'/').update({
            Documents: url
        }).then(() => {
            console.log("URL added in database successfully.")
        }).catch(e => console.log(e))


   })
   .catch(console.error);
   }
   function uploadImage2() {
      const ref = firebase.storage().ref();
      const file = document.querySelector("#photo2").files[0];
      if (typeof file === "undefined") {
        return alert('No image selected');
      }

      //const name = +new Date() + "-" + file.name;
      const metadata = {
         contentType: file.type
      };
      const getRef = "agentInfo/"+uid+"/Portfolio";
      const task = ref.child(getRef).put(file, metadata);

      task.then(snapshot => snapshot.ref.getDownloadURL()).then(url => {
      console.log(url);

        firebase.database().ref('agentInfo/'+uid+'/').update({
            Portfolio: url
        }).then(() => {
            console.log("URL added in database successfully.")
        }).catch(e => console.log(e))

    alert('image uploaded successfully');
   })
   .catch(console.error);
   }

</script>
</html>