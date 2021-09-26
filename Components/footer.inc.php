           
           </div>
        </div>  
     </div> 
     <nav class="toolbar pb-1 fixed-bottom shadow-lg">
         <div class="FooterLine"></div>
        <div class="p-1 pl-4 mt-1">
            <span style="font-size: 12px;">Supported by: Marcopolo</span>
            <span class="float-right pr-3" style="font-size: 12px;">
                <?php 
                    echo "Signed In as: ".$_SESSION["company"]." /".$_SESSION["name"]." ".$_SESSION["last_name"];
                ?>
            </span>
          <h1></h1>
        </div>
     </nav>
</body>
</html>
<script type="text/javascript">

    $(document).ready(function(){  
        $('#user_data').DataTable();  
    }); 

    function hide() {
        var sidebar = document.getElementsByClassName("sidebar")[0];
        var content = document.getElementsByClassName("wrapper")[0];
        var sidebarContent = document.getElementsByClassName("sidebarContent")[0];  

        if (sidebar.style.width == "0%") {
            sidebar.style.width = "20%";
            content.style.width="80%";
            document.getElementById("btn").className = "fas fa-arrow-left";
        }
        else {
            sidebar.style.width = "0%";
            content.style.width = "100%";
            document.getElementById("btn").className = "fas fa-arrow-right";
        }

        sidebar.style.transitionduration=".3s";
        sidebar.style.transitiontimingfunction="ease-in"
    }

    function menue(id) {
        if (id == 10) {
            if (document.getElementById("service").style.display == "block") {
                document.getElementById("service").style.display = "none";
                document.getElementById("first").className = "fas fa-angle-right";
            }
            else {
                document.getElementById("first").className = "fas fa-angle-down";
                document.getElementById("second").className = "fas fa-angle-right";
                document.getElementById("third").className = "fas fa-angle-right";
                document.getElementById("service").style.display = "block";
                document.getElementById("business").style.display = "none";
                document.getElementById("product").style.display = "none";

            }
        }else if (id == 20) {
            if (document.getElementById("business").style.display == "block") {
                document.getElementById("business").style.display = "none";
                document.getElementById("second").className = "fas fa-angle-right";
            }
            else {
                document.getElementById("first").className = "fas fa-angle-right";
                document.getElementById("second").className = "fas fa-angle-down";
                document.getElementById("third").className = "fas fa-angle-right";
                document.getElementById("service").style.display = "none";
                document.getElementById("business").style.display = "block";
                document.getElementById("product").style.display = "none";
            }
        }else if (id == 30) {
            if (document.getElementById("product").style.display == "block") {
                document.getElementById("product").style.display = "none";
                document.getElementById("third").className = "fas fa-angle-right";
            }
            else {
                document.getElementById("first").className = "fas fa-angle-right";
                document.getElementById("second").className = "fas fa-angle-right";
                document.getElementById("third").className = "fas fa-angle-down";
                document.getElementById("service").style.display = "none";
                document.getElementById("business").style.display = "none";
                document.getElementById("product").style.display = "block";
            }
        }
    }

    // window.onload = function(){
    //     var m=document.getElementById("menu");
    //     document.onclick = function(e){
    //         if(e.target.id == 'button'){
    //             m.style.visibility = 'visible';
    //         }
    //         if(e.target.id !== 'menu' && e.target.id !== 'button'){
    //             m.style.visibility = 'hidden';
    //         }
    //     };
    // };
    
    const inpFile = document.getElementById("inptFile");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = document.getElementById("image-preview__image");    
    const previewDefaultText = document.getElementById("image-preview__defualt-text");
    
    if(inpFile !==null){
        inpFile.addEventListener("change",  function(){
            const file = this.files[0];
            
            if(file){
                const reader = new FileReader();
                previewDefaultText.style.display = "none";
                previewImage.style.display = "block";
                
                reader.addEventListener("load", function(){
                    previewImage.setAttribute("src", this.result);
                });
                reader.readAsDataURL(file);
            }else{
                previewDefaultText.style.display = null;
                previewImage.style.display = null;
                previewImage.setAttribute("src", "");
            }
        });
    }
    
    
    window.onload = function(){
        
        $.ajax({
            type: "POST",
            url: 'reservedDates',
            data: {room: 1},
            success: function(data)
            {
                var jsonData = JSON.parse(data);
                
                var disabledArr = jsonData.date;
                $("#checkin").daterangepicker({
                    singleDatePicker: true,
                    isInvalidDate: function(arg){
                        // Prepare the date comparision
                        var thisMonth = arg._d.getMonth()+1;   // Months are 0 based
                        if (thisMonth<10){
                            thisMonth = "0"+thisMonth; // Leading 0
                        }
                        var thisDate = arg._d.getDate();
                        if (thisDate<10){
                            thisDate = "0"+thisDate; // Leading 0
                        }
                        var thisYear = arg._d.getYear()+1900;   // Years are 1900 based
            
                        var thisCompare = thisMonth +"/"+ thisDate +"/"+ thisYear;
                        console.log(thisCompare);
            
                        if($.inArray(thisCompare,disabledArr)!=-1){
                            console.log("      ^--------- DATE FOUND HERE");
                            return arg._pf = {userInvalidated: true};
                        }
                    }
            
                }, function (start, end, label) {
                        checkIn = (moment(start).format("DD-MM-YYYY"));
                });
            }   
        });

        $.ajax({
            type: "POST",
            url: 'reservedDates',
            data: {room: 1},
            success: function(data)
            {
                var jsonData = JSON.parse(data);
                
                var disabledArr = jsonData.date;
                $("#checkout").daterangepicker({
                    singleDatePicker: true,
                    isInvalidDate: function(arg){
                        // Prepare the date comparision
                        var thisMonth = arg._d.getMonth()+1;   // Months are 0 based
                        if (thisMonth<10){
                            thisMonth = "0"+thisMonth; // Leading 0
                        }
                        var thisDate = arg._d.getDate();
                        if (thisDate<10){
                            thisDate = "0"+thisDate; // Leading 0
                        }
                        var thisYear = arg._d.getYear()+1900;   // Years are 1900 based
            
                        var thisCompare = thisMonth +"/"+ thisDate +"/"+ thisYear;
                        console.log(thisCompare);
            
                        if($.inArray(thisCompare,disabledArr)!=-1){
                            console.log("      ^--------- DATE FOUND HERE");
                            return arg._pf = {userInvalidated: true};
                        }
                    }
            
                }, function (start, end, label) {
                        checkIn = (moment(start).format("DD-MM-YYYY"));
                });
                
            }   
        });
        
    };


    // Get the modal
