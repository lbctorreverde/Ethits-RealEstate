
var uid = "<?php echo $id;?>";
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.16.0/firebase-app.js";
import {getStorage, ref, uploadBytesResumable, getDownloadURL} from "https://www.gstatic.com/firebasejs/9.16.0/firebase-storage.js"
import { getDatabase, ref as sRef, set  } from "https://www.gstatic.com/firebasejs/9.16.0/firebase-database.js"

// adding firebase data
const firebaseConfig = {
    apiKey: "AIzaSyCyDWYfM3b4Owdf8DSWY7u_WHggWba7iR4",
    authDomain: "agentfinderphp.firebaseapp.com",
    databaseURL: "https://agentfinderphp-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "agentfinderphp",
    storageBucket: "agentfinderphp.appspot.com",
    messagingSenderId: "455836025375",
    appId: "1:455836025375:web:bc5dba0687e3aadb690b2a"
};

console.log(firebaseConfig);
const app = initializeApp(firebaseConfig);
const db = getDatabase();
const storage = getStorage(app);
const metadata = {
contentType: 'image/jpeg',
};

const file = document.querySelector("#fileInp").files[0];
const storageRef = ref(storage, 'images/' + file.name);
const name = new Date() + '-' + file.name;
const uploadTask = uploadBytesResumable(storageRef, file, metadata);



const task = uploadBytes(storage, 'agentInfo/', +uid, 'License');

function uploadImage(){
    let storageRef = firebase.storage().ref("agentInfo/"+uid+"/License");
    let uploadTask = storageRef.put(fileItem);

    uploadTask.on("state_changed", (snapshot)=>{
        console.log(snapshot);
    },(error)=>{
        console.log("Error is ", error);
    },()=>{

        uploadTask.snapshot.ref.getdownloadURL().then((url)=>{
            console.log("URL", url);
        })
    })

}