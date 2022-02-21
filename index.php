<!doctype html>
<html>
<head>
 
   <meta name="robots" content="noindex,nofollow">
   <title>AJAX Pet Adoption Agency</title>
   <style>
       #myForm div{
        margin-bottom:2%;
        }
   </style>
   <script src="https://code.jquery.com/jquery-latest.js"></script>
   
</head>
<body>
<h2>AJAX Pet Adoption Agency</h2>
<p>Make some choices, and reveal your pet!</p>
<div id="output">
<form id="myForm" action="" method="get">

   <div id="pet_feels">
       <h3>Feels</h3>
       <p>Please choose how you would like your pet to feel:</p>
       <input type="radio" name="feels" value="fluffy" required="required">fluffy <br />
       <input type="radio" name="feels" value="scaly">scaly <br />
   </div>
  
   <div id="pet_likes">
       <h3>Likes</h3>
       <p>Please tell us what your pet will like:</p>
       <input type="radio" name="likes" value="petted" required="required">to be petted <br />
       <input type="radio" name="likes" value="ridden">to be ridden <br />
   </div>
  
    <div id="pet_eats">
       <h3>Eats</h3>
       <p>Please tell us what your pet likes to eat:</p>
       <input type="radio" name="eats" value="carrots" required="required">carrots <br />
       <input type="radio" name="eats" value="pets">other people's pets <br />
   </div>
  
   <div id="pet_name">
       <h3>Pet Name</h3>
       <p>Please tell us the name of your pet's name:</p>
       <input type="text" name="name"</br>
   </div>
         
   <div><input type="submit" value="submit it!" /></div>
</form>
</div>
<p><a href="index.php">RESET</a></p>
<script>
            function titleCase(value) {
                value = value.toLowerCase().split(' ');
                for (var i = 0; i < value.length; i++) {
                  value[i] = value[i].charAt(0).toUpperCase() + value[i].slice(1); 
                  // value of zero (Kim) - K to uppercase + value of 1 (i and everything after to concatenate)
                }
                return value.join(' ');
              }

    $("document").ready(function(){
        
        //hide likes, eats, and name
        $('#pet_likes').hide();
        $('#pet_eats').hide();
        $('#pet_name').hide();
        

        //on click of feels, likes is shown
         $('#pet_feels').click(function(){
           $('#pet_likes').slideDown(200);
         });

        //on click of likes, eats is shown
         $('#pet_likes').click(function(){
           $('#pet_eats').slideDown(200);
         });

        //on click of eats, name is shown
         $('#pet_eats').click(function(){
           $('#pet_name').slideDown(200);
         });
        
        $('#myForm').submit(function(e){
            e.preventDefault();//no need to submit as you'll be doing AJAX on this page
            let feels = $("input[name=feels]:checked").val();
            let likes = $("input[name=likes]:checked").val();
            let eats = $("input[name=eats]:checked").val();
            let name = $("input[name=name]").val();
            let titleName = titleCase(name);
            titleName = `<span style="background-color: orange">${titleName}</span>`;
            let pet = "ERROR";

            if(feels=="fluffy" && likes=="petted" && eats=="carrots"){
              pet = "rabbit";
            }

            if(feels=="fluffy" && likes=="petted" && eats=="pets"){
              pet = "golden";
            }

            if(feels=="fluffy" && likes=="ridden" && eats=="carrots"){
              pet = "hedgehog";
            }         

            if(feels=="fluffy" && likes=="ridden" && eats=="pets"){
              pet = "lab";
            }          

            if(feels=="scaly" && likes=="petted" && eats=="carrots"){
              pet = "pig";
            }

            if(feels=="scaly" && likes=="petted" && eats=="pets"){
              pet = "pom";
            }

            if(feels=="scaly" && likes=="ridden" && eats=="carrots"){
              pet = "kitten";
            }
          
            if(feels=="scaly" && likes=="ridden" && eats=="pets"){
              pet = "velociraptor";
            }
            //alert(feels);

            //where we'll store all data to show
            var output = '';

            output += `<p>Congratulations! You have a new pet ${pet}.</p>`;
            output += `<p>Your pet feels ${feels}.</p>`;
            output += `<p>Your pet likes to be ${likes}.</p>`;
            output += `<p>Your pet likes to eat ${eats}.</p>`;
            output += `<p>Your pet's name is ${titleName}.</p>`;

            //get data frim server side page using AJAX
            $.get( "includes/get_pet.php", { critter: pet } )
             .done(function( data ) {
             //alert( "Data Loaded: " + data );
               $('#output').html(data + output);
             })
            .fail(function(xhr, status, error) {
                 //Ajax request failed.
                 var errorMessage = xhr.status + ': ' + xhr.statusText
                 alert('Error - ' + errorMessage);
             });

            
            //lets output info about the pet to the page
        
        });

    });

   </script>
</body>
</html>