var RoomModal = document.getElementById("RoomModal");

// Get the button that opens the modal
var RoomBtn = document.getElementById("RoomBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
RoomBtn.onclick = function() {
    RoomModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    RoomModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == RoomModal) {
    RoomModal.style.display = "none";
  }
}



// Get the modal
var ServiceModal = document.getElementById("ServiceModal");

// Get the button that opens the modal
var ServiceBtn = document.getElementById("ServiceBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[1];

// When the user clicks on the button, open the modal
ServiceBtn.onclick = function() {
    ServiceModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    ServiceModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == ServiceModal) {
    ServiceModal.style.display = "none";
  }
}




function add_room() {
        var room_type_id = $('#1').val();
        var room_type = $('#1 option:selected').html();
        var price = $('#price').val();

        var room = document.getElementById('room');
        
        var newRow = room.insertRow(room.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);

        cell1.innerHTML = room_type_id;
        cell1.setAttribute("hidden","")
        cell2.innerHTML = room_type;
        cell3.innerHTML = price;
        cell4.innerHTML = "<input type='button' name='btnRemove' onclick='RemoveRoom();' value='Remove' class='btn btn-danger btn-sm p-0 pl-1 pr-1'>";
    }


    function RemoveRoom() {
        var RemoveRoom = document.getElementById('room'), Index;
        for (var i = 1; i < RemoveRoom.rows.length; i++) {
            RemoveRoom.rows[i].cells[3].onclick = function () {
                Index = this.parentElement.rowIndex;
                RemoveRoom.deleteRow(Index);
            };
        }
    }

    function add_service() {
        var service_id = $('#2').val();
        var service_name = $('#2 option:selected').html();
        var price = $('#service_price').val();

        var service = document.getElementById('services');
        
        var newRow = service.insertRow(service.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);

        cell1.innerHTML = service_id;
        cell1.setAttribute("hidden","");
        cell2.innerHTML = service_name;
        cell3.innerHTML = price;
        cell4.innerHTML = "<input type='button' name='btnRemove' onclick='RemoveService();' value='Remove' class='btn btn-danger btn-sm p-0 pl-1 pr-1'>";
    }


    function RemoveService() {
        var RemoveService = document.getElementById('service'), Index;
        for (var i = 1; i < RemoveService.rows.length; i++) {
            RemoveService.rows[i].cells[3].onclick = function () {
                Index = this.parentElement.rowIndex;
                RemoveService.deleteRow(Index);
            };
        }
    }


// $(document).ready(function() {
//     $('#loginform').submit(function(e) {
//         e.preventDefault();
//         $.ajax({
//             type: "POST",
//             url: 'loginctrl.php',
//             data: $(this).serialize(),
//             success: function(response)
//             {
//                 var jsonData = JSON.parse(response);
  
//                 // user is logged in successfully in the back-end
//                 // let's redirect
//                 if (jsonData.success == "1")
//                 {
//                     location.href = 'Dashboard.php';
//                 }
//                 else
//                 {
//                     alert('Invalid Credentials!');
//                 }
//            }
//        });
//      });
// });

</script>

