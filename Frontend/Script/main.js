

document.getElementById("review_button").addEventListener('click',async ()=>{
 const file = document.getElementById('filename').value.trim();
 const code = document.getElementById('code').value;
 if (!file|| !code) {
    return alert("Enter filename and code!");
 }

 axios.post("http://localhost/AI_Review/Backend/review.php",{
              Filename: file ,Code :code
              })
               .then(response =>{
                console.log("Server response:", response.data);
               })
                .catch(error =>{
                  console.error("Error",error)
                });
               });

         